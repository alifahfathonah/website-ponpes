<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class Rooms extends Core_base {

	public function __construct()
	{
		if (!parent::is_login()) {
            redirect('login');
        }
		parent::__construct();
		$this->load->model('m_rooms');
	}

	public function index()
	{
		if ($this->com_user['level'] == 2) {
            redirect('login');
        }
		// load css & js tambahan (yg blm ada di template)
		$this->load_css('assets/modules/jqueryformvalidator/form-validator/theme-default.min.css');
		$this->load_js('assets/modules/jqueryformvalidator/form-validator/jquery.form-validator.min.js');
		
		$this->load->model('room_type/m_room_type');

		$data 				= array();
		$data['room_types'] = $this->m_room_type->get_data();
		parent::display('index', $data);
	}

	public function get_datatable() {
		// validasi request hanya dari ajax
		if (!$this->input->is_ajax_request()) {
			return;
		}

		$datatabel = $this->m_rooms->get_datatable($this->input->post());
		foreach ($datatabel['data'] as $value) {
			$tombol  = '<div class=""><button type="button" data-toggle="modal" data-target="#exampleModal" data-id="' . $value[sizeof($value)-1] . '" class="btn btn-xs btn-warning edit"> <i class="fa fa-edit"></i> </button>';
			$tombol  .= ' <button type="button" class="btn btn-danger btn-xs delete" data-id="' . $value[sizeof($value)-1] . '"><i class="fa fa-trash"></i> </button></div>';

			$value[sizeof($value)-1] = $tombol;
			$dttbl[] = $value;
		}
		$datatabel['data'] = isset($dttbl) ? $dttbl : array();
		$this->output->set_output(json_encode($datatabel));
	}

	function CreateOrUpdate (){
		// validasi request hanya dari ajax
        if (!$this->input->is_ajax_request()) {
            return;
		}
		
        // load library untuk validasi
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('room_number', 'Nomor Kamar', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('room_type', 'Nomor Kamar', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('qty', 'Kuota Kamar', 'required|is_natural_no_zero');

        // run server side validation
        if ($this->form_validation->run() === false) {
            $result['status'] = false;
            $result['message'] = validation_errors();
            return $this->output->set_output(json_encode($result));
        }

        $variables['room_number'] = $this->input->post('room_number', true);
        $variables['room_type'] = $this->input->post('room_type', true);
		$variables['qty'] = $this->input->post('qty', true);

		// validasi data room_number & room_type
		if (!$this->m_rooms->check_unique_data($variables['room_number'], $variables['room_type'], $this->input->post('id'))) {
			$result['status'] = true;
			$result['message'] = 'Tidak dapat menginputkan nomor kamar yang telah digunakan.';
			return $this->output->set_output(json_encode($result));
		}

		// proses update data
		if ($this->input->post('id')) {
			if ($this->m_rooms->update_data('rooms', 'id', $this->input->post('id'), $variables)) {
				$result['status'] = true;
				$result['message'] = 'Data berhasil diubah.';
			}
			return $this->output->set_output(json_encode($result));
		}

		// proses tambah data
        if ($this->m_rooms->add_data('rooms', $variables)) {
            $result['status'] = true;
			$result['message'] = 'Data berhasil ditambahkan.';
			return $this->output->set_output(json_encode($result));
		}
		
		$result['status'] = true;
		$result['message'] = 'Data gagal ditambahkan.';
		return $this->output->set_output(json_encode($result));
	}
	
	function delete () {
        // harus request menggunakan ajax
        if (!$this->input->is_ajax_request() || empty($this->input->post('id')))
            return;
        // data hapus
        $data_hapus['id'] = $this->input->post('id');
        // proses hapus
        if ($this->m_rooms->delete_data('rooms', $data_hapus)) {
            $result['status'] = true;
            $result['message'] = 'Data berhasil dihapus.';
        } else {
            $error_db = $this->m_rooms->get_db_error();
            $result['status'] = false;
            $result['message'] = 'Kesalahan kode : ' . $error_db['code'];
        }
        return $this->output->set_output(json_encode($result));
	}
	
	function show_detail (){
		// validation
		if (!$this->input->is_ajax_request())
			return;
		$id = $this->input->post('data_id');
		// select data by id
		$result = $this->m_rooms->get_detail($id);
		if (!empty($result)) {
			$data['status'] = true;
			$data['data'] = $result;
		} else {
			$data['status'] = false;
			$data['data'] = null;
			$data['message'] = $this->m_rooms->get_error_message();
		}
		$this->output->set_output(json_encode($data));
	}

	public function get_room_available (){
		
		// validasi request hanya dari ajax
		if (!$this->input->is_ajax_request()) {
			return;
		}
		$room_id = $this->input->post('room_id');
		if ($this->com_user['level'] == 2) {
			$this->load->model('students/m_students');
			$students = $this->m_students->get_detail($this->com_user['student_id']);
			$room_id = $students['room_id'];
        }
		$room_type_id = $this->input->post('room_type_id');
		$data = $this->m_rooms->get_room_available($room_type_id,$room_id);
		$this->output->set_output(json_encode($data));
	}
}