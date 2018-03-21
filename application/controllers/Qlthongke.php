<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Qlthongke extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
        $this->load->model('m_giasu');
        $this->load->model('m_phuhuynh');
		$this->load->model('m_lop');
		$this->load->model('m_nhansu');
		$this->load->model('m_lienhe');
        
	}
 

 //////////// Thống kê gia sư
         
	    public function thongke_gs(){
				/////Tổng số lượng gia sư: 
		$sql = "SELECT * FROM giasu ";
        $num = $this->db->query($sql)->result();
        count($num);
								
								///// Số lượng tài khoản gia sư đăng ký

		$sql1 = "SELECT * FROM giasu a WHERE gs_trangthai = 0";
        $num1 = $this->db->query($sql1)->result();
        count($num1);
					
		
								////// Số lượng gia sư đang hoạt động
		$sql2 = "SELECT * FROM giasu a WHERE gs_trangthai = 1";
        $num2 = $this->db->query($sql2)->result();
        count($num2);

		//////// Số lượng gia sư đang dạy
		$sql3 =  "SELECT * FROM giasu a, dangky b WHERE a.gs_tk_id = b.dk_gs_id AND b.dk_trangthai= 1 ";
        $num3 = $this->db->query($sql3)->result();
        count($num3);
		

		


						////////   Số lượng gia sư chưa có lớp dạy:                         
		$sql4 = "SELECT * FROM giasu a left join dangky b ON a.gs_tk_id = b.dk_gs_id AND a.gs_trangthai=1 AND b.dk_trangthai <> 1 AND b.dk_gs_id NOT IN (select dk_gs_id FROM dangky WHERE dk_trangthai=1)";
        $num4 = $this->db->query($sql4)->result();
        count($num4);

								//////// Số lượng gia sư chưa đăng ký lớp dạy
		$sql6 = "SELECT * FROM giasu  WHERE gs_trangthai=1  AND gs_tk_id NOT IN (select dk_gs_id FROM dangky)";
        $num6 = $this->db->query($sql6)->result();
        count($num6);
					

							//// Số lượng gia sư bị block: 
		$sql5 = "SELECT * FROM giasu a WHERE gs_trangthai = 2";
        $num5 = $this->db->query($sql5)->result();
        count($num5);


		$data = array('num'=>$num,'num1' => $num1,'num2' => $num2,'num3' => $num3,'num4'=>$num4, 'num5'=>$num5, 'num6'=>$num6);

		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlthongke/thongkegiasu" ,$data);
		$this->load->view("/admin/v_footer");

		  }

		  //////////////////////////// Phụ huynh

		  // tổng số phụ huynh
		   public function thongke_ph(){
		$sql = "SELECT * FROM phuhuynh ";
        $num = $this->db->query($sql)->result();
        count($num);

		// số lượng phụ huynh đã duyệt
		$sql2 = "SELECT * FROM phuhuynh WHERE ph_trangthai = 1";
        $num2 = $this->db->query($sql2)->result();
        count($num2);

		///// Số lượng tài khoản phụ huynh đăng ký

		$sql1 = "SELECT * FROM phuhuynh WHERE ph_trangthai = 0";
        $num1 = $this->db->query($sql1)->result();
        count($num1);

		////// Số lượng phụ huynh bị block
		$sql5 = "SELECT * FROM phuhuynh a WHERE ph_trangthai = 2";
        $num5 = $this->db->query($sql5)->result();
        count($num5);

		/// số lượng phụ huynh đang học

		$sql3 ="SELECT * FROM phuhuynh a, lopday b, dangky c WHERE a.ph_tk_id = b.ph_tk_id AND b.ld_id = c.dk_ld_id AND c.dk_trangthai = 1 GROUP BY c.dk_trangthai ";  
		$num3 = $this->db->query($sql3)->result();
		count($num3);

		/// số lượng phụ huynh chưa đăng ký lớp dạy

			$sql6 = "SELECT * FROM phuhuynh a, lopday b  WHERE a.ph_tk_id = b.ph_tk_id AND a.ph_trangthai=1  AND a.ph_tk_id GROUP BY a.ph_tk_id NOT IN (select dk_gs_id FROM dangky)";
        $num6 = $this->db->query($sql6)->result();
        count($num6);
					

		$data = array('num' => $num, 'num1' => $num1, 'num2' => $num2, 'num5' => $num5, 'num3' => $num3, 'num6' => $num6);
		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlthongke/thongkephuhuynh" ,$data);
		$this->load->view("/admin/v_footer");
		   }







		   	///////////////////// Lớp
  
	  public function thongke_lop(){
				/////Tổng số lượng gia sư: 
		$sql = "SELECT * FROM lopday ";
        $num = $this->db->query($sql)->result();
        count($num);
								
								///// Số lượng lớp chưa duyệt

		$sql1 = "SELECT * FROM lopday WHERE ld_trangthai = 0";
        $num1 = $this->db->query($sql1)->result();
        count($num1);
					
		
								////// Số lượng lớp đả duyệt
		$sql2 = "SELECT * FROM lopday WHERE ld_trangthai = 1";
        $num2 = $this->db->query($sql2)->result();
        count($num2);

		//////// Số lượng lớp đang dạy
		$sql3 =  "SELECT * FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND b.dk_trangthai= 1 ";
        $num3 = $this->db->query($sql3)->result();
        count($num3);
		

		


						////////   Số lượng lơp có gia sư đăng ký nhưng phụ huynh chưa duyệt:                         
		$sql4 = "SELECT * FROM giasu a, dangky b WHERE a.gs_tk_id = b.dk_gs_id AND a.gs_trangthai=1 AND b.dk_trangthai = 0 GROUP BY b.dk_ld_id";
        $num4 = $this->db->query($sql4)->result();
        count($num4);

								//////// Số lượng lớp chưa có gia sư đăng ký
		$sql6 = "SELECT * FROM lopday  WHERE ld_trangthai=1  AND ld_id NOT IN (select dk_ld_id FROM dangky)";
        $num6 = $this->db->query($sql6)->result();
        count($num6);
					

							//// Số lượng gia sư bị block: 
		$sql5 = "SELECT * FROM giasu a WHERE gs_trangthai = 2";
        $num5 = $this->db->query($sql5)->result();
        count($num5);


		$data = array('num'=>$num,'num1' => $num1,'num2' => $num2,'num3' => $num3,'num4'=>$num4, 'num5'=>$num5, 'num6'=>$num6);



		$this->load->view("/admin/v_header");
		$this->load->view("/admin/qlthongke/thongkelop" ,$data);
		$this->load->view("/admin/v_footer");




  }
}
?>
