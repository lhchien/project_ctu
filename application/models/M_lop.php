<?php
class M_lop extends CI_Model{

	public $table = 'lopday';
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

      public function getlopInfo($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->row(); //tra ve object
      }

        public function updatelop($id, $data = array()){
        $where = array('ld_id' => $id);
    	  $this->db->where($where);
        $this->db->update($this->table, $data);
    }
    }

?>