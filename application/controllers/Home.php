<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Home extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_home');
		$this->load->model('m_giasu');
		$this->load->model('m_phuhuynh');
		$this->load->model('m_admin');
	}

	public function index($page='v_home'){
		//$this->load->helper('url');
		//echo base_url()."<br/>".$page."<br/>/pages/".$page;
		$this->session->set_flashdata('message', NULL);

		if(!file_exists('application/views/pages/'.$page.'.php')){
			show_404();
		}
		
		$data=array('title'=>'Trang chủ');
		$this->load->view("/layout/header",$data);
		$this->load->view("/pages/".$page);
		$this->load->view("/layout/footer");
	}

	public function login(){
		//$this->load->helper('form');
		//$this->load->library('form_validation');

		if($this->input->post("submit")){
			//tao cac tap luat
			$this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email|trim|xss_clean');
			$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required|xss_clean');
			//$this->form_validation->set_rules('submit', 'Đồng ý', 'callback_checkLogin');

			//in thong bao loi
			$this->form_validation->set_message('required', '%s không được bỏ trống!');
			$this->form_validation->set_message('valid_email', '%s không đúng định dạng!');

			if($this->form_validation->run()){
				//lay du lieu tu form post sang
	            $email    = $this->input->post('txtEmail');
	            $password = $this->input->post('txtMatKhau');
	            $password = md5($password);

	            if(!$this->m_home->checkLogin($email,$password)){
		            //trả về thông báo lỗi
		            $this->session->set_flashdata('message','Tài khoản không chính xác, vui lòng nhập lại!');
		            //return false;
		        }
		        else {
		        	$where = array('tk_email' => $email, 'tk_matkhau' => $password);
		        	//lay thong tin thanh vien
		            $user = $this->m_home->getUserInfo($where); //var_dump($user); //die();
		            //luu thong tin thanh vien vao session
		            $this->session->set_userdata('login', $user[0]);
		            //tạo thông báo
		            $this->session->set_flashdata('flash_message', 'Đăng nhập thành công');
		            redirect();//chuyen toi trang chu
		        }
		        //return true;
			}

		}//end-if submit

		$data=array('title'=>'Đăng nhập');
		$this->load->view("/layout/header", $data);
		$this->load->view("/pages/v_login");
		$this->load->view("/layout/footer");
	}

	/* Kiểm tra đã đăng nhập hay chưa */
	public function userIsLogin(){
	    $user_data = $this->session->userdata('login');
	    if(!$user_data)
	        return false;
	    return true;
	}

	/* Phuong thuc dang xuat */
    public function logout(){
        if($this->userIsLogin()){
           $this->session->unset_userdata('login');
        }
        $this->session->unset_userdata('login');
        redirect();
    }

    
    public function isNotRobot($captcha=''){
    	$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
		$site_key    = '6LeqwhYUAAAAAJu9fKPwbIMrYQAfMIJ6a9YC24DG';
		$secret_key  = '6LeqwhYUAAAAAANDmJzpC9hDkG18WYg0W8BnRPQz';

		if(!$captcha){
			//echo '<h2>Hay xac nhan CAPTCHA</h2>';
			return false;
		}
		else{
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=
			6LeawxYUAAAAADJMg3dRCDo1uD5nwi6CDJvMPIhC&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);

			$response = json_decode($response); //var_dump($response);
			if($response->success){
				return false;
			}
			else
				return true;
		}
    }
    
    public function register(){
    	

    	if($this->input->post("submit")){

			$this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email|trim|xss_clean');
			$this->form_validation->set_rules('txtMatKhau', 'Mật khẩu', 'required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('txtXNMatKhau', 'Xác nhận MK', 'required|matches[txtMatKhau]|xss_clean');
			$this->form_validation->set_rules('optLoaiTK', 'Loại tài khoản', 'required');

			$this->form_validation->set_message('required', '%s không được bỏ trống!');
			$this->form_validation->set_message('valid_email', '%s không đúng định dạng!');
			$this->form_validation->set_message('min_length', '%s ít nhất 6 ký tự!');
			$this->form_validation->set_message('matches', '%s không trùng khớp!');


			if($this->form_validation->run()){

	            $email    = $this->input->post('txtEmail');
	            $password = $this->input->post('txtMatKhau');
	            $password = md5($password);
	            $quyen    = $this->input->post('optLoaiTK');
	            $captcha = $_POST['g-recaptcha-response'];

	            $where = array('tk_email' => $email);
		        $user  = $this->m_home->getUserInfo($where);

		        if($this->isNotRobot($captcha)){
		        	if(!empty($user)){
		        		$this->session->set_flashdata('message','Tài khoản email này đã tồn tại, mời kiểm tra lại!');
			        }
			        else{
			        	$data = array("tk_email" => $email,
			        				  "tk_matkhau" => $password,
			        				  "tk_quyen" => $quyen,
			        				  "tk_trangthai" => 1);
			        	$this->m_home->insertUser($data);

			        	if($quyen == 2){

			        		$where = array('tk_email' => $email);
				        	$user  = $this->m_home->getUserInfo1($where);
				        	//var_dump($user);
				        	$dong = array(  "gs_tk_id"        => $user->tk_id,
		                                    "gs_gioitinh"     => -1,
		                                    "gs_hinhanh"      => "img/no_img.jpg",
		                                    "gs_trangthai"    => 0
		                                 );
				        	$this->m_giasu->insertGiaSu($dong);

				        	$this->session->set_flashdata('message', 'Đăng ký thành công');
				            //redirect();
			        	}

			        	if($quyen == 3){

			        		$where = array('tk_email' => $email);
				        	$user  = $this->m_home->getUserInfo1($where);
				        	//var_dump($user);
				        	$dong = array(  "ph_tk_id"        => $user->tk_id,
		                                    "ph_gioitinh"     => -1,
		                                    "ph_hinhanh"      => "img/no_img.jpg",
		                                    "ph_trangthai"    => 0
		                                 );
				        	$this->m_phuhuynh->insertPhuHuynh($dong);

				        	$this->session->set_flashdata('message', 'Đăng ký thành công');
				            //redirect();
			        	}

			        }
		        }
		        else
		        	$this->session->set_flashdata('message', 'Kiểm tra ô xác nhận không phải Robot!');
		        
			}

		}//end-if submit

		$data=array('title'=>'Đăng ký tài khoản');
		$this->load->view("/layout/header", $data);
		$this->load->view("/pages/v_register");
		$this->load->view("/layout/footer");
    }

    public function changePass(){
    	if($this->input->post("submit")){

			$this->form_validation->set_rules('txtMKCu', 'MK cũ', 'required|trim|xss_clean');
			$this->form_validation->set_rules('txtMKMoi', 'MK mới', 'required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('txtXNMatKhau', 'Xác nhận MK', 'required|matches[txtMKMoi]|xss_clean');

			$this->form_validation->set_message('required', '%s không được bỏ trống!');
			$this->form_validation->set_message('min_length', '%s ít nhất 6 ký tự!');
			$this->form_validation->set_message('matches', '%s không trùng khớp!');

			if($this->form_validation->run()){

	            $oldpass = $this->input->post('txtMKCu');
	            $newpass = $this->input->post('txtMKMoi');
	            $oldpass = md5($oldpass);
	            $newpass = md5($newpass);

	            $where = array('tk_email' => $this->session->userdata('login')->tk_email, 'tk_matkhau' => $oldpass);
		        $user  = $this->m_home->getUserInfo($where);

		        if(empty($user)){
		        	$this->session->set_flashdata('message','Mật khẩu cũ không trùng khớp, mời kiểm tra lại!');
		        }
		        else{
		        	$data = array("tk_matkhau" => $newpass);
		        	$this->m_home->changePass($this->session->userdata('login')->tk_id, $data);
		        	$this->session->set_flashdata('message', 'Đổi mật khẩu thành công, đăng xuất áp dụng MK mới!');
		        }
			}

		}//end-if submit

		$data=array('title'=>'Đổi mật khẩu');
		$this->load->view("/layout/header", $data);
		$this->load->view("/pages/v_changepass");
		$this->load->view("/layout/footer");
    }


    //_______________________PHU HUYNH_______________________

    public function changePass_ph(){


    	if($this->input->post("submit")){

    		$this->form_validation->set_rules('txtMKCu', 'MK cũ', 'required|trim|xss_clean');
			$this->form_validation->set_rules('txtMKMoi', 'MK mới', 'required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('txtXNMatKhau', 'Xác nhận MK', 'required|matches[txtMKMoi]|xss_clean');

			$this->form_validation->set_message('required', '%s không được bỏ trống!');
			$this->form_validation->set_message('min_length', '%s ít nhất 6 ký tự!');
			$this->form_validation->set_message('matches', '%s không trùng khớp!');

			if($this->form_validation->run()){

	            $oldpass = $this->input->post('txtMKCu');
	            $newpass = $this->input->post('txtMKMoi');
	            $oldpass = md5($oldpass);
	            $newpass = md5($newpass);

	            $where = array('tk_email' => $this->session->userdata('login')->tk_email, 'tk_matkhau' => $oldpass);
		        $user  = $this->m_home->getUserInfo($where);

		        if(empty($user)){
		        	$this->session->set_flashdata('message','Mật khẩu cũ không trùng khớp, mời kiểm tra lại!');
		        }
		        else{
		        	$data = array("tk_matkhau" => $newpass);
		        	$this->m_home->changePass($this->session->userdata('login')->tk_id, $data);
		        	$this->session->set_flashdata('message', 'Đổi mật khẩu thành công, đăng xuất áp dụng MK mới!');
		        }
			}

    	}

    	$data=array('title'=>'Đổi mật khẩu phụ huynh');
    	$this->load->view("/layout/header", $data);
		$this->load->view("/pages/v_changepass_ph");
		$this->load->view("/layout/footer");



    }
 
}
?>