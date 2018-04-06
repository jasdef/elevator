<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mainpage extends CI_Controller {
	var $data = array();
	function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('Form_model');
		$this->load->model('m_warranty_model');
		$this->load->model('Customer_model');
		$this->load->model('m_service_model');
		$this->load->library('datamodel');
		$this->load->library('common');

        //菜單顯示部分
        $this->load->model('Usermenu_model');
        $usermenu_m = new Usermenu_model();
        if(isset($_SESSION['id'])) {
            $this->aUsermenulist = $usermenu_m->usermenulist($_SESSION['id']);
        }
	}
	
	public function index()
	{					
		$this->data['session']=$_SESSION;
		if(isset($_SESSION["account"]) && $_SESSION["account"] != null){ //已經登入的話直接回首頁  
			$form_model = new Form_model();
			$warranty_model = new m_warranty_model();
			$Service_model= new m_service_model();
			$common = new Common();
			$temp = $form_model->getTransaction();
			$temp_array = array();
			$remind_arry = array();
			$index = 0;
			$isAdd = false;
			if ($temp != 0) 
			{
				foreach ($temp as $row) 
				{
					$row->status = "已完成收款";
					$row->left_money = $row->total_price;	

					for ($i = 0; $i < 6; $i++)
					{
						
						if ($row->item[$i] != 0 && $row->item_status[$i] != $common->ITEM_STAUTS_ALREADY_GET_MONEY) 
						{
							$row->status = "尚未收款完成";	
							$isAdd = true;
						}
						else if ($row->item[$i] != 0 && $row->item_status[$i] == $common->ITEM_STAUTS_ALREADY_GET_MONEY)
						{
							$row->left_money -= ($row->total_price*($row->item[$i]*0.01));
						}
					}
					
					if ($isAdd) 
					{
						$temp_array[$index] = $row;
						$index++;
						$isAdd = false;
					}
					else if ($row->is_signing != $common->FORM_STATUS_SIGNING_COMPLETE)
					{
						$row->type = "買賣單";
						$row->status = "簽保固單";
						$row->action = base_url("/Warranty/warranty_create_by_transaction/".$row->id."/".$row->elevator_num);
						$row->cancel = base_url("/Form/close_remind/transaction_id/".$row->id);
						$row->action_name = "結單";
						$remind_arry[count($remind_arry)] = $row;
						
					}
					
					
				}
				$this->data['transaction'] = $temp_array;
			}
			
								
			$temp = $warranty_model->getRemindWarranty();
			$result_array = array();
			$index = 0;
			
			if ($temp != 0) 
			{
				foreach ($temp as $row) 
				{
					$need_times = $row->free_maintenance * 12;
					
					if ($need_times > $row->warranty_times) 
					{
						$result_array[$index] = $row;		
						$row->need_times = $need_times;
						$index++;
					}
					else 
					{
						$row->type = "保固單";
						$row->status = "簽保養單";
						$remind_arry[count($remind_arry)] = $row;						
					}
				}								
			}
			
			$this->data['warranty'] = $result_array;
			
		
			$temp = $Service_model->getRemindService();
			$result_array = array();
			$index = 0;
			
			if ($temp != 0) 
			{
				foreach ($temp as $row) 
				{
					$need_times = $row->mechanical_warranty * 12 * $row->service_month * $row->do_times;
					
					if ($need_times > $row->service_times) 
					{
						$result_array[$index] = $row;		
						$row->need_times = $need_times;
						$index++;
					}
					else 
					{
						$row->type = "保養單";
						$row->status = "續約保養單";
						$remind_arry[count($remind_arry)] = $row;					
					}
				}
			}			
			
			$this->data['service'] = $result_array;
			$this->data['remind_signing'] = $remind_arry;
			
			
			
			
			
			$this->load->view('mainpage', $this->data);  
		}
		else {
			$this->load->view('sign-in'); 
		}
	}		
}