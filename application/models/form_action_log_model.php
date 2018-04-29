<?php


class Form_action_log_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->library('Form_data');
		$this->load->library('Datamodel');
		$this->load->library('Common');
	}
	
	public function addLog($data)
	{
		$nowDate = getdate();		
		$dispatch_date = $nowDate['year']."/".$nowDate['mon']."/".$nowDate['mday'];
		$common = new Common();
		$this->db->set('table_id',$data->table_id);
		$this->db->set('table_type',$data->table_type);
		$this->db->set('dispatcher',$data->dispatcher);	
		$this->db->set('is_finish', $common->DISPATCH_STATE_NOT_DISPATCH_STAFF);
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
		$common = new Common();
		$this->db->where('id',$data->id);
		$d['staff'] = $data->staff;
		$d['is_finish'] = $common->DISPATCH_STATE_ALREADY_DISPATCH;
		$this->db->update('form_action_log',$d);				
	}	
	
	public function actionDoneStaff($id)
	{
		$common = new Common();
		$this->db->where('id',$id);
		$d['is_finish'] = $common->DISPATCH_STATE_WAIT_CHECK;
		$this->db->update('form_action_log',$d);
	}

	public function checkDone($id) 
	{
		$common = new Common();
		$nowDate = getdate();		
		$finish_date = $nowDate['year']."/".$nowDate['mon']."/".$nowDate['mday'];
		$this->db->where('id',$id);
		$d['is_finish'] = $common->DISPATCH_STATE_CHECK_DONE;
		$d['finish_date'] = $finish_date;
		$this->db->update('form_action_log',$d);				
	}
	
	public function deleteLog($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('form_action_log');		
	}
	
	public function getDispatchList()
	{
		$common = new Common();
		$this->db->select('*');
		$this->db->where('is_finish !=', $common->DISPATCH_STATE_CHECK_DONE);//因為回照片會改成狀態3 但有可能要多傳一些照片 所以先這樣做

		$this->db->where('staff', $_SESSION['id']);
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


	public function getNotFinishLog() 
	{
		$common = new Common();
		$this->db->select('*');
		$this->db->where('is_finish !=', $common->DISPATCH_STATE_CHECK_DONE);
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
