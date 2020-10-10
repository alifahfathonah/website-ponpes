<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/M_model_base.php';

class M_Dashboard extends M_model_base{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_count_pengurus() {
    $sql = "SELECT COUNT(*) as jumlah FROM staff";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_count_kamar() {
    $sql = "SELECT COUNT(*) as jumlah FROM rooms";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_count_santri() {
    $sql = "SELECT COUNT(*) as jumlah FROM students";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_count_pembayaran($student_id) {
    $sql = "SELECT COUNT(*) as jumlah FROM payments WHERE 1";

    if (!empty($student_id)) {
      $sql .= " AND student_id = ?";
    }
    $query = $this->db->query($sql, $student_id);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

}
