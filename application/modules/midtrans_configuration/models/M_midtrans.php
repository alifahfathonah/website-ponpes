<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/M_model_base.php';

class M_Midtrans extends M_model_base{

  public function __construct()
  {
    parent::__construct();
  }

  public function get_midtrans_configuration(){

    $query = $this->db->query('SELECT * FROM midtrans_configuration');

    if ($query->num_rows() > 0) {
        $result = [];
        foreach ($query->result_array() as $row){
                $value = null;
                if ($row['type'] == "string") {
                    $value = strval($row['value']);
                }elseif ($row['type'] == "boolean") {
                    $value = boolval($row['value']);
                }
                $result[$row['name']] = $value;
            }
        $query->free_result();
        return $result;
    } else {
        return array();
    }
  }

  public function get_midtrans_payment_status($order_id){
    $sql = "SELECT * FROM midtrans_payments
            WHERE order_id = ? ";
    $query = $this->db->query($sql, $order_id);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_midtrans_payments_by_payment_id($payment_id){
    $sql = "SELECT * FROM midtrans_payments mp
            JOIN payments p on p.id = mp.payment_id
            WHERE p.id = ? ORDER BY mp.id DESC LIMIT 1";
    $query = $this->db->query($sql, $payment_id);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_payment_by_midtrans_order_id($order_id){
    $sql = "SELECT p.* FROM midtrans_payments mp
            JOIN payments p on p.id = mp.payment_id
            WHERE mp.order_id = ? ORDER BY mp.id DESC LIMIT 1";
    $query = $this->db->query($sql, $order_id);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function check_paid_off_payment($payment_id){
    $sql = "SELECT p.* FROM midtrans_payments mp
            JOIN payments p on p.id = mp.payment_id
            WHERE mp.transaction_status = 'settlement' and p.id = ". $this->db->escape_like_str($payment_id);
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }
}