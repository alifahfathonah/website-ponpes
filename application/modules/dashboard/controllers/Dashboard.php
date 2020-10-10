<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class Dashboard extends Core_base {

	public function __construct() {
        parent::__construct();
        if (!parent::is_login()) {
            redirect('login');
		}
		
	}
	
	public function index()
	{
		$this->load->model('m_dashboard');
		$this->load->model('students/m_students');

		$data = array();
		$data['data_pengurus'] 	=  $this->m_dashboard->get_count_pengurus()['jumlah'];
		$data['data_santri'] 	=  $this->m_dashboard->get_count_santri()['jumlah'];
		$data['data_kamar'] 	=  $this->m_dashboard->get_count_kamar()['jumlah'];
		$data['data_pembayaran'] = $this->m_dashboard->get_count_pembayaran($this->com_user['student_id'])['jumlah'];

		parent::display('index', $data);
	}
}