<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Warranty extends CI_Controller {
	
	var $data =array();
	function __construct()
	{
		parent::__construct();
		session_start();
        $this->load->model('public_tools'); //常用工具
		$this->load->model('Customer_model');
		$this->load->model('m_warranty_model');
		$this->load->model('Form_model');
		$this->load->library('datamodel');

        //菜單顯示部分
        $this->load->model('Usermenu_model');
        $usermenu_m = new Usermenu_model();
        if(isset($_SESSION['id'])) {
            $this->aUsermenulist = $usermenu_m->usermenulist($_SESSION['id']);
        }
	}
	
	public function warranty_home() 
	{	
		$warranty_model = new m_warranty_model();
		$form_model = new Form_model();			
		$temp = $warranty_model->getwarranty();	
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
					$row->transaction_name = "";
					if ($row->transaction_id != 0) 
					{
						$transaction = $form_model->getTransactionByID($row->transaction_id);
						$row->transaction_name = $transaction['name'];
					}
					
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
		$this->load->view('v_warranty_home', $this->data);
	}

	
	public function switch_page($id)//多頁數執行
	{

		$warranty_model = new m_warranty_model();
		$temp = $warranty_model->getwarranty();	
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
		$this->load->view('v_warranty_home', $this->data);
	}
	
	public function warranty_Search() 
	{	
		$searchvalue = $this->input->post("Search"); 
		if($searchvalue != null)
		{ 
			redirect(base_url("/warranty/search_switchpage/1/".$searchvalue));
		}			
		else	
		{
			redirect(base_url("/warranty/warranty_home")); 
					
		} 
	}

	
	public function search_switchpage($id,$searchvalue)//多頁數執行
	{
		$searchvalue=urldecode($searchvalue);
		$warranty_model = new m_warranty_model();
		$temp = $warranty_model->getwarrantyBySearch($searchvalue);	
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
			$this->data['search'] = $searchvalue;
		}
		else
		{
			$this->data = null;
		}		
		$this->load->view('v_search_warranty', $this->data);
	}
	
	public function delete_warranty() 
	{
		$warranty_model = new m_warranty_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["warranty_id"];
		$warranty_model->deletewarranty($id);
		$this->data = $warranty_model->getwarranty();	
		redirect(base_url("/warranty/warranty_home"));	
	}
		
	public function edit_warranty() 
	{
		$warranty_model = new m_warranty_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["warranty_id"];
		$this->data = $warranty_model->getwarrantyByID($id);
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
		
		$this->load->view('v_edit_warranty', $this->data);
	}
	
	public function view_warranty_view() 
	{
				$warranty_model = new m_warranty_model();
		$this->data = $this->uri->uri_to_assoc(3);
		$id = $this->data["warranty_id"];
		$this->data = $warranty_model->getwarrantyByID($id);
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

        //圖片檢視
        $public_tools = new public_tools();
        $imgdata = $public_tools->getimgview(array('type'=>'warranty','typeid'=>$id));
        $this->data['imgdata'] = $imgdata;
		
		$this->load->view('v_view_warranty', $this->data);
	}

    public function delete_imgadd(){

        $transaction_id = $this->input->get('warranty_id');
        $id = $this->input->get('id');
        $this->db->where('id', $id);

        $d['isdelete'] = 1;
        $this->db->update('imgaddress',$d);
        redirect(base_url("/Warranty/view_warranty_view/warranty_id/{$transaction_id}"));
    }
	
	public function warranty_edit() 
	{
		$warranty_model = new m_warranty_model();
		$data = New datamodel;
		$id = $this->input->post("Id");
		$customer = $this->input->post("customer");
		$mechanical_warranty = $this->input->post("mechanical_warranty");
		$free_maintenance = $this->input->post("free_maintenance");
		$effective_date = $this->input->post("effective_date");
		$contacter_1 = $this->input->post("contacter_1");
		$contacter_2 = $this->input->post("contacter_2");
		$contacter_3 = $this->input->post("contacter_3");
		$address = $this->input->post("address");
		$tel_1 = $this->input->post("tel_1");
		$tel_2 = $this->input->post("tel_2");
		$tel_3 = $this->input->post("tel_3");	
		$fax_1 = $this->input->post("fax_1");
		$fax_2 = $this->input->post("fax_2");
		$fax_3 = $this->input->post("fax_3");
		$num = $this->input->post("Num");
		$transaction_id = $this->input->post("transaction_id");
		$is_remind = $this->input->post("is_remind");
		$data->id = $id;
		$data->customer = $customer;
		$data->mechanical_warranty = $mechanical_warranty;
		$data->free_maintenance = $free_maintenance;
		$data->effective_date = $effective_date;
		$data->contacter_1 = $contacter_1;	
		$data->contacter_2 = $contacter_2;
		$data->contacter_3 = $contacter_3;
		$data->address = $address;
		$data->tel_1 = $tel_1;
		$data->tel_2 = $tel_2;
		$data->tel_3 = $tel_3;
		$data->fax_1 = $fax_1;
		$data->fax_2 = $fax_2;
		$data->fax_3 = $fax_3;
		$data->num = $num;
		$data->transaction_id = $transaction_id;
		$data->is_remind = $is_remind;
		$warranty_model->updatewarranty($data);

        $public_tools = new public_tools();
        $public_tools->upload_tools(array('table'=>'warranty','id'=>$id,'file_name'=>'warranty','upload_path'=>'warranty'));

		redirect(base_url("/warranty/warranty_home"));
	}
	
		
	public function create_warranty() 
	{	
		$this->load->view('v_create_warranty');
	}
	
	public function warranty_create_by_transaction($transaction_id, $nums) 
	{
		$form_model = new form_model();
		$warranty_model = new m_warranty_model();
		$data = New datamodel;
		$data->transaction_id = $transaction_id;
		
		for ($i = 0; $i < $nums; $i++)
			$warranty_model->insertwarranty($data);
		
		$data->is_signing = 2;//已簽約不用再提醒了
		$form_model->updateTransactionSigningState($data);
		
		redirect(base_url("/warranty/warranty_home"));
	}
		
	public function warranty_create() 
	{
		$warranty_model = new m_warranty_model();
		$data = New datamodel;
		$customer = $this->input->post("customer");
		$mechanical_warranty = $this->input->post("mechanical_warranty");
		$free_maintenance = $this->input->post("free_maintenance");
		$effective_date = $this->input->post("effective_date");
		$contacter_1 = $this->input->post("contacter_1");
		$contacter_2 = $this->input->post("contacter_2");
		$contacter_3 = $this->input->post("contacter_3");
		$address = $this->input->post("address");
		$tel_1 = $this->input->post("tel_1");
		$tel_2 = $this->input->post("tel_2");
		$tel_3 = $this->input->post("tel_3");	
		$fax_1 = $this->input->post("fax_1");
		$fax_2 = $this->input->post("fax_2");
		$fax_3 = $this->input->post("fax_3");
		$num = $this->input->post("Num");
		$transaction_id = $this->input->post("transaction_id");
		$data->customer = $customer;
		$data->mechanical_warranty = $mechanical_warranty;
		$data->free_maintenance = $free_maintenance;
		$data->effective_date = $effective_date;
		$data->contacter_1 = $contacter_1;
		$data->contacter_2 = $contacter_2;
		$data->contacter_3 = $contacter_3;
		$data->address = $address;
		$data->tel_1 = $tel_1;
		$data->tel_2 = $tel_2;
		$data->tel_3 = $tel_3;
		$data->fax_1 = $fax_1;
		$data->fax_2 = $fax_2;
		$data->fax_3 = $fax_3;;
		$data->num = $num;
		$data->is_remind = 1;//開始檢查提醒		
		$data->transaction_id = $transaction_id;
		$warranty_model->insertwarranty($data);
		redirect(base_url("/warranty/warranty_home"));	
	}
}
