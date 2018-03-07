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
		$this->load->library('datamodel');
		$this->load->library('common');
	}
	
	public function index()
	{					
		$this->data['session']=$_SESSION;
		if(isset($_SESSION["account"]) && $_SESSION["account"] != null){ //已經登入的話直接回首頁  
			$form_model = new Form_model();
			$warranty_model = new m_warranty_model();			
			$temp = $form_model->getTransaction();
			$temp_array = array();
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
						
						if ($row->item[$i] != 0 && $row->item_status[$i] != 5) 
						{
							$row->status = "尚未收款完成";	
							$isAdd = true;
						}
						else if ($row->item[$i] != 0 && $row->item_status[$i] == 5)
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
					
				}
				$this->data['transaction'] = $temp_array;
			}
			
			$temp = $warranty_model->getwarranty();
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
					}										
				}
				
				$this->data['warranty'] = $result_array;
			}
						
			
			$this->load->view('mainpage', $this->data);  
		}
		else {
			$this->load->view('sign-in'); 
		}
	}		
}