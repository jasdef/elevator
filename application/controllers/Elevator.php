<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elevator extends CI_Controller {
	
	var $data =array();
	function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('Elevator_model');
		$this->load->library('datamodel');
	}
	public function elevator_home() 
	{	
		$elevator_model = new Elevator_model();
		$this->data = $elevator_model->getElevator();	
		$this->load->view('elevator_home', $this->data);
	}
	
	
	public function create_elevator() 
	{	
		$this->load->view('create_elevator');
	}
	
	public function elevator_create() 
	{
		$elevator_model = new Elevator_model();
		$data = New datamodel;
		$name = $this->input->post("Name");  
		$model = $this->input->post("Model");
		$address = $this->input->post("Address");
		$contact = $this->input->post("Contact");
		$tel = $this->input->post("Tel");

		
		$data->name = $name;
		$data->model = $model;
		$data->address = $address;
		$data->contact = $contact;
		$data->tel = $tel;
		$elevator_model->insertElevator($data);
		redirect(base_url("/elevator/elevator_home"));
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
