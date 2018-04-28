<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dispatch extends CI_Controller {
	//
	var $data = array();	
	function __construct()
	{
		parent::__construct();
		session_start();
        $this->load->model('public_tools'); //常用工具
		$this->load->model('Form_action_log_model');
		$this->load->model('form_model');
		$this->load->model('m_personal_model');
		$this->load->model('m_warranty_model');
		$this->load->model('m_service_model');
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
	
	public function addLog()
	{
		
		$action_model = new Form_action_log_model();
		$personal_model = new m_personal_model();
		$data = New datamodel;
		$this->data = $this->uri->uri_to_assoc(3);
		$table_type = $this->data['table_type'];
		$this->data = $this->uri->uri_to_assoc(5);
		$table_id = $this->data['table_id'];
		$dispatcher = $_SESSION['id'];

		$data->table_id = $table_id;
		$data->table_type = $table_type;	
		$data->dispatcher = $dispatcher;
		$action_model->addLog($data);

		redirect(base_url("/dispatch/dispatch_home"));	
	}
	
	public function chage_staff_view() 
	{
		$action_model = new Form_action_log_model();
		$personal_model = new m_personal_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["dispatch_id"];	
		$this->data = $action_model->getLogByID($id);
		$this->data['all_staff'] = $personal_model->getStaff();		

		$this->load->view('v_edit_dispatch_staff', $this->data);

	}

	public function change_staff() 
	{
		$action_model = new Form_action_log_model();
		$data = New datamodel;
		$id = $this->input->post("Id");
		$staff = $this->input->post("Staff"); 	

		$data->id = $id;
		$data->staff = $staff;		
		
		$action_model->changeStaff($data);

		redirect(base_url("/dispatch/dispatch_home"));			
	}

	public function check_done() 
	{	
		$action_model = new Form_action_log_model();
		$table_model = null;
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["dispatch_id"];			
		$action_model->checkDone($id);
		$temp = $action_model->getLogByID($id);
		$table_model = $this->getModel($temp['table_type']);

		$table_model->updateRemindState($temp['table_id']);
		redirect(base_url("/dispatch/dispatch_home"));
	}

	public function getModel($table_type)
	{
		$common = new Common();

		switch ($table_type) 
		{
			case $common->FORM_TYPE_TRANSACTION:
				return new form_model();
			case $common->FORM_TYPE_WARRANTY:
				return new m_warranty_model();
			case $common->FORM_TYPE_SERVICE:
				return new m_service_model();
		}
	}

	public function dispatch_home() 
	{
		$action_model = new Form_action_log_model();
		$member_model = new m_personal_model();
		$form_model = new Form_model();
		$warranty_model = new m_warranty_model();
		$service_model = new m_service_model();
		
        $common = new Common();

		$temp = $action_model->getNotFinishLog();
		
         
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
                //$this->data['isby'] = $isby;

                foreach ($temp as $row):

                    if ($fristitem < $itemmax) 
					{
						switch ($row->table_type) 
						{
							case $common->FORM_TYPE_TRANSACTION:
							$r = $form_model->getTransactionByID($row->table_id);
							$row->table_name = $r['name'];
							break;							
							case $common->FORM_TYPE_WARRANTY:
							$r = $warranty_model->getwarrantyByID($row->table_id);
							$row->table_name = $r['customer'];
							break;
							case $common->FORM_TYPE_SERVICE:
							$r = $service_model->getserviceByID($row->table_id);
							$w = $warranty_model->getwarrantyByID($r['warranty_id']);
							$row->table_name = $w['customer'];
							break;							
						}
											
						$row->status = $common->conversionDispatchStateName($row->is_finish);
						$row->type_name = $common->conversionFormName($row->table_type);
						if ($row->staff != null)
							$row->staff_name = $member_model->getpersonalByID($row->staff)['name'];
						$row->dispatch_name =  $member_model->getpersonalByID($row->dispatcher)['name'];
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
            } 
			else 
			{
                $this->data = null;
            }
		
        $this->load->view('v_dispatch', $this->data);       
	}
	
	public function dispatch_Search() 
	{

		$searchvalue = $this->input->post("Search"); 
		if($searchvalue != null)
		{  
			redirect(base_url("/dispatch/search_switchpage/1/".$searchvalue)); 
		}			
		else	
		{
			redirect(base_url("/dispatch/dispatch_home")); 
					
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

		//圖片檢視
        $public_tools = new public_tools();
		$imgdata = $public_tools->getimgview(array('type'=>'transaction','typeid'=>$id));

		unset($this->data['item_count']);
		unset($this->data['customer']);
		unset($this->data['imgdata']);

		$this->data['item_count']=$count;
		$this->data['customer'] = $customer_model->getCustomerByID($customer_id);		
		$this->data['imgdata'] = $imgdata;
//		$this->load->view('v_view_transaction', $this->data);
		$this->load->view('v_view_transaction_bk', $this->data);
	}
		
	
	public function switch_page($id)
	{
		$action_log_model = new Form_action_log_model();
		$common = new Common();
		$temp = $action_log_model->getNotFinishLog();
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

				if($fristitem>=$prevcount)
				{				
					if($fristitem < $itemmax)
					{	
						$row->status = $common->conversionDispatchStateName($row->is_finish);
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
		$this->load->view('v_dispatch', $this->data);
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
