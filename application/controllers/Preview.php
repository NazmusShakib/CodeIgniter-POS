<?php 


class Preview extends CI_Controller{
	
	
	public function __construct(){
		
		parent::__Construct();
		$this->load->model('preview_mdl');
		
	}
	
	public function index(){
		//echo "Echo from Preview";
		$data[] = array();
		$myVar = $this->session->userdata('sess_invoice');
		//$myVar = $this->session->flashdata($sess_invoice);
		$data['records'] = $this->preview_mdl->get_by_id($myVar);
		
		$data['maincontent'] = $this->load->view('preview_view',$data,true);
		$this->cart->destroy();
		$this->load->view('master_view',$data);
	}
	
	public function get_data(){
		

		
	}
	
	
	
	
}


?>