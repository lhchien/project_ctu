<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Admin extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
				$this->load->model('m_lienhe');

	}

	public function index($page='v_login'){
		$this->session->set_flashdata('a_message', NULL);
		if(!file_exists('application/views/admin/'.$page.'.php')){
			show_404();
		}
		
		if(!$this->session->userdata('a_login')) {
			$this->load->view("/admin/".$page);
		}
		else{
			$this->load->view("/admin/v_main");
		}
	
	}

	public function login(){

		if($this->input->post("submit")){
			$this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email|trim|xss_clean');
			$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required|xss_clean');

			$this->form_validation->set_message('required', '%s không được bỏ trống!');
			$this->form_validation->set_message('valid_email', '%s không đúng định dạng!');

			if($this->form_validation->run()){
	            $email    = $this->input->post('txtEmail');
	            $password = $this->input->post('txtMatKhau');
	            $password = md5($password);

	            if(!$this->m_admin->checkLogin($email,$password)){
		            $this->session->set_flashdata('a_message','Tài khoản không chính xác!');
		        }
				
		        else{
		        	$where = array('tk_email' => $email, 'tk_matkhau' => $password);
		            $user = $this->m_admin->getAdminInfo($where); //var_dump($user); //die();
		            $this->session->set_userdata('a_login', $user[0]);
				
		            //$this->session->set_flashdata('flash_message', 'Đăng nhập thành công');
		            redirect("admin/index");//chuyen toi trang chu
		        }
				// else {
		        // 	$where = array('tk_email' => $email, 'tk_matkhau' => $password, 'tk_quyen' => -1);
		        //     $user = $this->m_admin->getAdminInfo($where); //var_dump($user); //die();
		        //     $this->session->set_userdata('a_login', $user[0]);
		        //     //$this->session->set_flashdata('flash_message', 'Đăng nhập thành công');
		        //     redirect("admin/index");//chuyen toi trang chu
		        // }
			}

		}//end-if submit
		
		$this->load->view("/admin/v_login");
	}

	/* Kiểm tra đã đăng nhập hay chưa */ 
	public function adminIsLogin(){
	    $user_data = $this->session->userdata('a_login');
	    if(!$user_data)
	        return false;
	    return true;
	}

	/* Phuong thuc dang xuat */
    public function logout(){
        if($this->adminIsLogin()){
           $this->session->unset_userdata('a_login');
        }
        $this->session->unset_userdata('a_login');
        redirect("/admin/index");
    }

    /* Phuong thuc cai dat */
    public function setting(){
    	//var_dump($this->m_admin->getPageSetting('user'));
    	$cd_ma =  $this->uri->segment(3); //var_dump($cd_ma);
    	$setting = $this->m_admin->getSettingInfo(); //var_dump($setting);
    	$data = array('setting' => $setting);

    	if($cd_ma!=NULL){
    		if($this->input->post('txtTrang')==0 || $this->input->post('txtTrang') == NULL){
    			$this->session->set_flashdata('a_message','Số trang nhập vào không hợp lệ!');
    		}
    		else{
    			$dong = array('cd_trang' => $this->input->post('txtTrang'));
	    		$this->m_admin->updateSetting($cd_ma, $dong);
	    		redirect('admin/setting','refresh');
    		}
    		
    	}
    	$this->load->view("/admin/v_header");
        $this->load->view("/admin/qlcaidat/index", $data);
        $this->load->view("/admin/v_footer");
    	
    }

	

}
?>