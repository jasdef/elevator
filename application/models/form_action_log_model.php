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
		$nowDate = getdate();		
		$dispatch_date = $nowDate['year']."/".$nowDate['mon']."/".$nowDate['mday'];
		
		$this->db->set('table_id',$data->table_id);
		$this->db->set('table_type',$data->table_type);
		$this->db->set('dispatcher',$data->dispatcher);	
		$this->db->set('is_finish', 0);
		$this->db->set('dispatch_date', $dispatch_date);
		$this->db->insert('form_action_log');
	}

	public function getLogByID($id) 
	{
		$this->db->select('*');
		$this->db->from('form_action_log');
		$this->db->where('id', $id);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			foreach ($result->result() as $row)
			{
				$form_data = array();
				foreach ($row as $k => $v)
				{
					$form_data[$k] = $v;
				}	
			}
			return $form_data;
		}
		return 0;
	}

	
	public function changeStaff($data) 
	{
		$this->db->where('id',$data->id);
		$d['staff'] = $data->staff;
		$this->db->update('form_action_log',$d);				
	}	
	
	public function checkDone($id) 
	{
		$nowDate = getdate();		
		$finish_date = $nowDate['year']."/".$nowDate['mon']."/".$nowDate['mday'];
		$this->db->where('id',$id);
		$d['is_finish'] = 1;
		$d['finish_date'] = $finish_date;
		$this->db->update('form_action_log',$d);				
	}
	
	public function deleteLog($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('form_action_log');		
	}
	
	public function getNotFinishLog() 
	{
		$this->db->select('*');
		$this->db->where('is_finish', 0);
		$this->db->from('form_action_log');
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$log[$idx] = new Datamodel();
				foreach ($row as $k => $v)
				{
					$log[$idx]->$k = $v;			
				}
				$idx++;
			}
			return $log;
		}
		return 0;
	}
}
