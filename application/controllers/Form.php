<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends CI_Controller {
	
	var $data =array();
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
		$this->data = $form_model->getForm();
		
		if ($this->data != 0) 
		{										
			foreach($this->data as $row):
			$row->status = $common->conversionFormStatusByID($row->status);
			$row->form_type = $common->conversionFormTypeByID($row->form_type);
			endforeach;
		}
		
		$this->load->view('form_home', $this->data);
	}
	
	public function project_new_admin()
	{
		$this->load->view('project_new_admin');
	}
	
	public function create_form() 
	{	
		$elevator_model = new Elevator_model();
		$customer_model = new Customer_model();
		$this->data['elevator'] = $elevator_model->getElevator();
		$this->data['customer'] = $customer_model->getCustomer();

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
		$month = $this->input->post("Month");
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
		$data->month = $month;
		$data->startDate = $startDate;
		$data->endDate = $endDate;
		$data->permissionDate = $permissionDate;
		$data->price = $price;
		$data->remind = $remind;

		$form_model->insertForm($data);
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
