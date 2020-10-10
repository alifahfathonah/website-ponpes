<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class users extends Core_base {

	public function __construct()
	{
		if (!parent::is_login()) {
			redirect('login');
			
		/*parent::__construct();
		if (!parent::is_login() || $this->com_user['level'] == 2) {
			redirect('login');*/

        }
		parent::__construct();
		$this->load->model('m_users');
		
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
		$datatabel = $this->m_users->get_datatable($this->input->post());
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
		$this->form_validation->set_rules('username', 'Username Santri', 'required');
		$this->form_validation->set_rules('level', 'Level Santri', 'required');
		
		$result = array();
        // run server side validation
        if ($this->form_validation->run() === false) {
            $result['status'] = false;
            $result['message'] = validation_errors();
            return $this->output->set_output(json_encode($result));
		}
		
		$variables['username'] 	= $this->input->post('username', true);
		$variables['email'] 	= $this->input->post('email', true);
		$variables['status'] 	= $this->input->post('status', true);
		$variables['level'] 	= $this->input->post('level', true);
		$variables['password'] 	= password_hash($this->input->post('password') . $this->config->item('encryption_key'), PASSWORD_BCRYPT);

		// proses update data
		if ($this->input->post('id')) {
			if ($this->m_users->update_data('users', 'id', $this->input->post('id'), $variables)) {
				$result['status'] = true;
				$result['message'] = 'Data berhasil diubah.';
			}
			return $this->output->set_output(json_encode($result));
		}

		// proses tambah data
        if ($this->m_users->add_data('users', $variables)) {
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
        if ($this->m_users->delete_data('Users', $data_hapus)) {
            $result['status'] = true;
            $result['message'] = 'Data berhasil dihapus.';
        } else {
            $error_db = $this->m_users->get_db_error();
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
		$result = $this->m_users->get_detail($id);
		if (!empty($result)) {
			$data['status'] = true;
			$data['data'] = $result;
		} else {
			$data['status'] = false;
			$data['data'] = null;
			$data['message'] = $this->m_users->get_error_message();
		}
		$this->output->set_output(json_encode($data));
	}
}