<?php


class m_warranty_model extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database();	
		$this->load->library('Datamodel');
		$this->load->library('Common');
	}
	
	public function deletewarranty($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('warranty');
	}	
	
	public function insertwarranty($data)
	{

		$this->db->set('customer',$data->customer);
		$this->db->set('mechanical_warranty',$data->mechanical_warranty);
		$this->db->set('free_maintenance',$data->free_maintenance);
		$this->db->set('effective_date',$data->effective_date);
		$this->db->set('contacter_1',$data->contacter_1);
		$this->db->set('contacter_2',$data->contacter_2);
		$this->db->set('contacter_3',$data->contacter_3);
		$this->db->set('address',$data->address);
		$this->db->set('tel_1',$data->tel_1);
		$this->db->set('tel_2',$data->tel_2);
		$this->db->set('tel_3',$data->tel_3);
		$this->db->set('fax_1',$data->fax_1);
		$this->db->set('fax_2',$data->fax_2);
		$this->db->set('fax_3',$data->fax_3);
		$this->db->set('num',$data->num);
		$this->db->set('is_remind', $data->is_remind);
		$this->db->set('transaction_id', $data->transaction_id);
		$this->db->insert('warranty');	
	}
	
	public function updatewarranty($data) 
	{
		$this->db->where('id',$data->id);

		$d['customer'] = $data->customer;
		$d['mechanical_warranty'] = $data->mechanical_warranty;
		$d['free_maintenance'] = $data->free_maintenance;
		$d['effective_date'] = $data->effective_date;
		$d['contacter_1'] = $data->contacter_1;
		$d['contacter_2'] = $data->contacter_2;
		$d['contacter_3'] = $data->contacter_3;
		$d['address'] = $data->address;
		$d['tel_1'] = $data->tel_1;
		$d['tel_2'] = $data->tel_2;
		$d['tel_3'] = $data->tel_3;
		$d['fax_1'] = $data->fax_1;
		$d['fax_2'] = $data->fax_2;
		$d['fax_3'] = $data->fax_3;
		$d['num'] = $data->num;
		$d['is_remind'] = $data->is_remind;
		$d['transaction_id'] = $data->transaction_id;
		$this->db->update('warranty',$d);
		
	}
	
	public function getwarrantyByID($id) 
	{
		$this->db->select('*');
		$this->db->from('warranty');
		$this->db->where('id', $id);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			foreach ($result->result() as $row)
			{
				$warranty_data = array();
				foreach ($row as $k => $v)
				{
					$warranty_data[$k] = $v;
				}	
			}
			return $warranty_data;
		}
		return 0;
	}
	
	public function getRemindSigningWarranty() 
	{
		$this->checkWarranty();
		$this->db->select('*');
		$this->db->from('warranty');
		$this->db->where('is_signing', 0);
		$this->db->where('is_remind', 2);
		$result = $this->db->get();
		$nowDate = getdate();
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{			
				$warranty_data[$idx] = new Datamodel();
				$temp = mb_split("/",$row->effective_date);
				if ($nowDate['year'] >= $temp[0]+$row->free_maintenance && $nowDate['mon'] >= $temp[1])				
				{					
					foreach ($row as $k => $v)
					{
						$warranty_data[$idx]->$k = $v;				
					}
					$idx++;					
				}
			}				
			
			if ($warranty_data[0]->id == null)
				return 0;
			return $warranty_data;
		}
		return 0;
	}
	
	public function updateTransactionSigningState($data) 
	{
		$this->db->where('id',$data->warranty_id);
		$d['is_signing'] = $data->is_signing;
		$this->db->update('warranty',$d);			
	}
	
	public function getRemindWarranty()
	{
		$this->checkWarranty();
		$this->db->select('*');
		$this->db->from('warranty');
		$this->db->where('is_remind', 1);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$warranty_data[$idx] = new Datamodel();
				foreach ($row as $k => $v)
				{
					$warranty_data[$idx]->$k = $v;				
				}
				$idx++;
			}
								
			return $warranty_data;
		}
		return 0;
	}
	
	private function checkWarranty()//檢查是否有需要提醒的單號 
	{
		$this->db->select('*');
		$this->db->from('warranty');
		$this->db->where('is_remind', 0);//0代表從來沒有提醒過 所以要檢查日期是否到了該提醒
		$result = $this->db->get();
		$nowDate = getdate();
		$common = new Common();
		if ($result->num_rows() > 0)
		{
			
			foreach ($result->result() as $row)
			{
				if ($row->touch_time == null) 
				{
					$sratDate = $row->effective_date;
					
					$temp = mb_split("/",$sratDate);
					
					if ($nowDate['year'] == $temp[0])
					{
						if ($nowDate['mon'] == $temp[1]) 
						{
							$row->is_remind = $common->FORM_STATUS_NEED_REMIND;
							$this->updatewarranty($row);
							
						}
					}					
				}
				else 
				{
					$temp = mb_split("/", $row->touch_time);
					
					if ($nowDate['year'] == $temp[0])
					{
						if ($nowDate['mon'] > $temp[1]) 
						{
							$row->is_remind = $common->FORM_STATUS_NEED_REMIND;
							$this->updatewarranty($row);
							
						}
					}											
				}
				
				$need_times = $row->free_maintenance * 12;
				
				if ($need_times <= $row->warranty_times) 
				{
					$row->is_remind = $common->FORM_STATUS_SIGNING_COMPLETE;
					$this->updatewarranty($row);
				}		
			}
		}			
	}	
		
	public function getwarranty() 
	{
		$this->db->select('*');
		$this->db->from('warranty');
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$warranty_data[$idx] = new Datamodel();
				foreach ($row as $k => $v)
				{
					$warranty_data[$idx]->$k = $v;
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}
				$idx++;
			}
			return $warranty_data;
		}
		return 0;
		
	}


	public function getwarrantyBySearch($value) 
	{
		$this->db->select('*');
		$this->db->from('warranty');
		$this->db->or_like('id',$value,'both');
		$this->db->or_like('customer',$value,'both');
		$this->db->or_like('mechanical_warranty',$value,'both');
		$this->db->or_like('free_maintenance',$value,'both');
		$this->db->or_like('effective_date',$value,'both');
		$this->db->or_like('contacter_1',$value,'both');
		$this->db->or_like('contacter_2',$value,'both');
		$this->db->or_like('contacter_3',$value,'both');
		$this->db->or_like('address',$value,'both');
		$this->db->or_like('tel_1',$value,'both');
		$this->db->or_like('tel_2',$value,'both');
		$this->db->or_like('tel_3',$value,'both');
		$this->db->or_like('fax_1',$value,'both');
		$this->db->or_like('fax_2',$value,'both');
		$this->db->or_like('fax_3',$value,'both');
		$this->db->or_like('num',$value,'both');
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
}
?>