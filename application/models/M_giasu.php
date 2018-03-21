<?php
class M_giasu extends CI_Model{

    //ten bang du lieu
    public $table  = 'giasu';
    public $table2 = 'tinh';
    public $table3 = 'daylop';

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

    //phuong thuc cho table giasu
    public function getAllGiaSu($where = array(), $limit, $offset){
        if(!empty($where))
            $this->db->where($where);
        $this->db->order_by('gs_tk_id desc');
        $this->db->limit($limit, $offset);
        $result = $this->db->get($this->table);
        return $result->result();
    }

    public function getGiaSuInfo($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->row(); //
    }

    public function getMultiGiaSuInfo($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->result(); //
    }

    public function insertGiaSu($data = array()){
        $this->db->insert($this->table, $data);
    }

    public function updateGiaSu($id, $data = array()){
        $where = array('gs_tk_id' => $id);
    	$this->db->where($where);
        $this->db->update($this->table, $data);
    }

    public function getNumGiaSu($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->num_rows();
    }


    //phuong thuc cho table Tinh
    public function getTinhInfo($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table2);
        return $result->row();
    }


    //phuong thuc cho table daylop
    public function getGiaSuDayLop($where = array()){
        $this->db->order_by('dl_id desc');
        $this->db->where($where);
        $result = $this->db->get($this->table3);
        return $result->result(); //
    }

    public function insertGiaSuDayLop($data = array()){
        $this->db->insert($this->table3, $data);
    }

    public function updateGiaSuDayLop($id, $data = array()){
        $where = array('dl_id' => $id);
        $this->db->where($where);
        $this->db->update($this->table3, $data);
    }
}
?>