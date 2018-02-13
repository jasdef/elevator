<?php


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

}
