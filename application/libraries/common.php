<?php

class Common
{
	
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
	
}
