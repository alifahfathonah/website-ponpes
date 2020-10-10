<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class Payments extends Core_base {

    private $midtrans_configuration = null;
    
	public function __construct()
	{   
		parent::__construct();
		if (!parent::is_login()) {
            redirect('login');
        }
        
        $this->load->model('m_payments');
        $this->load->model('students/m_students');
        $this->load->model('midtrans_configuration/m_midtrans');

        $this->midtrans_configuration = $this->m_midtrans->get_midtrans_configuration();
        // midtrans library
        require_once(APPPATH.'libraries/Midtrans.php');
        \Midtrans\Config::$serverKey = $this->midtrans_configuration['ServerKey'];
        \Midtrans\Config::$isProduction = (strpos($this->midtrans_configuration['ServerKey'], 'SB-Mid') !== false ? false : true );
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

	}

	public function index()
	{
		// load css & js tambahan (yg blm ada di template)
		$this->load_css('assets/modules/jqueryformvalidator/form-validator/theme-default.min.css');
		$this->load_js('assets/modules/jqueryformvalidator/form-validator/jquery.form-validator.min.js');

		parent::display('index');
    }
    
    public function get_datatable (){
		// validasi request hanya dari ajax
		if (!$this->input->is_ajax_request()) {
			return;
        }
        $student_id = null;
        if ($this->com_user['level'] == 2) {
            $student_id = $this->com_user['student_id'];
        }
		$datatabel = $this->m_payments->get_datatable($this->input->post(),$student_id);
		foreach ($datatabel['data'] as $value) {
            // tombol detail dan delete
			$tombol  = '<div class=""><a href="'. base_url() .'payments/detail/'. $value[sizeof($value)-1] .'"><button type="button" class="btn btn-xs btn-warning edit" onclick="edit_data()"> <i class="fa fa-edit"></i> </button></a>';
            // $tombol  .= ' <button type="button" class="btn btn-danger btn-xs delete" data-id="' . $value[sizeof($value)-1] . '"><i class="fa fa-trash"></i> </button></div>';
            
            // tombol edit
            if ($value[4] > 0 && $this->com_user['level'] > 0) {
                $tombol  = '<div class=""><a href="'. base_url() .'payments/detail/'. $value[sizeof($value)-1] .'"><button type="button" class="btn btn-xs btn-info edit" onclick="edit_data()"> <i class="fa fa-eye"></i> </button></a>';
            }
            
            // atur format tanggal
            $date = date_create($value[2]);
            $value[2] = date_format($date, "d M Y");
            
            // status pembayaran
            $value[4] = '<div class="btn btn-sm '. ($value[4] == 1?"btn-success":"btn-danger") .'">' . ($value[4] == 1?"Disetujui":"Belum disetujui") . '</div>';

            $is_paid_off = (empty($this->m_midtrans->check_paid_off_payment($value[sizeof($value)-1]))? false : true);
            
            // tampilkan gambar bukti pembayaran
            if ($is_paid_off) {
                $data['payments']['photo'] = base_url() . 'assets/img/midtrans.png';
                $foto = "<img onclick='zoomImage(this)' src ='". base_url() . "assets/img/midtrans.png' style='width:100px' />";
            }else if ($value[sizeof($value)-2] == "") {
                $foto = "<img onclick='zoomImage(this)' src ='". base_url() ."assets/img/no-image.jpg' style='width:100px' />";
            }else{
                $foto = "<img onclick='zoomImage(this)' src ='". base_url(). $value[sizeof($value)-2] ."' style='width:100px' />";
            }

            
			$value[sizeof($value)-1] = $tombol;
			$value[sizeof($value)-2] = $foto;
            
            $dttbl[] = $value;
		}
		$datatabel['data'] = isset($dttbl) ? $dttbl : array();
		$this->output->set_output(json_encode($datatabel));
    }
    
    public function detail ($param = null){
		$this->load_css('assets/modules/jqueryformvalidator/form-validator/theme-default.min.css');
		$this->load_js('assets/modules/jqueryformvalidator/form-validator/jquery.form-validator.min.js');
        
        $data = array();
        $data['readonly']  = "";
        $data['midtrans_client_key'] = $this->midtrans_configuration['ClientKey'];

        #ketika user santri tambah data
        if ($this->com_user['level'] == 2) {
            $data['students'] = $this->m_students->get_data(null, $this->com_user['student_id']);
        }

        if (!empty($param)) {
            $data['is_paid_off'] = (empty($this->m_midtrans->check_paid_off_payment($param))? false : true);
            $data['payments'] = $this->m_payments->get_detail($param);
            
            if ($data['is_paid_off']) {
                $data['payments']['photo'] = base_url() . 'assets/img/midtrans.png';
            }else{
                $data['payments']['photo'] = (empty($data['payments']['photo'])? null : base_url() . $data['payments']['photo']);
            }

            $data['students'] = $this->m_students->get_data(null, $data['payments']['student_id']);
            $data['readonly'] = ($data['payments']['is_approved'] > 0 && $this->com_user['level'] > 0? "readonly" : "");
        }
        
		parent::display('form', $data);
    }
    
    function create_or_update (){
		// validasi request hanya dari ajax
        if (!$this->input->is_ajax_request()) {
            return;
		}
		
        // load library untuk validasi
        $this->load->library('form_validation');
        if ($this->com_user['level'] != 2) {   
		    $this->form_validation->set_rules('student_id', 'Santri', 'required');
        }
		$this->form_validation->set_rules('transaction_date', 'Tanggal Pembayaran', 'required');
		$this->form_validation->set_rules('amount', 'Jumlah Dibayarkan', 'required');

        $result = array();
        
        // run server side validation
        if ($this->form_validation->run() === false) {
            $result['status'] = false;
            $result['message'] = validation_errors();
            return $this->output->set_output(json_encode($result));
        }
        
		//proses simpan data
        $id = $this->input->post('id');
        $payments = $this->m_payments->get_detail($id);

        // if (!empty($id) && $payments['is_approved'] == 1 && $this->com_user['level'] == 2) {
        //     $result['status']  = false;
        //     $result['message'] = 'Anda tidak memilii hak akses terhadap data yang sudah disetujui.';
        //     return $this->output->set_output(json_encode($result));
        // }
        
        $variables = array();
        $curr_date = date('Y-m-d H:i:s');
        $variables['student_id'] 	= $this->input->post('student_id', true);
        $variables['transaction_date'] 	= $this->input->post('transaction_date', true);
        $variables['is_approved']   = $this->input->post('status', true);
        $variables['amount'] 		= str_replace(".","",$this->input->post('amount', true));
        $variables['updated_at']    = $curr_date;

        if ($this->com_user['level'] == 2) {
            $variables['student_id']   = $this->com_user['student_id'];
            $variables['is_approved']  = 0;
        }

        $widget_name	= "photo";
        $old_file		= (!empty($payments['photo'])?$payments['photo']:null);
        $upload_path	= "uploads/payments/";

        $photo = parent::UploadImage($widget_name, $old_file, $upload_path);	
        if (!$photo['status']) {
            $result['status']  = false;
            $result['message'] = 'Data gagal diubah.';
            return $this->output->set_output(json_encode($result));
        }
        $variables['photo']    = $photo['url_file'];
        
        if (!empty($id)) {
            if ($id != "") {
                $is_paid_off = (empty($this->m_midtrans->check_paid_off_payment($id))? false : true);
                if ($is_paid_off) {
                    unset($variables['is_approved']);
                }
                if ($this->m_payments->update_data('payments','id', $id, $variables)) {                    
                    $result['status']  = true;
                    $result['message'] = 'Data berhasil diubah.';
                } else {
                    $result['status']  = false;
                    $result['message'] = 'Data gagal diubah.';
                }
                return $this->output->set_output(json_encode($result));
            }
        }
        
        $variables['created_at'] = $curr_date;
        if ($this->m_payments->add_data('payments', $variables)) {
            $result['status']  = true;
            $result['message'] = 'Data berhasil ditambahkan.';
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
		$payment = $this->m_payments->get_detail($data_hapus['id']);
		
        // proses hapus
        if ($this->m_payments->delete_data('payments', $data_hapus)) {
			//Delete old file
			if (file_exists($payment['photo'])) {
				unlink($payment['photo']);
            }
            $result['status'] = true;
            $result['message'] = 'Data berhasil dihapus.';
            return $this->output->set_output(json_encode($result));
		}
		
		$error_db = $this->m_payments->get_db_error();
		$result['status'] = false;
		$result['message'] = 'Kesalahan kode : ' . $error_db['code'];
		
        return $this->output->set_output(json_encode($result));
    }
    
    // ------------------ Midtrans ------------------ //
    // generate token midtrans
    function generate_midtrans_token(){
        
        // validasi request hanya dari ajax
        if (!$this->input->is_ajax_request()) {
            return;
		}
		
        // load library untuk validasi
        $this->load->library('form_validation');
        if ($this->com_user['level'] != 2) {   
		    $this->form_validation->set_rules('student_id', 'Santri', 'required');
        }
		$this->form_validation->set_rules('transaction_date', 'Tanggal Pembayaran', 'required');
        $this->form_validation->set_rules('amount', 'Jumlah Dibayarkan', 'required');
        
        // run server side validation
        if ($this->form_validation->run() === false) {
            $result['status'] = false;
            $result['message'] = validation_errors();
            return $this->output->set_output(json_encode($result));
        }
        
        if ($this->input->post('id')) {
            $payment_id = $this->input->post('id');
            $payment = $this->m_midtrans->get_midtrans_payments_by_payment_id($payment_id);
            
            if (
                !empty($payment)
                && $payment['amount'] == str_replace(".","",$this->input->post('amount', true))
                && $payment['transaction_date'] == $this->input->post('transaction_date') . ' 00:00:00'
                ) {
                    try {
                        $status = \Midtrans\Transaction::status($payment['order_id']);
                        if (!empty($payment) && $status->status_code == '201') {
                            $data = [];
                            $data["order_id"] = $payment['order_id'];
                            $data["token"] = $payment['token'];
                            $data["status"] = true;
                            return $this->output->set_output(json_encode($data));    
                        }
                    } catch (Exception $e) {}
            }
            
        }

        // get order_id
        $order_id = time() . mt_rand();

        // set item
        $item_price = str_replace(".","",$this->input->post('amount', true));
        $item_name = "Pembayaran SPP";

        // set customer
        if ($this->com_user['level'] == 0 || $this->com_user['level'] == 1) {
            $student = $this->m_students->get_detail($this->input->post('student_id'));
            $customer_name = $student['name'];
            $customer_email = $student['email'];
            $customer_phone = $student['phone'];
        }else {
            $customer_name = $this->com_user['student_name'];
            $customer_email = $this->com_user['email'];
            $customer_phone = $this->com_user['student_phone'];
        }

        // Required
		$transaction_details = array(
		  'order_id' => $order_id,
		  'gross_amount' => $item_price
        );
        
        // Optional
		$customer_details = array(
            'first_name'    => $customer_name,
            // 'last_name'     => "",
            'email'         => $customer_email,
            'phone'         => $customer_phone,
             //'billing_address'  => $billing_address
             //'shipping_address' => $shipping_address
          );

		// Optional
		$item_detail = array(
		  'id' => '1',
		  'price' => $item_price,
		  'quantity' => 1,
		  'name' => $item_name
		);

		// Optional
		$item_details = array($item_detail);

		// Optional
		$billing_address = array(
		  'first_name'    => "",
		  'last_name'     => "",
		  'address'       => "",
		  'city'          => "",
		  'postal_code'   => "",
		  'phone'         => "",
		  'country_code'  => ''
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "",
		  'last_name'     => "",
		  'address'       => "",
		  'city'          => "",
		  'postal_code'   => "",
		  'phone'         => "",
		  'country_code'  => ''
		);

        // Optional, remove this to display all available payment methods
        $enable_payments = array(
            "gopay",
            "mandiri_clickpay",
            "bri_epay",
            "echannel",
            "bbm_money",
            "xl_tunai",
            "indosat_dompetku",
            "mandiri_ecash",
            "permata_va",
            "bca_va",
            "bni_va",
            "other_va",
            "kioson",
            // "Indomaret"
        );

		// Fill transaction details
		$transaction = array(
            // 'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

		//error_log(json_encode($transaction));
		$snapToken = \Midtrans\Snap::getSnapToken($transaction);

        $variables = [];
        $variables['updated_at'] = date('Y-m-d H:i:s');
        if (!$this->m_payments->update_data('payments', 'id', $payment_id, $variables)) {
            $result = [];
            $result['status'] = false;
            $result['message'] = 'Error';
            return $this->output->set_output(json_encode($data));
        }
        $variables = [];
        $variables['payment_id'] = $payment_id;
        $variables['order_id'] = $order_id;
        $variables['gross_amount'] = $item_price;
        $variables['token'] = $snapToken;

        if (!$this->m_payments->add_data('midtrans_payments', $variables)) {
            $result = [];
            $result['status'] = false;
            $result['message'] = 'Error';
            return $this->output->set_output(json_encode($data));
        }

        $data = [];
        $data["order_id"] = $order_id;
        $data["token"] = $snapToken;
        $data["status"] = true;
        return $this->output->set_output(json_encode($data));

    }

    // create data to table midtrans_payments
    function create_or_update_midtrans_payment($token, $order_id, $student_id){
        $status = \Midtrans\Transaction::status($order_id);

        if (!empty($status->status_code)) {
            if ($status->status_code == '404') {
                $result = [];
                $result['status']  = false;
                $result['message'] = $status->status_message;
                return $result;
            }
        }

        $last_update_payment = $this->m_payments->get_last_update_payment_by_student($student_id);

        if (empty($last_update_payment)) {
            $result = [];
            $result['status']  = false;
            $result['message'] = 'Payment tidak ditemukan';
            return $result;
        }

        $variables = [];
        $variables['payment_id'] = $last_update_payment['id'];
        $variables['transaction_id'] = $status->transaction_id;
        $variables['order_id'] = $status->order_id;
        $variables['payment_type'] = $status->payment_type;
        $variables['transaction_status'] = $status->transaction_status;
        $variables['transaction_time'] = $status->transaction_time;
        $variables['gross_amount'] = $status->gross_amount;
        $variables['signature_key'] = $status->signature_key;
        $variables['token'] = $token;

        $payment = $this->m_midtrans->get_midtrans_payment_status($order_id);
        if (empty($payment)) {
            if ($this->m_payments->add_data('midtrans_payments', $variables)) {
                $result['status']  = true;
                $result['message'] = 'Data berhasil ditambahkan.';
            } else {
                $result['status']  = false;
                $result['message'] = 'Data gagal ditambahkan.';
            }
            return $result;
        }

        if ($this->m_payments->update_data('midtrans_payments', 'id', $payment['id'], $variables)) {
            $result['status']  = true;
            $result['message'] = 'Data berhasil ditambahkan.';
        } else {
            $result['status']  = false;
            $result['message'] = 'Data gagal ditambahkan.';
        }

        return $result;
        
    }

    function delete_canceled_order($order_id){
        // harus request menggunakan ajax
        if (!$this->input->is_ajax_request())
            return;

        // data hapus
        $data_hapus['order_id'] = $order_id;
        
        // proses hapus
        if (!$this->m_payments->delete_data('midtrans_payments', $data_hapus)) {
            $result['status'] = true;
            $result['message'] = 'Data berhasil dihapus.';
            return $this->output->set_output(json_encode($result));
		}
		
		$error_db = $this->m_payments->get_db_error();
		$result['status'] = false;
		$result['message'] = 'Kesalahan kode : ' . $error_db['code'];
		
        return $this->output->set_output(json_encode($result));
    }
    function tambahdata(){
        $amount=$this->input->post('amount');
        // echo $amount;
        $total  = preg_replace('/[^0-9]/','', $amount);
        $tagihan1=$total/2;
        $tagihan2= $total - $tagihan1;
        $nextdue = 15;
        $jt1 =  date('Y-m-d H:i:s');
        $jt2 = date('Y-m-d H:i:s', strtotime('+'.$nextdue.'days',strtotime($jt1)));

        $student_id=$this->m_payments->get_students()->result();
        foreach ($student_id as $stut){
            $id_stut[]= $stut->id;
        }
        $query = $this->db->query("SELECT * FROM students");
            if($query->num_rows()>0)
            {
                $row = $query->row();
                $id_students = $row->id;
                
              $kembali= $query->num_rows();
            }
            else
            {
                $kembali= 0;
            }
        for($i=1; $i <= $kembali; $i++){
            foreach ($student_id as $stut){
                $id_stut[$i]= $stut->id;
                $tg1[$i] = array(
                    'student_id' => $id_stut[$i],
                    'amount' => $tagihan1,
                    'is_approved' => '0',
                    'transaction_date' => $jt1
                );
    
                $tg2[$i] = array(
                    'student_id' => $id_stut[$i],
                    'amount' => $tagihan2,
                    'is_approved' => '0',
                    'transaction_date' => $jt2
                );
                for($j=1; $j <= $i; $j++ ){
                    $this->db->insert('payments',$tg1[$i]);
                    $this->db->insert('payments',$tg2[$i]);
                }
            };
              redirect('payments');
        }
    }

    public function lunas () {
        $sessi=$this->com_user['id'] ;

        $query=$this->db->get_where('students', array('user_id' => $sessi));
		if ($query->num_rows()>0) {
			$row = $query->row_array();
			$id = $row['id'];
			$nama = $row['name'];
		
		}


        $this->db->select_sum('amount');
        $this->db->where('student_id',$id);
        $query = $this->db->get('payments');
        if($query->num_rows()>0)
        {
            $total= $query->row()->amount;
        }
        else
        {
            $total= 0;
        }


        $data = array();
        $data['total'] = $total;
        $data['nama'] = $nama;
        $data['id'] = $id;
        $data['readonly']  = "";
        $data['midtrans_client_key'] = $this->midtrans_configuration['ClientKey'];

        #ketika user santri tambah data
        if ($this->com_user['level'] == 2) {
            $data['students'] = $this->m_students->get_data(null, $this->com_user['student_id']);
        }

        if (!empty($param)) {
            $data['is_paid_off'] = (empty($this->m_midtrans->check_paid_off_payment($param))? false : true);
            $data['payments'] = $this->m_payments->get_detail($param);
            
            if ($data['is_paid_off']) {
                $data['payments']['photo'] = base_url() . 'assets/img/midtrans.png';
            }else{
                $data['payments']['photo'] = (empty($data['payments']['photo'])? null : base_url() . $data['payments']['photo']);
            }

            $data['students'] = $this->m_students->get_data(null, $data['payments']['student_id']);
            $data['readonly'] = ($data['payments']['is_approved'] > 0 && $this->com_user['level'] > 0? "readonly" : "");
        }
        
		parent::display('lunas', $data);
    }
}