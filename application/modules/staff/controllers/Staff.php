<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class Staff extends Core_base {

	public function __construct(){
		parent::__construct();
		if (!parent::is_login() || $this->com_user['level'] == 2) {
            redirect('login');
        }
		$this->load->model('m_staff');
		$this->load->model('register/m_register');
	}

	public function index (){
		// load css & js tambahan (yg blm ada di template)
		$this->load_css('assets/modules/jqueryformvalidator/form-validator/theme-default.min.css');
		$this->load_js('assets/modules/jqueryformvalidator/form-validator/jquery.form-validator.min.js');

        $data = array();
		parent::display('index', $data);
	}
	public function detail ($param = null){
		$this->load_css('assets/modules/jqueryformvalidator/form-validator/theme-default.min.css');
		$this->load_js('assets/modules/jqueryformvalidator/form-validator/jquery.form-validator.min.js');

		$data = array();

		if ($this->com_user['level'] == 2) {
			redirect('dashboard');
		}elseif ($this->com_user['level'] == 1) {
			$data['staff'] = $this->m_staff->get_detail($this->com_user['staff_id']);
		}elseif (!empty($param)) {
			$data['staff'] = $this->m_staff->get_detail($param);
		}

		parent::display('form', $data);
	}

	public function get_datatable (){
		// validasi request hanya dari ajax
		if (!$this->input->is_ajax_request()) {
			return;
		}

		$datatabel = $this->m_staff->get_datatable($this->input->post());
		foreach ($datatabel['data'] as $value) {
			$tombol  = '<div class=""><a href="'. base_url() .'staff/detail/'. $value[sizeof($value)-1] .'"><button type="button" class="btn btn-xs btn-warning edit" onclick="edit_data()"> <i class="fa fa-edit"></i> </button></a>';
			$tombol  .= ' <button type="button" class="btn btn-danger btn-xs delete" data-id="' . $value[sizeof($value)-1] . '"><i class="fa fa-trash"></i> </button></div>';
			
			if ($this->com_user['level'] == 1 && $this->com_user['staff_id'] != $value[sizeof($value)-1]) {
                $tombol  = '';
			}
						
			$value[sizeof($value)-1] = $tombol;

			$foto = "<img onclick='zoomImage(this)' src ='". base_url(). $value[sizeof($value)-2] ."' style='width:100px' />";
			$value[sizeof($value)-2] = $foto;
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
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('name', 'Nama Petugas', 'min_length[5]|max_length[30]|required');
		$this->form_validation->set_rules('no_identity', 'Nomor Identity', 'required');
		$this->form_validation->set_rules('address', 'Alamat', 'required');
		$this->form_validation->set_rules('phone', 'Nomor Telepon', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->input->post('password') != "" || !$this->input->post('id')) {
			$this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('re_password', 'Retype Password', 'required|matches[password]');
			$variables['password'] 	= $this->input->post('password', true);
		}

		$result = array();
        // run server side validation
        if ($this->form_validation->run() === false) {
            $result['status'] = false;
            $result['message'] = validation_errors();
            return $this->output->set_output(json_encode($result));
		}
		
		$variables['username'] 	= $this->input->post('username', true);
		$variables['email'] 	= $this->input->post('email', true);
		$variables['level']		= 1;
		$variables['is_email_verified'] = true;
		$variables['status']   	= true;
		
		if ($this->input->post('password')) {
			$variables['password'] 	= password_hash($this->input->post('password') . $this->config->item('encryption_key'), PASSWORD_BCRYPT);
		}
		
		// Cek username terdaftar atau tidak
		$check_username = $this->m_register->get_detail_user_by_username($variables['username']);
		if (count($check_username) > 0 && !$this->input->post('id')) {
			$result['status'] 	= false;
			$result['message'] 	= 'Username telah digunakan';
			return $this->output->set_output(json_encode($result));
		}

		//proses ubah data
		$id = $this->input->post('id');

		//staff hanya dapat mengedit data staffnya sendiri
		if ($this->com_user['level'] == 1) {
			$id = $this->com_user['staff_id'];
		}

		if ($id) {
			$users = $this->m_register->get_user_by_staff_id($id);
			if ($this->m_register->update_data('users','id', $users['id'], $variables)) {
				$variables = array();
				$variables['user_id'] 		= $this->m_register->get_detail_user_by_username($this->input->post('username', true))['id'];
				$variables['name'] 			= $this->input->post('name', true);
				$variables['no_identity'] 	= $this->input->post('no_identity', true);
				$variables['address'] 		= $this->input->post('address', true);
				$variables['phone'] 		= $this->input->post('phone', true);
	
				$widget_name	= "photo";
				$old_file		= (!empty($users['photo'])?$users['photo']:null);
				$upload_path	= "uploads/foto_profile/";

				if (!empty($_FILES[$widget_name]['name'])) {
					$photo    = parent::UploadImage($widget_name, $old_file, $upload_path);
					if (!$photo['status']) {
						$result['status']  = false;
						$result['message'] = 'Data gagal diubah.';
						return $this->output->set_output(json_encode($result));
					}
					$variables['photo']    = $photo['url_file'];
				}
				
				if ($this->m_register->update_data('staff','id', $id, $variables)) {
					$result['status']  = true;
					$result['message'] = 'Data berhasil diubah.';
				} else {
					$result['status']  = false;
					$result['message'] = 'Data gagal diubah.';
				}
	
			} else {
				$result['status']  = false;
				$result['message'] = 'Data gagal diubah.';
			}
			return $this->output->set_output(json_encode($result));
		}

		// proses tambah data
        if ($this->m_register->add_data('users', $variables)) {
			$variables = array();
			$variables['user_id'] 		= $this->m_register->get_detail_user_by_username($this->input->post('username', true))['id'];
			$variables['name'] 			= $this->input->post('name', true);
			$variables['no_identity'] 	= $this->input->post('no_identity', true);
			$variables['address'] 		= $this->input->post('address', true);
			$variables['phone'] 		= $this->input->post('phone', true);

			$widget_name	= "photo";
			$old_file		= '';
			$upload_path	= "uploads/foto_profile/";

			if (!empty($_FILES[$widget_name]['name'])) {
				$photo    = parent::UploadImage($widget_name, $old_file, $upload_path);
				if (!$photo['status']) {
					$result['status']  = false;
					$result['message'] = 'Data gagal ditambahkan.';
					return $this->output->set_output(json_encode($result));
				}
				$variables['photo']    = $photo['filename'];
			}
			
            if ($this->m_register->add_data('staff', $variables)) {
				$result['status']  = true;
				$result['message'] = 'Data berhasil ditambahkan.';
			} else {
				$result['status']  = false;
				$result['message'] = 'Data gagal ditambahkan.';
			}

        } else {
            $result['status']  = false;
            $result['message'] = 'Data gagal ditambahkan.';
        }
		return $this->output->set_output(json_encode($result));
	}

	function delete () {
        // harus request menggunakan ajax
        if (!$this->input->is_ajax_request() || empty($this->input->post('id')))
			return;
			
        // data hapus
		$data_hapus['id'] = $this->input->post('id');
		$staff = $this->m_staff->get_detail($data_hapus['id']);
		
        // proses hapus
        if ($this->m_staff->delete_data('staff', $data_hapus)) {
			if ($this->m_staff->delete_data('users', $staff['user_id'])) {
				//Delete iamge
				if (file_exists($staff['photo'])) {
					unlink($staff['photo']);
				}
				$result['status'] = true;
				$result['message'] = 'Data berhasil dihapus.';
				return $this->output->set_output(json_encode($result));
			} 
        }
		$error_db = $this->m_staff->get_db_error();
		$result['status'] = false;
		$result['message'] = 'Kesalahan kode : ' . $error_db['code'];
        
        
	}
}