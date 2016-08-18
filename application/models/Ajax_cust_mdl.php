<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_cust_mdl extends CI_model{
	
	var $table = 'customer';
	var $column = array('customer_name','address','contact','prod_name','membership_number','note','expected_date');
	var $order = array('customer_id' => 'desc');//Default order

	public function add_record($data){
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}
	
	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		}
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	public function delete_by_id($id)
	{
		$this->db->where('customer_id', $id);
		$this->db->delete($this->table);
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

}


?>