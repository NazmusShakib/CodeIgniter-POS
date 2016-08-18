<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
/* 		if(!$this->session->userdata('username'))
		{
			redirect('login');
		} */
		$this->load->model('model_orders');
	}

	public function index()
	{
		$this->_validate();
		
 		$is_processed = $this->model_orders->process();
		
		if($is_processed)
		{
			echo json_encode(array("status" => TRUE));
			
			//redirect(base_url());
		}else{
				$this->session->set_flashdata('error','Failed To Processed Your Order ! , please try again');
				redirect('welcome');
			 }
	}

	
	
	public function success()
	{
		$data['get_sitename'] = $this->model_settings->sitename_settings();
		$data['get_footer'] = $this->model_settings->footer_settings();	
	
		$this->load->view('order_success',$data);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('custm_name') == '')
		{
			$data['inputerror'][] = 'custm_name';
			$data['error_string'][] = 'Customer name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('cash') == '')
		{
			$data['inputerror'][] = 'cash';
			$data['error_string'][] = 'Cash is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}//end  class