<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Qlgiasu extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_giasu');
        $this->load->model('m_lienhe');

	}


     public function active(){
         
        $offset=($this->uri->segment(2)=="active" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');  
        if($this->input->post("key")!= null)    	
            $sql = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id AND gs_trangthai=1 and gs_hoten like '%".$this->input->post("key")."%' ORDER BY gs_tk_id desc LIMIT $offset, $limit";
        else
            $sql = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id AND gs_trangthai=1 ORDER BY gs_tk_id desc LIMIT $offset, $limit";
        $giasu = $this->db->query($sql)->result(); 
		//$this->db->where($where);
		//$giasu = $this->db->get('giasu')->row(); //var_dump($giasu);
		$data = array('giasu' => $giasu,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlgiasu/active", $data);
		$this->load->view("/admin/v_footer");
    }
      public function stopactive(){
       
            $offset=($this->uri->segment(2)=="stopactive" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
            $limit= $this->m_admin->getPageSetting('admin');        
           if($this->input->post("key")!= null)    	
            $sql = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id AND gs_trangthai=2 and gs_hoten like '%".$this->input->post("key")."%' ORDER BY gs_tk_id desc LIMIT $offset, $limit";
        else
            $sql = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id AND gs_trangthai=2 ORDER BY gs_tk_id desc LIMIT $offset, $limit";
         $giasu = $this->db->query($sql)->result(); 
 
		$data = array('giasu' => $giasu,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlgiasu/stopactive", $data);
		$this->load->view("/admin/v_footer");
    }

	public function detail_gs(){
		//echo site_url(); echo "<br/>".base_url(); echo "<br/>".$this->uri->segment(3);
		$gs_id = $this->uri->segment(3);
		// $sql = "select * from giasu a left join daylop b on a.gs_tk_id = b.dl_gs_id where a.gs_tk_id = $gs_id";
        $sql = "SELECT * FROM giasu a, daylop b, taikhoan c WHERE  c.tk_id = a.gs_tk_id AND a.gs_tk_id = b.dl_gs_id AND  a.gs_tk_id = $gs_id ";
        $giasu = $this->db->query($sql)->row();
		$data = array('giasu' => $giasu);
		
		$this->load->view("/admin/qlgiasu/detail", $data);
		$this->load->view("/admin/v_footer");
       
	}
	

    public function deleteactive_gs() {
        $offset=($this->uri->segment(2)=="active" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id AND gs_trangthai=1 ORDER BY gs_tk_id desc LIMIT $offset, $limit";
        $giasu = $this->db->query($sql)->result(); 
		//$this->db->where($where);
		//$giasu = $this->db->get('giasu')->row(); //var_dump($giasu);
		

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
            redirect('qlgiasu/active','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qlgiasu/active", $data);
      $this->load->view("/admin/v_footer");
    
    }

    public function deletestopactive_gs() {
        $offset=($this->uri->segment(2)=="stopactive" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id AND gs_trangthai=2 ORDER BY gs_tk_id desc LIMIT $offset, $limit";
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
            redirect('qlgiasu/stopactive','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qlgiasu/stopactive", $data);
      $this->load->view("/admin/v_footer");
    
    }

      public function upImage(){

        if($this->input->post('submit')){
            //Cau hinh cac tham so
            $config = array();
            $config['upload_path']   = './img/gs_img';
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
                    $config['source_image'] = './img/gs_img/'.$data['file_name'];
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
	
	public function editInfo_gs(){
        if( $this->input->post('submit') ){
            
            $this->form_validation->set_rules('txtName', 'Họ tên', 'required|trim|xss_clean');
            $this->form_validation->set_rules('optSex', 'Giới tính', 'required');
            $this->form_validation->set_rules('slNamSinh', 'Năm sinh', 'required');
            $this->form_validation->set_rules('txtPhone', 'Điện thoại', 'required|min_length[7]|max_length[11]');
            $this->form_validation->set_rules('slTrinhDo', 'Trình độ', 'required');
            $this->form_validation->set_rules('txtChuyenNganh', 'Chuyên ngành', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s không được bỏ trống!');
            $this->form_validation->set_message('min_length', '%s không hợp lệ, tối thiểu 7 số!');
            $this->form_validation->set_message('max_length', '%s không hợp lệ, tối đa 11 số!');
            
            if( $this->form_validation->run() ){
                $gs_tk_id       = $this->uri->rsegment('3');
                $image          = $this->upImage();
                $gs_hoten       = $this->input->post('txtName');
                $gs_gioitinh    = $this->input->post('optSex');
                $gs_namsinh     = $this->input->post('slNamSinh');
                $gs_diachi      = $this->input->post('txtAddress');
                $gs_dienthoai   = $this->input->post('txtPhone');
                $gs_gioithieu   = $this->input->post('description');
                $gs_trinhdo     = $this->input->post('slTrinhDo');
                $gs_chuyennganh = $this->input->post('txtChuyenNganh');
                $gs_congviec    = $this->input->post('txtCongViec');
                $gs_hinhanh     = empty($image['file_name']) 
                                  ? 'img/no_img.jpg' 
                                  : 'img/gs_img/'.$image['file_name'];

                $where          = array('gs_tk_id' => $gs_tk_id);
                $giasu          = $this->m_giasu->getGiaSuInfo($where);
                //xoa file cu
                if(!empty($image) && $giasu->gs_hinhanh!='img/no_img.jpg')
                    @unlink("./".$giasu->gs_hinhanh);

                $gs_hinhanh = empty($image['file_name']) ? $giasu->gs_hinhanh : 'img/gs_img/'.$image['file_name'];
                $dong       = array(  "gs_hoten"        => $gs_hoten,
                                      "gs_gioitinh"     => $gs_gioitinh,
                                      "gs_namsinh"      => $gs_namsinh,
                                      "gs_dienthoai"    => $gs_dienthoai,
                                      "gs_hinhanh"      => $gs_hinhanh,
                                      "gs_gioithieu"    => $gs_gioithieu,
                                      "gs_trinhdo"      => $gs_trinhdo,
                                      "gs_chuyennganh"  => $gs_chuyennganh,
                                      "gs_congviec"     => $gs_congviec,
                                    );
                $this->m_giasu->updateGiaSu($gs_tk_id, $dong);
                if(!empty($image))
                    $this->session->set_flashdata('message', 'Update thành công.');
                
            }
              $this->session->set_flashdata('message', 'Cập nhật thông tin thành công.');
        }

        $data=array('title'=>'Cập nhật thông tin');
        $this->load->view("/admin/v_header");
        $this->load->view("/admin/qlgiasu/edit");
        $this->load->view("/admin/v_footer");
    }

    public function active_gs(){
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
    public function block_gs(){
      $gs_id = $this->uri->segment(3);
      $sql = "select * from giasu a, taikhoan b where a.gs_tk_id = b.tk_id and gs_tk_id = $gs_id";
      $user = $this->db->query($sql)->row();
      $sql = "UPDATE giasu SET gs_trangthai=2 WHERE gs_tk_id = $gs_id";
      $this->db->query($sql);
      $this->session->set_flashdata('a_message', 'Block tài khoản '.$user->tk_email.' thành công');
      
        redirect('qlgiasu/active','refresh');
    }


}
?>