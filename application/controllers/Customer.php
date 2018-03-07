<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	var $data =array();
	function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('Customer_model');
		$this->load->library('datamodel');

		//菜單顯示部分
        $this->load->model('Usermenu_model');
        $usermenu_m = new Usermenu_model();
        $this->aUsermenulist = $usermenu_m->usermenulist($_SESSION['id']);

	}
	
	public function customer_home() 
	{	
		$customer_model = new Customer_model();
		$temp = $customer_model->getCustomer();	
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
		$this->load->view('customer_home', $this->data);
	}
	
	public function create_customer() 
	{	
		$this->load->view('create_customer');
	}
	
	
	public function switch_page($id)//多頁數執行
	{

		$customer_model = new Customer_model();
		$temp = $customer_model->getCustomer();	
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
		$this->load->view('customer_home', $this->data);
	}
	
	public function delete_customer() 
	{
		$customer_model = new Customer_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["customer_id"];
		$customer_model->deleteCustomer($id);
		$this->data = $customer_model->getCustomer();	
		redirect(base_url("/customer/customer_home"));	
	}
		
	public function edit_customer() 
	{
		$customer_model = new Customer_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["customer_id"];
		$this->data = $customer_model->getCustomerByID($id);
		if($this->data['contacter_3'] != null)
		{
			 $this->data['contacter_count'] = 3 ;
		}
		elseif($this->data['contacter_2'] != null)
		{
			$this->data['contacter_count'] = 2 ;
		}
		else
		{
			$this->data['contacter_count'] = 1 ;
		}
		
		
		if($this->data['address_3'] != null)
		{
			 $this->data['address_count'] = 3 ;
		}
		elseif($this->data['address_2'] != null)
		{
			$this->data['address_count'] = 2 ;
		}
		else
		{
			$this->data['address_count'] = 1 ;
		}
		
		
		if($this->data['tel_3'] != null)
		{
			 $this->data['tel_count'] = 3 ;
		}
		elseif($this->data['tel_2'] != null)
		{
			$this->data['tel_count'] = 2 ;
		}
		else
		{
			$this->data['tel_count'] = 1 ;
		}
		
		
		if($this->data['fax_3'] != null)
		{
			 $this->data['fax_count'] = 3 ;
		}
		elseif($this->data['fax_2'] != null)
		{
			$this->data['fax_count'] = 2 ;
		}
		else
		{
			$this->data['fax_count'] = 1 ;
		}
		
		$this->load->view('edit_customer', $this->data);
	}
	
	
	public function customer_edit() 
	{
		$customer_model = new Customer_model();
		$data = New datamodel;
		$id = $this->input->post("Id");
		$company = $this->input->post("company");
		$contacter_1 = $this->input->post("contacter_1");
		$contacter_2 = $this->input->post("contacter_2");
		$contacter_3 = $this->input->post("contacter_3");
		$address_1 = $this->input->post("address_1");
		$address_2 = $this->input->post("address_2");
		$address_3 = $this->input->post("address_3");
		$tel_1 = $this->input->post("tel_1");
		$tel_2 = $this->input->post("tel_2");
		$tel_3 = $this->input->post("tel_3");	
		$fax_1 = $this->input->post("fax_1");
		$fax_2 = $this->input->post("fax_2");
		$fax_3 = $this->input->post("fax_3");
		$num = $this->input->post("Num");
		$data->id = $id;
		$data->company = $company;
		$data->contacter_1 = $contacter_1;	
		$data->contacter_2 = $contacter_2;
		$data->contacter_3 = $contacter_3;
		$data->address_1 = $address_1;
		$data->address_2 = $address_2;
		$data->address_3 = $address_3;
		$data->tel_1 = $tel_1;
		$data->tel_2 = $tel_2;
		$data->tel_3 = $tel_3;
		$data->fax_1 = $fax_1;
		$data->fax_2 = $fax_2;
		$data->fax_3 = $fax_3;
		$data->num = $num;
		
		$customer_model->updateCustomer($data);
		redirect(base_url("/customer/customer_home"));
	}
	
	public function customer_create() 
	{
		$customer_model = new Customer_model();
		$data = New datamodel;
		$company = $this->input->post("company");
		$contacter_1 = $this->input->post("contacter_1");
		$contacter_2 = $this->input->post("contacter_2");
		$contacter_3 = $this->input->post("contacter_3");
		$address_1 = $this->input->post("address_1");
		$address_2 = $this->input->post("address_2");
		$address_3 = $this->input->post("address_3");
		$tel_1 = $this->input->post("tel_1");
		$tel_2 = $this->input->post("tel_2");
		$tel_3 = $this->input->post("tel_3");	
		$fax_1 = $this->input->post("fax_1");
		$fax_2 = $this->input->post("fax_2");
		$fax_3 = $this->input->post("fax_3");
		$num = $this->input->post("Num");
		$data->company = $company;
		$data->contacter_1 = $contacter_1;
		$data->contacter_2 = $contacter_2;
		$data->contacter_3 = $contacter_3;
		$data->address_1 = $address_1;
		$data->address_2 = $address_2;
		$data->address_3 = $address_3;
		$data->tel_1 = $tel_1;
		$data->tel_2 = $tel_2;
		$data->tel_3 = $tel_3;
		$data->fax_1 = $fax_1;
		$data->fax_2 = $fax_2;
		$data->fax_3 = $fax_3;;
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
