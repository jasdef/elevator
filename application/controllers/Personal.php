<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends CI_Controller 
{
	var $data = array();
	function __construct()
	{
		parent::__construct();
		session_start();
        $this->load->model('public_tools'); //常用工具
        $this->load->model('m_personal_model');
		$this->load->library('datamodel');
		$this->load->library('Member');
        $this->load->library('pagination');
	}

    public function personal_list()
    {

        $public_tools = new public_tools();
        $m_personal_model = new m_personal_model();

        $this->data['page_title'] = '人員列表';
        $this->data['breadcrumb_trail'] = $public_tools->breadcrumbTrail(array('人員管理','人員列表'));

        $iResult = $m_personal_model->getPersonalList();

        $this->data['list'] = $iResult['results'];

        $this->data['total_rows'] = $iResult['affects'];
        $config['base_url'] = "http://{$_SERVER['HTTP_HOST']}/elevator/personal/personal_list";
        $config['total_rows'] = $this->data['total_rows'];
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $this->load->view('v_personal_list', $this->data);
    }
		
	public function personal_home() 
	{	
		$m_personal_model = new m_personal_model();
		$temp = $m_personal_model->getpersonal();
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
			$this->data['fristitem'] = $fristitem; 
			$this->data['itemmax'] = $itemmax;	
											
			foreach($temp as $row):
				if($fristitem < $itemmax)
				{	
					$this->data[$fristitem] = $row;
					if($this->data[$fristitem]->status != 1)
					{
						$this->data[$fristitem]->status = "未停權";
					}
					else
					{
						$this->data[$fristitem]->status = "已停權";
					}
					
					if($this->data[$fristitem]->permission == 1)
					{
						$this->data[$fristitem]->permission = "系統管理員";
					}
					elseif($this->data[$fristitem]->permission == 2)
					{
						$this->data[$fristitem]->permission = "會計";
					}
					else
					{
						$this->data[$fristitem]->permission = "員工";
					}
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
			$this->data=null;
		}
		$this->load->view('v_personal_home', $this->data);
	}
	
	public function switch_page($id)
	{
		$m_personal_model = new m_personal_model();
		$temp = $m_personal_model->getForm();
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
				if($fristitem>=$i)
				{				
					if($fristitem < $itemmax)
					{	
						$this->data[$j] = $row;
						if($this->data[$j]->status != 1)
						{
							$this->data[$j]->status = "未停權";
						}
						else
						{
							$this->data[$j]->status = "已停權";
						}
						
						if($this->data[$j]->permission == 1)
						{
							$this->data[$j]->permission = "系統管理員";
						}
						elseif($this->data[$j]->permission == 2)
						{
							$this->data[$j]->permission = "會計";
						}
						else
						{
							$this->data[$j]->permission = "員工";
						}
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
		$this->load->view('v_personal_home', $this->data);
	}
	
	public function create_personal() 
	{	
		$this->load->view('v_create_personal');
	}
			
	public function personal_create() 
	{
		$m_personal_model = new m_personal_model();
		$data = New datamodel;
		$mem = new Member;
		
		$account = $this->input->post("account"); 	
		$password = $this->input->post("password"); 
		$passwordrt = $this->input->post("passwordrt");
		$name = $this->input->post("name");
		$permission = $this->input->post("permission"); 
		$status = $this->input->post("status"); 
		if(trim($account) =="" || trim($password) =="" || trim($passwordrt) =="" || trim($name) =="" || trim($permission) =="" || trim($status) ==""){  
			$this->load->view('v_create_personal',Array(  
				"errorMessage" => "資料不得有空值，請重新輸入！" ,  
			));  
			return false;  
		} 
		
		$exist = $mem->isExist($account);
		if($exist != 0)
		{
						$this->load->view("v_create_personal",Array( 
					"errorMessage" => "帳號已重複",
				)  
			); 
			return false; 
		}
		
		if($password != $passwordrt)
		{  
			$this->load->view("v_create_personal",Array( 
					"errorMessage" => "密碼不符合",
				)  
			);        
			return false;
		}
		else
		{
		$data->account = $account;
		$data->password = $password;
		$data->name = $name;
		$data->permission = $permission;
		$data->status = $status;
		
		$m_personal_model->insertpersonal($data);
		redirect(base_url("/personal/personal_home"));
		}
	}
	
		public function check($account,$password)
	{
		
		$mem = new Member;
		
		$person = $mem->getMemberData($account);		
		
		if($person->password == $password)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	
	}
	
	public function delete_personal() 
	{
		$m_personal_model = new m_personal_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["personal_id"];
		$m_personal_model->deletepersonal($id);
		$this->data = $m_personal_model->getpersonal();	
		redirect(base_url("/personal/personal_home"));	
	}	
	
	public function edit_personal() 
	{
		$m_personal_model = new m_personal_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["personal_id"];
		$this->data = $m_personal_model->getpersonalByID($id);
		$permission = $this->data['permission'];
		$status = $this->data['status'];

		
		$this->load->view('v_edit_personal', $this->data);
	}	
	
	public function personal_edit() 
	{
		$m_personal_model = new m_personal_model();
		$data = New datamodel;
		$id = $this->input->post("Id");
		$account = $this->input->post("account");
		$pw = $this->input->post("password");
		$name = $this->input->post("name");
		$permission = $this->input->post("permission");
		$status = $this->input->post("status");
		
		
		
		$data->id = $id;
		$data->account = $account;
		$data->password = $pw;
		$data->name = $name;
		$data->permission = $permission;
		$data->status = $status;

		
		$m_personal_model->updatepersonal($data);
		redirect(base_url("/personal/personal_home"));
	}
}
