<?php

class Common
{
	public $FORM_STATUS_NOT_REMIND = 0;//不需要提醒的狀態
	public $FORM_STATUS_NEED_REMIND = 1;//提醒要跑保養 或者 要簽約的狀態
	public $FORM_STATUS_SIGNING_COMPLETE = 2; //已經簽完約或者不用簽約 不用再提醒保養的狀態
	
	public $ITEM_STAUTS_NONE = 0;//尚無狀態
	public $ITEM_STAUTS_INVOICE = 1;//已開發票
	public $ITEM_STAUTS_REQUEST_PAYMENT = 2;//已送請款單
	public $ITEM_STAUTS_BOTH = 3;//已送請款單/發票
	public $ITEM_STAUTS_NOT_GET_MONEY = 4;//尚未收款
	public $ITEM_STAUTS_ALREADY_GET_MONEY = 5;//已收款
	
	public function conversionFormStatusByID($id) 
	{
		switch ($id) 
		{
			case 0:
				return '尚無狀態';
			case 1:
				return '已開發票';
			case 2:
				return '已送請款單';
			case 3:
				return '已送請款單/發票';
			case 4:
				return '尚未收款';
			case 5:
				return '已收款';
			
		}		
	}	
	
	public function conversionFormTypeByID($id) 
	{
		switch ($id) 
		{
			case 0:
				return '尚未選擇合約書類型';
			case 1:
				return '買賣合約書';
			case 2:
				return '保養合約書';
			case 3:
				return '保固合約書';			
		}
	}

	public function converservicemonthByID($id) 
	{
		switch ($id) 
		{
			case 0:
				return '請選擇單雙月保養';
			case 1:
				return '單月保養';
			case 2:
				return '雙月保養';
		}
	}	
	
	public function converlicenseByID($id) 
	{
		switch ($id) 
		{
			case 1:
				return '有';
			case 2:
				return '無';
		}
	}
	
	public function conversionbystatus($id)
	{
		switch ($id) 
		{
			case 1:
				return '已完成收款';
			case 2:
				return '尚未收款完成';
		}
	}
	
}
