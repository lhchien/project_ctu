<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Qlnhansu extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_nhansu');
			$this->load->model('m_lienhe');

	}

	 public function active(){
         
        $offset=($this->uri->segment(2)=="active" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM taikhoan t, nhansu n WHERE t.tk_id=n.ns_tk_id AND ns_trangthai=1 ORDER BY t.tk_quyen desc LIMIT $offset, $limit";
        $nhansu = $this->db->query($sql)->result(); 
		$data = array('nhansu' => $nhansu,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlnhansu/active", $data);
		$this->load->view("/admin/v_footer");
    }
	  public function stopactive(){
         
        $offset=($this->uri->segment(2)=="stopactive" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;  
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM taikhoan t, nhansu n WHERE t.tk_id=n.ns_tk_id AND ns_trangthai=2 ORDER BY ns_tk_id desc LIMIT $offset, $limit";
        $nhansu = $this->db->query($sql)->result(); 
		$data = array('nhansu' => $nhansu,'limit'=> $limit,'offset'=>$offset);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlnhansu/active", $data);
		$this->load->view("/admin/v_footer");
    }

		public function detail_ns(){
        $ns_id = $this->uri->segment(3);

		$sql = "select * from nhansu a left join taikhoan b on a.ns_tk_id = b.tk_id where b.tk_id = $ns_id";
        $nhansu = $this->db->query($sql)->row();
		$data = array('nhansu' => $nhansu);		
		$this->load->view("/admin/qlnhansu/detail", $data);
		$this->load->view("/admin/v_footer");
	}

		
    public function delete_ns() {
        $offset=($this->uri->segment(2)=="active" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
        $limit= $this->m_admin->getPageSetting('admin');      	
        $sql = "SELECT * FROM taikhoan t, nhansu n WHERE t.tk_id=n.ns_tk_id AND ns_trangthai=1 ORDER BY ns_tk_id desc LIMIT $offset, $limit";
        $nhansu = $this->db->query($sql)->result(); 
	
		

      $ns_tk_id =  $this->uri->segment(3);
      $data = array('nhansu' => $nhansu,
              'ns_tk_id' => $ns_tk_id,
              'confirm' => 'yes','limit'=> $limit,'offset'=>$offset);
      
      if($this->input->post("submit")){
        //xoa hinh
        $where = array('ns_tk_id' => $ns_tk_id);
        $this->db->where($where);
            $nhansu = $this->db->get("nhansu")->row(); //var_dump($nhansu);
            if($nhansu->ns_hinhanh!='img/no_img.jpg')
                @unlink("./".$giasu->ns_hinhanh);
        
        //xoa nhansu và xoa taikhoan
            $query = $this->db->query("delete from nhansu where ns_tk_id = $ns_tk_id");
            
            $this->db->delete('taikhoan', array('tk_id' => $ns_tk_id));
            redirect('qlnhansu/active','refresh');
      }
      
      $this->load->view("/admin/v_header");
      $this->load->view("/admin/qlnhansu/active", $data);
      $this->load->view("/admin/v_footer");
    
    }




    public function upImage(){

        if($this->input->post('submit')){
            //Cau hinh cac tham so
            $config = array();
            $config['upload_path']   = './img/ns_img';
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
                    $config['source_image'] = './img/ns_img/'.$data['file_name'];
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
	
	public function editInfo_ns(){
        if( $this->input->post('submit') ){
            
            $this->form_validation->set_rules('txtName', 'Họ tên', 'required|trim|xss_clean');
            $this->form_validation->set_rules('optSex', 'Giới tính', 'required');
            $this->form_validation->set_rules('txtPhone', 'Điện thoại', 'required|min_length[7]|max_length[11]|integer');
            $this->form_validation->set_rules('txtDiaChi', 'Địa chỉ', 'required|trim|xss_clean');
        

            $this->form_validation->set_message('required', '%s không được bỏ trống!');
            $this->form_validation->set_message('min_length', '%s không hợp lệ, tối thiểu 7 số!');
            $this->form_validation->set_message('max_length', '%s không hợp lệ, tối đa 11 số!');
            
		if(!$this->session->flashdata('a_message'))
            if( $this->form_validation->run() ){
                $ns_tk_id       = $this->uri->rsegment('3');
				
                $image          = $this->upImage();
                $ns_hoten       = $this->input->post('txtName');
                $ns_gioitinh    = $this->input->post('optSex');
                $ns_diachi     = $this->input->post('txtDiaChi');
                $ns_dienthoai   = $this->input->post('txtPhone');
                $ns_hinhanh     = empty($image['file_name']) 
                                  ? 'img/no_img.jpg' 
                                  : 'img/ns_img/'.$image['file_name'];

                $where          = array('ns_tk_id' => $ns_tk_id);
                $nhansu          = $this->m_nhansu->getnhansuInfo1($where);

				//echo $ns_hoten; die();
                //xoa file cu
                if(!empty($image) && $nhansu->ns_hinhanh!='img/no_img.jpg')
                    @unlink("./".$nhansu->ns_hinhanh);

                $ns_hinhanh = empty($image['file_name']) ? $nhansu->ns_hinhanh : 'img/ns_img/'.$image['file_name'];
                $dong       = array(  "ns_hoten"        => $ns_hoten,
                                      "ns_gioitinh"     => $ns_gioitinh,
                                      "ns_dienthoai"    => $ns_dienthoai,
                                      "ns_hinhanh"      => $ns_hinhanh,
                                      "ns_diachi"      => $ns_diachi,
                                    );
               $this->m_nhansu->updateNhansu($ns_tk_id, $dong);
           
                  
						 $this->session->set_flashdata('message', 'Cập nhật thông tin thành công');
                
            }
		
        }
		 
        $data=array('title'=>'Cập nhật thông tin');
        $this->load->view("/admin/v_header");
        $this->load->view("/admin/qlnhansu/edit",$data);
        $this->load->view("/admin/v_footer");
    }
    
    public function taotk_ns(){
    	

    	if($this->input->post("submit")){

			$this->form_validation->set_rules('txtEmail', 'Username', 'required|valid_email|trim|xss_clean');
			$this->form_validation->set_rules('txtPassword', 'Password', 'required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('txtImportPassword', 'Nhập lại Password', 'required|matches[txtPassword]|xss_clean');
			$this->form_validation->set_rules('optTKquyen', 'Tài khoản quyền', 'required');

			$this->form_validation->set_message('required', '%s không được bỏ trống!');
			$this->form_validation->set_message('valid_email', '%s không đúng định dạng!');
			$this->form_validation->set_message('min_length', '%s ít nhất 6 ký tự!');
			$this->form_validation->set_message('matches', '%s không trùng khớp!');


			if($this->form_validation->run()){

	            $email    = $this->input->post('txtEmail');
	            $password = $this->input->post('txtPassword');
	            $password = md5($password);
	            $quyen    = $this->input->post('optTKquyen');
	            

	            $where = array('tk_email' => $email);
		        $user  = $this->m_nhansu->getTaiKhoanInfo($where);

		        // if($this->isNotRobot($captcha)){
		        	if(!empty($user)){
		        		$this->session->set_flashdata('message','Tài khoản email này đã tồn tại, hải kiểm tra lại!');
			        }
			        else{
			        	$data = array("tk_email" => $email,
			        				  "tk_matkhau" => $password,
			        				  "tk_quyen" => $quyen,
			        				  "tk_trangthai" => 1);
			        	
						$this->m_nhansu->insertUser1($data);

			        	if($quyen ==1){

			        		$where = array('tk_email' => $email);
				        	$user  = $this->m_nhansu->getTaikhoanInfo1($where);
				        	//var_dump($user);
				        	$dong = array(  "ns_tk_id"        => $user->tk_id,
		                                    "ns_gioitinh"     => -1,
		                                    "ns_hinhanh"      => "img/no_img.jpg",
		                                    "ns_trangthai"    => 1
		                                 );
				        	$this->m_nhansu->insertUser($dong);
							
                           
				            //redirect();
			        	}

			        	if($quyen == -1){

			        		$where = array('tk_email' => $email);
				        	$user  = $this->m_nhansu->getTaikhoanInfo1($where);
				        	//var_dump($user);
				        	$dong = array(  "ns_tk_id"        => $user->tk_id,
		                                    "ns_gioitinh"     => -1,
		                                    "ns_hinhanh"      => "img/no_img.jpg",
		                                    "ns_trangthai"    => 1
		                                 );
				        	$this->m_nhansu->insertUser($dong);
                           
						  
						  
				            //redirect();
			        	}
                          redirect('qlnhansu/active','refresh');
				        	 $this->session->set_flashdata('a_message', 'Tạo tài khoản '.$user->tk_email.' thành công');
			        }
		
		        
			}

		}//end-if submit
		
		
		$data=array('title'=>'Tạo tài khoán quản trị');

		$this->load->view("/admin/v_header", $data);

		$this->load->view("/admin/qlnhansu/taotknhansu");
		$this->load->view("/admin/v_footer");
    }




    public function changepass_ns(){
    	if($this->input->post("submit")){

			$this->form_validation->set_rules('txtOldPass', 'Password hiện tại', 'required|trim|xss_clean');
			$this->form_validation->set_rules('txtNewPass', 'Password mới', 'required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('txtImportPass', 'Nhập lại Password mới', 'required|matches[txtNewPass]|xss_clean');

			$this->form_validation->set_message('required', '%s không được bỏ trống!');
			$this->form_validation->set_message('min_length', '%s ít nhất 6 ký tự!');
			$this->form_validation->set_message('matches', '%s không trùng khớp!');

			if($this->form_validation->run()){

	            $oldpass = $this->input->post('txtOldPass');
	            $newpass = $this->input->post('txtNewPass');
	            $oldpass = md5($oldpass);
	            $newpass = md5($newpass);

	            $where = array('tk_email' => $this->session->userdata('a_login')->tk_email, 'tk_matkhau' => $oldpass);
		        $user  = $this->m_nhansu->getTaiKhoanInfo($where);

		        if(empty($user)){
		        	$this->session->set_flashdata('message','Mật khẩu cũ không trùng khớp !');
		        }
		        else{
		        	$data = array("tk_matkhau" => $newpass);
		        	$this->m_nhansu->changepass($this->session->userdata('a_login')->tk_id, $data);
		        	$this->session->set_flashdata('message', 'Đổi mật khẩu thành công, đăng xuất áp dụng MK mới!');
		        }
			}

		}//end-if submit

		$data=array('title'=>'Đổi mật khẩu');
		$this->load->view("/admin/v_header", $data);
		$this->load->view("/admin/qlnhansu/changepass");
		$this->load->view("/admin/v_footer");
    }



}
?>