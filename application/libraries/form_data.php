<?php

class Form_data
{
	/**
    table_type
	1 = 買賣單
	2 = 保固單
	3 = 保養單
	*/
	private $data = array();
	
	function __construct()
	{
	
	}
	
	public function __set($name,$value)
	{
		$this->data[$name] = $value;
	}
	
	public function __get($name)
	{
		if (array_key_exists($name,$this->data))
		{
			return $this->data[$name];
		}
	}


}
