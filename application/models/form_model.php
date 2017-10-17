<?php


class Form_model extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database();	
		$this->load->library('Datamodel');
		
	}
	
	public function insertTransaction($data) 
	{
		$this->db->set('name', $data->name);
		$this->db->set('total_price', $data->total_price);
		$this->db->set('start_date', $data->start_date);
		$this->db->set('is_return', $data->is_return);
		$this->db->set('remind_month', $data->remind_month);
		$this->db->set('receipt_status', $data->receipt_status);
		for ($i = 0; $i < 6; $i++) 
		{
			$this->db->set('item'.($i+1), $data->item[$i]);
			$this->db->set('item_status'.($i+1), $data->item_status[$i]);
		}
		$this->db->insert('transaction_form');			
	}		
	
	public function updateTransaction($data) 
	{
		$this->db->where('id',$data->id);
		$d['name'] = $data->name;
		$d['total_price'] = $data->total_price;
		$d['start_date'] = $data->start_date;
		$d['is_return'] = $data->is_return;
		$d['remind_month'] = $data->remind_month;
		$d['receipt_status'] = $data->receipt_status;

		for ($i = 0; $i < 6; $i++) 
		{
			$d['item'.($i+1)] = $data->item[$i];
			$d['item_status'.($i+1)] = $data->item_status[$i];
		}
		$this->db->update('transaction_form',$d);	
		
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
		
	public function updateForm($data) 
	{
		$this->db->where('id',$data->id);
	
		$d['is_return'] = $data->return_back;
		$d['status'] = $data->status;
		$d['form_type'] = $data->type;
		if ($data->type == 2) 
		{
			$d['month'] = $data->month;
			$d['warranty'] = 0;
		}
		
		if ($data->type == 3) 
		{
			$d['month'] = 0;
			$d['warranty'] = $data->warranty;			
		}
		
		$d['start_date'] = $data->startDate;
		$d['end_date'] = $data->endDate;
		$d['permission_date'] = $data->permissionDate;
		$d['price'] = $data->price;
		$d['receipt_remind'] = $data->remind;
		$d['elevator_id'] = $data->elevator;
		$d['customer_id'] = $data->customer;
		$this->db->update('form',$d);
		
	}
	
	public function deleteForm($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('form');
	}	
	
	public function deleteTransaction($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('transaction_form');
	}	
	
	public function getTransaction() 
	{
		$this->db->select('*');
		$this->db->from('transaction_form');
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			$item = array();
			$item_status = array();
			foreach ($result->result() as $row)
			{
				$form_data[$idx] = new Datamodel();
				$idx2 = 0;
				$idx3 = 0;
				foreach ($row as $k => $v)
				{
										
					if (preg_match("/\item_status/i", $k)) 
					{
						$item_status[$idx3] = $v;
						$idx3++;						
					}
					else if (preg_match("/\item/i", $k)) 
					{
						$item[$idx2] = $v;
						$idx2++;
					}
					else 
					{
						$form_data[$idx]->$k = $v;						
					}
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}
				$form_data[$idx]->item = $item;
				$form_data[$idx]->item_status = $item_status;
				$idx++;
			
			}
			return $form_data;
		}
		return 0;
		
	}
	
	public function getTransactionByID($id) 
	{
		$this->db->select('*');
		$this->db->from('transaction_form');
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
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}	
			}
			return $form_data;
		}
		return 0;
		
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
	
	public function getFormByID($id) 
	{
		$this->db->select('*');
		$this->db->from('form');
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
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}	
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