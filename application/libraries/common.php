<?php

class Common
{
	public $FORM_STATUS_NOT_REMIND = 0;//不需要提醒的狀態
	public $FORM_STATUS_NEED_REMIND = 1;//提醒要跑保養 或者 要簽約的狀態
	public $FORM_STATUS_SIGNING_COMPLETE = 2; //保養次數或日期已經到了
	public $NOT_ANYTHING_SIGNING = 0;//還沒談簽約
	public $ALREADY_SIGNING = 1;//已經簽約了
	public $NO_CONTUNUE_SIGNING = 2;//沒有續簽
	
	public $ITEM_STAUTS_NONE = 0;//尚無狀態
	public $ITEM_STAUTS_INVOICE = 1;//已開發票
	public $ITEM_STAUTS_REQUEST_PAYMENT = 2;//已送請款單
	public $ITEM_STAUTS_BOTH = 3;//已送請款單/發票
	public $ITEM_STAUTS_NOT_GET_MONEY = 4;//尚未收款
	public $ITEM_STAUTS_ALREADY_GET_MONEY = 5;//已收款
	
	public $FORM_TYPE_TRANSACTION = 1;//買賣單
	public $FORM_TYPE_WARRANTY = 2;//保固單
	public $FORM_TYPE_SERVICE = 3;//保養單
	
	public $DISPATCH_STATE_NOT_DISPATCH = 0;//還沒派遣
	public $DISPATCH_STATE_NOT_DISPATCH_STAFF = 1;//還沒派遣員工
	public $DISPATCH_STATE_ALREADY_DISPATCH = 2;//已經派遣員工了
	public $DISPATCH_STATE_WAIT_CHECK = 3;//員工做完了，等待確認
	public $DISPATCH_STATE_CHECK_DONE = 4;//確認完成

	public function conversionDispatchStateName($state) 
	{
		switch ($state) 
		{
			case 1:
				return '未派遣員工';
			case 2:
				return '已派員工';
			case 3:
				return '等待確認';
			case 4:
				return '確認完成';		
		}		
	}
	
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
	
	public function conversionFormName($id) 
	{
		switch ($id) 
		{
			case 1:
				return '買賣單';
			case 2:
				return '保養單';
			case 3:
				return '保固單';			
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
