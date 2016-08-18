<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_ctrl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Supplier_mdl','person');
	}

	public function index()
	{
		$data[] = array();
		$data['maincontent'] = $this->load->view('supplier_view',$data,true);		
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
			$row[] = $person->suplier_name;
			$row[] = $person->suplier_contact;
			$row[] = $person->suplier_address;
			$row[] = $person->contact_person;
			$row[] = $person->note;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$person->suplier_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->suplier_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
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
				'suplier_name' => $this->input->post('supp_name'),
				'suplier_address' => $this->input->post('address'),
				'contact_person' => $this->input->post('cnt_person'),
				'suplier_contact' => $this->input->post('contact_no'),
				'note' => $this->input->post('note'),
			);
		$insert = $this->person->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'suplier_name' => $this->input->post('supp_name'),
				'suplier_address' => $this->input->post('address'),
				'contact_person' => $this->input->post('cnt_person'),
				'suplier_contact' => $this->input->post('contact_no'),
				'note' => $this->input->post('note'),
			);
		$this->person->update(array('suplier_id' => $this->input->post('id')), $data);
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

		if($this->input->post('supp_name') == '')
		{
			$data['inputerror'][] = 'supp_name';
			$data['error_string'][] = 'Supplier name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('address') == '')
		{
			$data['inputerror'][] = 'address';
			$data['error_string'][] = 'Address is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('cnt_person') == '')
		{
			$data['inputerror'][] = 'cnt_person';
			$data['error_string'][] = 'Contact Person is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('contact_no') == '')
		{
			$data['inputerror'][] = 'contact_no';
			$data['error_string'][] = 'Contact No is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('note') == '')
		{
			$data['inputerror'][] = 'note';
			$data['error_string'][] = 'Note is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
