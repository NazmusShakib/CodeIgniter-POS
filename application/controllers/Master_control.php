<?php 

class Master_control extends CI_Controller{
	
	public function index(){
		$data[] = array();
		$data['maincontent'] = $this->load->view('home_view',$data,true);		
		$this->load->view('master_view',$data);
	}
	
	
	public function home_control(){
		$data[] = array();
		$data['content'] = $this->load->view('home_view');
	}
	
	
}



?>