<?php

public class form_action_log 
{
	
	function __construct()
	{
		$CI=& get_instance();
		$CI->load->model('Form_action_log_model');
		$CI->load->library('Form_data');	
	}
	
	public function addLog($data) 
	{
		$model = new Form_action_log_model();
		$model->addLog($data);
	}
	
	public function updateLog($data) 
	{
		$model = new Form_action_log_model();
		$model->updateLog($data);		
	}
	
	public function getLog($data) 
	{
		$model = new Form_action_log_model();
		$model->updateLog($data);		
	}
		
}