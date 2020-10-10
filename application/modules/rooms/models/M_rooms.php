<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/M_model_base.php';

class M_rooms extends M_model_base{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_datatable($params = null) {
    $sql = "SELECT r.id, r.room_number, rt.name, r.qty FROM rooms r
            JOIN room_types rt on rt.id = r.room_type";
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
          $rows[] = $row->room_number;
          $rows[] = $row->name;
          $rows[] = $row->qty;
          $rows[] = $row->id;
          $option['data'][] = $rows;
      }
      $list->free_result();
      return $option;
  }

  public function get_detail($params) {
    $sql = "SELECT r.id, r.room_number, rt.id as room_type_id, r.qty FROM rooms r
            JOIN room_types rt on rt.id = r.room_type
            WHERE r.id = ? ";
    $query = $this->db->query($sql, $params);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function check_unique_data($room_number, $room_type_id, $excepted_id = null) {
    $sql = "SELECT * FROM rooms r
            WHERE r.room_number = " . $this->db->escape_like_str($room_number) . " and r.room_type = " . $this->db->escape_like_str($room_type_id);

    if (!empty($excepted_id)) {
      $sql .= " and r.id <> " . $this->db->escape_like_str($excepted_id);
    }

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return false;
    } else {
      return true;
    }
  }

  public function get_data($param = null) {
    
    $sql = "SELECT * FROM rooms";

    if (!empty($param)) {
      $sql .= " AND id = ". $this->db->escape_like_str($param);
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

  public function get_room_available($param = null, $room_id = null) {
    $sql = "SELECT r.* FROM rooms r
            WHERE (r.qty > (SELECT COUNT(s.room) FROM students s JOIN rooms r on r.id = s.room WHERE r.room_type = " . $this->db->escape_like_str($param) .")  OR r.id = ". $this->db->escape_like_str($room_id) . ")";
   
    $sql .= " AND r.room_type = ". $this->db->escape_like_str($param);
    
    $query = $this->db->query($sql, $param);
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
