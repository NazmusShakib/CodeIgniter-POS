<?php

class Customer_control extends CI_Controller{
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('customer_model');
	}
	
	
	public function index()
	{
		$data[] = array();
		if($query = $this->customer_model->get_records()){
			$data['records'] = $query;
		}
		if(isset($btnupdate)){
		$data['one_cust'] = $this->customer_model->getcustomerrow($cust_id);
		}
		$data['maincontent'] = $this->load->view('customer_view',$data,true);	
		$this->load->view('master_view',$data);
	}
	
	public function add_customer(){		
		$data = array(
			'customer_name' => $this->input->post('cust_fname'),
			'address' => $this->input->post('cust_addr'),
			'contact' => $this->input->post('cont_no'),
			'prod_name' => $this->input->post('prods_names'),
			'membership_number' => $this->input->post('cust_mem_no'),
			'note' => $this->input->post('cust_note'),
			'expected_date' => $this->input->post('cust_ex_date')
		);
		$this->customer_model->add_record($data);
		$this->index();
	}
	
	public function edit_pop(){
		$this->load->view('cust_edit',true);
	}
	
	public function edit($cust_id){
		$data['one_cust'] = $this->customer_model->getcustomerrow($cust_id);
		
		//$this->index();
		$data['maincontent'] = $this->load->view('customer_view',$data,true);	
		$this->load->view('master_view',$data);
	}
	 
	public function delete(){
		$this->load->model('customer_model');
		$this->customer_model->delete_row();
		$this->index();
	}
	
	}
?>