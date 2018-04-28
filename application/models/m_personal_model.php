<?php


class m_personal_model extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database();
        $this->load->model('public_tools');
		$this->load->library('Datamodel');
        $this->load->library('pagination');
		
	}
	
	public function deletepersonal($id) 
	{
		$this->db->where('id', $id);
		//$this->db->delete('account');

		$d['isdelete'] = 1;
        $this->db->update('account',$d);
	}	
	
	public function insertpersonal($data)
	{

		$this->db->set('account',$data->account);
		$this->db->set('password',$data->password);
		$this->db->set('name',$data->name);
		$this->db->set('permission',$data->permission);
		$this->db->set('status',$data->status);
		$this->db->set('menuidarray',$data->menuidarray);
		$this->db->insert('account');
	}
	
	public function updatepersonal($data) 
	{
		$this->db->where('id',$data->id);

		$d['account'] = $data->account;
		$d['password'] = $data->password;
		$d['name'] = $data->name;
		$d['permission'] = $data->permission;
		$d['status'] = $data->status;
		$d['menuidarray'] = $data->menuidarray;

		
		$this->db->update('account',$d);
		
	}
	
	public function getpersonalByID($id) 
	{
		$this->db->select('*');
		$this->db->from('account');
		$this->db->where('id', $id);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			foreach ($result->result() as $row)
			{
				$personal_data = array();
				foreach ($row as $k => $v)
				{
					$personal_data[$k] = $v;
				}	
			}
			return $personal_data;
		}
		return 0;
	}

	public function getStaff()
	{
		$this->db->select('*');
		$this->db->where('permission', '3');
		$this->db->from('account');
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$personal_data[$idx] = new Datamodel();
				foreach ($row as $k => $v)
				{
					$personal_data[$idx]->$k = $v;			
				}
				$idx++;
			}
			return $personal_data;
		}
		return 0;

	}
	
	public function getpersonal() 
	{
		$this->db->select('*');
		$this->db->from('account');
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$personal_data[$idx] = new Datamodel();
				foreach ($row as $k => $v)
				{
					$personal_data[$idx]->$k = $v;
				}
				$idx++;
			}
			return $personal_data;
		}
		return 0;
		
	}

    public function getPersonalList($toPage,$toRows)
    {
        $public_tools = new public_tools();
        $toPage = is_null($toPage)?1:$toPage;
        $toPage = ($toPage-1)<0?0:($toPage-1)*$toRows;

        $sSql = "select * from account where isdelete=0 limit $toPage,$toRows";
        $query = $this->db->query($sSql);

        $data['results'] = $query->result_array();
        $data['affects'] = $public_tools->get_total('account');

        return $data;

    }

    public function getMenuPermission($sPermission=''){
	    if($sPermission=='') return false;

	    $configkey = '';
	    switch($sPermission){
            case '1' :
                $configkey = 'admin_group';
                break;
            case '2':
                $configkey = 'finance_group';
                break;
            case '3':
                $configkey = 'employee_group';
                break;
        }

        if ($configkey=='') return false;

	    $sSql = "select * from config where configkey='{$configkey}'";
        $query = $this->db->query($sSql);
        $sMenuPermission = $query->row_array();
        return $sMenuPermission['configvalue'];

    }

    public function getUsermenuData()
    {
        $public_tools = new public_tools();

        $sSql = "SELECT * FROM `config` where configkey in ('admin_group','finance_group','employee_group')";
        $query = $this->db->query($sSql);
        $menu_group=$query->result_array();

        foreach($menu_group as $k=>$v){
            $menu_group[$k]['configvalue'] = explode(',',$v['configvalue']);
        }

        $sSql = "SELECT * FROM `usermenu` where isdisabled !=1 and parentid = 0";
        $query = $this->db->query($sSql);

        $parentarray = $query->result_array();

        foreach ($parentarray as $k=>$v){

            $parentarray[$k]['admin_group'] = in_array($v['menuid'],$menu_group[0]['configvalue'])&&$menu_group[0]['configkey']=='admin_group'?1:0;
            $parentarray[$k]['finance_group'] = in_array($v['menuid'],$menu_group[1]['configvalue'])&&$menu_group[1]['configkey']=='finance_group'?1:0;
            $parentarray[$k]['employee_group'] = in_array($v['menuid'],$menu_group[2]['configvalue'])&&$menu_group[2]['configkey']=='employee_group'?1:0;

            $sSql = "SELECT * FROM `usermenu` where isdisabled !=1 and parentid = {$v['menuid']}";
            $query = $this->db->query($sSql);
            $parentarray[$k]['sub'] = $query->result_array();

            foreach ($parentarray[$k]['sub'] as $k1=>$v1){
                $parentarray[$k]['sub'][$k1]['admin_group'] = in_array($v1['menuid'],$menu_group[0]['configvalue'])&&$menu_group[0]['configkey']=='admin_group'?1:0;
                $parentarray[$k]['sub'][$k1]['finance_group'] = in_array($v1['menuid'],$menu_group[1]['configvalue'])&&$menu_group[1]['configkey']=='finance_group'?1:0;
                $parentarray[$k]['sub'][$k1]['employee_group'] = in_array($v1['menuid'],$menu_group[2]['configvalue'])&&$menu_group[2]['configkey']=='employee_group'?1:0;
            }
        }

        $data['results'] = $parentarray;
        //var_dump($parentarray);
        return $data;
    }

    public function editPowerConfig($group='',$value=''){
        if($group=='' || $value=='') return false;

        $this->db->where('configkey', $group);
        return $this->db->update('config',$value);
    }

}