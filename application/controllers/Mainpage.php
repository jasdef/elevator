<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mainpage extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		session_start();
	}
	
	public function index()
	{
		  
		$data=$_SESSION;
		if(isset($_SESSION["account"]) && $_SESSION["account"] != null){ //已經登入的話直接回首頁  
			$this->load->view('mainpage',$data);  
		}
		else {
			$this->load->view('sign-in'); 
		}
	}		
}