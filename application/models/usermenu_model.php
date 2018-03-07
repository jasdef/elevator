<?php

class Usermenu_model extends CI_Model
{

	public function usermenulist($iUserid=0)
	{
		if($iUserid==0){
		    return false;
        }

        $sSql = "select menuidarray from account where id ={$iUserid} and `status`=0";
        $query = $this->db->query($sSql);
        $useridmenu = $query->row_array();

        if(!isset($useridmenu['menuidarray']) || $useridmenu['menuidarray']==''){
            session_start();
            session_destroy();
            redirect(base_url("/mainpage/index")); //轉回登入頁
            return false;
        }

        $sSql = "select * from usermenu where menuid in ({$useridmenu['menuidarray']}) and ismenu=1 and isdisabled!=1 and parentid = 0";
        $query = $this->db->query($sSql);
        $results = array();

        foreach ($query->result_array() as $vNavheader){
            $results[$vNavheader['menuid']] = $vNavheader;
            $sSql = "select * from usermenu where menuid in ({$useridmenu['menuidarray']}) and parentid = '{$vNavheader['menuid']}' and ismenu=1 and isdisabled!=1";
            $query_navlist = $this->db->query($sSql);
            foreach ($query_navlist->result_array() as $vNavlist){
                $results[$vNavheader['menuid']]['subtype'][]=$vNavlist;
            }
        }

        return $results;
	}

}
