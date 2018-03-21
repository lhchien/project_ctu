<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class qllopday extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_giasu');
		$this->load->model('m_phuhuynh');
		$this->load->model('m_lop');
        		$this->load->model('m_lienhe');

		
	}



 public function active(){
        $search = (isset($_POST["search_ld"]))? " AND l.ld_mon like '%".$_POST["key_mon"]."%' AND l.ld_khoilop  like '%".$_POST["key_lop"]."%'" : "";
        $offset=($this->uri->segment(2)=="active" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM lopday l, dangky d WHERE l.ld_id = d.dk_ld_id AND ld_trangthai=1 AND dk_trangthai=1 $search ORDER BY ld_id desc LIMIT $offset, $limit";
        $lopday = $this->db->query($sql)->result(); 
		$data = array('lopday' => $lopday,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qllop/active", $data);
		$this->load->view("/admin/v_footer");
 	}

	public function chuacogiasu(){
          $search = (isset($_POST["search_ld"]))? " AND l.ld_mon like '%".$_POST["key_mon"]."%' AND l.ld_khoilop  like '%".$_POST["key_lop"]."%'" : "";
         $offset=($this->uri->segment(2)=="chuacogiasu" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM lopday l, dangky d WHERE l.ld_id = d.dk_ld_id AND ld_trangthai=1 AND dk_trangthai=0 GROUP BY dk_ld_id desc LIMIT $offset, $limit";
        $lopday = $this->db->query($sql)->result(); 
		$data = array('lopday' => $lopday,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qllop/chuacogiasu", $data);
		$this->load->view("/admin/v_footer");
	}
 	public function ketthuckhoahoc_ld(){
        $search = (isset($_POST["search_ld"]))? " AND l.ld_mon like '%".$_POST["key_mon"]."%' AND l.ld_khoilop  like '%".$_POST["key_lop"]."%'" : "";
        $offset=($this->uri->segment(2)=="ketthuckhoahoc_ld" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
       $sql = "SELECT * FROM lopday l, dangky d WHERE l.ld_id = d.dk_ld_id AND ld_trangthai=1 AND dk_trangthai=-2 ORDER BY ld_id desc LIMIT $offset, $limit";
        $lopday = $this->db->query($sql)->result(); 
		$data = array('lopday' => $lopday,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qllop/ketthuckhoahoc", $data);
		$this->load->view("/admin/v_footer");
 	} 
	public function detail_ld(){
		
		$ld_id = $this->uri->segment(3);
		$sql = "SELECT * FROM taikhoan t,phuhuynh p,lopday l, dangky d, giasu g, daylop a WHERE t.tk_id = p.ph_tk_id AND p.ph_tk_id = l.ph_tk_id AND l.ld_id = d.dk_ld_id AND d.dk_gs_id = g.gs_tk_id AND g.gs_tk_id = a.dl_gs_id AND ld_trangthai = 1 AND dk_trangthai = 1 AND l.ld_id =$ld_id";
		$lopday = $this->db->query($sql)->row();
		$data = array('lopday' => $lopday);
		
		$this->load->view("/admin/qllop/detail", $data);
		$this->load->view("/admin/v_footer");
	}
	public function chuacogiasudetail_ld(){
		
		
		$ld_id = $this->uri->segment(3);
		$sql = "SELECT * FROM taikhoan t,phuhuynh p,lopday l, dangky d WHERE t.tk_id = p.ph_tk_id AND p.ph_tk_id = l.ph_tk_id AND l.ld_id = d.dk_ld_id AND  l.ld_id =$ld_id AND ld_trangthai = 1 AND dk_trangthai = 0";
		$lopday = $this->db->query($sql)->row();
		$data = array('lopday' => $lopday);
		
		$this->load->view("/admin/qllop/chuacogiasudetail", $data);
		$this->load->view("/admin/v_footer");
	}
    public function kethuckhoahocdetail_ld(){
		
		$ld_id = $this->uri->segment(3);
		$sql = "SELECT * FROM taikhoan t,phuhuynh p,lopday l, dangky d, giasu g, daylop a WHERE t.tk_id = p.ph_tk_id AND p.ph_tk_id = l.ph_tk_id AND l.ld_id = d.dk_ld_id AND d.dk_gs_id = g.gs_tk_id AND g.gs_tk_id = a.dl_gs_id AND ld_trangthai = 1 AND dk_trangthai = -2 AND l.ld_id =$ld_id";
		$lopday = $this->db->query($sql)->row();
		$data = array('lopday' => $lopday);
		
		$this->load->view("/admin/qllop/ketthuckhoahocdetail", $data);
		$this->load->view("/admin/v_footer");
	}
	
	 public function delete_ld() {
        $offset=($this->uri->segment(2)=="active" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM lopday l, dangky d WHERE l.ld_id = d.dk_ld_id AND ld_trangthai=1 AND dk_trangthai=1 ORDER BY ld_id desc LIMIT $offset, $limit";
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
        
        //xoa phuhuynh và xoa taikhoan
            $query = $this->db->query("delete from lopday where ld_id = $ld_id");
            $this->db->delete('lopday', array('ld_id' => $ld_id));
            redirect('qllop/active','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qllop/active", $data);
      $this->load->view("/admin/v_footer");
    
    }

 public function chuacogiasudelete_ld() {
        $offset=($this->uri->segment(2)=="chuacogiasu" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM lopday l, dangky d WHERE l.ld_id = d.dk_ld_id AND ld_trangthai=1 AND dk_trangthai=0 GROUP BY dk_ld_id desc LIMIT $offset, $limit";
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
        
        //xoa phuhuynh và xoa taikhoan
            $query = $this->db->query("delete from lopday where ld_id = $ld_id");
            $this->db->delete('lopday', array('ld_id' => $ld_id));
            redirect('qllop/chuacogiasu','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qllop/chuacogiasu", $data);
      $this->load->view("/admin/v_footer");
    
    }
    
	 public function ketthuckhoahocdelete_ld() {
        $offset=($this->uri->segment(2)=="ketthuckhoahoc" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM lopday l, dangky d WHERE l.ld_id = d.dk_ld_id AND ld_trangthai=1 AND dk_trangthai=-2 ORDER BY ld_id desc LIMIT $offset, $limit";
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
        
        //xoa phuhuynh và xoa taikhoan
            $query = $this->db->query("delete from lopday where ld_id = $ld_id");
            $this->db->delete('lopday', array('ld_id' => $ld_id));
            redirect('qllop/ketthuckhoahoc','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qllop/ketthuckhoahoc", $data);
      $this->load->view("/admin/v_footer");
    
    }

      public function upImage(){

        if($this->input->post('submit')){
            //Cau hinh cac tham so
            $config = array();
            $config['upload_path']   = './img/ld_img';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size']      = '600'; //500Kb
            $config['max_width']     = '1028';
            $config['max_height']    = '1028';
            $config['remove_spaces'] = TRUE;

            //load thư viện upload
            $this->upload->initialize($config); //var_dump($_FILES['fileImg']['name']);

            $data = array();
            if(!empty($_FILES['fileImg']['name'])){
                //thuc hien upload
                if($this->upload->do_upload('fileImg')){
                    //chua mang thong tin upload thanh cong
                    $data = $this->upload->data(); //print_r($data);

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './img/ld_img/'.$data['file_name'];
                    $config['maintain_ratio'] = FALSE;
                    $config['width']     = 530;
                    $config['height']   = 600;
                    $config['x_axis'] = ($data['image_width'] - $config['width'])/2; //left
                    $config['y_axis'] = ($data['image_height'] - $config['height'])/2; //top
                    //echo  $config['x_axis']."-".$config['y_axis'];
                    $this->image_lib->initialize($config);
                    $this->image_lib->crop();
                }
                else{
                    //hien thi lỗi nếu có
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', $error); //echo $error;
                }
            }

        }
        return $data;
    }
    public function editInfo_ld(){
        if( $this->input->post('submit') ){
            
            $this->form_validation->set_rules('txtTieude', 'Tiêu đề', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtMon', 'Môn', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtSoluong', 'Số lượng học viên', 'required|min_length[1]|max_length[2]');
			$this->form_validation->set_rules('txtBuoi', 'Buổi dạy', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtGio', 'Giờ dạy', 'required|trim|min_length[3]|max_length[5]');
            $this->form_validation->set_rules('txtDiachi', 'Địa chỉ', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s không được bỏ trống!');
            $this->form_validation->set_message('min_length', '%s ,Độ dày tối thiểu không hợp lệ!');
            $this->form_validation->set_message('max_length', '%s ,Độ dày tối đa không hợp lệ!');
            
            if( $this->form_validation->run() ){
                $ld_id       = $this->uri->rsegment('3');
                $image          = $this->upImage();
                $ld_tieude       = $this->input->post('txtTieude');
				$ld_mon       = $this->input->post('txtMon');
                $ld_soluong     = $this->input->post('txtSoluong');
                $ld_buoiday      = $this->input->post('txtBuoi');
                $ld_thoigian   = $this->input->post('txtGio');
				$ld_mota_diadiem      = $this->input->post('txtDiachi');
                $ld_yeucau   = $this->input->post('description');
                $ld_hinhanh     = empty($image['file_name']) 
                                  ? 'img/no_img.jpg' 
                                  : 'img/ld_img/'.$image['file_name'];

                $where          = array('ld_id' => $ld_id);
                $lopday          = $this->m_lop->getlopInfo($where);
                //var_dump($lopday);
                //xoa file cu
                if(!empty($image) && $lopday->ld_hinhanh != "img/no_img.jpg")
                    @unlink("./".$lopday->ld_hinhanh);

                $ld_hinhanh = empty($image['file_name']) ? $lopday->ld_hinhanh : 'img/ld_img/'.$image['file_name'];
                $dong       = array(  "ld_tieude"        => $ld_tieude,
                                      "ld_mon"     => $ld_mon,
                                      "ld_soluong"      => $ld_soluong,
                                      "ld_buoiday"    => $ld_buoiday,
                                      "ld_thoigian"      => $ld_thoigian,
                                      "ld_mota_diadiem"    => $ld_mota_diadiem,
                                      "ld_yeucau"      => $ld_yeucau,
                                      "ld_hinhanh"      => $ld_hinhanh,
                    
                                    );
                $this->m_lop->updatelop($ld_id, $dong);
                if(!empty($image))
                    $this->session->set_flashdata('message', 'Update thành công');
                
            }
        }

        $data=array('title'=>'Cập nhật thông tin');
        $this->load->view("/admin/v_header");
        $this->load->view("/admin/qllop/edit");
        $this->load->view("/admin/v_footer");
    }

	public function chuacogiasueditInfo_ld(){
        if( $this->input->post('submit') ){
            
            $this->form_validation->set_rules('txtTieude', 'Tiêu đề', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtMon', 'Môn', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtSoluong', 'Số lượng học viên', 'required|min_length[1]|max_length[2]');
			$this->form_validation->set_rules('txtBuoi', 'Buổi dạy', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtGio', 'Giờ dạy', 'required|trim|min_length[3]|max_length[5]');
            $this->form_validation->set_rules('txtDiachi', 'Địa chỉ', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s không được bỏ trống!');
            $this->form_validation->set_message('min_length', '%s ,Độ dày tối thiểu không hợp lệ!');
            $this->form_validation->set_message('max_length', '%s ,Độ dày tối đa không hợp lệ!');
            
            if( $this->form_validation->run() ){
                $ld_id       = $this->uri->rsegment('3');
                $image          = $this->upImage();
                $ld_tieude       = $this->input->post('txtTieude');
				$ld_mon       = $this->input->post('txtMon');
                $ld_soluong     = $this->input->post('txtSoluong');
                $ld_buoiday      = $this->input->post('txtBuoi');
                $ld_thoigian   = $this->input->post('txtGio');
				$ld_mota_diadiem      = $this->input->post('txtDiachi');
                $ld_yeucau   = $this->input->post('description');
                $ld_hinhanh     = empty($image['file_name']) 
                                  ? 'img/no_img.jpg' 
                                  : 'img/ld_img/'.$image['file_name'];

                $where          = array('ld_id' => $ld_id);
                $lopday          = $this->m_lop->getlopInfo($where);
                //var_dump($lopday);
                //xoa file cu
                if(!empty($image) && $lopday->ld_hinhanh != "img/no_img.jpg")
                    @unlink("./".$lopday->ld_hinhanh);

                $ld_hinhanh = empty($image['file_name']) ? $lopday->ld_hinhanh : 'img/ld_img/'.$image['file_name'];
                $dong       = array(  "ld_tieude"        => $ld_tieude,
                                      "ld_mon"     => $ld_mon,
                                      "ld_soluong"      => $ld_soluong,
                                      "ld_buoiday"    => $ld_buoiday,
                                      "ld_thoigian"      => $ld_thoigian,
                                      "ld_mota_diadiem"    => $ld_mota_diadiem,
                                      "ld_yeucau"      => $ld_yeucau,
                                      "ld_hinhanh"      => $ld_hinhanh,
                    
                                    );
                $this->m_lop->updatelop($ld_id, $dong);
                if(!empty($image))
                    $this->session->set_flashdata('message', 'Update thành công');
                
            }
        }

        $data=array('title'=>'Cập nhật thông tin');
        $this->load->view("/admin/v_header");
        $this->load->view("/admin/qllop/chuacogiasuedit");
        $this->load->view("/admin/v_footer");
    }
public function ktkheditInfo_ld(){
        if( $this->input->post('submit') ){
            
            $this->form_validation->set_rules('txtTieude', 'Tiêu đề', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtMon', 'Môn', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtSoluong', 'Số lượng học viên', 'required|min_length[1]|max_length[2]');
			$this->form_validation->set_rules('txtBuoi', 'Buổi dạy', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtGio', 'Giờ dạy', 'required|trim|min_length[3]|max_length[5]');
            $this->form_validation->set_rules('txtDiachi', 'Địa chỉ', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s không được bỏ trống!');
            $this->form_validation->set_message('min_length', '%s ,Độ dày tối thiểu không hợp lệ!');
            $this->form_validation->set_message('max_length', '%s ,Độ dày tối đa không hợp lệ!');
            
            if( $this->form_validation->run() ){
                $ld_id       = $this->uri->rsegment('3');
                $image          = $this->upImage();
                $ld_tieude       = $this->input->post('txtTieude');
				$ld_mon       = $this->input->post('txtMon');
                $ld_soluong     = $this->input->post('txtSoluong');
                $ld_buoiday      = $this->input->post('txtBuoi');
                $ld_thoigian   = $this->input->post('txtGio');
				$ld_mota_diadiem      = $this->input->post('txtDiachi');
                $ld_yeucau   = $this->input->post('description');
                $ld_hinhanh     = empty($image['file_name']) 
                                  ? 'img/no_img.jpg' 
                                  : 'img/ld_img/'.$image['file_name'];

                $where          = array('ld_id' => $ld_id);
                $lopday          = $this->m_lop->getlopInfo($where);
                //var_dump($lopday);
                //xoa file cu
                if(!empty($image) && $lopday->ld_hinhanh != "img/no_img.jpg")
                    @unlink("./".$lopday->ld_hinhanh);

                $ld_hinhanh = empty($image['file_name']) ? $lopday->ld_hinhanh : 'img/ld_img/'.$image['file_name'];
                $dong       = array(  "ld_tieude"        => $ld_tieude,
                                      "ld_mon"     => $ld_mon,
                                      "ld_soluong"      => $ld_soluong,
                                      "ld_buoiday"    => $ld_buoiday,
                                      "ld_thoigian"      => $ld_thoigian,
                                      "ld_mota_diadiem"    => $ld_mota_diadiem,
                                      "ld_yeucau"      => $ld_yeucau,
                                      "ld_hinhanh"      => $ld_hinhanh,
                    
                                    );
                $this->m_lop->updatelop($ld_id, $dong);
                if(!empty($image))
                    $this->session->set_flashdata('message', 'Update thành công');
                
            }
        }

        $data=array('title'=>'Cập nhật thông tin');
        $this->load->view("/admin/v_header");
        $this->load->view("/admin/qllop/ketthuckhoahocedit");
        $this->load->view("/admin/v_footer");
    }
       public function active_ld(){
      $gs_id = $this->uri->segment(3);
      $sql = "select * from giasu a, taikhoan b where a.gs_tk_id = b.tk_id and gs_tk_id = $gs_id";
      $user = $this->db->query($sql)->row();
      $sql = "UPDATE giasu SET gs_trangthai=1 WHERE gs_tk_id = $gs_id";
      $this->db->query($sql);
      $sql = "DELETE FROM thongbao WHERE tb_tk_id = $gs_id";
      $this->db->query($sql);
      $this->session->set_flashdata('a_message', 'Active tài khoản '.$user->tk_email.' thành công');
        redirect('qlgiasu/stopactive','refresh');
    }
  
 
}
?>