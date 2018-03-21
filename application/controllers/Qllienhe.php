<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Qllienhe extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
        $this->load->model('m_giasu');
        $this->load->model('m_phuhuynh');
		$this->load->model('m_lop');
		$this->load->model('m_nhansu');
		$this->load->model('m_lienhe');
	}
 	public function lienhe_gs(){
         
        $offset=($this->uri->segment(2)=="lienhegiasu" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM lienhe l, taikhoan t, giasu g WHERE l.lh_tk_id = t.tk_id AND t.tk_id = g.gs_tk_id ORDER BY lh_trangthai  desc LIMIT $offset, $limit";
        $lienhe = $this->db->query($sql)->result(); 
		//var_dump($lienhe);
		//$this->db->where($where);
		//$giasu = $this->db->get('giasu')->row(); //var_dump($giasu);
		$data = array('lienhe' => $lienhe,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qllienhe/lhgiasu/lienhegiasu", $data);
		$this->load->view("/admin/v_footer");
    }

	public function noidung_lh(){
		
		$lh_id = $this->uri->segment(3);
		$sql = "SELECT * FROM lienhe l, taikhoan t, giasu g  WHERE l.lh_tk_id = t.tk_id AND t.tk_id = g.gs_tk_id  AND l.lh_tk_id = $lh_id";
		$lienhe = $this->db->query($sql)->row();
		$data = array('lienhe' => $lienhe);
		 if( $this->input->post('submit') ){
				$lh_phanhoi   = $this->input->post('description');
				$id = $this->input->post('lh_id');
				
				$where          = array('lh_tk_id' => $lh_id);
				$dong       = array(  
                                       "lh_phanhoi"    => $lh_phanhoi,
                                     );

				$this->m_lienhe->updatelienhe($id, $dong);
				 redirect('../qllienhe/noidung_lh/'.$lh_id,'refresh');
        }

		$this->load->view("/admin/qllienhe/lhgiasu/lienhenoidung", $data);
		$this->load->view("/admin/v_footer");
		
		
	}
	
    public function deletelh_gs() {
        $offset=($this->uri->segment(2)=="lienhe_gs" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM lienhe l, taikhoan t, giasu g WHERE l.lh_tk_id = t.tk_id AND t.tk_id = g.gs_tk_id ORDER BY lh_trangthai  desc LIMIT $offset, $limit";
        $lienhe = $this->db->query($sql)->result(); 
	

      $lh_id =  $this->uri->segment(3);
      $data = array('lienhe' => $lienhe,
              'lh_id' => $lh_id,
              'confirm' => 'yes','limit'=> $limit,'offset'=>$offset);
      
      if($this->input->post("submit")){
        //xoa hinh
        $where = array('lh_id' => $lh_id);
        $this->db->where($where);
            $lienhe = $this->db->get("lienhe")->row();
           
        
        
            $query = $this->db->query("delete from lienhe where lh_id = $lh_id");
            //$this->db->delete('giasu', array('gs_tk_id' => $gs_tk_id));
            $this->db->delete('lienhe', array('lh_id' => $lh_id));
            redirect('qllienhe/lienhegiasu','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qllienhe/lhgiasu/lienhegiasu", $data);
      $this->load->view("/admin/v_footer");
    
    }




//////////////////////////////////////////////////////////

	public function lienhe_ph(){
         
        $offset=($this->uri->segment(2)=="lienhephuhuynh" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM lienhe l, taikhoan t, phuhuynh p WHERE l.lh_tk_id = t.tk_id AND t.tk_id = p.ph_tk_id ORDER BY lh_tk_id desc LIMIT $offset, $limit";
        $lienhe = $this->db->query($sql)->result(); 
		$data = array('lienhe' => $lienhe,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qllienhe/lhphuhuynh/lienhephuhuynh", $data);
		$this->load->view("/admin/v_footer");
    }


		
	public function phuhuynhnoidung_lh(){
		
		$lh_id = $this->uri->segment(3);
		$sql = "SELECT * FROM lienhe l, taikhoan t, phuhuynh p  WHERE l.lh_tk_id = t.tk_id AND t.tk_id = p.ph_tk_id  AND l.lh_tk_id = $lh_id";
		$lienhe = $this->db->query($sql)->row();
		$data = array('lienhe' => $lienhe);
		 if( $this->input->post('submit') ){
				$lh_phanhoi   = $this->input->post('description');
				$id = $this->input->post('lh_id');
				
				$where          = array('lh_tk_id' => $lh_id);
				$dong       = array(  
                                       "lh_phanhoi"    => $lh_phanhoi,
                                     );

				$this->m_lienhe->updatelienhe($id, $dong);
				 redirect('../qllienhe/phuhuynhnoidung_lh/'.$lh_id,'refresh');
        }

		$this->load->view("/admin/qllienhe/lhphuhuynh/lienhenoidungph", $data);
		$this->load->view("/admin/v_footer");
		
		
	}

}
?>
