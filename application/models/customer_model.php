<?php


class Customer_model extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database();	
		$this->load->library('Datamodel');
		
	}
	
	public function deleteCustomer($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('customer');
	}
	
	
	public function insertCustomer($data)
	{

		$this->db->set('name',$data->name);
		$this->db->set('address',$data->address);
		$this->db->set('tel',$data->tel);
		$this->db->set('fax',$data->fax);
		$this->db->set('num',$data->num);
		$this->db->insert('customer');	
	}
	
	public function updateCustomer($data) 
	{
		$this->db->where('id',$data->id);

		$d['name'] = $data->name;
		$d['address'] = $data->address;
		$d['tel'] = $data->tel;
		$d['fax'] = $data->fax;
		$d['num'] = $data->num;
		
		$this->db->update('customer',$d);
		
	}
	
	public function getCustomerByID($id) 
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id', $id);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			foreach ($result->result() as $row)
			{
				$customer_data = array();
				foreach ($row as $k => $v)
				{
					$customer_data[$k] = $v;
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}	
			}
			return $customer_data;
		}
		return 0;
		
	}
	
	public function getCustomer() 
	{
		$this->db->select('*');
		$this->db->from('customer');
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$customer_data[$idx] = new Datamodel();
				foreach ($row as $k => $v)
				{
					$customer_data[$idx]->$k = $v;
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}
				$idx++;
			
			}
			return $customer_data;
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