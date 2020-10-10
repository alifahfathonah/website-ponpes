<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class Room_type extends Core_base {

	public function __construct()
	{
		parent::__construct();
		if (!parent::is_login() || $this->com_user['level'] == 2) {
            redirect('login');
        }
		$this->load->model('m_room_type');
	}

	public function index()
	{
		
		// load css & js tambahan (yg blm ada di template)
		$this->load_css('assets/modules/jqueryformvalidator/form-validator/theme-default.min.css');
		$this->load_js('assets/modules/jqueryformvalidator/form-validator/jquery.form-validator.min.js');

        $data = array();
		parent::display('index', $data);
	}

	public function get_datatable() {
		// validasi request hanya dari ajax
		if (!$this->input->is_ajax_request()) {
			return;
		}

		$datatabel = $this->m_room_type->get_datatable($this->input->post());
		foreach ($datatabel['data'] as $value) {
			$tombol  = '<div class=""><button type="button" data-toggle="modal" data-target="#exampleModal" data-id="' . $value[1] . '" class="btn btn-xs btn-warning edit"> <i class="fa fa-edit"></i> </button>';
			$tombol  .= ' <button type="button" class="btn btn-danger btn-xs delete" data-id="' . $value[1] . '"><i class="fa fa-trash"></i> </button></div>';
			
			$value[1] = $value[2];
			$value[2] = $tombol;
			$dttbl[] = $value;
		}
		$datatabel['data'] = isset($dttbl) ? $dttbl : array();
		$this->output->set_output(json_encode($datatabel));
	}

    function create () {
        // validasi request hanya dari ajax
        if (!$this->input->is_ajax_request()) {
            return;
        }

        // load library untuk validasi
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nama Tipe Kamar', 'required');

        // run server side validation
        if ($this->form_validation->run() === false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
            return $this->output->set_output(json_encode($data));
        }

        $variables['name'] = $this->input->post('name', true);

        // proses simpan
        if ($this->m_room_type->add_data('room_types', $variables)) {
            $result['status'] = true;
            $result['message'] = 'Data ' . $variables['name'] . ' berhasil ditambahkan.';
        } else {
            $result['status'] = true;
            $result['message'] = 'Data ' . $variables['name'] . ' gagal ditambahkan.';
        }

        return $this->output->set_output(json_encode($result));
	}
	
	function update () {
		// validasi request hanya dari ajax
        if (!$this->input->is_ajax_request()) {
            return;
        }

        // load library untuk validasi
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nama Tipe Kamar', 'required');
		
		// run server side validation
        if ($this->form_validation->run() === false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
            return $this->output->set_output(json_encode($data));
		}
		
		$variables['name'] = $this->input->post('name', true);
		
		if ($this->m_room_type->update_data('room_types', 'id', $this->input->post('id'), $variables)) {
			$result['status'] = true;
			$result['message'] = 'Data berhasil diubah.';
		} else {
			$error_db = $this->m_room_type->get_db_error();
			$result['status'] = false;
			$result['message'] = 'Data gagal diubah.  Kesalahan kode : ' . $error_db['code'];
		}
		$this->output->set_output(json_encode($result));
	}

	function CreateOrUpdate (){
		if ($this->input->post('id')) {
			$this->update();
			return;
		}
		$this->create();
		return;
	}

	function delete () {
        // harus request menggunakan ajax
        if (!$this->input->is_ajax_request() || empty($this->input->post('id')))
            return;
        // data hapus
        $data_hapus['id'] = $this->input->post('id');
        // proses hapus
        if ($this->m_room_type->delete_data('room_types', $data_hapus)) {
            $result['status'] = true;
            $result['message'] = 'Data berhasil dihapus.';
        } else {
            $error_db = $this->m_room_type->get_db_error();
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
		$result = $this->m_room_type->get_detail($id);
		if (!empty($result)) {
			$data['status'] = true;
			$data['data'] = $result;
		} else {
			$data['status'] = false;
			$data['data'] = null;
			$data['message'] = $this->m_room_type->get_error_message();
		}
		$this->output->set_output(json_encode($data));
	}
}