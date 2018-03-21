<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="vn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản trị</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script language="javascript" src="https://freetuts.net/public/cdn/jquery/jquery-2.2.0.min.js"></script>
    <script language="javascript" src="https://freetuts.net/public/cdn/bootstrap/v3.3.6/js/bootstrap.min.js"></script>
<!--google map-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
	  <script src="<?php echo base_url(); ?>chartjs/Chart.js"></script>
    <script src="<?php echo base_url(); ?>chartjs/Chart.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="all" />  
</head>

<style type="text/css">
.table > thead{
	font-weight: bold;
	color: #fff;
	background: #000;
}
</style>
<?php if(!isset($_SESSION['a_login'])) redirect("admin/index"); ?>
<body>
<nav class="navbar navbar-inverse">
	<div class="navbar-collapse collapse" id="menu">
		<ul class="nav navbar-nav">
		
			<li><a href="<?php echo base_url(); ?>admin/index"><span class="glyphicon glyphicon-home" style="margin-left: -15px;"></span></a></li>
		

			<li class="<?php echo ($this->uri->rsegment('1')=='qlnhansu') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>qlnhansu/active"><strong>QL.Nhân viên</strong></a></li>
			<!--<li>
				<a data-toggle="dropdown" href="<?php echo base_url(); ?>qlnhansu/active">QL.Gia sư <span class="caret"></span></a>
				<ul class="dropdown-menu">
					
					<li><a href="<?php echo base_url(); ?>qlnhansu/active">Đang hoạt động</a></li>
					<li><a href="<?php echo base_url(); ?>qlnhansu/stopactive">Ngừng hoạt động</a></li>	
				</ul>
			
			<li>-->
			<li>
				<a data-toggle="dropdown" href="<?php echo base_url(); ?>qlgiasu/index"><strong>QL.Gia sư</strong> <span class="caret"></span></a>
				<ul class="dropdown-menu">
					
					<li><a href="<?php echo base_url(); ?>qlgiasu/active">Đang hoạt động</a></li>
					<li><a href="<?php echo base_url(); ?>qlgiasu/stopactive">Ngừng hoạt động</a></li>
				</ul>
			</li>
			
			<li>
				<a data-toggle="dropdown" href="<?php echo base_url(); ?>qlphuhuynh/index"><strong>QL.Phu huynh</strong> <span class="caret"></span></a>
				<ul class="dropdown-menu">
					
					<li><a href="<?php echo base_url(); ?>qlphuhuynh/active">Đang hoạt động</a></li>
					<li><a href="<?php echo base_url(); ?>qlphuhuynh/stopactive">Ngừng hoạt động</a></li>
				</ul>
			</li>	
			
			<li>
				<a data-toggle="dropdown" href="<?php echo base_url(); ?>qllop/index"><strong>QL.Lớp</strong><span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url(); ?>qllopday/active">Đang hoạt động</a></li>
					<li><a href="<?php echo base_url(); ?>qllopday/Chuacogiasu">Lớp chưa có gia sư</a></li>
					<li><a href="<?php echo base_url(); ?>qllopday/ketthuckhoahoc_ld"> Lớp kết thúc khóa học</a></li>
				</ul>
			</li>	
			<li>
				<a data-toggle="dropdown" href="<?php echo base_url(); ?>"><strong>QL.Đăng ký</strong><span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url(); ?>qlpheduyet/pheduyetgiasu">Gia sư</a></li>
					<li><a href="<?php echo base_url(); ?>qlpheduyet/pheduyetphuhuynh">Phụ huynh</a></li>
					<li><a href="<?php echo base_url(); ?>qldangkylop/dangkylop_dk">Mở lớp</a></li>
				</ul>
			</li>
				
				<?php if($this->session->userdata('a_login')->tk_quyen==1){ ?>
			<li>
				<a data-toggle="dropdown" href="<?php echo base_url(); ?>"><strong>QL.Liên hệ</strong>
				
				<?php
				$trangthai = array(  "lh_trangthai"    => 1);
				$dslienhe = $this->m_lienhe->getlistlienhe($trangthai);
				if(count($dslienhe) >0 ) { ?> 

			

                <i class="glyphicon glyphicon-envelope" title="Bạn có tin nhắn"></i>   <span class="label label-success">New</span>
                  
              
		  
		   
		   <?php } else { ?>

                 
              
		   <?php } ?>

				
				
				
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url(); ?>qllienhe/lienhe_gs">Gia sư</a></li>
					<li><a href="<?php echo base_url(); ?>qllienhe/lienhe_ph">Phụ huynh</a></li>
				</ul>
			</li>
  			<?php } ?>
			
	        <li>
				<a data-toggle="dropdown" href="<?php echo base_url(); ?>qlthongke/index"><strong>QL.Thống kê</strong> <span class="caret"></span></a>
				<ul class="dropdown-menu">
					
					<li><a href="<?php echo base_url(); ?>qlthongke/thongke_gs">Gia sư</a></li>
					<li><a href="<?php echo base_url(); ?>qlthongke/thongke_ph">Phụ huynh</a></li>
					<li><a href="<?php echo base_url(); ?>qlthongke/thongke_lop">Lớp</a></li>
				</ul>
			</li>

	<?php if($this->session->userdata('a_login')->tk_quyen==1){ ?>
			<li class="<?php echo ($this->uri->rsegment('1')=='qlcaidat') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>admin/setting"><strong>Cài đặt</strong></a></li>
			
				<?php }
	 	 ?>
		  
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
			<?php	$sql = "SELECT * FROM nhansu n, taikhoan t WHERE n.ns_tk_id = t.tk_id AND t.tk_id =".$this->session->userdata('a_login')->tk_id;
						$nhansu = $this->db->query($sql)->row(); ?>                                             
				<a data-toggle="dropdown" href=""><span class="glyphicon glyphicon-user"></span>&nbsp;<strong> Xin chào, <?php  echo ($nhansu->ns_hoten =="")?"Hảy cập nhật tên của bạn": $nhansu->ns_hoten ;?> <span class="caret"></strong></span></a>
				<ul class="dropdown-menu">
					
					<li><a href="<?php echo base_url(); ?>qlnhansu/detail_ns/<?php echo $nhansu->ns_tk_id ?>"><span class="glyphicon glyphicon-user"></span>&nbsp; Thông tin</a></li>
					<li><a href="<?php echo base_url(); ?>qlnhansu/editInfo_ns/<?php echo $nhansu->ns_tk_id ?>"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Cập nhật thông tin</a></li>
					<li><a href="<?php echo base_url(); ?>qlnhansu/changepass_ns/<?php echo $nhansu->ns_tk_id ?>"><span class="glyphicon glyphicon-lock"></span>&nbsp; Đổi mật khẩu</a></li>
					<div class="divider"></div>
					<li><a href="<?php echo base_url(); ?>admin/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Thoát</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>