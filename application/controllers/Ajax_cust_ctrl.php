<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_cust_ctrl extends CI_Controller{
	
	public function __construct(){
		
		parent::__construct();
		$this->load->model('ajax_cust_mdl','cust_mdl');
	}
	public function index(){
		$data[] = array();
		$data['maincontent'] = $this->load->view('ajax_cust_view',$data,true);		
		$this->load->view('master_view',$data);		
	}
	
	public function ajax_list(){
		
		$list = $this->cust_mdl->get_datatables();
		$data = array();
		$no = $_POST['start'];
		
		foreach($list as $customer){
			$no++;
			$row = array();
			$row[] = $customer->customer_name;
			$row[] = $customer->address;
			$row[] = $customer->contact;
			$row[] = $customer->prod_name;
			$row[] = $customer->membership_number;
			$row[] = $customer->note;
			$row[] = $customer->expected_date;
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$customer->customer_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$customer->customer_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->cust_mdl->count_all(),
						"recordsFiltered" => $this->cust_mdl->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_delete($id)
	{
		$this->cust_mdl->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_add(){
		$this->_validate();
		$data = array(
			'customer_name' => $this->input->post('cust_fname'),
			'address' => $this->input->post('cust_addr'),
			'contact' => $this->input->post('cont_no'),
			'prod_name' => $this->input->post('prods_names'),
			'membership_number' => $this->input->post('cust_mem_no'),
			'note' => $this->input->post('cust_note'),
			'expected_date' => $this->input->post('cust_ex_date')
		);
		$insert = $this->cust_mdl->add_record($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_edit($id)
	{
		$data = $this->cust_mdl->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
		
	
	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'customer_name' => $this->input->post('cust_fname'),
				'address' => $this->input->post('cust_addr'),
				'contact' => $this->input->post('cont_no'),
				'prod_name' => $this->input->post('prods_names'),
				'membership_number' => $this->input->post('cust_mem_no'),
				'note' => $this->input->post('cust_note'),
				'expected_date' => $this->input->post('cust_ex_date')
			);
		$this->cust_mdl->update(array('customer_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
	
	
	private function _validate(){
		
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('cust_fname') == ''){
			$data['inputerror'][] = 'cust_fname';
			$data['error_string'][] = 'Customer name is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('cust_addr') == ''){
			$data['inputerror'][] = 'cust_addr';
			$data['error_string'][] = 'Customer name is required';
			$data['status'] = FALSE;
		}
		
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		
	}
	
	
}