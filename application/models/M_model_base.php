<?php

class M_model_base extends CI_Model {

    var $pesan_error = array(
        1451 => 'Data sedang digunakan oleh sistem.  Silakan periksa kembali penggunaan data.'
    );

    public function __construct() {
        parent::__construct();
    }

    function add_data($tabel, $data) {
        if (empty($tabel) || empty($data))
            return false;
        return $this->db->insert($tabel, $data);
    }

    function add_data_batch($tabel, $data) {
        if (empty($tabel) || empty($data))
            return false;
        return $this->db->insert_batch($tabel, $data);
    }

    function update_data($tabel, $kolom, $id, $data) {
        if (empty($tabel) || empty($data) || empty($kolom) || empty($id))
            return false;
        $data_transaction_log = array(
            'Condition' => $kolom . ' = ' . $id,
            'Data'      => $data
        );

        $this->db->where($kolom, $id);
        return $this->db->update($tabel, $data);
    }

    function update_data_batch($tabel, $data, $id) {
        if (empty($tabel) || empty($data) || empty($id))
            return false;
        $data_transaction_log = array(
            'Condition' => 'id = ' . $id,
            'Data'      => $data
        );
        return $this->db->update_batch($tabel, $data, $id);
    }

    function delete_data($tabel, $parameter) {
        if (empty($tabel) OR empty($parameter))
            return false;
        $data_transaction_log = array(
            'Condition' => $parameter
        );
        return $this->db->delete($tabel, $parameter);
    }

    function get_error_message() {
        $get_error = $this->db->error();
        if (isset($this->pesan_error[$get_error['code']])){
            return $this->pesan_error[$get_error['code']];
        }
        return $get_error['message'];
    }

    function get_db_error() {
        return $this->db->error();
    }

    function id_terakhir() {
        return $this->db->insert_id();
    }

}
