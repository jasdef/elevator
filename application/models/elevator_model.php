<?php


class Elevator_model extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database();	
		$this->load->library('Datamodel');
		
	}
	
	public function deleteElevator($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('elevator');
	}
	
	
	public function insertElevator($data)
	{

		$this->db->set('model',$data->model);
		$this->db->insert('elevator');	
	}
	
	public function updateElevator($data) 
	{
		$this->db->where('id',$data->id);

		$d['model'] = $data->model;
		
		$this->db->update('elevator',$d);
		
	}
	
	public function getElevatorByID($id) 
	{
		$this->db->select('*');
		$this->db->from('elevator');
		$this->db->where('id', $id);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			foreach ($result->result() as $row)
			{
				$elevator_data = array();
				foreach ($row as $k => $v)
				{
					$elevator_data[$k] = $v;
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}	
			}
			return $elevator_data;
		}
		return 0;
		
	}
	
	public function getElevator() 
	{
		$this->db->select('*');
		$this->db->from('elevator');
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$elevator_data[$idx] = new Datamodel();
				foreach ($row as $k => $v)
				{
					$elevator_data[$idx]->$k = $v;
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}
				$idx++;
			
			}
			return $elevator_data;
		}
		return 0;
		
	}
	
	
/*	public function getForm() 
	{
		$data = new Datamodel();
		$this->db->select('*');
		$this->db->from('form');
		//$this->db->where('account',$account);
		$result = $this->db->get();

		if ($result->num_rows() > 0)
		{
			$r = $result->result();
			
			$params = (array)$r[0];
			
			foreach ($params as $k => $v)
			{
				
				$data->$k = $v;
			
			}
			
			return $data;
		}
		else
		{
			return 0;
		}
		
	}
		*/
	
	
	
}