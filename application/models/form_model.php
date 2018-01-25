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
		$this->db->set('is_return', $data->return_back);
		$this->db->set('elevator_num', $data->elevator_num);
		$this->db->set('receipt_status', $data->receipt_status);
		$this->db->set('customer_id', $data->customer_id);
		for ($i = 0; $i < 6; $i++) 
		{
			//echo Item_name[$i]."<br>";
			$this->db->set('item_name'.($i+1), $data->item_name[$i]);
			$this->db->set('item'.($i+1), $data->item[$i]);
			$this->db->set('item_status'.($i+1), $data->item_status[$i]);
		}
		$this->db->insert('transaction_form');			
	}		
	
	public function updateTransaction($data) 
	{
		$this->db->where('id',$data->id);
		$d['name'] = $data->name;
		$d['elevator_num'] = $data->elevator_num;
		$d['total_price'] = $data->total_price;
		$d['start_date'] = $data->start_date;
		$d['is_return'] = $data->is_return;
		$d['receipt_status'] = $data->receipt_status;
		$d['customer_id'] = $data->customer_id;
		for ($i = 0; $i < 6; $i++) 
		{
			$this->db->set('item_name'.($i+1), $data->item_name[$i]);
			$d['item'.($i+1)] = $data->item[$i];
			$d['item_status'.($i+1)] = $data->item_status[$i];
		}
		$this->db->update('transaction_form',$d);	
		
	}	
	
	
	public function deleteTransaction($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('transaction_form');
	}	
	
	public function getTransaction($sWhere='',$sOrder='')
	{
		$sSql = "select * from transaction_form where 1 ";

		if($sWhere!=''){
            $sSql .= " and name like '%{$sWhere}%'";
        }
        if($sOrder!=''){
		    $sSql .= "order by {$sOrder}";
        }
        echo "$sSql";
		$result = $this->db->query($sSql);

		if ($result->num_rows() > 0)
		{
			$idx = 0;
			$item = array();
			$item_name = array();
			$item_status = array();
			foreach ($result->result() as $row)
			{
				$form_data[$idx] = new Datamodel();
				$idx2 = 0;
				$idx3 = 0;
				$idx4 = 0;
				foreach ($row as $k => $v)
				{
						//echo $v;				
					if (preg_match("/\item_status/i", $k)) 
					{
						$item_status[$idx3] = $v;
						$idx3++;						
					}
					else if (preg_match("/\item_name/i", $k)) 
					{
						$item_name[$idx4] = $v;
						$idx4++;
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
				$form_data[$idx]->item_name = $item_name;
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
	public function getTransactionBySearch($value) 
	{
		$this->db->select('*');
		$this->db->from('transaction_form');
		$this->db->or_like('id',$value,'both');
		$this->db->or_like('name',$value,'both');
		$this->db->or_like('total_price',$value,'both');
		$this->db->or_like('start_date',$value,'both');
		$this->db->or_like('is_return',$value,'both');
		$this->db->or_like('remind_month',$value,'both');
		$this->db->or_like('receipt_status',$value,'both');
		$this->db->or_like('item_name1',$value,'both');
		$this->db->or_like('item_name2',$value,'both');
		$this->db->or_like('item_name3',$value,'both');
		$this->db->or_like('item_name4',$value,'both');
		$this->db->or_like('item_name5',$value,'both');
		$this->db->or_like('item_name6',$value,'both');
		$this->db->or_like('item1',$value,'both');
		$this->db->or_like('item2',$value,'both');
		$this->db->or_like('item3',$value,'both');
		$this->db->or_like('item4',$value,'both');
		$this->db->or_like('item5',$value,'both');
		$this->db->or_like('item6',$value,'both');
		$this->db->or_like('item_status1',$value,'both');
		$this->db->or_like('item_status2',$value,'both');
		$this->db->or_like('item_status3',$value,'both');
		$this->db->or_like('item_status4',$value,'both');
		$this->db->or_like('item_status5',$value,'both');
		$this->db->or_like('item_status6',$value,'both');
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			$item = array();
			$item_name = array();
			$item_status = array();
			foreach ($result->result() as $row)
			{
				$form_data[$idx] = new Datamodel();
				$idx2 = 0;
				$idx3 = 0;
				$idx4 = 0;
				foreach ($row as $k => $v)
				{
						//echo $v;				
					if (preg_match("/\item_status/i", $k)) 
					{
						$item_status[$idx3] = $v;
						$idx3++;						
					}
					else if (preg_match("/\item_name/i", $k)) 
					{
						$item_name[$idx4] = $v;
						$idx4++;
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
				$form_data[$idx]->item_name = $item_name;
				$form_data[$idx]->item_status = $item_status;
				$idx++;
			
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