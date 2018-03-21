<?php
	
	class M_phuhuynh extends CI_model
	{

		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}


	//______________________PHU HUYNH/HOC SINH__________________________
		public $tb = 'phuhuynh';
   
	    public function getAllPhuHuynh()
        { 
            $this->db->order_by('ph_tk_id','DESC');
            $query = $this->db->get($this->tb);
            return $query->result();
        }

        public function getAllPhuHuynh_s($where = array(), $limit, $offset){
	        if(!empty($where))
	        $this->db->where($where);
	        $this->db->order_by('ph_tk_id','DESC');
	        $this->db->limit($limit, $offset);
	        $result = $this->db->get($this->tb);
	        return $result->result();
	    }


		public function insertPhuHuynh($data = array())
		{
	        $this->db->insert($this->tb, $data);
	    }

		public function getPhuHuynhInfo($where = array())
		{
        	$this->db->where($where);
	        $result = $this->db->get($this->tb);
	        return $result->row(); //
    	}
    	public function getPhuHuynhInfo1($where = array())
		{
        	$this->db->where($where);
	        $result = $this->db->get($this->tb);
	        return $result->result(); //
    	}

    	public function updatePhuHuynh($id, $data = array()){
	        $where = array('ph_tk_id' => $id);
	    	$this->db->where($where);
	        $this->db->update($this->tb, $data);
    	}

    	public function getNumPhuHuynh($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->tb);
        return $result->num_rows();
    	}

// XU LY THONG TIN LOP HOC CLASS --------------------------------------------------
    	public $tbClass = 'lopday';	

    	public function insertClass($data = array())
		{
	        $this->db->insert($this->tbClass, $data);
	    }

    	public function getClassInfo($where = array())
		{
        	$this->db->where($where);
	        $result = $this->db->get($this->tbClass);
	        return $result->result(); 
    	}

    	public function getAllClass($where = array(), $limit, $offset){
	        if(!empty($where))
	        $this->db->where($where);
	        $this->db->order_by('ld_id desc');
	        $this->db->limit($limit, $offset);
	        $result = $this->db->get($this->tbClass);
	        return $result->result();
	    }

	    public function updateClass($id, $data = array()){
	        $where = array('ld_id' => $id);
	    	$this->db->where($where);
	        $this->db->update($this->tbClass, $data);
    	}

    	public function deleteClass($id){
	        $where = array('ld_id' => $id);
	    	$this->db->where($where);
	        $this->db->delete($this->tbClass);
    	}

    	public function getNumClass(){
    	$sql = "SELECT DISTINCT ld_id, `ld_tieude`, `ld_mon`, `ld_khoilop`, `ld_soluong`, `ld_yeucau`, `ld_buoiday`, `ld_thoigian`, `ld_diadiem`, `ld_mota_diadiem`, `ld_hinhanh`, `ld_trangthai`, `ld_diem_cmt`, `ld_noidung_cmt`, dk_trangthai FROM lopday LEFT JOIN dangky ON lopday.ld_id = dangky.dk_ld_id WHERE (dk_trangthai >=0 OR dk_trangthai is null) AND lopday.ld_trangthai = 1";
        return $this->db->query($sql)->num_rows();
    	}

// XU LY THONG TIN ĐANG KI DAY HOC--------------------------------------------------
    	public $tb_dk = 'dangky';

    	public function insert_dk_day($data = array())
		{
	        $this->db->insert($this->tb_dk, $data);
	    }

	    public function sosanh($where){
	    	$this->db->where($where);
	    	$result = $this->db->get($this->tb_dk);
	    	return $result->num_rows();
	    }

	    public function delete_dangky($where = array()){
	    	$this->db->where($where);
	        $this->db->delete($this->tb_dk);
    	}


	}


?>
