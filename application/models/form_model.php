<?php


class Form_model extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database();	
		$this->load->library('Datamodel');
		
	}
	
	public function insertForm($data)
	{
		$this->db->set('is_return',$data->return_back);
		$this->db->set('status',$data->status);
		$this->db->set('form_type',$data->type);
		if ($data->type == 2)
			$this->db->set('month',$data->month);
		if ($data->type == 3)
			$this->db->set('warranty',$data->warranty);
		$this->db->set('start_date',$data->startDate);
		$this->db->set('end_date',$data->endDate);
		$this->db->set('permission_date',$data->permissionDate);
		$this->db->set('price',$data->price);
		$this->db->set('receipt_remind',$data->remind);
		$this->db->set('elevator_id',$data->elevator);
		$this->db->set('customer_id',$data->customer);
		$this->db->insert('form');	
	}
	
	
	public function getForm() 
	{
		$this->db->select('*');
		$this->db->from('form');
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$form_data[$idx] = new Datamodel();
				foreach ($row as $k => $v)
				{
					$form_data[$idx]->$k = $v;
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}
				$idx++;
			
			}
			return $form_data;
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