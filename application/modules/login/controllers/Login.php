<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class Login extends Core_base {

	public function __construct() {
        parent::__construct();
	}
	
	public function index()
	{
		if (parent::is_login()) {
            redirect('dashboard');
        }
		parent::display_no_theme('index');
	}

	function do_login() {
		
		// validasi request hanya dari ajax
		if (!$this->input->is_ajax_request()) {
			return;
		}

		$this->load->model('users/m_users');
		$username = $this->input->post('username', true);
		$password = $this->input->post('password') . $this->config->item('encryption_key');
		$user = $this->m_users->get_user_by_username($username);
		
		if (!empty($user)) {
			
			if (password_verify($password, $user['password'])) {

				if ($user['is_email_verified'] <= 0) {
					$status['pesan'] = 'Email belum terverifikasi.';
					$status['type'] = 'error';
					$status['status'] = false;
					$this->output->set_output(json_encode($status));
					return;
				}

				if ($user['status'] <= 0) {
					$status['pesan'] = 'Akun anda belum diaktifkan, silahahkan hubungi pengurus PPSPA Komplek 6.';
					$status['type'] = 'error';
					$status['status'] = false;
					$this->output->set_output(json_encode($status));
					return;
				}

				$status['pesan'] = 'Login Berhasil.';
				$status['status'] = true;
				$this->session->set_userdata('AUTH', $user);
				$this->output->set_output(json_encode($status));
				return;
			}
		}

		$status['pesan'] = 'User atau password tidak benar.';
		$status['type'] = 'error';
		$status['status'] = false;
		$this->output->set_output(json_encode($status));
		return;
	}

	public function do_logout (){
		$this->session->unset_userdata('AUTH');
		redirect('login');
	}
}