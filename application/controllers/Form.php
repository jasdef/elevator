<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends CI_Controller {
	//
	var $data = array();
	function __construct()
	{
		parent::__construct();
		session_start();
        $this->load->model('public_tools'); //常用工具
		$this->load->model('Form_model');
		$this->load->model('Elevator_model');
		$this->load->model('Customer_model');
		$this->load->library('datamodel');
		$this->load->library('common');
        $this->load->library('pagination');
		
		
        $this->load->helper(array('form', 'url'));//

        //菜單顯示部分
        $this->load->model('Usermenu_model');
        $usermenu_m = new Usermenu_model();
        if(isset($_SESSION['id'])) {
            $this->aUsermenulist = $usermenu_m->usermenulist($_SESSION['id']);
        }
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
			$error1 = "未選擇上傳圖片";
            print_r($error);
			echo "<br>".$error1;
			echo "<br><a href=".base_url("/form/upload").">返回上一頁</a>";
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

        $iTransactionId=$this->input->get('transaction_id'); //買賣單
        $iWarrantyId=$this->input->get('warranty_id'); //保固單
        $iServiceId=$this->input->get('service_id'); //保養名冊

        $form_model = new Form_model();
        $common = new Common();

        if($iTransactionId && !$iWarrantyId){

            $aRowTransactiondata=$form_model->getRowTransactiondata($iTransactionId);
            $aRowTransactiondata['status_sta'] = $common->conversionbystatus($aRowTransactiondata['status']);
            $this->data['RowTransactiondata'] = $aRowTransactiondata;

            $aWarrantyldatalist=$form_model->getWarrantyldatalist($iTransactionId);
            $this->data['Warrantyldatalist'] = $aWarrantyldatalist;

            $this->load->view('v_transaction_process', $this->data);

        }
        elseif($iTransactionId && $iWarrantyId){
            $aRowTransactiondata=$form_model->getRowTransactiondata($iTransactionId);
            $aRowTransactiondata['status_sta'] = $common->conversionbystatus($aRowTransactiondata['status']);
            $this->data['RowTransactiondata'] = $aRowTransactiondata;

            $aRowWarrantydata=$form_model->getRowWarrantyldata($iWarrantyId);
            $this->data['RowRowWarrantydata'] = $aRowWarrantydata;

            $aServicedatalist=$form_model->getServicedatalist($iWarrantyId);


            foreach($aServicedatalist as $k=>$row) {
                $row['service_month'] = $common->converservicemonthByID($row['service_month']);
                $row['license'] = $common->converlicenseByID($row['license']);
                $row['status'] = "已完成收款";
                    for ($i = 1; $i <= 6; $i++) {

                        if ($row['payment_amount'.$i] != 0 && $row['item_status'.$i] != 5) {
                            $row['status'] = "尚未收款完成";
                        } else if ($row['payment_amount'.$i] != 0 && $row['item_status'.$i] == 5) {
                            $row['status'] = "已完成收款";
                        }
                    }
                $aServicedatalist[$k] = $row;
            }
            $this->data['Servicedatalist'] = $aServicedatalist;

            $this->load->view('v_transaction_process2', $this->data);
        }
        else {

            $sSearch = $this->input->get("Search");
            $isorder = $this->input->get("isorder") ? $this->input->get("isorder") : 'id';
            $isby = $this->input->get("isby");

            $sOrder = '';
            if ($isorder) {

                if ($isby == '') {
                    $isby = 'asc';
                } elseif ($isby == 'asc') {
                    $isby = 'desc';
                } elseif ($isby == 'desc') {
                    $isby = 'asc';
                } else {
                    $isby = '';
                }
                $sOrder = "$isorder $isby";
            }

            $temp = $form_model->getTransaction($sSearch, $sOrder);
            $fristitem = 0;
            $totalitem = 0;

            if ($temp != 0) {
                $totalitem = count($temp);
                if (10 > $totalitem) {
                    $itemmax = $totalitem;
                } else {
                    $itemmax = 10;
                }
                $this->data['fristitem'] = $fristitem;
                $this->data['itemmax'] = $itemmax;
                $this->data['isby'] = $isby;

                foreach ($temp as $row):
                    //	$row->status = $common->conversionFormStatusByID($row->status);
                    //	$row->form_type = $common->conversionFormTypeByID($row->form_type);
                    $row->status = 1;
                    $row->is_complete = true;
                    $row->left_money = $row->total_price;
                    if ($fristitem < $itemmax) {

                        for ($i = 0; $i < 6; $i++) {

                            if ($row->item[$i] != 0 && $row->item_status[$i] != 5) {
                                $row->status = 2;
                                $row->is_complete = false;
                            } else if ($row->item[$i] != 0 && $row->item_status[$i] == 5) {
                                $row->left_money -= ($row->total_price * ($row->item[$i] * 0.01));
                            }
                        }
                        $row->status = $common->conversionbystatus($row->status);
                        $this->data[$fristitem] = $row;
                    }
                    $fristitem++;
                endforeach;

                //資料筆數
                if ($totalitem >= 10) {
                    $totalitem;
                    if ($totalitem % 10 != 0) {
                        $pageitem = floor($totalitem / 10) + 1;
                    } else {
                        $pageitem = $totalitem / 10;
                    }
                } else {
                    $pageitem = 1;
                }
                //頁數
                $pagefrist = 0;
                if ($pageitem > 10) {
                    $pagetotal = 10;
                } else {
                    $pagetotal = $pageitem;
                }
                $this->data['pagefrist'] = $pagefrist;
                $this->data['pagetotal'] = $pagetotal;
                $this->data['pageid'] = 1;
            } else {
                $this->data = null;
            }
            $this->load->view('v_transaction_home', $this->data);
        }
	}
	
	public function transaction_Search() 
	{

		$searchvalue = $this->input->post("Search"); 
		if($searchvalue != null)
		{  
			redirect(base_url("/Form/search_switchpage/1/".$searchvalue)); 
		}			
		else	
		{
			redirect(base_url("/Form/transaction_home")); 
					
		} 
	}
	
	public function search_switchpage($id,$searchvalue)
	{	
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
			$count = 0;	
			$prevcount = ($id-1) * 10 ;//依頁面筆數 EX 第3頁(從21~30筆資料)，此處為前20筆資料
			$this->data['fristitem'] = ($id - 1) * 10;//丟往前端迴圈參數
			$this->data['itemmax'] = $itemmax;//丟往前端迴圈參數
			foreach($temp as $row):
				$row->status = 1;
				$row->is_complete = true;
				$row->left_money = $row->total_price;
				if($fristitem>=$prevcount)
				{				
					if($fristitem < $itemmax)
					{	
						for($i=0;$i<6;$i++)
						{
							if ($row->item[$i] != 0 && $row->item_status[$i] != 5) 
							{
								$row->status = 2;	
								$row->is_complete = false;
							}
							else if ($row->item[$i] != 0 && $row->item_status[$i] == 5)
							{
								$row->left_money -= ($row->total_price*($row->item[$i]*0.01));
							}
						}
						$row->status = $common->conversionbystatus($row->status);
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
		$is_duty = $this->input->post("IsDuty");
		$is_receipt = $this->input->post("IsReceipt");
		$remark = $this->input->post("Remark");
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
		$data->is_duty = $is_duty;
		$data->is_receipt = $is_receipt;
		$data->remark = $remark;
		
		
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

		//保固頁標籤
        $toPage = $this->input->get('per_page');
        $perPageRows = 10;
        $iResult = $form_model->getWarrantyList($id,$toPage,$perPageRows);

        $this->data['warranty_list'] = $iResult['results'];

        $this->data['total_rows'] = $iResult['affects'];
        $config['base_url'] = "http://{$_SERVER['HTTP_HOST']}/elevator/personal/personal_list";
        $config['total_rows'] = $this->data['total_rows'];
        $config['per_page'] = $perPageRows;
        $this->pagination->initialize($config);
		
		$this->data['item_count']=$count;
		$this->data['customer'] = $customer_model->getCustomerByID($customer_id);		
//		$this->load->view('v_view_transaction', $this->data);
		$this->load->view('v_view_transaction_bk', $this->data);
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
		$is_duty = $this->input->post("IsDuty");
		$is_receipt = $this->input->post("IsReceipt");
		$remark = $this->input->post("Remark");
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
		$data->is_return = $is_return;
		$data->customer_id = $customer;
		$data->start_date = $start_date;
		$data->item = $item;
		$data->item_status = $item_status;
		$data->item_name = $item_name;
		$data->remind = $remind;
		$data->is_duty = $is_duty;
		$data->is_receipt = $is_receipt;
		$data->remark = $remark;
		
		
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
			$count = 0;	
			$prevcount = ($id-1) * 10 ;//依頁面筆數 EX 第3頁(從21~30筆資料)，此處為前20筆資料
			$this->data['fristitem'] = ($id - 1) * 10;//丟往前端迴圈參數
			$this->data['itemmax'] = $itemmax;//丟往前端迴圈參數
			foreach($temp as $row):
				//$row->status = $common->conversionFormStatusByID($row->status);
				//$row->form_type = $common->conversionFormTypeByID($row->form_type);
				$row->status = 1;
				$row->is_complete = true;
				$row->left_money = $row->total_price;
				if($fristitem>=$prevcount)
				{				
					if($fristitem < $itemmax)
					{	
						for($i=0;$i<6;$i++)
						{
							if ($row->item[$i] != 0 && $row->item_status[$i] != 5) 
							{
								$row->status = 2;	
								$row->is_complete = false;
							}
							else if ($row->item[$i] != 0 && $row->item_status[$i] == 5)
							{
								$row->left_money -= ($row->total_price*($row->item[$i]*0.01));
							}
						}
						$row->status = $common->conversionbystatus($row->status);
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
