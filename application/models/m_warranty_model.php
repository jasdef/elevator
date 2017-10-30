<?php


class m_warranty_model extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database();	
		$this->load->library('Datamodel');
		
	}
	
	public function deletewarranty($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('warranty');
	}	
	
	public function insertwarranty($data)
	{

		$this->db->set('customer',$data->customer);
		$this->db->set('mechanical_warranty',$data->mechanical_warranty);
		$this->db->set('free_maintenance',$data->free_maintenance);
		$this->db->set('effective_date',$data->effective_date);
		$this->db->set('contacter_1',$data->contacter_1);
		$this->db->set('contacter_2',$data->contacter_2);
		$this->db->set('contacter_3',$data->contacter_3);
		$this->db->set('address',$data->address);
		$this->db->set('tel_1',$data->tel_1);
		$this->db->set('tel_2',$data->tel_2);
		$this->db->set('tel_3',$data->tel_3);
		$this->db->set('fax_1',$data->fax_1);
		$this->db->set('fax_2',$data->fax_2);
		$this->db->set('fax_3',$data->fax_3);
		$this->db->set('num',$data->num);
		$this->db->set('transaction_id', $data->transaction_id);
		$this->db->insert('warranty');	
	}
	
	public function updatewarranty($data) 
	{
		$this->db->where('id',$data->id);

		$d['customer'] = $data->customer;
		$d['mechanical_warranty'] = $data->mechanical_warranty;
		$d['free_maintenance'] = $data->free_maintenance;
		$d['effective_date'] = $data->effective_date;
		$d['contacter_1'] = $data->contacter_1;
		$d['contacter_2'] = $data->contacter_2;
		$d['contacter_3'] = $data->contacter_3;
		$d['address'] = $data->address;
		$d['tel_1'] = $data->tel_1;
		$d['tel_2'] = $data->tel_2;
		$d['tel_3'] = $data->tel_3;
		$d['fax_1'] = $data->fax_1;
		$d['fax_2'] = $data->fax_2;
		$d['fax_3'] = $data->fax_3;
		$d['num'] = $data->num;
		$d['transaction_id'] = $data->transaction_id;
		$this->db->update('warranty',$d);
		
	}
	
	public function getwarrantyByID($id) 
	{
		$this->db->select('*');
		$this->db->from('warranty');
		$this->db->where('id', $id);
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			foreach ($result->result() as $row)
			{
				$warranty_data = array();
				foreach ($row as $k => $v)
				{
					$warranty_data[$k] = $v;
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}	
			}
			return $warranty_data;
		}
		return 0;
	}
	
	public function getwarranty() 
	{
		$this->db->select('*');
		$this->db->from('warranty');
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
		{
			$idx = 0;
			foreach ($result->result() as $row)
			{
				$warranty_data[$idx] = new Datamodel();
				foreach ($row as $k => $v)
				{
					$warranty_data[$idx]->$k = $v;
					//$form_data[$idx]->manger= @$this->getMemberName($row->manager);// to do get elevator num
				}
				$idx++;
			}
			return $warranty_data;
		}
		return 0;
		
	}	
}
?>