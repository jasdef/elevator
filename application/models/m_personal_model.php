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
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}	
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
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
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

}