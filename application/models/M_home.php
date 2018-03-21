<?php
class M_home extends CI_Model{

    //ten bang du lieu
    public $table = 'taikhoan';

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    
    /* kiem tra tai khoan dang nhap trong csdl */
	public function checkLogin($email, $password){
        $where = array('tk_email' => $email, 'tk_matkhau' => $password);
        $this->db->where($where);
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    /* lay thong tin thanh vien */
    public function getUserInfo($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->result(); //tra ve object
    }

    /* lay thong tin thanh vien */
    public function getUserInfo1($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->row(); //tra ve object
    }

    /* them user moi */
    public function insertUser($data = array()){
        $this->db->insert($this->table, $data);
    }

    /* doi mat khau */
    public function changePass($id, $data = array()){
        $where = array('tk_id' => $id);
        $this->db->where($where);
        $this->db->update($this->table, $data);
    }
}
?>
