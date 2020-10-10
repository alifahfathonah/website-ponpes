<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/M_model_base.php';

class M_Payments extends M_model_base{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_datatable($params = null, $student_id = null) {
    $sql = "SELECT p.id, s.id as students_id, s.name, p.amount, p.transaction_date, p.is_approved, p.photo, p.created_at FROM payments p
            JOIN students s on s.id = p.student_id WHERE 1";


    $rowCount = $this->db->query($sql)->num_rows();

    if (!empty($student_id)) {
      $sql .= ' AND s.id = ' . $this->db->escape_like_str($student_id);
    }
    if (!empty($params['search']['value'])) {
        $sql .= ' AND (s.name LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%"';
        $sql .= ' OR p.created_at LIKE "%' . $this->db->escape_like_str($params['search']['value']) . '%")';
    }

    $sql .= '  ORDER BY created_at DESC';

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
        $rows[] = $row->transaction_date;
        $rows[] = $row->amount;
        $rows[] = $row->is_approved;
        $rows[] = $row->photo;
        $rows[] = $row->id;
        $option['data'][] = $rows;
    }
    $list->free_result();
    return $option;
  }

  public function get_detail($params) {
    $sql = "SELECT * FROM payments
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

  public function get_last_update_payment_by_student($student_id){
    $sql = "SELECT * FROM payments
            WHERE student_id = ? ORDER BY updated_at DESC LIMIT 1 ";
    $query = $this->db->query($sql, $student_id);
    if ($query->num_rows() > 0) {
      $result = $query->row_array();
      $query->free_result();
      return $result;
    } else {
      return array();
    }
  }

  public function get_students ()
  {
    $query=$this->db->query('SELECT * from students');
    return $query;
  }
}
