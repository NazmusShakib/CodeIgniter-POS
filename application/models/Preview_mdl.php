<?php 

class preview_mdl extends CI_Model{
	
	var $table = 'orders';
	var $column = array('invoice_id,product_id,product_type,product_title,qty,price,profit,options');
	var $order = array('id' => 'desc'); // default order 
	
	public function get_records(){
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function get_by_id($id){
		/* $query = $this->db->get($this->table);
				 $this->db->where('invoice_id',$id);
		return $this->db->get($this->table)->row();
		 */
		//return $this->db->get_where($this->table, array('invoice_id' => $id));
		 
		$query = $this->db->query("select * from orders where invoice_id = '$id'");
		$result = $query->result_array();
		return $result; // this will return your data as array
	}
	
	
	
}


?>