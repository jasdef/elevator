<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {
	
	var $data =array();
	function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('Customer_model');
		$this->load->model('m_warranty_model');
		$this->load->model('m_service_model');
		$this->load->library('datamodel');
		$this->load->library('common');
	}
	
public function service_home() 
	{	
		$service_model = new m_service_model();
		$temp = $service_model->getservice();
		$common = new Common();		
		$fristitem = 0;
		$itemmax = 10;
		
		if ($temp != 0) 
		{	
			$totalitem = count($temp);	
			if( 10 > $totalitem)
			{
				$itemmax = $totalitem;
			}
			else
			{
				$itemmax = 10;		
			}
			$this->data['fristitem'] = $fristitem; 			
			$this->data['itemmax'] = $itemmax;			
			foreach($temp as $row):	
				$row->Item_status = $common->conversionFormStatusByID($row->Item_status);
				$row->service_month = $common->converservicemonthByID($row->service_month);
				$row->license = $common->converlicenseByID($row->license);	
				if($fristitem < $itemmax)
				{	
					$this->data[$fristitem] = $row;
				}
				$fristitem++;
			endforeach;			
			
			//資料筆數
			if($totalitem >= 10)
			{	
				if($totalitem % 10 != 0)
				{
					$pageitem = floor($totalitem / 10) + 1;
				}
				else
				{
					$pageitem = $totalitem / 10;
				}		
			}
			else
			{
				$pageitem = 1;
			}
			//頁碼
			$pagefrist = 0;
			if($pageitem > 10 )
			{	
				$pagetotal = 10;
			}
			else
			{
				$pagetotal = $pageitem;		
			}
			$this->data['pagefrist'] = $pagefrist;	//各10頁的第一頁
			$this->data['pagetotal'] = $pagetotal;	//各10頁的總筆數數		
			$this->data['pageid'] = 1;			//第幾頁
		}
		else
		{
			$this->data = null;
		}		
		$this->load->view('v_service_home', $this->data);
	}

	
	public function switch_page($id)//多頁數執行
	{

		$service_model = new m_service_model();
		$temp = $service_model->getservice();
		$common = new Common();		
		$fristitem = 0;
		if ($temp != 0) 
		{	
			$totalitem = count($temp);		
			if(($id * 10) > $totalitem)
			{
				$itemmax = $totalitem;
			}
			else
			{
				$itemmax = ($id * 10);		
			}
			$j = 0;	
			$i = ($id - 1) * 10 ;//依頁面筆數 EX 第3頁(從21~30筆資料)，此處為前20筆資料
			$this->data['fristitem'] = ($id - 1) * 10;//丟往前端迴圈參數
			$this->data['itemmax'] = $itemmax;//丟往前端迴圈參數
			foreach($temp as $row):
				$row->Item_status = $common->conversionFormStatusByID($row->Item_status);
				$row->service_month = $common->converservicemonthByID($row->service_month);
				$row->license = $common->converlicenseByID($row->license);	
				if($fristitem >= $i)
				{				
					if($fristitem < $itemmax)
					{	
						$this->data[$j] = $row;
						$j++;
					}
				}	
				$fristitem++;				
			endforeach;			
			
			//資料筆數
			if($totalitem >= 10)
			{	
				if($totalitem % 10 != 0)
				{
					$pageitem = floor($totalitem / 10) + 1;
				}
				else
				{
					$pageitem = $totalitem / 10;
				}		
			}
			else
			{
				$pageitem = 1;
			}
			//頁數		
			if($id > 10 )
			{	
				$pagefrist = floor(($id - 1) / 10) * 10;
				$pagetotal = (floor(($id - 1) / 10) + 1) * 10;
				if($pagelast > $sheetid)
				{
					$pagetotal = $sheetid;
				}
			}
			else
			{	
				$pagefrist = 0;
				$pagetotal = $pageitem;		
			}
			$this->data['pagefrist'] = $pagefrist;	//各10頁的第一頁
			$this->data['pagetotal'] = $pagetotal;	//各10頁的總筆數數		
			$this->data['pageid'] = $id;			//第幾頁
		}
		else
		{
			$this->data = null;
		}		
		$this->load->view('v_service_home', $this->data);
	}
