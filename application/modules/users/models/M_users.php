<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/M_model_base.php';

class M_Users extends M_model_base{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_datatable($params = null) {
    $sql = "SELECT * FROM users";
      $rowCount = $this->db->query($sql)->num_rows();

      if (!empty($params['search']['value'])) {
          $sql .= ' WHERE name LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%"';
      }

      $sql .= '  ORDER BY id ASC';

      // hitung total data
      $filteredRow = $this->db->query($sql)->num_rows();
      // limit
      $start = $params['start'];
      $length = $params['length'];
      $sql .= " LIMIT {$start}, {$length}";

      $list = $this->db->query($sql);

      /**
       * convert to json
       */
      $option['draw'] = $params['draw'];
      $option['recordsTotal'] = $rowCount;
      $option['recordsFiltered'] = $filteredRow;
      $option['data'] = array();

      $no = $params['start'] + 1;
      foreach ($list->result() as $row) {
          $rows = array();
          $rows[] = $no++ . '.';
          $rows[] = $row->username;
          $rows[] = $row->email;
          $rows[] = $row->status;
          $rows[] = $row->level;
          $rows[] = $row->id;
          $option['data'][] = $rows;
      }
      $list->free_result();
      return $option;
  }

  public function get_detail($params) {
    $sql = "SELECT * FROM users
            WHERE id = ? ";
    $query = $this->db->query($sql, $params);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_detail_for_session($params) {
    $sql = "SELECT  
            u.id, st.id as staff_id, s.id as student_id, u.username, u.email, u.level, u.is_email_verified, u.status,
            st.name as staff_name, s.name as student_name, st.photo as staff_photo, s.photo as student_photo,
            s.phone as student_phone
            FROM users u
            LEFT JOIN staff st on st.user_id = u.id
            LEFT JOIN students s on s.user_id = u.id
            WHERE u.id = ? ";
    $query = $this->db->query($sql, $params);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_user_by_username($params) {
    $sql = "SELECT u.* FROM users u
            WHERE u.username = ? ";
    $query = $this->db->query($sql, $params);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_user_bytoken($email, $remember_token) {
    $sql = "SELECT * FROM users
            WHERE email = '". $this->db->escape_like_str($email) ."' AND remember_token = '". $this->db->escape_like_str($remember_token)."'";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_user_by_email($params) {
    $sql = "SELECT u.* FROM users u
            WHERE u.email = ? ";
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
