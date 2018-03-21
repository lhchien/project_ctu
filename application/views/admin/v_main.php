<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="vn">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php if(isset($title)) echo $title; else echo "Tiểu luận - Gia sư online"; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/StyleMain.css" rel="stylesheet"> 
    <!--google map-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="all" />  
   
</head>

<script>
	$(document).ready(function(){
		setInterval(function(){
		  $(".fade").fadeOut('slow')
			$('.fade').fadeOut('slow');},5000);
	});
</script>
</head>
<body>

<div class="container-fluid text-center">
<!-- 	<div class="row">
		 <div class="banner">
			<img src="<?php echo base_url(); ?>img/banner2.jpg" height="110" width="100%">	
		</div>   
 	</div>	-->


	 <div id="header" class="row">
		 <div class="col-md-8">
		 </div>
	 	<div class="col-md-4">
			<table border="0px" width="100%" height="60px" >
				
		<?php	
					
						$sql = "SELECT * FROM nhansu n, taikhoan t  WHERE n.ns_tk_id = t.tk_id AND t.tk_id =".$this->session->userdata('a_login')->tk_id;
						$nhansu = $this->db->query($sql)->row(); ?>

				<tr>
					<td width="40%" align="center">
														  
					 <img height="100" width="100" src="<?php echo isset($nhansu) ? base_url().$nhansu->ns_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive"> 
					</td>
					<td><b>Welcome to Administration System</b>
						<h5><a href="<?php echo base_url();?>qlnhansu/detail_ns/<?php echo $nhansu->ns_tk_id ?>"><?php  echo($this->session->userdata('a_login')->tk_email); ?></a></h5>
						<a target="_blank" href="<?php echo base_url(); ?>qlnhansu/detail_ns/<?php echo($this->session->userdata('a_login')->tk_id) ?>">
							<button type="button" class="btn btn-xs btn-info" value="PROFILE"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;PROFILE </button>
						</a>	
								
						<a href="<?php echo base_url(); ?>admin/logout">
								<button type="button" class="btn btn-xs btn-info" value="PROFILE"><span class="glyphicon glyphicon-log-out"></span>&nbsp;LOGOUT</button>
							</a>
					</td>
				<tr>
			</table>
			</div>
			
	</div><!--End Row-->
		
	<div class="row">
		
		<div class="col-md-2"> 
		</div>
				
					
				
		<div class="col-md-8">
			
			<h2 class="text-info">Menu Quản Trị Hệ Thống Website</h2>
		
			<table class="table table-striped table-bordered">
				
				<tr>
					<td>
						<a target="_blank" href="<?php echo base_url(); ?>index.php" >
						<img src="<?php echo base_url(); ?>img/trang_chu.png" height="80" width="80" style="border:none; cursor:hand" >
						</a>
						
					</td>
					<td>
						<a href="<?php echo base_url(); ?>qlnhansu/active">
						<img src="<?php echo base_url(); ?>img/Nhan_vien.png" height="80" width="80" style="border:none; cursor:hand" >
						</a>
						
					</td>
					<td>
						<a href="<?php echo base_url(); ?>qlgiasu/active">
						<img src="<?php echo base_url(); ?>img/gia_su.jpg" height="80" width="80" style="border:none; cursor:hand" />
						</a>
					</td>
					
				</tr>
				<tr>
					<td><div align="center"><span class="header"><a target="_blank" href="<?php echo base_url(); ?>index.php">Trang chủ</a></span></div></td>
					<td><div align="center"><span class="header"><a href="<?php echo base_url(); ?>qlnhansu/active">Nhân viên</a></span></div></td>
					<td><div align="center"><span class="header"><a href="<?php echo base_url(); ?>qlgiasu/active">Gia sư</a></span></div></td>
					
				</tr>
				
				<tr>
					
					
					<td>
						<a href="<?php echo base_url(); ?>qllopday/active">
						<img src="<?php echo base_url(); ?>img/lop.jpg" height="80" width="80" style="border:none; cursor:hand" >
						</a>
					</td>
					<td>
						<a href="<?php echo base_url(); ?>qlphuhuynh/active">
						<img src="<?php echo base_url(); ?>img/phu_huynh.png" height="80" width="80" style="border:none; cursor:hand" >
						</a>
					</td>
					<td>
						<a href="<?php echo base_url(); ?>qlpheduyet/pheduyetgiasu">
						<img src="<?php echo base_url(); ?>img/Don_tu.png" height="80" width="80" style="border:none; cursor:hand" />
						</a>
					</td>
				</tr>
				<tr>
									
					<td><div align="center"><span class="header"><a href="<?php echo base_url(); ?>qllopday/active">Lớp </a></span></div></td>
					<td><div align="center"><span class="header"><a href="<?php echo base_url(); ?>qlphuhuynh/active">Phụ huynh </a></span></div></td>
					<td><div align="center"><span class="header"><a href="<?php echo base_url(); ?>qlpheduyet/pheduyetgiasu">Phê Duyệt</a></span></div></td>
					
				</tr>
				<tr>
				
					<td>
						<a href="<?php echo base_url(); ?>qllienhe/lienhe_gs">
						<img src="<?php echo base_url(); ?>img/lienhe.jpg" height="80" width="80" style="border:none; cursor:hand" />
						</a>
					</td>
					<td>
						<a href="<?php echo base_url(); ?>qlthongke/thongke_gs">
						<img src="<?php echo base_url(); ?>img/Ic.png" height="80" width="80" style="border:none; cursor:hand" >
						</a>
					</td>
					<td>
						<a href="<?php echo base_url(); ?>admin/setting">
						<img src="<?php echo base_url(); ?>img/caidat-icon.png" height="80" width="80" style="border:none; cursor:hand" />
						</a>
					</td>
					

				</tr>
				<tr>
					 <td><div align="center"><span class="header"><a href="<?php echo base_url(); ?>qllienhe/lienhe_gs">Liên hệ</a></span></div></td>
					<td><div align="center"><span class="header"><a href="<?php echo base_url(); ?>qlthongke/thongke_gs">Thống kê</a></span></div></td>
					
					<td><div align="center"><span class="header"><a href="admin/setting">Cài đặt</a></span></div></td>
					
				
				</tr>

				
			</table>
	
		</div>
		<div class="col-md-2"> 
	</div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<!-- ckeditor -->
<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>

<!-- captcha google -->
<script src='https://www.google.com/recaptcha/api.js'></script>

</body>
</html>