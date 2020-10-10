<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/M_model_base.php';

class M_room_type extends M_model_base{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_datatable($params = null) {
    $sql = "SELECT * FROM room_types";
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
          $rows[] = $row->id;
          $rows[] = $row->name;
          $option['data'][] = $rows;
      }
      $list->free_result();
      return $option;
  }

  public function get_detail($params) {
    $sql = "SELECT id, name FROM room_types
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

  public function get_data($param = null) {
    $sql = "SELECT * FROM room_types WHERE 1";
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

  public function get_data_available($param = null) {
    $sql = "SELECT rt.*, SUM(r.qty) as jumlah, r.id as room_id FROM room_types rt
            JOIN rooms r on r.room_type = rt.id
            GROUP BY rt.id
            HAVING SUM(r.qty) > (SELECT count(*) FROM students s WHERE s.room = room_id)";
    if (!empty($param)) {
      $sql .= " OR room_id = ". $this->db->escape_like_str($param);
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
