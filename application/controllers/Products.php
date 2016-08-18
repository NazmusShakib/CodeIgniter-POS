<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Products_mdl','person');
	}

	public function index()
	{
		$data[] = array();
		$data['maincontent'] = $this->load->view('products_view',$data,true);		
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$list = $this->person->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->product_code;
			$row[] = $person->gen_name;
			$row[] = $person->product_name;
			$row[] = $person->supplier;
			$row[] = $person->date_arrival;
			$row[] = $person->expiry_date;
			$row[] = $person->o_price;
			$row[] = $person->price;
			$row[] = $person->qty;
			$row[] = $person->qty_sold;
			$row[] = "";

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$person->product_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->product_id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->person->count_all(),
						"recordsFiltered" => $this->person->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->person->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'product_code' => $this->input->post('brand_nam'),
				'gen_name' => $this->input->post('gen_name'),
				'product_name' => $this->input->post('categoryDes'),
				'date_arrival' => $this->input->post('date_arrival'),
				'expiry_date' => $this->input->post('exp_date'),
				'price' => $this->input->post('sell_price'),
				'o_price' => $this->input->post('orginal_price'),
				'profit' => $this->input->post('profit'),
				'supplier' => $this->input->post('supp_name'),
				'qty' => $this->input->post('quantity'),
				'qty_sold' => $this->input->post('qtyleft')
			);
		$insert = $this->person->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'product_code' => $this->input->post('brand_nam'),
				'gen_name' => $this->input->post('gen_name'),
				'product_name' => $this->input->post('categoryDes'),
				'date_arrival' => $this->input->post('date_arrival'),
				'expiry_date' => $this->input->post('exp_date'),
				'price' => $this->input->post('sell_price'),
				'o_price' => $this->input->post('orginal_price'),
				'profit' => $this->input->post('profit'),
				'supplier' => $this->input->post('supp_name'),
				'qty' => $this->input->post('quantity'),
				'qty_sold' => $this->input->post('qtyleft')
			);
		$this->person->update(array('product_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->person->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('gen_name') == '')
		{
			$data['inputerror'][] = 'gen_name';
			$data['error_string'][] = 'Generic name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('quantity') == '')
		{
			$data['inputerror'][] = 'quantity';
			$data['error_string'][] = 'Quantity is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('brand_nam') == '')
		{
			$data['inputerror'][] = 'brand_nam';
			$data['error_string'][] = 'Brand Name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('date_arrival') == '')
		{
			$data['inputerror'][] = 'date_arrival';
			$data['error_string'][] = 'Arrival Date is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('sell_price') == '')
		{
			$data['inputerror'][] = 'sell_price';
			$data['error_string'][] = 'Selling Price is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
