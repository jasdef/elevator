<?php


class m_service_model extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database();	
		$this->load->library('Datamodel');
		$this->load->model('m_warranty_model');
	}
	
	public function deleteservice($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('service');
	}	
	//
	public function insertservice($data)
	{

		$this->db->set('signing_day',$data->signing_day);
		$this->db->set('service_month',$data->service_month);
		$this->db->set('mechanical_warranty',$data->mechanical_warranty);
		$this->db->set('license',$data->license);
		$this->db->set('license_day',$data->license_day);
		$this->db->set('do_times',$data->do_times);
		$this->db->set('Total_price',$data->Total_price);
		for ($i = 0; $i < 6; $i++) 
		{
			$this->db->set('payment_date'.($i+1), $data->payment_date[$i]);
			$this->db->set('payment_amount'.($i+1), $data->payment_amount[$i]);
			$this->db->set('item_status'.($i+1), $data->item_status[$i]);
		}
		
		$this->db->set('remark',$data->remark);
		$this->db->set('warranty_id', $data->warranty_id);
		$this->db->insert('service');	
	}
	
	public function updateservice($data) 
	{
		$this->db->where('id',$data->id);

		$d['signing_day'] = $data->signing_day;
		$d['service_month'] = $data->service_month;
		$d['mechanical_warranty'] = $data->mechanical_warranty;
		$d['license'] = $data->license;
		$d['license_day'] = $data->license_day;
		$d['Total_price'] = $data->Total_price;
		$d['is_remind'] = $data->is_remind;
		$d['do_times'] = $data->do_times;
		$d['service_times'] = $data->service_times;

		for ($i = 0; $i < count($data->payment_date); $i++) 
		{
			$d['payment_date'.($i+1)] = $data->payment_date[$i];
			$d['payment_amount'.($i+1)] = $data->payment_amount[$i];
			$d['item_status'.($i+1)] = $data->item_status[$i];
		}
		$d['remark'] = $data->remark;
		$d['warranty_id'] = $data->warranty_id;
		$this->db->update('service',$d);
		
	}
	
	public function getserviceByID($id) 
	{
		$this->db->select('*');
		$this->db->from('service');
		$this->db->where('id', $id);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			foreach ($result->result() as $row)
			{
				$service_data = array();
				foreach ($row as $k => $v)
				{
					$service_data[$k] = $v;
				}	
			}
			return $service_data;
		}
		return 0;
	}
	
	public function getservice() 
	{
		$this->db->select('*');
		$this->db->from('service');
		$result = $this->db->get();
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			$payment_amount = array();
			$payment_date = array();
			$item_status = array();
			foreach ($result->result() as $row)
			{
				$service_data[$idx] = new Datamodel();
				$idx2 = 0;
				$idx3 = 0;
				$idx4 = 0;
				foreach ($row as $k => $v)
				{		
					if (preg_match("/\item_status/i", $k)) 
					{
						$item_status[$idx3] = $v;
						$idx3++;						
					}
					else if (preg_match("/payment_date/i", $k)) 
					{
						$payment_date[$idx4] = $v;
						$idx4++;
					}
					else if (preg_match("/payment_amount/i", $k)) 
					{
						$payment_amount[$idx2] = $v;
						$idx2++;
					}
					else 
					{
						$service_data[$idx]->$k = $v;						
					}
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}
				$service_data[$idx]->payment_amount = $payment_amount;
				$service_data[$idx]->payment_date = $payment_date;
				$service_data[$idx]->item_status = $item_status;
				$idx++;
			
			}
			return $service_data;
		}
		return 0;
		
	}
	
	public function getRemindSigningService() 
	{
		$w_model = new m_warranty_model();
		$this->checkRemind();
		$this->db->select('*');
		$this->db->from('service');
		$this->db->where('is_signing', 0);
		$this->db->where('is_remind', 2);
		$result = $this->db->get();
		$nowDate = getdate();
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$service_data[$idx] = new Datamodel();
				
				$temp = mb_split("/",$row->signing_day);
				if ($nowDate['year'] >= $temp[0]+$row->mechanical_warranty && $nowDate['mon'] >= $temp[1])				
				{
					foreach ($row as $k => $v)
					{					
						if ($k == "warranty_id") 
						{
							$temp = $w_model->getwarrantyByID($v);
							if ($temp != 0) 
							{
							
								$service_data[$idx]->customer = $temp['customer'];							
							}
							
						}
						$service_data[$idx]->$k = $v;
					}
					$idx++;					
				}
			}			
				
			if ($service_data[0]->id == null)
				return 0;			
			return $service_data;
		}
		return 0;
		
	}
	
	public function updateTransactionSigningState($data) 
	{
		$this->db->where('id',$data->service_id);
		$d['is_signing'] = $data->is_signing;
		$this->db->update('service',$d);			
	}
	
	public function getRemindService() 
	{
		$w_model = new m_warranty_model();
		$this->checkRemind();
		$this->db->select('*');
		$this->db->from('service');
		$this->db->where('is_remind', 1);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$service_data[$idx] = new Datamodel();
				foreach ($row as $k => $v)
				{
					
					if ($k == "warranty_id") 
					{
						$temp = $w_model->getwarrantyByID($v);
						if ($temp != 0) 
						{
						
							$service_data[$idx]->customer = $temp['customer'];							
						}
						
					}
					$service_data[$idx]->$k = $v;
				}
				$idx++;
			}			
				
								
			return $service_data;
		}
		return 0;
		
	}			
	
	private function checkRemind()//檢查是否有需要提醒的單號  
	{
		$this->db->select('*');
		$this->db->from('service');
		$this->db->where('is_remind', 0);//0代表從來沒有提醒過 所以要檢查日期是否到了該提醒
		$result = $this->db->get();
		$common = new Common();
		$nowDate = getdate();
		if ($result->num_rows() > 0)
		{
			
			foreach ($result->result() as $row)
			{
				
				if ($row->touch_time == null && $row->signing_day != null) 
				{
					$sratDate = $row->signing_day;
					
					$temp = mb_split("/",$sratDate);
					
					if ($nowDate['year'] == $temp[0])
					{
						if ($nowDate['mon'] == $temp[1]) 
						{
							$row->is_remind = $common->FORM_STATUS_NEED_REMIND;;
							$this->updateservice($row);
							
						}
					}				
				}
				else if ($row->touch_time != null)
				{
					$touchTime = $row->touch_time;
					$is_need = false;
					
					if ($row->service_times == 0)
					{					
						$is_need = true;
					}
					else if (($row->service_times % $row->do_times) != 0) 
					{						
						$is_need = true;
					}
					
					$temp = mb_split("/",$touchTime);
					
					if ($nowDate['year'] == $temp[0])
					{
						if ($nowDate['mon'] > $temp[1] && $is_need) 
						{
							$row->is_remind = $common->FORM_STATUS_NEED_REMIND;;
							$this->updateservice($row);
							
						}
					}						
				}
				
				$need_times = $row->mechanical_warranty * 12 * $row->service_month * $row->do_times;
				
				if ($need_times <= $row->service_times) 
				{
					$row->is_remind = $common->FORM_STATUS_SIGNING_COMPLETE;
					$this->updateservice($row);
				}												
			}
		}
		
	}
}
?>