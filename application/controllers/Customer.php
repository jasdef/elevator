<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	var $data =array();
	function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('Customer_model');
		$this->load->library('datamodel');
	}
	
	public function customer_home() 
	{	$_SESSION["pagesheet"]=1;
		$customer_model = new Customer_model();
		$this->data = $customer_model->getCustomer();	
		$this->load->view('customer_home', $this->data);
	}
	
	public function create_customer() 
	{	
		$this->load->view('create_customer');
	}
		public function customer_sheet($id)
			{

			
			$_SESSION["pagesheet"]=$id;
			$customer_model = new Customer_model();
			$this->data = $customer_model->getCustomer();	
			$this->load->view('customer_home', $this->data);
			}
	
	public function delete_customer() 
	{
		$customer_model = new Customer_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["customer_id"];
		$customer_model->deleteCustomer($id);
		$this->data = $customer_model->getCustomer();	
		$this->load->view('customer_home', $this->data);	
	}
		
	public function edit_customer() 
	{
		$customer_model = new Customer_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["customer_id"];
		$this->data = $customer_model->getCustomerByID($id);
		$this->load->view('edit_customer', $this->data);
	}
	
	
	public function customer_edit() 
	{
		$customer_model = new Customer_model();
		$data = New datamodel;
		$id = $this->input->post("Id");
		$name = $this->input->post("Name");
		$address = $this->input->post("Address");
		$tel = $this->input->post("Tel");
		$fax = $this->input->post("Fax");
		$num = $this->input->post("Num");
		$data->id = $id;
		$data->name = $name;
		$data->address = $address;
		$data->tel = $tel;
		$data->fax = $fax;
		$data->num = $num;
		
		$customer_model->updateCustomer($data);
		redirect(base_url("/customer/customer_home"));
	}
	
	public function customer_create() 
	{
		$customer_model = new Customer_model();
		$data = New datamodel;
		$name = $this->input->post("Name");
		$address = $this->input->post("Address");
		$tel = $this->input->post("Tel");
		$fax = $this->input->post("Fax");
		$num = $this->input->post("Num");
		$data->name = $name;
		$data->address = $address;
		$data->tel = $tel;
		$data->fax = $fax;
		$data->num = $num;
		$customer_model->insertCustomer($data);
		redirect(base_url("/customer/customer_home"));
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
