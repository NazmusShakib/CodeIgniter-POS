<?php

	class Sales_mdl extends CI_Model{
		
	var $table = 'products';
	var $column = array('product_code','gen_name','product_name','o_price','price','profit','supplier','qty','qty_sold','expiry_date','date_arrival'); //set column field database for order and search
	var $order = array('product_id' => 'desc'); // default order 
		
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_records(){
		$query = $this->db->get($this->table);
		return $query->result();
	}
	
	public function get_by_id($id){
		$this->db->where('product_id',$id);
		return $this->db->get($this->table)->row();
	}

	}

?>