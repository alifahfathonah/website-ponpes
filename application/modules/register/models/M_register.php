<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/M_model_base.php';

class M_register extends M_model_base{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_detail_user_by_username($params) {
    $sql = "SELECT * FROM users
            WHERE username = ? ";
    $query = $this->db->query($sql, $params);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_user_by_staff_id($params) {
    $sql = "SELECT u.* FROM users u
            JOIN staff s on s.user_id = u.id
            WHERE s.id = ? ";
    $query = $this->db->query($sql, $params);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_user_by_students_id($params) {
    $sql = "SELECT u.* FROM users u
            JOIN students s on s.user_id = u.id
            WHERE s.id = ? ";
    $query = $this->db->query($sql, $params);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

}
