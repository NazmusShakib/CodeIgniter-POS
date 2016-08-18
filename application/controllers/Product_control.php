<?php

class Product_control extends CI_Controller{
	
	
	public function index(){
		$data[] = array();
		$data['maincontent'] = $this->load->view('products_view',$data,true);		
		$this->load->view('master_view',$data);
	}
	
	public function add_product(){
		$data[] = array();
		$data['maincontent'] = $this->load->view('popup',$data,true);
		$data['popuup'] = $this->load->view('popup',$data,true);
		$this->load->view('master_view',$data);
	}

	public function delete(){
		$this->customer_model->delete_row();
		$this-index();
	}
	
}

?>