<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class Midtrans_configuration extends Core_base {
    
	public function __construct()
	{   
        parent::__construct();
		if (!parent::is_login()) {
            redirect('login');
        }
        $this->load->model('m_midtrans');
    }

    public function index(){
        // load css & js tambahan (yg blm ada di template)
		$this->load_css('assets/modules/jqueryformvalidator/form-validator/theme-default.min.css');
		$this->load_js('assets/modules/jqueryformvalidator/form-validator/jquery.form-validator.min.js');
        $data['midtrans_configuration'] = $this->m_midtrans->get_midtrans_configuration();
		parent::display('index', $data);
    }

    public function update(){
        // validasi request hanya dari ajax
        if (!$this->input->is_ajax_request()) {
            return;
        }
  
        // load library untuk validasi
		$this->load->library('form_validation');
		$this->form_validation->set_rules('client_key', 'Client Key', 'required');
        $this->form_validation->set_rules('server_key', 'Server Key', 'required');
     
        // run server side validation
        if ($this->form_validation->run() === false) {
            $result['status'] = false;
            $result['message'] = validation_errors();
            return $this->output->set_output(json_encode($result));
        }

        $variables = [];
        $variables["value"] = $this->input->post("client_key");
        if (!$this->m_midtrans->update_data('midtrans_configuration','name', 'ClientKey', $variables)) {
            $result['status']  = false;
            $result['message'] = 'Data gagal diubah.';
            return $this->output->set_output(json_encode($result));
        }

        $variables = [];
        $variables["value"] = $this->input->post("server_key");
        if (!$this->m_midtrans->update_data('midtrans_configuration','name', 'ServerKey', $variables)) {
            $result['status']  = false;
            $result['message'] = 'Data gagal diubah.';
            return $this->output->set_output(json_encode($result));
        }

        $result['status']  = true;
        $result['message'] = 'Data berhasil diubah';
        return $this->output->set_output(json_encode($result));
    }

}