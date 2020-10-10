<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class Resetpass extends Core_base {

	public function index()
	{
		parent::__construct();
		$this->load->view('resetpass');
	}

	public function confirm_reset_pass()
	{
		$this->load->view('confirm_reset_pass');
	}

	function create () {
        // validasi request hanya dari ajax
        if (!$this->input->is_ajax_request()) {
            return;
        }

		// load library untuk validasi
		$this->load->model('users/m_users');
        $this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');

        // run server side validation
        if ($this->form_validation->run() === false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
            return $this->output->set_output(json_encode($data));
		}
		
		$variables['email']  			= $this->input->post('email', true);
		$variables['remember_token'] 	= bin2hex(random_bytes(64));
		$user = $this->m_users->get_user_by_email($variables['email']);
		
		if (count($user) <= 0){
			$result['status'] = false;
            $result['message'] = 'Email belum terdaftar.';
             return $this->output->set_output(json_encode($result));
		}

		$this->send_email_reset($user['username'], $variables['email'], "Reset Password", $variables['remember_token']);

        // proses simpan
        if ($this->m_users->update_data('users', 'id', $user['id'], $variables)) {
			
			$result['status'] = true;
			$result['message'] = 'Reset password berhasil terkirim ke email.';

        } else {
            $result['status'] = false;
            $result['message'] = 'Terjadi Kegagalan';
        }

        return $this->output->set_output(json_encode($result));
	}

	public function new_password()
	{
		// load css & js tambahan (yg blm ada di template)
		$this->load->model('users/m_users');
		$data['email'] 				= $this->input->get('e');
		$data['remember_token'] 	= $this->input->get('t');
		
		$user = $this->m_users->get_user_bytoken($data['email'], $data['remember_token']);

		if (!empty($user)) {
			parent::display_no_theme('confirm_reset_pass',$data);
		}
		return;
	}

	public function validation()
	{
		// load css & js tambahan (yg blm ada di template)
		$this->load->model('users/m_users');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('re_password', 'Retype Password', 'required|matches[password]');

	
		// run server side validation
        if ($this->form_validation->run() === false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
            return $this->output->set_output(json_encode($data));
		}
		
		$email 				= $this->input->post('email');
		$remember_token 	= $this->input->post('remember_token');
		$user = $this->m_users->get_user_bytoken($email, $remember_token);
		
		
		//validasi password
        if ($this->input->post('password') != '') {
            if (!$this->input->post('password') == password_check($this->input->post('password'))) {
                $data['status'] = false;
                $data['pesan'] = "Password harus terdiri dari 8-30 karakter dengan kombinasi huruf besar, huruf kecil, angka, dan simbol ";
                return $this->output->set_output(json_encode($data));
            }
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('re_password', 'Retype Password', 'required|matches[password]');
        }
		if (!empty($user)) {
			$variables['password'] 			= password_hash($this->input->post('password') . 
			$this->config->item('encryption_key'), PASSWORD_BCRYPT);
			$variables['remember_token'] 	= null;

			if ($this->m_users->update_data('users', 'id', $user['id'], $variables)) {
				$result['status'] 	= true;
				$result['message'] 	= 'Password berhasil diubah.';
			}
		}else {
			$result['status'] 	= true;
			$result['message'] 	= 'Password gagal diubah.';
		}

		return $this->output->set_output(json_encode($result));
	}
	
	public function send_email_reset($username, $recipient, $subject, $remember_token) 
	{
		$html = '
		<div id="app">
			<section class="section">
			<div class="container mt-5">
				<div class="row">
				<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
					<div class="text-center" style="margin-bottom:10px">
						<img src="'.base_url().'assets/frontend/img/ppspa.png" alt="logo"  width="80" class="shadow-light rounded-circle">
					</div>
					<div class="card card-primary">
					<div class="card-header text-center" style="display:block">
						<h4>Reset Akun PPSPA Komplek 6</h4>                    
					</div>
					<div class="card-body">
						<form action="" method="POST">
						<div class="form-group">
							<p>Hi. '. $username .' <br>
							Berikut adalah link reset akun anda.</p>
							<a href="'. base_url('resetpass/new_password/?e='.$recipient.'&t='.$remember_token).'">'. base_url('resetpass/new_password/?e='.$recipient.'&t='.$remember_token) .'</a>
						</div>
						</form>
					</div>
					</div>
				</div>
				</div>
			</div>
			</section>
		</div>
		';
		parent::send_mail($recipient, $subject, $html);
		return true;
	}
}
	/* ADDITIONAL FUNCTION */
    function password_check ($password){
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&.\*])(?=.{8,30})/', $password)) 
        {
            return TRUE;
        } 
        return FALSE;
    }

