<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sales_mdl','sales');
	}
	
	public function index(){
		$data[] = array();	
		if($query = $this->sales->get_records()){
			$data['records'] = $query;
		}
		$data['maincontent'] = $this->load->view('sales_view',$data,true);		
		$this->load->view('master_view',$data);
	}
	
	public function addcart(){
		$produ = $this->sales->get_by_id($this->input->post('p_id'));
		$pfit = $produ->price - $produ->o_price;
		
		$insert = array(
			'id' => $produ->product_id,
			'qty' => $this->input->post('qty'),
			'price' => $produ->price,
			'name' => $produ->product_code,
			'cat' => $produ->product_name,
			'gen_name' => $produ->gen_name,
			'profit' =>  $pfit,
		);
		$this->cart->insert($insert);
		//$this->index();
		redirect(base_url().'sales');	
	}
	function remove($rowid) {
		$this->cart->update(array(
			'rowid' => $rowid,
			'qty' => 0
		));
		redirect(base_url().'sales');
	}
	
	public function cartupdate(){
		$i = 1;
		foreach($this->cart->contents() as $items)
		{
			$this->cart->update(
				array(
					'rowid' => $items['rowid'],
					'qty' => $_POST['qty'.$i]
				)
			);
			$i++;
		}
		redirect(base_url().'sales');
	}
	
	public function destroy(){
		$this->cart->destroy();
		redirect(base_url().'sales');
	}
	
	
}