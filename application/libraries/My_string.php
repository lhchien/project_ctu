<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_string{
// Biến cục bộ CI chỉ nắm trong string
	private $CI;
	
// Hàm được khỏi tạo đầu tiên
// get_instance() thay cho this bên controller
	public function __construct(){
		$this->CI=& get_instance();
	}
	// ký tự mặc định là 10, char mặc định 
	//gắn thêm chuổi ký tự vào mật khẩu, tăng bảo mật
	public function random($leng = 10, $char = FALSE){
		if($char == FALSE) $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrdtuvwxyz0123456789!@#$%^&*()';
		else $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrdtuvwxyz0123456789';
		mt_srand((double)microtime() * 1000000);
		$salt= '';
		for($i=0; $i<$leng; $i++){
			$salt = $salt . substr($s, (mt_rand()%(strlen($s))), 1);
		}
		return $salt;
	}
	public function encryption_password($password = '', $salt = ''){
		return md5($salt.md5($salt.md5($password).$salt).$salt);
	}
}