<?php


class Form_action_log_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->library('Form_data');
		$this->load->library('Datamodel');
	
	}
	
	public function addLog($data)
	{
		$this->db->set('table_id',$data->table_id);
		$this->db->set('table_type',$data->talbe_type);
		$this->db->set('permission`',$person->permission);	
		$this->db->set('status',0);
		$this->db->insert('account');
	}

	
	public function updateLog($data)
	{
		$this->db->where('id',$uid);
		
		$this->db->delete('account');
	
	}
	
	public function freezeMember($uid)
	{
		$data = array('status'=>0);
		
		$this->db->where('id',$uid);
		
		$this->db->update('account',$data);
	}

	
	public function updateMember($uid,$array)
	{
		$this->db->where('id',$uid);
		
		$this->db->update('account',$array);
	}
	
	public function selectAccount($account)
	{
		$person = new Personal_data();
		$this->db->select('`account`');
		$this->db->from('account');
		$this->db->where('account',$account);
		$data = $this->db->get();
		
		
		
		if ($data->num_rows() > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
	
	
	public function getMemberData($account)
	{
		$person = new Personal_data();
		$this->db->select('`id`,`account`,`password`,`permission`,`status`');
		$this->db->from('account');
		$this->db->where('account',$account);
		$data = $this->db->get();
		
		if ($data->num_rows() > 0)
		{
			$r = $data->result();
			
			$params = (array)$r[0];
			
			foreach ($params as $k => $v)
			{
				
				$person->$k = $v;
			
			}
			
			return $person;
		}
		else
		{
			return 0;
		}
	
	}

	public function insertFile($data)
	{
		/*
		$this->db->set('name',$data->name);
		$this->db->set('sex',$data->sex);
		$this->db->set('bir',$data->bir);
		$this->db->set('age',$data->age);
		$this->db->set('grade',$data->grade);
		$this->db->set('rank',$data->rank);
		$this->db->set('county',$data->county);
		$this->db->set('language',$data->language);
		$this->db->insert('children');*/
		
		$this->db->set('testing_id',$data->testing_id);
		$this->db->set('topic_id',$data->topic_id);
		$this->db->set('voice_file',$data->voice_file);
		$this->db->insert('result');
	}

}
