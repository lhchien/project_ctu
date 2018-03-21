<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_thongbao extends CI_Model {
 
    var $table = 'thongbao';
    var $column_order = array('tb_noidung','tb_ngay',null); //set column field database for datatable orderable
    var $column_search = array('tb_noidung','tb_ngay'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
 
 
}