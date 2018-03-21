<?php
class M_lienhe extends CI_Model{

	public $table = 'lienhe';
	public $table2 = 'taikhoan';

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

      public function getlienheInfo($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->result(); //tra ve object
      }
      public function getlistlienhe($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->result(); //tra ve object
      }

public function updatettlienhe($id, $data = array()){
        $where = array('lh_tk_id' => $id);
    	$this->db->where($where);
        $this->db->update($this->table, $data);
    }
      public function updatelienhe($id, $data = array()){
        $where = array('lh_id' => $id);
    	$this->db->where($where);
        $this->db->update($this->table, $data);
    }
}