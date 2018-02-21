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
    public function get_total($sTable='')
    {
        if($sTable=='') return 0;
        $this->db->from($sTable);
        return $this->db->count_all_results();
    }

}
