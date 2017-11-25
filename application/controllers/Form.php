<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends CI_Controller {
	//
	var $data = array();
	function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('Form_model');
		$this->load->model('Elevator_model');
		$this->load->model('Customer_model');
		$this->load->library('datamodel');
		$this->load->library('common');
		
		
        $this->load->helper(array('form', 'url'));//
	}
	
	public function upload()//////////////////////////
    {
        $this->load->view('upload_form');
    }

    public function do_upload()
    {
        $config['upload_path']      = './uploads/';//資料夾位置
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 0;//檔案大小 0為不限制
        $config['max_width']        = 0;//最大畫數 0為不限制
        $config['max_height']       = 0;//最小畫數 0為不限制

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            
            $this->load->view('upload_success', $data);
        }
    }
	
	//////////////////////////////////////////////////
	
	

	
	public function transaction_home() 
	{
		$form_model = new Form_model();
		$common = new Common();
		$temp = $form_model->getTransaction();
		$fristitem = 0;
		$totalitem = 0;
		
		if ($temp != 0) 
		{	
			$totalitem = count($temp);	
			if(10 > $totalitem)
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
			//	$row->status = $common->conversionFormStatusByID($row->status);
			//	$row->form_type = $common->conversionFormTypeByID($row->form_type);
				$row->status = "已完成收款";
				$row->is_complete = true;
				$row->left_money = $row->total_price;
				if($fristitem < $itemmax)
				{	

					for ($i = 0; $i < 6; $i++)
					{
						
						if ($row->item[$i] != 0 && $row->item_status[$i] != 5) 
						{
							$row->status = "尚未收款完成";	
							$row->is_complete = false;
						}
						else if ($row->item[$i] != 0 && $row->item_status[$i] == 5)
						{
							$row->left_money -= ($row->total_price*($row->item[$i]*0.01));
						}
					}
			
					$this->data[$fristitem] = $row;
				}
				$fristitem++;
			endforeach;			
			
			//資料筆數
			if($totalitem >= 10)
			{	 $totalitem;
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
				$pageitem=1;
			}
			//頁數
			$pagefrist = 0;
			if($pageitem > 10 )
			{	
				$pagetotal = 10;
			}
			else
			{
				$pagetotal = $pageitem;		
			}
			$this->data['pagefrist'] = $pagefrist;
			$this->data['pagetotal'] = $pagetotal;		
			$this->data['pageid'] = 1;	
		}
		else
		{
			$this->data = null;
		}

		$this->load->view('v_transaction_home', $this->data);	
	}
	
	public function transaction_Search() 
	{
		$form_model = new Form_model();
		$common = new Common();
		$searchvalue = $this->input->post("Search"); 
		$temp = $form_model->getTransactionBySearch($searchvalue);
		$fristitem = 0;
		$totalitem = 0;
		//$_SESSION['searchvalue'] = $searchvalue;
		//echo "<br>".count($temp);	
		if ($temp != 0) 
		{	
			$totalitem = count($temp);	
			if(10 > $totalitem)
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
			//	$row->status = $common->conversionFormStatusByID($row->status);
			//	$row->form_type = $common->conversionFormTypeByID($row->form_type);
				$row->status = "已完成收款";
				$row->left_money = $row->total_price;
				if($fristitem < $itemmax)
				{	

					for ($i = 0; $i < 6; $i++)
					{
						
						if ($row->item[$i] != 0 && $row->item_status[$i] != 5) 
						{
							$row->status = "尚未收款完成";													
						}
						else if ($row->item[$i] != 0 && $row->item_status[$i] == 5)
						{
							$row->left_money -= ($row->total_price*($row->item[$i]*0.01));
						}
					}
			
					$this->data[$fristitem] = $row;
				}
				$fristitem++;
			endforeach;			
			//echo "<br>$fristitem=".$fristitem;
			//資料筆數
			if($totalitem >= 10)
			{	 $totalitem;
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
				$pageitem=1;
			}
			//頁數
			$pagefrist = 0;
			if($pageitem > 10 )
			{	
				$pagetotal = 10;
			}
			else
			{
				$pagetotal = $pageitem;		
			}
			$this->data['pagefrist'] = $pagefrist;
			$this->data['pagetotal'] = $pagetotal;		
			$this->data['pageid'] = 1;	
			$this->data['search'] = $searchvalue;
		}
		else
		{
			$this->data = null;
		}
		//echo "<br>".count($this->data);	
		$this->load->view('v_search_transaction', $this->data);	
	}
	
		
	public function search_switchpage($id,$searchvalue)
	{	//echo $searchvalue = $_SESSION['searchvalue'] ;
		$searchvalue=urldecode($searchvalue);
		$form_model = new Form_model();
		$common = new Common();
		$temp = $form_model->getTransactionBySearch($searchvalue);
		$fristitem = 0;
		$k = array();
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
			$i = ($id-1) * 10 ;//依頁面筆數 EX 第3頁(從21~30筆資料)，此處為前20筆資料
			$this->data['fristitem'] = ($id - 1) * 10;//丟往前端迴圈參數
			$this->data['itemmax'] = $itemmax;//丟往前端迴圈參數
			foreach($temp as $row):
				$row->status = $common->conversionFormStatusByID($row->status);
				$row->form_type = $common->conversionFormTypeByID($row->form_type);
				if($fristitem>=$i)
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
			$this->data['pagefrist'] = $pagefrist;
			$this->data['pagetotal'] = $pagetotal;		
			$this->data['pageid'] = $id;
			$this->data['search'] = $searchvalue;			
		}
		else
		{
			$this->data = null;
		}
		$this->load->view('v_search_transaction', $this->data);	
	}

	
	public function create_transaction_view() 
	{
		$customer_model = new Customer_model();
		$this->data['customer'] = $customer_model->getCustomer();
		//$this->data['formType'] = $formType;
		$this->load->view('v_create_transaction', $this->data);	
	}
	
	public function create_transaction_model() 
	{
		$form_model = new Form_model();
		$data = New datamodel;
		$name = $this->input->post("Company_name"); 	
		$total_price = $this->input->post("Total_price"); 
		$is_return = $this->input->post("IsReturn"); 
		$start_date = $this->input->post("Start_date");  
		$elevator_num = $this->input->post("Elevator_num");
		$customer = $this->input->post("Customer"); 

		$startDate = $this->input->post("Start_date");
		
		$remind = $this->input->post("Remind");
		$item = array();
		$item_status = array();
		
		for ($i = 0; $i < 6; $i++)
		{	
			$item_name[$i] = $this->input->post("Item_name".($i+1)) == Null ? "" : $this->input->post("Item_name".($i+1));
			$item[$i] = $this->input->post("Item".($i+1)) == Null ? 0 : $this->input->post("Item".($i+1));
			$item_status[$i] = $this->input->post("Item_status".($i+1)) == Null ? 0 : $this->input->post("Item_status".($i+1));			
		}
		
		$data->name = $name;
		$data->total_price = $total_price;
		$data->return_back = $is_return;
		$data->customer_id = $customer;
		$data->start_date = $start_date;
		$data->item = $item;
		$data->item_status = $item_status;
		$data->item_name = $item_name;
		$data->remind = $remind;
		$data->elevator_num = $elevator_num;
		
		$form_model->insertTransaction($data);
		redirect(base_url("/form/transaction_home"));
		
	}
	
	public function delete_transaction_model() 
	{
		$form_model = new Form_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["transaction_id"];
		$form_model->deleteTransaction($id);
		$this->transaction_home();	
	}
	
	
	public function edit_transaction_view() 
	{
		$count=0;
		$form_model = new Form_model();
		$customer_model = new Customer_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["transaction_id"];
		$this->data = $form_model->getTransactionByID($id);
		
		for ($i = 0; $i < 6; $i++)
		{//echo $i;
			//echo $this->data["item_name1"];
			
			if($this->data["item_name".($i+1)] != "")
			{	
				$count++;//計算item_name欄位有幾個被使用				
			}

		}
		$this->data['item_count']=$count;
	
		$this->data['customer'] = $customer_model->getCustomer();						
		$this->load->view('v_edit_transaction', $this->data);		
	}
	
	public function view_transaction_view() 
	{
		$form_model = new Form_model();
		$customer_model = new Customer_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["transaction_id"];	
		$this->data = $form_model->getTransactionByID($id);
		$customer_id = $this->data['customer_id'];
		$count = 0;
		for ($i = 0; $i < 6; $i++)
		{//echo $i;
			//echo $this->data["item_name1"];
			
			if($this->data["item_name".($i+1)] != "")
			{	
				$count++;//計算item_name欄位有幾個被使用				
			}

		}
		
		$this->data['item_count']=$count;
		$this->data['customer'] = $customer_model->getCustomerByID($customer_id);		
		$this->load->view('v_view_transaction', $this->data);			
	}
		
	public function edit_transaction_model() 
	{
		$form_model = new Form_model();
		$data = New datamodel;
		$id = $this->input->post("Id");
		$name = $this->input->post("Company_name"); 	
		$elevator_num = $this->input->post("Elevator_num");
		$total_price = $this->input->post("Total_price"); 
		$is_return = $this->input->post("IsReturn"); 
		$start_date = $this->input->post("Start_date");  
		$customer = $this->input->post("Customer"); 

		$startDate = $this->input->post("Start_date");
		
		$remind = $this->input->post("Remind");
		$item = array();
		$item_status = array();
		
		for ($i = 0; $i < 6; $i++)
		{
			$item_name[$i] = $this->input->post("Item_name".($i+1));
			$item[$i] = $this->input->post("Item".($i+1));
			$item_status[$i] = $this->input->post("Item_status".($i+1));			
		}
		
		$data->id = $id;
		$data->name = $name;
		$data->elevator_num = $elevator_num;
		$data->total_price = $total_price;
		$data->return_back = $is_return;
		$data->customer_id = $customer;
		$data->start_date = $start_date;
		$data->item = $item;
		$data->item_status = $item_status;
		$data->item_name = $item_name;
		$data->remind = $remind;

		$form_model->updateTransaction($data);
		redirect(base_url("/form/transaction_home"));
		
	}
	
	
	
	public function switch_page($id)
	{
		$form_model = new Form_model();
		$common = new Common();
		$temp = $form_model->getTransaction();
		$fristitem = 0;
		$k = array();
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
			$i = ($id-1) * 10 ;//依頁面筆數 EX 第3頁(從21~30筆資料)，此處為前20筆資料
			$this->data['fristitem'] = ($id - 1) * 10;//丟往前端迴圈參數
			$this->data['itemmax'] = $itemmax;//丟往前端迴圈參數
			foreach($temp as $row):
				$row->status = $common->conversionFormStatusByID($row->status);
				$row->form_type = $common->conversionFormTypeByID($row->form_type);
				if($fristitem>=$i)
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
			$this->data['pagefrist'] = $pagefrist;
			$this->data['pagetotal'] = $pagetotal;		
			$this->data['pageid'] = $id;	
		}
		else
		{
			$this->data = null;
		}
		$this->load->view('v_transaction_home', $this->data);
	}

				
	public function Excel() 
	{
		setcookie("member_id",$_SESSION['id'],time()+3600);
		$project_list =  new Project_model();
		$member_id = $_SESSION['id'];
		$this->data = $project_list->getProject_List($member_id);
		$this->load->view('excel_home',$this->data);
	}

}
