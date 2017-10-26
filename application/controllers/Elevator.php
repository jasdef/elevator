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
		$temp = $elevator_model->getElevator();	
		$fristitem = 0;
		$itemmax = 10;
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
				if($fristitem < $itemmax)
				{	
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
		$this->load->view('elevator_home', $this->data);
	}
	
	public function switch_page($id)//多頁數執行
	{
		$elevator_model = new Elevator_model();
		$temp = $elevator_model->getElevator();	
		$fristitem = 0;
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
			$i = ($id - 1) * 10 ;//依頁面筆數 EX 第3頁(從21~30筆資料)，此處為前20筆資料
			$this->data['fristitem'] = ($id - 1) * 10;//丟往前端迴圈參數
			$this->data['itemmax'] = $itemmax;//丟往前端迴圈參數
			foreach($temp as $row):
				if($fristitem >= $i)
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
		$this->load->view('elevator_home', $this->data);
	}
	
	
	public function create_elevator() 
	{	
		$this->load->view('create_elevator');
	}
	
	public function delete_elevator() 
	{
		$elevator_model = new Elevator_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["elevator_id"];
		$elevator_model->deleteElevator($id);
		$this->data = $elevator_model->getElevator();	
		$this->load->view('elevator_home', $this->data);	
	}
		
	public function edit_elevator() 
	{
		$elevator_model = new Elevator_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["elevator_id"];
		$this->data = $elevator_model->getElevatorByID($id);
		$this->load->view('edit_elevator', $this->data);
	}
	
	
	public function elevator_edit() 
	{
		$elevator_model = new Elevator_model();
		$data = New datamodel;
		$id = $this->input->post("Id");
		$model = $this->input->post("Model");
		$data->id = $id;
		$data->model = $model;
		$elevator_model->updateElevator($data);
		redirect(base_url("/elevator/elevator_home"));
	}
	
	
	public function elevator_create() 
	{
		$elevator_model = new Elevator_model();
		$data = New datamodel;
		$model = $this->input->post("Model");
		$data->model = $model;
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
