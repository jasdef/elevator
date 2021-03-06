<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {
	
	var $data =array();
	function __construct()
	{
		parent::__construct();
		session_start();
        $this->load->model('public_tools'); //常用工具
		$this->load->model('Customer_model');
		$this->load->model('m_service_model');
		$this->load->model('m_warranty_model');
		$this->load->model('Form_action_log_model');
		$this->load->library('datamodel');
		$this->load->library('common');

        //菜單顯示部分
        $this->load->model('Usermenu_model');
        $usermenu_m = new Usermenu_model();
        if(isset($_SESSION['id'])) {
            $this->aUsermenulist = $usermenu_m->usermenulist($_SESSION['id']);
        }
	}
	
	public function service_home() 
	{	
		$service_model = new m_service_model();
		$temp = $service_model->getservice();
		$common = new Common();		
		$fristitem = 0;
		$itemmax = 10;
		$nowDate = getdate();
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
				$row->service_month = $common->converservicemonthByID($row->service_month);
				$row->license = $common->converlicenseByID($row->license);
				$row->status = "已完成收款";
				$row->is_create_service = false;
				if($fristitem < $itemmax)
				{	
					for ($i = 0; $i < 6; $i++)
					{
						
						if ($row->payment_amount[$i] != 0  && $row->item_status[$i] != $common->ITEM_STAUTS_ALREADY_GET_MONEY) 
						{	
							$row->status = "尚未收款完成";	
						}
						else if ($row->payment_amount[$i] != 0  && $row->item_status[$i] == $common->ITEM_STAUTS_ALREADY_GET_MONEY)
						{
							$row->status = "已完成收款";
						}																		
						
					}
					
					if ($row->signing_day != null) 
					{
						$temp = mb_split("/",$row->signing_day);
						if ($nowDate['year'] >= $temp[0]+$row->mechanical_warranty && $nowDate['mon'] >= $temp[1]
							&& $row->is_signing == $common->NOT_ANYTHING_SIGNING && $row->is_remind == $common->FORM_STATUS_SIGNING_COMPLETE)				
						{
							$row->is_create_service = true;
						}						
					}	
									
					//echo "<br>";	
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
			$fristitem = 0;
			$count = 0;	
			$prevcount = ($id - 1) * 10 ;//依頁面筆數 EX 第3頁(從21~30筆資料)，此處為前20筆資料
			$this->data['fristitem'] = ($id - 1) * 10;//丟往前端迴圈參數
			$this->data['itemmax'] = $itemmax;//丟往前端迴圈參數
			foreach($temp as $row):
				//$row->item_status = $common->conversionFormStatusByID($row->item_status);
				$row->service_month = $common->converservicemonthByID($row->service_month);
				$row->license = $common->converlicenseByID($row->license);
				$row->status = "已完成收款";
				
				if($fristitem >= $prevcount)
				{				
					if($fristitem < $itemmax)
					{	
							
						for ($i = 0; $i < 6; $i++)
						{
							
							if ($row->payment_amount[$i] != 0  && $row->item_status[$i] != 5) 
							{	
								$row->status = "尚未收款完成";	
							}
							else if ($row->payment_amount[$i] != 0  && $row->item_status[$i] == 5)
							{
								$row->status = "已完成收款";
							}
							
							
						}
						$this->data[$count] = $row;
						$count++;
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
	
	public function delete_service() 
	{
		$m_service_model = new m_service_model();
		$this->data = $this->uri->uri_to_assoc(3);
		echo $id = $this->data["service_id"];
		$m_service_model->deleteservice($id);
		$this->data = $m_service_model->getservice();	
		redirect(base_url("/service/service_home"));	
	}
	
	public function edit_service_staff()	
	{
		$service_model = new m_service_model();
		$warranty_model = new m_warranty_model();

		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["service_id"];
		$this->data = $this->uri->uri_to_assoc(5);
		$action_id = $this->data["action_id"];

		$service = $service_model->getserviceByID($id);

		$this->data = $warranty_model->getwarrantyByID($service['warranty_id']);
		if($this->data['contacter_3'] != null)
		{
			 $this->data['contacter_count'] = 3 ;
		}
		elseif($this->data['contacter_2'] != null)
		{
			$this->data['contacter_count'] = 2 ;
		}
		else
		{
			$this->data['contacter_count'] = 1 ;
		}
				
		if($this->data['tel_3'] != null)
		{
			 $this->data['tel_count'] = 3 ;
		}
		elseif($this->data['tel_2'] != null)
		{
			$this->data['tel_count'] = 2 ;
		}
		else
		{
			$this->data['tel_count'] = 1 ;
		}
		
		
		if($this->data['fax_3'] != null)
		{
			$this->data['fax_count'] = 3 ;
		}
		elseif($this->data['fax_2'] != null)
		{
			$this->data['fax_count'] = 2 ;
		}
		else
		{
			$this->data['fax_count'] = 1 ;
		}
		
		$this->data['id'] = $service['id'];

		$this->data['warranty_id'] = $service['warranty_id'];
		$this->data['action_id'] = $action_id;
		$this->load->view('v_edit_service_staff', $this->data);
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
	
	public function view_service_view() 
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

        $public_tools = new public_tools();
        $imgdata = $public_tools->getimgview(array('type'=>'service','typeid'=>$id));
        $this->data['imgdata'] = $imgdata;

		$this->load->view('v_view_service', $this->data);
		
	}

    public function delete_imgadd(){

        $transaction_id = $this->input->get('service_id');
        $id = $this->input->get('id');
        $this->db->where('id', $id);

        $d['isdelete'] = 1;
        $this->db->update('imgaddress',$d);
        redirect(base_url("/service/view_service_view/service_id/{$transaction_id}"));
    }
	
	public function service_edit_staff()
	{	
		$action_id = $this->input->post("Action_id");
		$id = $this->input->post("Id");
		$action_model = new Form_action_log_model();
		$public_tools = new public_tools();
        $public_tools->upload_tools(array('table'=>'service','id'=>$id,'file_name'=>'service','upload_path'=>'service'));
        $action_model->actionDoneStaff($action_id);

        redirect(base_url("/dispatch/dispatch_home_staff"));
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
		$do_times = $this->input->post("do_times");
		$is_remind = $this->input->post("is_remind");
		for ($i = 0; $i < 6; $i++)
		{	
			$payment_date[$i] = $this->input->post("payment_date".($i+1)) == Null ? "" : $this->input->post("payment_date".($i+1));
			$payment_amount[$i] = $this->input->post("payment_amount".($i+1))  == Null ? 0 :  $this->input->post("payment_amount".($i+1));
			$item_status[$i] = $this->input->post("item_status".($i+1)) == Null ? "" : $this->input->post("item_status".($i+1));			
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
		$data->item_status = $item_status;
		$data->remark = $remark;
		$data->warranty_id = $warranty_id;
		$data->do_times = $do_times;
		$data->is_remind = $is_remind;
		$service_model->updateservice($data);

        $public_tools = new public_tools();
        $public_tools->upload_tools(array('table'=>'service','id'=>$id,'file_name'=>'service','upload_path'=>'service'));

		redirect(base_url("/service/service_home"));
	}
	
	public function close_remind()//for 首頁 取消保養單續約 
	{
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["service_id"];
		$service_model = new m_service_model();
		$common = new Common();
		$data = New datamodel;
		$data->service_id = $id;
		$data->is_signing = $common->NO_CONTUNUE_SIGNING;
		
		$service_model->updateTransactionSigningState($data);
		redirect(base_url("/mainpage/index"));
	}

	
	public function create_service() 
	{	
		$this->load->view('v_create_service');
	}
	
	public function service_create_by_self($service_id) 
	{

		$service_model = new m_service_model();
		$data = $service_model->getserviceByID($service_id);

		$data->signing_day = null;
		$data->touch_time = null;
		$data->is_remind = $common->FORM_STATUS_NOT_REMIND;
		$data->is_signing = $common->NOT_ANYTHING_SIGNING;		
		$service_model->insertservice($data);
		
		$data->is_signing = $common->ALREADY_SIGNING;		
		$wservice_model->updateTransactionSigningState($data);
		
		
		redirect(base_url("/service/service_home"));	
	}
	
	public function service_create_by_warranty($warranty_id) 
	{
		$warranty_model = new m_warranty_model();
		$service_model = new m_service_model();
		$warranty = $warranty_model->getwarrantyByID($warranty_id);
		$data = New datamodel;
		$data->warranty_id = $warranty_id;
		$data->signing_day = $warranty['effective_date'];
		$data->mechanical_warranty = $warranty['free_maintenance'];
		
		$service_model->insertservice($data);
		
		$data->is_signing = $common->ALREADY_SIGNING;		
		$warranty_model->updateTransactionSigningState($data);
		
		
		redirect(base_url("/service/service_home"));	
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
		$do_times = $this->input->post("do_times");
		for ($i = 0; $i < 6; $i++)
		{	
			$payment_date[$i] = $this->input->post("payment_date".($i+1)) == Null ? "" : $this->input->post("payment_date".($i+1));
			$payment_amount[$i] = $this->input->post("payment_amount".($i+1)) == Null ? 0 : $this->input->post("payment_amount".($i+1));
			$item_status[$i] = $this->input->post("item_status".($i+1)) == Null ? 0 : $this->input->post("item_status".($i+1));			
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
		$data->item_status = $item_status;
		$data->remark = $remark;
		$data->warranty_id = $warranty_id;
		$data->do_times = $do_times;
		$service_model->insertservice($data);
		redirect(base_url("/service/service_home"));	
	}
}
