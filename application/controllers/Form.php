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
	}
	public function form_home() 
	{	
		$form_model = new Form_model();
		$common = new Common();
		$temp = $form_model->getForm();
		$fristitem = 0;
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
			$this->data[13] = $fristitem; 
			$this->data[14] = $itemmax;	
											
			foreach($temp as $row):
				$row->status = $common->conversionFormStatusByID($row->status);
				$row->form_type = $common->conversionFormTypeByID($row->form_type);
				if($fristitem < $itemmax)
				{	
					$this->data[$fristitem] = $row;
				}
				$fristitem++;
			endforeach;			
		}	
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
		$this->data[10] = $pagefrist;
		$this->data[11] = $pagetotal;		
		$this->data[12] = 1;	
		$this->load->view('form_home', $this->data);
	}
	/*
	public function switch_page10(19) 
	{
		11~15 21~30
		30
		
	->	21
	->total	5
	}*/
	
	public function switch_page($id)
	{
		$form_model = new Form_model();
		$common = new Common();
		$temp = $form_model->getForm();
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
			$this->data[13] = ($id - 1) * 10;//丟往前端迴圈參數
			$this->data[14] = $itemmax;//丟往前端迴圈參數
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
		}	
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
		$this->data[10] = $pagefrist;
		$this->data[11] = $pagetotal;		
		$this->data[12] = $id;	
		$this->load->view('form_home', $this->data);
	}
	
	public function project_new_admin()
	{
		$this->load->view('project_new_admin');
	}
	
	public function create_form($formType) 
	{	
		$elevator_model = new Elevator_model();
		$customer_model = new Customer_model();
		$this->data['elevator'] = $elevator_model->getElevator();
		$this->data['customer'] = $customer_model->getCustomer();
		$this->data['formType'] = $formType;
		$this->load->view('create_form', $this->data);
	}
					
	public function form_create() 
	{
		$form_model = new Form_model();
		$data = New datamodel;
		$type = $this->input->post("FormType"); 	
		$status = $this->input->post("FormStatus"); 
		$is_return = $this->input->post("IsReturn"); 
		$elevator = $this->input->post("Elevator");  
		$customer = $this->input->post("Customer"); 
		if ($type == 2)
			$month = $this->input->post("Month");
		if ($type == 3)
			$warranty = $this->input->post("Warranty");
		$startDate = $this->input->post("Start_date");
		$endDate = $this->input->post("End_date");
		$permissionDate = $this->input->post("Permission_date");
		$price = $this->input->post("Price");
		$remind = $this->input->post("Remind");

		$data->type = $type;
		$data->status = $status;
		$data->return_back = $is_return;
		$data->customer = $customer;
		$data->elevator = $elevator;
		if ($type == 2)
			$data->month = $month;
		if ($type == 3)
			$data->warranty = $warranty;
		$data->startDate = $startDate;
		$data->endDate = $endDate;
		$data->permissionDate = $permissionDate;
		$data->price = $price;
		$data->remind = $remind;

		$form_model->insertForm($data);
		redirect(base_url("/form/form_home"));
	}
	
	public function delete_form() 
	{
		$form_model = new Form_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["form_id"];
		$form_model->deleteForm($id);
		$this->form_home();
		//$this->data = $form_model->getForm();	
		//$this->load->view('form_home', $this->data);	
	}	
	
	public function edit_form() 
	{
		$form_model = new Form_model();
		$elevator_model = new Elevator_model();
		$customer_model = new Customer_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["form_id"];
		$this->data = $form_model->getFormByID($id);
		$this->data['elevator'] = $elevator_model->getElevator();
		$this->data['customer'] = $customer_model->getCustomer();				
		
		$this->load->view('edit_form', $this->data);
	}
	
	public function form_change($type)//For 在編輯中切換表單類型 要對應的切換欄位用 
	{
	/*	$form_model = new Form_model();
		$elevator_model = new Elevator_model();
		$customer_model = new Customer_model();
		//$this->data = $this->uri->uri_to_assoc(3);
	//	$id = $this->data["type"];
		/*$type = $this->data["type"];
		$this->data = $form_model->getFormByID($id);
		$this->data['form_type'] = $type;
		$this->data['elevator'] = $elevator_model->getElevator();
		$this->data['customer'] = $customer_model->getCustomer();				
		
		$this->load->view('edit_form', $this->data);*/
	}
	
	public function form_edit() 
	{
		$form_model = new Form_model();
		$data = New datamodel;
		$id = $this->input->post("Id"); 
		$type = $this->input->post("FormType"); 	
		$status = $this->input->post("FormStatus"); 
		$is_return = $this->input->post("IsReturn"); 
		$elevator = $this->input->post("Elevator");  
		$customer = $this->input->post("Customer"); 
		if ($type == 2)
			$month = $this->input->post("Month");
		if ($type == 3)
			$warranty = $this->input->post("Warranty");
		$startDate = $this->input->post("Start_date");
		$endDate = $this->input->post("End_date");
		$permissionDate = $this->input->post("Permission_date");
		$price = $this->input->post("Price");
		$remind = $this->input->post("Remind");
		
		$data->id = $id;
		$data->type = $type;
		$data->status = $status;
		$data->return_back = $is_return;
		$data->customer = $customer;
		$data->elevator = $elevator;
		if ($type == 2)
			$data->month = $month;
		if ($type == 3)
			$data->warranty = $warranty;
		$data->startDate = $startDate;
		$data->endDate = $endDate;
		$data->permissionDate = $permissionDate;
		$data->price = $price;
		$data->remind = $remind;
		$form_model->updateForm($data);
		redirect(base_url("/form/form_home"));
	}	
	
	
	public function select_school_name(){
		$schoolfuntion = new Project_model();
		$this->data = $schoolfuntion->selectschoolname();
		$length = count($this->data);
		for($a = 0;$a<=$length;$a++){
			if($a == 0)
				$schooldata.= '<option value="0" selected="selected">請選擇</option>';
			else
				$schooldata.= '<option value='.$this->data[$a-1]->id.'>'.$this->data[$a-1]->name.'</option>';
		}
		print_r($schooldata);
	}
	
	public function creating_project()
	{
		$project = New Project_model;
		$data = New datamodel;
		
		/*儲存新增專案資料*/
		$projectname = $this->input->post("ProjectName");  
		date_default_timezone_set('Asia/Taipei');
        $area = $this->input->post("Area");  
        $SchoolName = $this->input->post("SchoolName");  
        $county = $this->input->post("Counties");  
        $status = $this->input->post("purview");
		
		/*欄位不得為空值判斷*/
		if(trim($projectname) == ""){  
			$this->load->view('project_new_admin',Array(  
				"errorMessage" => "資料不得有空值，請重新輸入！" ,  
				"ProjectName" => $projectname
			));  
			return false;  
		}
		
		/*縣市下拉式選單判斷*/
		if($county == "0"){  
			$this->load->view('project_new_admin',Array(  
				"errorMessage" => "請選擇縣市！" ,  
				"ProjectName" => $projectname
			));  
			return false;  
		}
		
		/*地區下拉式選單判斷*/
		if($area == "請選擇"){  
			$this->load->view('project_new_admin',Array(  
				"errorMessage" => "請選擇地區！" ,  
				"ProjectName" => $projectname ,
				"Counties" => $county
			));  
			return false;  
		}
		
		$data->name = $projectname;
		$data->area = $area;
		$data->county = $county;
		$data->status = $status;
		$data->manager = $project->memberid($_SESSION["account"], $_SESSION["username"]);
		
		if($SchoolName == 0){
			$NewSchoolName = $this->input->post("NewSchoolName");
			$data->school_id = $project->schoolname($NewSchoolName);
			
		}
		else{
			$data->school_id = $project->schoolname($SchoolName);
		}
		$project->createProject($data);
		
		redirect(base_url("/projectadmin/project_home"));
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
