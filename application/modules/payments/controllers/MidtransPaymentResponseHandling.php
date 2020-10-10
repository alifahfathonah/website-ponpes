<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Core_base.php';

class MidtransPaymentResponseHandling extends Core_base {

	public function __construct()
	{
		$this->load->model('m_payments');
		$this->load->model('midtrans_configuration/m_midtrans');

        $this->midtrans_configuration = $this->m_midtrans->get_midtrans_configuration();
        // midtrans library
        require_once(APPPATH.'libraries/Midtrans.php');
        \Midtrans\Config::$serverKey = $this->midtrans_configuration['ServerKey'];
        \Midtrans\Config::$isProduction = (strpos($this->midtrans_configuration['ServerKey'], 'SB-Mid') !== false ? false : true );
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
	}
	
	public function index(){

		$notif = new \Midtrans\Notification();
		
		$transaction = $notif->transaction_status;
		$fraud = $notif->fraud_status;

		error_log("Order ID $notif->order_id: "."transaction status = $transaction, fraud staus = $fraud");

		$variables = [];
        $variables['transaction_id'] = $notif->transaction_id;
        $variables['order_id'] = $notif->order_id;
        $variables['payment_type'] = $notif->payment_type;
        $variables['transaction_status'] = $notif->transaction_status;
        $variables['transaction_time'] = $notif->transaction_time;
        $variables['gross_amount'] = $notif->gross_amount;
		$variables['signature_key'] = $notif->signature_key;
		
		$this->m_midtrans->update_data('midtrans_payments', 'order_id', $notif->order_id, $variables);

		if ($transaction == 'settlement') {
			if ($fraud == 'challenge') {
			// TODO Set payment status in merchant's database to 'challenge'
			}
			else if ($fraud == 'accept') {
				$payment = $this->m_midtrans->get_payment_by_midtrans_order_id($notif->order_id);
				$payment['is_approved'] = true;
				$this->m_payments->update_data('payments', 'id', $payment['id'],  $payment);
			}
		}
		else if ($transaction == 'capture') {
			if ($fraud == 'challenge') {
			// TODO Set payment status in merchant's database to 'challenge'
			}
			else if ($fraud == 'accept') {

			}
		}
		else if ($transaction == 'cancel') {
			if ($fraud == 'challenge') {
			// TODO Set payment status in merchant's database to 'failure'
			}
			else if ($fraud == 'accept') {
			// TODO Set payment status in merchant's database to 'failure'
			}
		}
		else if ($transaction == 'deny') {
			// TODO Set payment status in merchant's database to 'failure'
		}
		var_dump('berhasil');exit;
        header('Location: https://' . base_url('payments'));
	}
}