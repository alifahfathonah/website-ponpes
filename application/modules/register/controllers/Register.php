<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class Register extends Core_base {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_register');
	}

	public function index()
	{
		// load css & js tambahan (yg blm ada di template)
		$this->load_css('assets/modules/jqueryformvalidator/form-validator/theme-default.min.css');
		$this->load_js('assets/modules/jqueryformvalidator/form-validator/jquery.form-validator.min.js');

		parent::display_no_theme('index');
	}

	function create () {
        // validasi request hanya dari ajax
        if (!$this->input->is_ajax_request()) {
            return;
        }

		// load library untuk validasi
		$this->load->model('users/m_users');
        $this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'min_length[5]|max_length[30]|required');
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('no_identity', 'No Identitas', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
		$this->form_validation->set_rules('address', 'Alamat', 'required');
		$this->form_validation->set_rules('phone', 'Nomor Telepon', 'max_length[30]|required');

		//validasi password
        if ($this->input->post('password') != '') {
            if (!$this->password_check($this->input->post('password'))) {
                $data['status'] = false;
                $data['pesan'] = "Password harus terdiri dari 8-30 karakter dengan kombinasi huruf besar, huruf kecil, angka, dan simbol ";
                return $this->output->set_output(json_encode($data));
            }
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('re_password', 'Retype Password', 'required|matches[password]');
        }

        // run server side validation
        if ($this->form_validation->run() === false) {
            $data['status'] = false;
            $data['message'] = validation_errors();
            return $this->output->set_output(json_encode($data));
        }

        $variables['username'] 	= $this->input->post('username', true);
		$variables['password'] 	= password_hash($this->input->post('password') . $this->config->item('encryption_key'), PASSWORD_BCRYPT);
		$email					= $this->input->post('email', true);
		$variables['email']  	= $email;
		$variables['level'] 	= 2;
		$variables['is_email_verified'] = false;
		$variables['status'] 			= false;
		$remember_token 				= bin2hex(random_bytes(64)); 
		$variables['remember_token'] 	= $remember_token;

		// Cek username terdaftar atau tidak
		if (count($this->m_register->get_detail_user_by_username($variables['username'])) > 0) {
			$result['status'] = false;
			$result['message'] = 'Username telah digunakan';
			return $this->output->set_output(json_encode($result));
			
		}
		
		// Cek email terdaftar atau tidak
		if (count($this->m_users->get_user_by_email($this->input->post('email', true))) > 0) {
			$result['status'] = false;
			$result['message'] = 'Email telah digunakan';
			return $this->output->set_output(json_encode($result));
			
		}

		// proses simpan
		
        if ($this->m_register->add_data('users', $variables)) {
		
			$variables = array();
			$variables['user_id'] 		= $this->m_register->get_detail_user_by_username($this->input->post('username', true))['id'];
			$variables['name'] 			= $this->input->post('name', true);
			$variables['no_identity'] 	= $this->input->post('no_identity', true);
			$variables['address'] 		= $this->input->post('address', true);
			$variables['phone'] 		= $this->input->post('phone', true);
			
		


            if ($this->m_register->add_data('students', $variables)) {
				$this->send_email_register($this->input->post('username', true), $email, "Register Confirmation", $remember_token);
				$result['status'] = true;
				$result['message'] = 'Pendaftaran berhasil, silahkan cek email anda.';
			} else {
				$result['status'] = false;
				$result['message'] = 'Pendaftaran gagal.';
			}

        } else {
            $result['status'] = true;
            $result['message'] = 'Pendaftaran gagal.';
        }

        return $this->output->set_output(json_encode($result));
	}

	public function validation()
	{
		// load css & js tambahan (yg blm ada di template)
		$this->load->model('users/m_users');
		$email 				= $this->input->get('e');
		$remember_token 	= $this->input->get('t');
		$data['is_success'] = false;
		$data['email'] = $email;
		
		$user = $this->m_users->get_user_bytoken($email, $remember_token);
		if (!empty($user)) {
			$variables['is_email_verified'] = true;
			$variables['remember_token'] 	= null;

			if ($this->m_users->update_data('users', 'id', $user['id'], $variables)) {
				$result['status'] 	= true;
				$result['message'] 	= 'Data berhasil diubah.';
				$data['is_success'] = true;
			}
		}
		parent::display_no_theme('validation',$data);
	}
function aktiv () {
	$email 				= $this->input->post('email');
	$status 	= $this->input->post('status');

	$this->db->set('status', $status);
	$this->db->set('remember_token', NULL);
	$this->db->where('email', $email);
	$this->db->update('users');

	$query=$this->db->get_where('users', array('email' =>$email));
	if ($query->num_rows()>0) {
		$row = $query->row_array();
		$id = $row['id'];
		
		}

	$this->db->set('room', null);
	$this->db->where('user_id', $id);
	$this->db->update('students');

	
	redirect('login');


}
	public function send_email_register($username, $recipient, $subject, $remember_token) 
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
						<h4>Verifikasi Email</h4>                    
					</div>
					<div class="card-body">
						<form action="" method="POST">
						<div class="form-group">
							<p>Hi. '. $username .' <br>
							Berikut adalah link validasi email anda.</p>
							<a href="'. base_url('register/validation/?e='.$recipient.'&t='.$remember_token).'">'. base_url('register/validation/?e='.$recipient.'&t='.$remember_token) .'</a>
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

	/* ADDITIONAL FUNCTION */
    function password_check ($password){
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&.\*])(?=.{8,30})/', $password)) 
        {
            return TRUE;
        } 
        return FALSE;
    }

} 