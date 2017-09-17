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

		$this->db->set('company',$data->company);
		$this->db->set('contacter_1',$data->contacter_1);
		$this->db->set('contacter_2',$data->contacter_2);
		$this->db->set('contacter_3',$data->contacter_3);
		$this->db->set('address_1',$data->address_1);
		$this->db->set('address_2',$data->address_2);
		$this->db->set('address_3',$data->address_3);
		$this->db->set('tel_1',$data->tel_1);
		$this->db->set('tel_2',$data->tel_2);
		$this->db->set('tel_3',$data->tel_3);
		$this->db->set('fax',$data->fax);
		$this->db->set('num',$data->num);
		$this->db->insert('customer');	
	}
	
	public function updateCustomer($data) 
	{
		$this->db->where('id',$data->id);

		$d['company'] = $data->company;
		$d['contacter_1'] = $data->contacter_1;
		$d['contacter_2'] = $data->contacter_2;
		$d['contacter_3'] = $data->contacter_3;
		$d['address_1'] = $data->address_1;
		$d['address_2'] = $data->address_2;
		$d['address_3'] = $data->address_3;
		$d['tel_1'] = $data->tel_1;
		$d['tel_2'] = $data->tel_2;
		$d['tel_3'] = $data->tel_3;
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