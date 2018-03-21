<?php
class M_nhansu extends CI_Model{

	public $table = 'nhansu';
	public $table1 = 'taikhoan';

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

      public function getnhansuInfo($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->result(); //tra ve object
      }

      public function getnhansuInfo1($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->row(); //tra ve object
      }
      
      	public function updateNhansu($id, $data = array()){
	          $where = array('ns_tk_id' => $id);
	    	  $this->db->where($where);
	          $this->db->update($this->table, $data);
    	}

		public function getTaiKhoanInfo($where = array()){
      	      $this->db->where($where);
      	      $result = $this->db->get($this->table1);
        return $result->result(); //tra ve object
    }

	    public function getTaikhoanInfo1($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table1);
        return $result->row(); //tra ve object
	}

		public function insertUser1($data = array()){
       		 $this->db->insert($this->table1, $data);
    }
		public function insertUser($data = array()){
       		 $this->db->insert($this->table, $data);
    }

 		public function changepass($id, $data = array()){
       		 $where = array('tk_id' => $id);
       		 $this->db->where($where);
       		 $this->db->update($this->table1, $data);
    }		
      

    
}

?>