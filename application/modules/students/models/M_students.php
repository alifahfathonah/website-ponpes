<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/M_model_base.php';

class M_students extends M_model_base{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_datatable($params = null) {
    $sql = "SELECT s.name, s.no_identity, u.username, s.phone, s.photo,s.id FROM students s
            JOIN users u on u.id = s.user_id
            WHERE 1";
      $rowCount = $this->db->query($sql)->num_rows();

      if (!empty($params['search']['value'])) {
          $sql .= ' AND (u.username LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%"';
          $sql .= ' OR s.no_identity LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%"';
          $sql .= ' OR s.name LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%"';
          $sql .= ' OR s.phone LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%")';
      }

      $sql .= '  ORDER BY id DESC';

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
          $rows[] = $row->name;
          $rows[] = $row->no_identity;
          $rows[] = $row->username;
          $rows[] = $row->phone;
          $rows[] = $row->photo;
          $rows[] = $row->id;
          $option['data'][] = $rows;
      }
      $list->free_result();
      return $option;
  }

  public function get_detail($params) {
    $sql = "SELECT students.*, users.email, rooms.id as room_id, rooms.room_number, rooms.room_type, users.username, users.status, users.is_email_verified FROM students 
    JOIN users  on users.id = students.user_id
    LEFT JOIN rooms on rooms.id = students.room
    WHERE students.id = ?  ";
    $query = $this->db->query($sql, $params);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_data($param = null, $id = null) {
    $sql = "SELECT s.id, s.name FROM students s 
            JOIN users u on u.id = s.user_id 
            WHERE 1 AND u.status > 0";

    if (!empty($param)) {
      $sql .= " AND s.name = " . $param;
    }
    if (!empty($id)) {
      $sql .= " AND s.id = ". $id;
    }
    
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $key => $value) {
          $row[$key] = $value;
      }
      return json_decode(json_encode($row), true);
    } else {
      return array();
    }
  }
}
