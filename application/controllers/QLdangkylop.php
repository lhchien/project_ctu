<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Qldangkylop extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_giasu');
		$this->load->model('m_phuhuynh');
		$this->load->model('m_lop');
				$this->load->model('m_lienhe');

	}
  

  
  
          public function dangkylop_dk(){
         
        $offset=($this->uri->segment(2)=="dangkylop" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM lopday WHERE ld_id AND ld_trangthai=0 ORDER BY ld_id desc LIMIT $offset, $limit";
        $lopday = $this->db->query($sql)->result(); 
		//$this->db->where($where);
		//$giasu = $this->db->get('giasu')->row(); //var_dump($giasu);
		$data = array('lopday' => $lopday,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qldangkylop/dangkylop", $data);
		$this->load->view("/admin/v_footer");
    }

        public function detail_dk(){
		
		$ld_id = $this->uri->segment(3);
		$sql = "SELECT * FROM lopday l WHERE l.ld_id AND l.ld_id =$ld_id";
		$lopday = $this->db->query($sql)->row();
		$data = array('lopday' => $lopday);
		
		$this->load->view("/admin/qldangkylop/dangkydetaillop", $data);
		$this->load->view("/admin/v_footer");
	}
    
           public function active_ld(){
      $ld_id = $this->uri->segment(3);
      $sql = "UPDATE lopday SET ld_trangthai=1 WHERE  ld_id = $ld_id";
      $this->db->query($sql);
      $this->session->set_flashdata('a_message', 'Update thành công');
	
         redirect('../qldangkylop/dangkylop_dk','refresh');
    }

	
     public function deletedk_ld() {
         $offset=($this->uri->segment(2)=="qldangkylop/dangkylop_dk" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM lopday WHERE ld_id AND ld_trangthai=0 ORDER BY ld_id desc LIMIT $offset, $limit";
        $lopday = $this->db->query($sql)->result(); 


      $ld_id =  $this->uri->segment(3);
      $data = array('lopday' => $lopday,
              'ld_id' => $ld_id,
              'confirm' => 'yes','limit'=> $limit,'offset'=>$offset);
      
      if($this->input->post("submit")){
        //xoa hinh
        $where = array('ld_id' => $ld_id);
        $this->db->where($where);
            $lopday = $this->db->get("lopday")->row(); //var_dump($lopday);
            if($lopday->ld_hinhanh!='img/no_img.jpg')
                @unlink("./".$lopday->ld_hinhanh);
        
        //xoa lopday và xoa taikhoan
            $query = $this->db->query("delete from lopday where ld_id = $ld_id");
          
            $this->db->delete('lopday', array('ld_id' => $ld_id));
            redirect('qldangkylop/dangkylop','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qldangkylop/dangkylop", $data);
      $this->load->view("/admin/v_footer");
    
    }
	

}