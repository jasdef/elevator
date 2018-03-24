<?php


class Form_model extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database();	
		$this->load->library('Datamodel');
		
	}
	
	public function insertTransaction($data) 
	{
		$this->db->set('name', $data->name);
		$this->db->set('total_price', $data->total_price);
		$this->db->set('start_date', $data->start_date);
		$this->db->set('is_return', $data->return_back);
		$this->db->set('elevator_num', $data->elevator_num);
		$this->db->set('receipt_status', $data->receipt_status);
		$this->db->set('customer_id', $data->customer_id);
		$this->db->set('is_duty', $data->is_duty);
		$this->db->set('is_receipt', $data->is_receipt);
		$this->db->set('remark', $data->remark);
		for ($i = 0; $i < 6; $i++) 
		{
			//echo Item_name[$i]."<br>";
			$this->db->set('item_name'.($i+1), $data->item_name[$i]);
			$this->db->set('item'.($i+1), $data->item[$i]);
			$this->db->set('item_status'.($i+1), $data->item_status[$i]);
		}
		$this->db->insert('transaction_form');			
	}		
	
	public function updateTransaction($data) 
	{
		$this->db->where('id',$data->id);
		$d['name'] = $data->name;
		$d['elevator_num'] = $data->elevator_num;
		$d['total_price'] = $data->total_price;
		$d['start_date'] = $data->start_date;
		$d['is_return'] = $data->is_return;
		$d['receipt_status'] = $data->receipt_status;
		$d['customer_id'] = $data->customer_id;
		$d['is_duty'] = $data->is_duty;
		$d['is_receipt'] = $data->is_receipt;
		$d['remark'] = $data->remark;
		
		for ($i = 0; $i < 6; $i++) 
		{
			$this->db->set('item_name'.($i+1), $data->item_name[$i]);
			$d['item'.($i+1)] = $data->item[$i];
			$d['item_status'.($i+1)] = $data->item_status[$i];
		}
		$this->db->update('transaction_form',$d);	
		
	}	
	
	
	public function deleteTransaction($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('transaction_form');
	}	
	
	public function getTransaction($sWhere='',$sOrder='')
	{
		$sSql = "select * from transaction_form where 1 ";

		if($sWhere!=''){
            $sSql .= " and name like '%{$sWhere}%'";
        }
        if($sOrder!=''){
		    $sSql .= "order by {$sOrder}";
        }
		$result = $this->db->query($sSql);

		if ($result->num_rows() > 0)
		{
			$idx = 0;
			$item = array();
			$item_name = array();
			$item_status = array();
			foreach ($result->result() as $row)
			{
				$form_data[$idx] = new Datamodel();
				$idx2 = 0;
				$idx3 = 0;
				$idx4 = 0;
				foreach ($row as $k => $v)
				{
						//echo $v;				
					if (preg_match("/\item_status/i", $k)) 
					{
						$item_status[$idx3] = $v;
						$idx3++;						
					}
					else if (preg_match("/\item_name/i", $k)) 
					{
						$item_name[$idx4] = $v;
						$idx4++;
					}
					else if (preg_match("/\item/i", $k)) 
					{
						$item[$idx2] = $v;
						$idx2++;
					}
					else 
					{
						$form_data[$idx]->$k = $v;						
					}
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}
				$form_data[$idx]->item = $item;
				$form_data[$idx]->item_name = $item_name;
				$form_data[$idx]->item_status = $item_status;
				$idx++;
			
			}
			return $form_data;
		}
		return 0;
		
	}


	public function getRowTransactiondata($iTransactionId){
	    if(!$iTransactionId) return false;

        $sSql = "select * from transaction_form where id={$iTransactionId} limit 1";
        $query = $this->db->query($sSql);

        $data = $query->row_array();

        $data['status'] = 1;
        for ($i = 1; $i <= 6; $i++) {

            if ($data['item'.$i] != 0 && $data['item_status'.$i] != 5) {
                $data['status'] = 2;
            }
        }

        return $data;
    }

    public function getWarrantyldatalist($iTransactionId){
        if(!$iTransactionId) return false;

        $sSql = "select * from warranty where transaction_id={$iTransactionId}";
        $query = $this->db->query($sSql);

        $data = $query->result_array();

        return $data;
    }

    public function getRowWarrantyldata($iWarrantyId){
        if(!$iWarrantyId) return false;

        $sSql = "select * from warranty where id={$iWarrantyId} limit 1";
        $query = $this->db->query($sSql);

        $data = $query->row_array();

        return $data;
    }

    public function getServicedatalist($iWarrantyId){
        if(!$iWarrantyId) return false;

        $sSql = "select * from service where warranty_id={$iWarrantyId}";
        $query = $this->db->query($sSql);

        $data = $query->result_array();

        return $data;
    }
	
	public function getTransactionByID($id) 
	{
		$this->db->select('*');
		$this->db->from('transaction_form');
		$this->db->where('id', $id);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			foreach ($result->result() as $row)
			{
				$form_data = array();
				foreach ($row as $k => $v)
				{
					$form_data[$k] = $v;
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}	
			}
			return $form_data;
		}
		return 0;
		
	}
	public function getTransactionBySearch($value) 
	{
		$this->db->select('*');
		$this->db->from('transaction_form');
		$this->db->or_like('id',$value,'both');
		$this->db->or_like('name',$value,'both');
		$this->db->or_like('total_price',$value,'both');
		$this->db->or_like('start_date',$value,'both');
		$this->db->or_like('is_return',$value,'both');
		$this->db->or_like('remind_month',$value,'both');
		$this->db->or_like('receipt_status',$value,'both');
		$this->db->or_like('item_name1',$value,'both');
		$this->db->or_like('item_name2',$value,'both');
		$this->db->or_like('item_name3',$value,'both');
		$this->db->or_like('item_name4',$value,'both');
		$this->db->or_like('item_name5',$value,'both');
		$this->db->or_like('item_name6',$value,'both');
		$this->db->or_like('item1',$value,'both');
		$this->db->or_like('item2',$value,'both');
		$this->db->or_like('item3',$value,'both');
		$this->db->or_like('item4',$value,'both');
		$this->db->or_like('item5',$value,'both');
		$this->db->or_like('item6',$value,'both');
		$this->db->or_like('item_status1',$value,'both');
		$this->db->or_like('item_status2',$value,'both');
		$this->db->or_like('item_status3',$value,'both');
		$this->db->or_like('item_status4',$value,'both');
		$this->db->or_like('item_status5',$value,'both');
		$this->db->or_like('item_status6',$value,'both');
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			$item = array();
			$item_name = array();
			$item_status = array();
			foreach ($result->result() as $row)
			{
				$form_data[$idx] = new Datamodel();
				$idx2 = 0;
				$idx3 = 0;
				$idx4 = 0;
				foreach ($row as $k => $v)
				{
						//echo $v;				
					if (preg_match("/\item_status/i", $k)) 
					{
						$item_status[$idx3] = $v;
						$idx3++;						
					}
					else if (preg_match("/\item_name/i", $k)) 
					{
						$item_name[$idx4] = $v;
						$idx4++;
					}
					else if (preg_match("/\item/i", $k)) 
					{
						$item[$idx2] = $v;
						$idx2++;
					}
					else 
					{
						$form_data[$idx]->$k = $v;						
					}
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}
				$form_data[$idx]->item = $item;
				$form_data[$idx]->item_name = $item_name;
				$form_data[$idx]->item_status = $item_status;
				$idx++;
			
			}
			return $form_data;
		}
		return 0;
		
	}

	public function getWarrantyList($iWarranty=0,$toPage,$toRows){

	    if($iWarranty==0){
	        return false;
        }

        $public_tools = new public_tools();
        $toPage = is_null($toPage)?1:$toPage;
        $toPage = ($toPage-1)<0?0:($toPage-1)*$toRows;

        $sSql = "select * from warranty where transaction_id={$iWarranty} limit $toPage,$toRows";
        $query = $this->db->query($sSql);

        $data['results'] = $query->result_array();
        $data['affects'] = $public_tools->get_total('warranty',array('transaction_id'=>$iWarranty));

        return $data;
    }


}