/*
	public function service_Search() 
	{	
		$searchvalue = $this->input->post("Search"); 
		$warranty_model = new m_warranty_model();
		$temp = $warranty_model->getwarrantyBysearch($searchvalue);	
		$fristitem = 0;
		$itemmax = 10;
		
		if ($temp != 0) 
		{	
			$totalitem = count($temp);	
			if( 10 > $totalitem)
			{
				$itemmax = $totalitem;
			}
			else
			{
				$itemmax = 10;		
			}
			$this->data['fristitem'] = $fristitem; 			
			$this->data['itemmax'] = $itemmax;			
			foreach($temp as $row):				
				if($fristitem < $itemmax)
				{	
					$this->data[$fristitem] = $row;
				}
				$fristitem++;
			endforeach;			
			
			//資料筆數
			if($totalitem >= 10)
			{	
				if($totalitem % 10 != 0)
				{
					$pageitem = floor($totalitem / 10) + 1;
				}
				else
				{
					$pageitem = $totalitem / 10;
				}		
			}
			else
			{
				$pageitem = 1;
			}
			//頁碼
			$pagefrist = 0;
			if($pageitem > 10 )
			{	
				$pagetotal = 10;
			}
			else
			{
				$pagetotal = $pageitem;		
			}
			$this->data['pagefrist'] = $pagefrist;	//各10頁的第一頁
			$this->data['pagetotal'] = $pagetotal;	//各10頁的總筆數數		
			$this->data['pageid'] = 1;			//第幾頁
		}
		else
		{
			$this->data = null;
		}		
		$this->load->view('v_warranty_home', $this->data);
	}

	
	public function search_switchpage($id,$searchvalue)//多頁數執行
	{

		$warranty_model = new m_warranty_model();
		$temp = $warranty_model->getwarranty();	
		$fristitem = 0;
		if ($temp != 0) 
		{	
			$totalitem = count($temp);		
			if(($id * 10) > $totalitem)
			{
				$itemmax = $totalitem;
			}
			else
			{
				$itemmax = ($id * 10);		
			}
			$j = 0;	
			$i = ($id - 1) * 10 ;//依頁面筆數 EX 第3頁(從21~30筆資料)，此處為前20筆資料
			$this->data['fristitem'] = ($id - 1) * 10;//丟往前端迴圈參數
			$this->data['itemmax'] = $itemmax;//丟往前端迴圈參數
			foreach($temp as $row):
				
				if($fristitem >= $i)
				{				
					if($fristitem < $itemmax)
					{	
						$this->data[$j] = $row;
						$j++;
					}
				}	
				$fristitem++;				
			endforeach;			
			
			//資料筆數
			if($totalitem >= 10)
			{	
				if($totalitem % 10 != 0)
				{
					$pageitem = floor($totalitem / 10) + 1;
				}
				else
				{
					$pageitem = $totalitem / 10;
				}		
			}
			else
			{
				$pageitem = 1;
			}
			//頁數		
			if($id > 10 )
			{	
				$pagefrist = floor(($id - 1) / 10) * 10;
				$pagetotal = (floor(($id - 1) / 10) + 1) * 10;
				if($pagelast > $sheetid)
				{
					$pagetotal = $sheetid;
				}
			}
			else
			{	
				$pagefrist = 0;
				$pagetotal = $pageitem;		
			}
			$this->data['pagefrist'] = $pagefrist;	//各10頁的第一頁
			$this->data['pagetotal'] = $pagetotal;	//各10頁的總筆數數		
			$this->data['pageid'] = $id;			//第幾頁
		}
		else
		{
			$this->data = null;
		}		
		$this->load->view('v_warranty_home', $this->data);
	}
	*/
	public function delete_service() 
	{
		$m_service_model = new m_service_model();
		$this->data = $this->uri->uri_to_assoc(3);
		echo $id = $this->data["service_id"];
		$m_service_model->deleteservice($id);
		$this->data = $m_service_model->getservice();	
		redirect(base_url("/service/service_home"));	
	}
		
	public function edit_service() 
	{
		$service_model = new m_service_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["service_id"];
		$this->data = $service_model->getserviceByID($id);
		$count = 0 ;
		for ($i = 0; $i < 6; $i++)
		{	
			if($this->data["payment_date".($i+1)] != "")
			{	
				$count++;				
			}
		}
		$this->data['payment_date_count']=$count;
		$this->load->view('v_edit_service', $this->data);
	}
	
	
	public function service_edit() 
	{
		$service_model = new m_service_model();
		$data = New datamodel;
		
		$id = $this->input->post("Id");
		$signing_day = $this->input->post("signing_day");
		$mechanical_warranty = $this->input->post("mechanical_warranty");
		$service_month = $this->input->post("service_month");
		$license = $this->input->post("license");
		$license_day = $this->input->post("license_day");
		$Total_price = $this->input->post("Total_price");

		for ($i = 0; $i < 6; $i++)
		{	
			$payment_date[$i] = $this->input->post("payment_date".($i+1)) == Null ? "" : $this->input->post("payment_date".($i+1));
			$payment_amount[$i] = $this->input->post("payment_amount".($i+1)) == Null ? 0 : $this->input->post("payment_amount".($i+1));
			$Item_status[$i] = $this->input->post("Item_status".($i+1)) == Null ? 0 : $this->input->post("Item_status".($i+1));			
		}
		$remark = $this->input->post("remark");		
		$warranty_id = $this->input->post("warranty_id");
		
		$data->id = $id;
		$data->signing_day = $signing_day;
		$data->mechanical_warranty = $mechanical_warranty;
		$data->service_month = $service_month;
		$data->license = $license;
		$data->license_day = $license_day;
		$data->Total_price = $Total_price;
		$data->payment_date = $payment_date;
		$data->payment_amount = $payment_amount;
		$data->Item_status = $Item_status;
		$data->remark = $remark;
		$data->warranty_id = $warranty_id;
		
		$service_model->updateservice($data);
		redirect(base_url("/service/service_home"));
	}
	
		
	public function create_service() 
	{	
		$this->load->view('v_create_service');
	}
	/*
	public function warranty_create_by_transaction($transaction_id, $nums) 
	{
		$warranty_model = new m_warranty_model();
		$data = New datamodel;
		$data->transaction_id = $transaction_id;
		
		for ($i = 0; $i < $nums; $i++)
			$warranty_model->insertwarranty($data);
		redirect(base_url("/warranty/warranty_home"));
	}
	*/	
	public function service_create() 
	{
		$service_model = new m_service_model();
		$data = New datamodel;
		
		$signing_day = $this->input->post("signing_day");
		$mechanical_warranty = $this->input->post("mechanical_warranty");
		$service_month = $this->input->post("service_month");
		$license = $this->input->post("license");
		$license_day = $this->input->post("license_day");
		$Total_price = $this->input->post("Total_price");

		for ($i = 0; $i < 6; $i++)
		{	
			$payment_date[$i] = $this->input->post("payment_date".($i+1)) == Null ? "" : $this->input->post("payment_date".($i+1));
			$payment_amount[$i] = $this->input->post("payment_amount".($i+1)) == Null ? 0 : $this->input->post("payment_amount".($i+1));
			$Item_status[$i] = $this->input->post("Item_status".($i+1)) == Null ? 0 : $this->input->post("Item_status".($i+1));			
		}
		$remark = $this->input->post("remark");		
		$warranty_id = $this->input->post("warranty_id");
		
		$data->signing_day = $signing_day;
		$data->mechanical_warranty = $mechanical_warranty;
		$data->service_month = $service_month;
		$data->license = $license;
		$data->license_day = $license_day;
		$data->Total_price = $Total_price;
		$data->payment_date = $payment_date;
		$data->payment_amount = $payment_amount;
		$data->Item_status = $Item_status;
		$data->remark = $remark;
		$data->warranty_id = $warranty_id;
		
		$service_model->insertservice($data);
		redirect(base_url("/service/service_home"));	
	}
}
