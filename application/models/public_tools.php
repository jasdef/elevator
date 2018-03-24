<?php

/**
 * Class Public_tools
 * @麵包削
 * @獲取table總數量
 */

class Public_tools extends CI_Model
{

    /**
     * @麵包削
     * @param array $data
     * @return null|string
     */
	public function breadcrumbTrail($data = array())
	{
		if(!isset($data)){
		    return null;
        }
        $results ='';
        foreach ($data as $v){
            $results .= '<li class="active">'.$v.'<span class="divider">/</span></li>';
        }
        return $results;
	}

    /**
     * @獲取table總數量
     * @param string $sTable
     * @return int
     */
    public function get_total($sTable='',$sWhere=array())
    {
        if($sTable=='') return 0;
        $this->db->from($sTable);
        if(!empty($sWhere)) {
            foreach ($sWhere as $k=>$v){
                $this->db->where($k,$v);
            }
        }

        return $this->db->count_all_results();
    }

    public function upload_tools($data = array()){

        if( ! ini_get('date.timezone') )
        {
            date_default_timezone_set('Asia/Taipei');
        }

        $config['upload_path']          = isset($data['upload_path'])?'./uploads/'.$data['upload_path']:'./uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
//        $config['max_size']             = 100;
//        $config['max_width']            = 1024;
//        $config['max_height']           = 768;
//        $config['max_height']           = 768;
        $config['file_name']           = isset($data['file_name'])?$data['file_name'].'_'.date("YmdHis"):date("YmdHis");

        if(!isset($data['table']) || !isset($data['id'])){
            return false;
        }

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            return false;
        }
        else
        {
            $upload_data = array('upload_data' => $this->upload->data());
            $inset_data = array(
                'type'=>$data['table'],
                'typeid'=>$data['id'],
                'imgadd'=>$upload_data['upload_data']['file_name'],
            );

            if($upload_data['upload_data']['file_name']=='') return false;

            if($this->db->insert('imgaddress', $inset_data)){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function getimgview($arraydata=array()){

        if(empty($arraydata)) return false;
        if(!isset($arraydata['type'])) return false;
        if(!isset($arraydata['typeid'])) return false;

        $sSql = "select * from imgaddress where type='{$arraydata['type']}' and typeid={$arraydata['typeid']} and isdelete=0 order by 1 desc";
        $query = $this->db->query($sSql);

        $data = $query->result_array();
        return $data;
    }

}
