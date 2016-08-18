<?php

class Customer_model extends CI_Model{
	function get_records(){
		$query = $this->db->get('customer');
		return $query->result();	
	}
	function add_record($data){
		$this->db->insert('customer',$data);
		//return;
	}
	function update_record($data){
		$this->db->where('id',7);
		$this->db->update('customer',$data);
	}
	function update_view($data){
		$this->db->where('customer_id',7);
		$this->db->update('customer',$data);
	}
	function delete_row(){
		$this->db->where('customer_id',$this->uri->segment(3));
		$this->db->delete('customer');
	}
	function getcustomerrow($customer_id){
		$this->db->where('customer_id',$customer_id);
		$query = $this->db->get('customer');
		return $query->row(); 	//return only one item or 1 row only
	}
}