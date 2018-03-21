<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Qlphuhuynh extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_phuhuynh');
		$this->load->model('m_admin');
        $this->load->model('m_lop');
        $this->load->model('m_lienhe');

	}


    public function upImage(){

        if($this->input->post('submit')){
            //Cau hinh cac tham so
            $config = array();
            $config['upload_path']   = './img/ph_img';
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
                    $config['source_image'] = './img/ph_img/'.$data['file_name'];
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
	
	public function editInfo_ph(){
        if( $this->input->post('submit') ){
          
            
            $this->form_validation->set_rules('txtName', 'Họ tên', 'required|trim|xss_clean');
            $this->form_validation->set_rules('optSex', 'Giới tính', 'required');
            $this->form_validation->set_rules('txtPhone', 'Điện thoại', 'required|min_length[7]|max_length[11]');
            $this->form_validation->set_rules('txtDiachi', 'Trình độ', 'required');
            $this->form_validation->set_rules('txtTrinhDo', 'Trình độ', 'required');
        

            $this->form_validation->set_message('required', '%s không được bỏ trống!');
            $this->form_validation->set_message('min_length', '%s không hợp lệ, tối thiểu 7 số!');
            $this->form_validation->set_message('max_length', '%s không hợp lệ, tối đa 11 số!');
            
            if( $this->form_validation->run() ){
                $ph_tk_id       = $this->uri->rsegment('3');
                $image          = $this->upImage();
                $ph_hoten       = $this->input->post('txtName');
               
               
                $ph_gioitinh    = $this->input->post('optSex');
                $ph_diadiem     = $this->input->post('txtDiachi');
                $ph_dienthoai   = $this->input->post('txtPhone');
                $ph_trinhdo     = $this->input->post('txtTrinhDo');
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
                                      "ph_diadiem"      => $ph_diadiem,
                                      "ph_dienthoai"    => $ph_dienthoai,
                                      "ph_trinhdo"      => $ph_trinhdo,
                                      "ph_hinhanh"      => $ph_hinhanh,
                                      
                                    );
                $this->m_phuhuynh->updatePhuHuynh($ph_tk_id, $dong);
                if(!empty($image))
                    $this->session->set_flashdata('message', 'Update thành công');
                
            }
             $this->session->set_flashdata('message', 'Cập nhật thành công');
        }

        $data=array('title'=>'Cập nhật thông tin');
        $this->load->view("/admin/v_header");
        $this->load->view("/admin/qlphuhuynh/edit");
        $this->load->view("/admin/v_footer");
    }






	 public function active(){
         
        $offset=($this->uri->segment(2)=="active" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      
        if($this->input->post("key")!= null)    	
            $sql = "SELECT * FROM taikhoan t, phuhuynh p WHERE t.tk_id=p.ph_tk_id AND ph_trangthai=1 and ph_hoten like '%".$this->input->post("key")."%' ORDER BY ph_tk_id desc LIMIT $offset, $limit";
        else
            $sql = "SELECT * FROM taikhoan t, phuhuynh p WHERE t.tk_id=p.ph_tk_id AND ph_trangthai=1 ORDER BY ph_tk_id desc LIMIT $offset, $limit";	
        $phuhuynh = $this->db->query($sql)->result(); 
		$data = array('phuhuynh' => $phuhuynh,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlphuhuynh/active", $data);
		$this->load->view("/admin/v_footer");
    }
	  public function stopactive(){ 
        $offset=($this->uri->segment(2)=="stopactive" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');  
        if($this->input->post("key")!= null)    	
            $sql = "SELECT * FROM taikhoan t, phuhuynh p WHERE t.tk_id=p.ph_tk_id AND ph_trangthai=2 and ph_hoten like '%".$this->input->post("key")."%' ORDER BY ph_tk_id desc LIMIT $offset, $limit";
        else
            $sql = "SELECT * FROM taikhoan t, phuhuynh p WHERE t.tk_id=p.ph_tk_id AND ph_trangthai=2 ORDER BY ph_tk_id desc LIMIT $offset, $limit";	
      
        $phuhuynh = $this->db->query($sql)->result(); 
		$data = array('phuhuynh' => $phuhuynh,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlphuhuynh/stopactive", $data);
		$this->load->view("/admin/v_footer");
    }
	  public function deleteactive_ph() {
        $offset=($this->uri->segment(2)=="active" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM taikhoan t, phuhuynh p WHERE t.tk_id=p.ph_tk_id AND ph_trangthai=1 ORDER BY ph_tk_id desc LIMIT $offset, $limit";
        $phuhuynh = $this->db->query($sql)->result(); 

      $ph_tk_id =  $this->uri->segment(3);
      $data = array('phuhuynh' => $phuhuynh,
              'ph_tk_id' => $ph_tk_id,
              'confirm' => 'yes','limit'=> $limit,'offset'=>$offset);
      
      if($this->input->post("submit")){
        //xoa hinh
        $where = array('ph_tk_id' => $ph_tk_id);
        $this->db->where($where);
            $phuhuynh = $this->db->get("phuhuynh")->row(); //var_dump($phuhuynh);
            if($phuhuynh->ph_hinhanh!='img/no_img.jpg')
                @unlink("./".$phuhuynh->ph_hinhanh);
        
        //xoa phuhuynh và xoa taikhoan
            $query = $this->db->query("delete from phuhuynh where ph_tk_id = $ph_tk_id");
            $this->db->delete('taikhoan', array('tk_id' => $ph_tk_id));
            redirect('qlphuhuynh/active','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qlphuhuynh/active", $data);
      $this->load->view("/admin/v_footer");
    
    }
     public function deletestopactive_ph() {
        $offset=($this->uri->segment(2)=="stopactive" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM taikhoan t, phuhuynh p WHERE t.tk_id=p.ph_tk_id AND ph_trangthai=2 ORDER BY ph_tk_id desc LIMIT $offset, $limit";
        $phuhuynh = $this->db->query($sql)->result(); 

      $ph_tk_id =  $this->uri->segment(3);
      $data = array('phuhuynh' => $phuhuynh,
              'ph_tk_id' => $ph_tk_id,
              'confirm' => 'yes','limit'=> $limit,'offset'=>$offset);
      
      if($this->input->post("submit")){
        //xoa hinh
        $where = array('ph_tk_id' => $ph_tk_id);
        $this->db->where($where);
            $phuhuynh = $this->db->get("phuhuynh")->row(); //var_dump($phuhuynh);
            if($phuhuynh->ph_hinhanh!='img/no_img.jpg')
                @unlink("./".$phuhuynh->ph_hinhanh);
        
        //xoa phuhuynh và xoa taikhoan
            $query = $this->db->query("delete from phuhuynh where ph_tk_id = $ph_tk_id");
            $this->db->delete('taikhoan', array('tk_id' => $ph_tk_id));
            redirect('qlphuhuynh/stopactive','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qlphuhuynh/stopactive", $data);
      $this->load->view("/admin/v_footer");
    
    }
	public function detail_ph(){
        $ph_id = $this->uri->segment(3);
		$sql = "select * from phuhuynh a left join lopday b on a.ph_tk_id = b.ph_tk_id where a.ph_tk_id = $ph_id";
        $phuhuynh = $this->db->query($sql)->row();
		$data = array('phuhuynh' => $phuhuynh);
		
		$this->load->view("/admin/qlphuhuynh/detail", $data);
		$this->load->view("/admin/v_footer");
	}
	

	public function active_ph(){
      $ph_id = $this->uri->segment(3);
      $sql = "select * from phuhuynh a, taikhoan b where a.ph_tk_id = b.tk_id and ph_tk_id = $ph_id";
      $user = $this->db->query($sql)->row();
      $sql = "UPDATE phuhuynh SET ph_trangthai=1 WHERE ph_tk_id = $ph_id";
      $this->db->query($sql);
      $this->session->set_flashdata('a_message', 'Active tài khoản '.$user->tk_email.' thành công');
        redirect('qlphuhuynh/stopactive','refresh');
    }
    public function block_ph(){
      $ph_id = $this->uri->segment(3);
      $sql = "select * from phuhuynh a, taikhoan b where a.ph_tk_id = b.tk_id and ph_tk_id = $ph_id";
      $user = $this->db->query($sql)->row();
      $sql = "UPDATE phuhuynh SET ph_trangthai=2 WHERE ph_tk_id = $ph_id";
      $this->db->query($sql);
      $this->session->set_flashdata('a_message', 'Block tài khoản '.$user->tk_email.' thành công');
      
        redirect('qlphuhuynh/active','refresh');
    }



}
?>
