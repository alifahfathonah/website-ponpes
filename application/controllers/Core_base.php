<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core_base extends MX_Controller {

	public $file_js = '';
  	public $file_css = '';
	public $breadcrumb = '';
	public $com_user = array();
	public $token = "";

	public function __construct() {
    	parent::__construct();
		$this->load->library('encryption');
		$this->load->helper('cookie');
		$this->load->helper('form');
		$this->load->library('upload');
	}
	  
	public function index()
	{
		$ctlObj = modules::load('beranda/controllers/');
		$ctlObj->index();
    }
    
    //fungsi untuk meload javascript
	protected function load_js($alamat) {
		if (is_file($alamat)) {
			$this->file_js .= '<script src="' . base_url($alamat) . '" type="text/javascript"></script>';
			$this->file_js .= "\n";
		} else {
			$this->file_js .= 'File javascript ' . $alamat . ' tidak ditemukan! <br>';
		}
	}

    //fungsi untuk meload css
	protected function load_css($alamat) {
		if (is_file($alamat)) {
			$this->file_css .= '<link href="' . base_url($alamat) . '" rel="stylesheet" type="text/css" />';
		} else {
			$this->file_css .= 'File css ' . $alamat . ' tidak ditemukan! <br>';
		}
    }
    
    protected function display($tpl_content = 'theme/default.php', $data = array()) {
		$data['FILE_JS'] = $this->file_js;
		$data['FILE_CSS'] = $this->file_css;
		$data['USER_LOGIN'] = $this->com_user;
		$data['TPL_ISI'] = $tpl_content;
		$data['CSRF_CONFIG'] = array('name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash());

        $this->load->view('layout', $data);
	}

	protected function display_no_theme($tpl_content = 'theme/default.php', $data = array()) {
		$data['FILE_JS'] = $this->file_js;
		$data['FILE_CSS'] = $this->file_css;
		$data['USER_LOGIN'] = $this->com_user;
		$data['TPL_ISI'] = $tpl_content;
		$data['CSRF_CONFIG'] = array('name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash());

        $this->load->view('theme/default.php', $data);
	}

	//function to image upload
	// $widget_name = 'photo';
	// $oldfile = file location (uploads/foto_profile/gambarku.jpg)
	// $upload_path = new location (uploads/foto_profile/)
	function UploadImage($widget_name, $old_file, $upload_path)
    {
        $config['upload_path'] = $upload_path; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

        $this->upload->initialize($config);
        if(!empty($_FILES[$widget_name]['name'])){

            if ($this->upload->do_upload($widget_name)){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']= $config['upload_path'].$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                // $config['quality']= '80%';
                // $config['width']= 500;
                // $config['height']= 500;
                $config['new_image']= $config['source_image'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                
                $output['status'] 	= true;
				$output['pesan'] 	= 'Foto profil berhasil diubah.';
				$output['url_file']	= $upload_path.$gbr['file_name'];
            }else {
                $output['status'] = false;
                $output['pesan'] = $this->upload->display_errors();
            }
                      
        }else{
            $output['status'] = true;
            $output['url_file'] = '';
		}

		//Delete old file
		if (empty(!$old_file)) {
			if (file_exists($old_file)) {
				unlink($old_file);
			}	
		}
		return $output;
	}
	
	function is_login()
	{
		$this->load->model('users/m_users');
		$this->com_user = $this->session->userdata('AUTH');

		if (!empty($this->com_user)) {
			$this->com_user = $this->m_users->get_detail_for_session($this->com_user['id']);
		}
		
		if (!empty($this->com_user)) {
			return true;
		}
		return false;
	}

	function send_mail($recipient, $subject, $html){
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
		$mail->isSMTP(); 
		// $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
		$mail->Host = "mail.ppspakomplek6.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
		$mail->Port = 465; // TLS only
		$mail->SMTPSecure = 'ssl'; // ssl is deprecated
		$mail->SMTPAuth = true;
		$mail->Username = 'admin@ppspakomplek6.com'; // email
		$mail->Password = 'Password.1p'; // password
		$mail->setFrom('admin@ppspakomplek6.com', 'Pondok Pesantren Pandanaran Komplek 6'); // From email and name
		$mail->addAddress($recipient); // to email and name
		$mail->Subject = $subject;
		$mail->msgHTML($html); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
		$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
		// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
		$mail->SMTPOptions = array(
							'ssl' => array(
								'verify_peer' => false,
								'verify_peer_name' => false,
								'allow_self_signed' => true
							)
						);
		if(!$mail->send()){
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
    }
    
}