<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mainpage extends CI_Controller {
	
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
	
	public function index()
	{					
		$data=$_SESSION;
		if(isset($_SESSION["account"]) && $_SESSION["account"] != null){ //已經登入的話直接回首頁  
			$form_model = new Form_model();
			$temp = $form_model->getTransaction();
			
			if ($temp != 0) 
			{
				foreach ($temp as $row) 
				{
					
					
				}
				
			}
			
			
			$this->load->view('mainpage',$data);  
		}
		else {
			$this->load->view('sign-in'); 
		}
	}		
}