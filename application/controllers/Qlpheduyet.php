<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Qlpheduyet extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_giasu');
        $this->load->model('m_admin');
        $this->load->model('m_phuhuynh');	
        	$this->load->model('m_lienhe');

		
	}
    
//Gia sư

      public function pheduyetgiasu(){
         
        $offset=($this->uri->segment(2)=="pheduyetgiasu" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id AND gs_trangthai=0 ORDER BY gs_tk_id desc LIMIT $offset, $limit";
        $giasu = $this->db->query($sql)->result(); 
		$data = array('giasu' => $giasu,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlpheduyet/pdgiasu/pheduyetgiasu", $data);
		$this->load->view("/admin/v_footer");
    }
    public function pheduyetdetail_gs(){
		//echo site_url(); echo "<br/>".base_url(); echo "<br/>".$this->uri->segment(3);
		$gs_id = $this->uri->segment(3);
		$sql = "select * from giasu a left join daylop b on a.gs_tk_id = b.dl_gs_id where a.gs_tk_id = $gs_id";
        $giasu = $this->db->query($sql)->row();
		$data = array('giasu' => $giasu);
		
		$this->load->view("/admin/qlpheduyet/pdgiasu/pheduyetgiasudetail", $data);
		$this->load->view("/admin/v_footer");
       
	}

    public function pdactive_gs(){
      $gs_id = $this->uri->segment(3);
      $sql = "UPDATE giasu SET gs_trangthai=1 WHERE gs_tk_id = $gs_id";
      $this->db->query($sql);
      $this->session->set_flashdata('a_message', 'Update thành công');
        redirect('qlpheduyet/pheduyetgiasu','refresh');
    }



     public function deletepheduyet_gs() {
         $offset=($this->uri->segment(2)=="qlpheduyet/pheduyetgiasu" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id AND gs_trangthai=0 ORDER BY gs_tk_id desc LIMIT $offset, $limit";
        $giasu = $this->db->query($sql)->result(); 


      $gs_tk_id =  $this->uri->segment(3);
      $data = array('giasu' => $giasu,
              'gs_tk_id' => $gs_tk_id,
              'confirm' => 'yes','limit'=> $limit,'offset'=>$offset);
      
      if($this->input->post("submit")){
        //xoa hinh
        $where = array('gs_tk_id' => $gs_tk_id);
        $this->db->where($where);
            $giasu = $this->db->get("giasu")->row(); //var_dump($giasu);
            if($giasu->gs_hinhanh!='img/no_img.jpg')
                @unlink("./".$giasu->gs_hinhanh);
        
        //xoa giasu và xoa taikhoan
            $query = $this->db->query("delete from giasu where gs_tk_id = $gs_tk_id");
            //$this->db->delete('giasu', array('gs_tk_id' => $gs_tk_id));
            $this->db->delete('taikhoan', array('tk_id' => $gs_tk_id));
            redirect('qlpheduyet/pheduyetgiasu','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qlpheduyet/pdgiasu/pheduyetgiasu", $data);
      $this->load->view("/admin/v_footer");
    
    }
	



// Phụ Huynh
     public function pheduyetphuhuynh(){
         
        $offset=($this->uri->segment(2)=="pheduyetphuhuynh" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM taikhoan t, phuhuynh p WHERE t.tk_id=p.ph_tk_id AND ph_trangthai=0 ORDER BY ph_tk_id desc LIMIT $offset, $limit";
        $phuhuynh = $this->db->query($sql)->result(); 
		$data = array('phuhuynh' => $phuhuynh,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlpheduyet/pdphuhuynh/pheduyetphuhuynh", $data);
		$this->load->view("/admin/v_footer");
    }
    	public function pheduyetdetail_ph(){
        $ph_id = $this->uri->segment(3);
		$sql = "select * from phuhuynh a left join lopday b on a.ph_tk_id = b.ph_tk_id where a.ph_tk_id = $ph_id";
        $phuhuynh = $this->db->query($sql)->row();
		$data = array('phuhuynh' => $phuhuynh);
		
		$this->load->view("/admin/qlpheduyet/pdphuhuynh/pheduyetphuhuynhdetail", $data);
		$this->load->view("/admin/v_footer");
	}

    public function deletepheduyet_ph() {
      $ph_tk_id =  $this->uri->segment(3);
      $where = array('ph_trangthai' => 0);
      $this->db->order_by("ph_tk_id", "desc");
      $phuhuynh = $this->m_phuhynh->getPhuhuynhInfo1($where);
      $data = array('phuhuynh' => $phuhuynh,
              'ph_tk_id' => $ph_tk_id,
              'confirm' => 'yes');
      
      if($this->input->post("submit")){
        //xoa hinh
        $where = array('ph_tk_id' => $ph_tk_id);
        $this->db->where($where);
            $phuhuynh = $this->db->get("phuhuynh")->row(); //var_dump($giasu);
            if($phuhuynh->ph_hinhanh!='img/no_img.jpg')
                @unlink("./".$phuhuynh->ph_hinhanh);
        
        //xoa giasu và xoa taikhoan
            $query = $this->db->query("delete from giasu where ph_tk_id = $ph_tk_id");
            //$this->db->delete('giasu', array('gs_tk_id' => $gs_tk_id));
            $this->db->delete('taikhoan', array('tk_id' => $gs_tk_id));
            redirect('qlpheduyet/pdphuhuynh/pheduyetphuhuynh','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qlpheduyet/pdphuhuynh/pheduyetphuhuynh", $data);
      $this->load->view("/admin/v_footer");
    
    }
       public function pdactive_ph(){
      $ph_id = $this->uri->segment(3);
      $sql = "UPDATE phuhuynh SET ph_trangthai=1 WHERE ph_tk_id = $ph_id";
      $this->db->query($sql);
      $this->session->set_flashdata('a_message', 'Update thành công');
        redirect('qlpheduyet/pheduyetphuhuynh','refresh');
    }

	public function pheduyeteditInfo_ph(){
        if( $this->input->post('submit') ){
            
            $this->form_validation->set_rules('txtName', 'Họ tên', 'required|trim|xss_clean');
            $this->form_validation->set_rules('optSex', 'Giới tính', 'required');
          //  $this->form_validation->set_rules('slNamSinh', 'Năm sinh', 'required');
            $this->form_validation->set_rules('txtPhone', 'Điện thoại', 'required|min_length[7]|max_length[11]');
            $this->form_validation->set_rules('slTrinhDo', 'Trình độ', 'required');
        

            $this->form_validation->set_message('required', '%s không được bỏ trống!');
            $this->form_validation->set_message('min_length', '%s không hợp lệ, tối thiểu 7 số!');
            $this->form_validation->set_message('max_length', '%s không hợp lệ, tối đa 11 số!');
            
            if( $this->form_validation->run() ){
                $ph_tk_id       = $this->uri->rsegment('3');
                $image          = $this->upImage();
                $ph_hoten       = $this->input->post('txtName');
                $ph_gioitinh    = $this->input->post('optSex');
            //    $ph_namsinh     = $this->input->post('slNamSinh');
                $ph_diadiem      = $this->input->post('txtAddress');
                $ph_dienthoai   = $this->input->post('txtPhone');
                $ph_trinhdo     = $this->input->post('slTrinhDo');
                $ph_hinhanh     = empty($image['file_name']) 
                                  ? 'img/no_img.jpg' 
                                  : 'img/ph_img/'.$image['file_name'];

                $where          = array('ph_tk_id' => $ph_tk_id);
                $phuhuynh          = $this->m_phuhuynh->getPhuHuynhInfo($where);
                //xoa file cu
                if(!empty($image) && $phuhuynh->ph_hinhanh!='img/no_img.jpg')
                    @unlink("./".$phuhuynh->ph_hinhanh);

                $ph_hinhanh = empty($image['file_name']) ? $phuhuynh->ph_hinhanh : 'img/ph_img/'.$image['file_name'];
                $dong       = array(  "ph_hoten"        => $ph_hoten,
                                      "ph_gioitinh"     => $ph_gioitinh,
                                      //"ph_namsinh"      => $ph_namsinh,
                                      "ph_dienthoai"    => $ph_dienthoai,
                                      "ph_hinhanh"      => $ph_hinhanh,
                                      "ph_trinhdo"      => $ph_trinhdo,
                                    );
                $this->m_phuhuynh->updatePhuHuynh($ph_tk_id, $dong);
                if(!empty($image))
                    $this->session->set_flashdata('message', 'Update thành công');
                
            }
            $this->session->set_flashdata('message', 'Cập nhật thông tin thành công');
        }

        $data=array('title'=>'Cập nhật thông tin');
        $this->load->view("/admin/v_header");
        $this->load->view("/admin/qlpheduyet/pdphuhuynh/pheduyeteditphuhuynh");
        $this->load->view("/admin/v_footer");
    }

////////////// Phê duyệt lớp








}