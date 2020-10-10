<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/M_model_base.php';

class M_staff extends M_model_base{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_datatable($params = null) {
    $sql = "SELECT s.*, u.username FROM staff s
            JOIN users u on s.user_id = u.id
            WHERE 1";
      $rowCount = $this->db->query($sql)->num_rows();

      if (!empty($params['search']['value'])) {
          $sql .= ' AND (u.username LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%"';
          $sql .= ' OR s.name LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%"';
          $sql .= ' OR s.no_identity LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%"';
          $sql .= ' OR s.address LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%"';
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
          $rows[] = $row->username;
          $rows[] = $row->name;
          $rows[] = $row->no_identity;
          $rows[] = $row->address;
          $rows[] = $row->phone;
          $rows[] = $row->photo;
          $rows[] = $row->id;
          $option['data'][] = $rows;
      }
      $list->free_result();
      return $option;
  }

  public function get_detail($params) {
    $sql = "SELECT s.*, u.username, u.email FROM staff s
            JOIN users u on u.id = s.user_id
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
