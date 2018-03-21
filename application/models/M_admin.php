<?php
class M_admin extends CI_Model{

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
    public function getAdminInfo($where = array()){
        $this->db->where($where);
        $result = $this->db->get($this->table);
        return $result->result(); //tra ve object
    }

    // public function getAllGiaSu($where = array(), $limit, $offset){
    //     if(!empty($where))
    //         $this->db->where($where);
    //     $this->db->order_by('gs_tk_id desc');
    //     $this->db->limit($limit, $offset);
    //     $result = $this->db->get($this->table);
    //     return $result->result();
    // }

    // public function getMultiGiaSuInfo($where = array()){
    //     $this->db->where($where);
    //     $result = $this->db->get('giasu');
    //     return $result->result(); //
    // }

    // public function getMultiPhuHuynhInfo($where = array()){
    //     $this->db->where($where);
    //     $result = $this->db->get('phuhuynh');
    //     return $result->result(); //
    // }
    // public function getMultiLopDayInfo($where = array()){
    //     $this->db->where($where);
    //     $result = $this->db->get('lopday');
    //     return $result->result(); //
    // }

    /* lay thong tin cai dat */
    public function getSettingInfo($where = array()){
        $this->db->where($where);
        $result = $this->db->get('caidat');
        return $result->result(); //tra ve object
    }

    public function updateSetting($id, $data = array()){
        $where = array('cd_ma' => $id);
        $this->db->where($where);
        $this->db->update('caidat', $data);
    }

    public function getPageSetting($type){
        $where = array('cd_ten' => $type);
        $this->db->where($where);
        $result = $this->db->get('caidat');
        return $result->row()->cd_trang;
    }
}
?>
