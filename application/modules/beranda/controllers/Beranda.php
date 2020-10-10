<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class Beranda extends Core_base {
	

	public function index()
	{
		parent::is_login();
		parent::display_no_theme('index');
	}
}