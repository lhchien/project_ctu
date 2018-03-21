<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Qllop extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_lop');
		$this->load->model('m_admin');
	}

public function index(){
        $where = array('ld_trangthai' => 1);
		$lop = $this->m_lop->getlopInfo($where);
		$data = array('lop' => $lop);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qllop/index", $data);
		$this->load->view("/admin/v_footer");
    }
	public function Chuacogiasu(){
        $where = array('ld_trangthai' => 1);
		$lop = $this->m_lop->getlopInfo($where);
		$data = array('lopday' => $lop);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qllop/Chuacogiasu", $data);
		$this->load->view("/admin/v_footer");
    }
	public function stopactive(){
        $where = array('ld_trangthai' => 0);
		$lop = $this->m_lop->getlopInfo($where);
		$data = array('lop' => $lop);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qllop/stopactive", $data);
		$this->load->view("/admin/v_footer");
    }

    public function delete_ld() {
		$ld_id =  $this->uri->segment(3);
		$this->db->order_by("ld_id", "desc");
		$lopday = $this->m_admin->getMultiLopDayInfo();
		$data = array('lopday' => $lopday,
					  'ld_id' => $ld_id,
					  'confirm' => 'yes');
		
		if($this->input->post("submit")){
			//xoa hinh
			$where = array('ld_id' => $ld_id);
			$this->db->where($where);
	        $lopday = $this->db->get("lopday")->row(); //var_dump($lopday);
	        if($lopday->ld_hinhanh!='img/no_img.jpg')
	            @unlink("./".$lopday->ld_hinhanh);
		 	
		 	//xoa lopday
	        $query = $this->db->query("delete from lopday where ld_id = $ld_id");
	        $this->db->delete('lopday', array('ld_id' => $ld_id));
	        redirect('qllopday/index','refresh');
		}
		
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qllopday/index", $data);
		$this->load->view("/admin/v_footer");
		
    }

    public function active_ld(){
    	$ld_id = $this->uri->segment(3);
    	$sql = "UPDATE lopday SET ld_trangthai=1 WHERE ld_id = $ld_id";
    	$this->db->query($sql);
    	//$this->session->set_flashdata('a_message', 'Update thành công');
        redirect('qllopday/index','refresh');
    }

}
?>