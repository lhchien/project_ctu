<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php if(isset($title)) echo $title; else echo "Tiểu luận - Gia sư online"; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>css/giasu.css" rel="stylesheet">

    <!--google map-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="all" />  
    
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>"><b><span class="glyphicon glyphicon-home" aria-hidden="true"></span> GIA SƯ ONLINE</b></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="<?php if($this->uri->rsegment('3') == 'v_home' || $this->uri->segment('1') == '') echo 'active';?>">
                        <a href="<?php echo base_url();?>v_home">TRANG CHỦ</a>
                    </li>
                    <li class="<?php if($this->uri->rsegment('3') == 'v_students'|| $this->uri->rsegment('2')=='pagination_ph_phuhuynh') echo 'active';?>">
                        <a href="<?php echo base_url();?>v_students">HỌC VIÊN</a>
                    </li>
                    <li class="<?php if($this->uri->rsegment('3') == 'v_class_need_student' || $this->uri->rsegment('2')=='pagination_ph' || $this->uri->rsegment('2')=='detail_class') echo 'active';?>">
                        <a href="<?php echo base_url();?>v_class_need_student">LỚP HỌC</a>
                    </li>
                    <li class="<?php if($this->uri->rsegment('3') == 'v_tutors' || $this->uri->rsegment('1')=='giasu') echo 'active';?>">
                        <a href="<?php echo base_url();?>v_tutors">GIA SƯ</a>
                    </li>
                    <li class="<?php if($this->uri->rsegment('3') == 'v_contact') echo 'active';?>">
                        <a href="<?php echo base_url();?>v_contact">LIÊN HỆ</a>
                    </li>
                    <!-- <li>
                        <a href="<?php //echo base_url();?>v_exam">VI DU</a>
                    </li> -->
                    
                </ul>
                <?php
                if($this->session->userdata('login')){
                $sql1 = "(SELECT ph_trangthai as trangthai FROM phuhuynh a, taikhoan c WHERE a.ph_tk_id = c.tk_id AND c.tk_id = ".$this->session->userdata('login')->tk_id.") UNION (SELECT gs_trangthai as trangthai FROM giasu b, taikhoan c WHERE b.gs_tk_id = c.tk_id AND c.tk_id = ".$this->session->userdata('login')->tk_id.")";
                //echo $sql1;
                $ph = $this->db->query($sql1)->row();
                //var_dump($ph->trangthai);  
                if(isset($ph->trangthai) && $ph->trangthai == 2)
                { 
                    $sql = "SELECT * FROM lienhe WHERE lh_tk_id =".$this->session->userdata('login')->tk_id;
                    $num = $this->db->query($sql)->num_rows(); //echo $num;

                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a data-toggle="dropdown" href="">
                                <span class="glyphicon glyphicon-user"></span>&nbsp; 
                                <?php 
                                    echo $this->session->userdata('login')->tk_email; 
                                    $sql = "SELECT * FROM thongbao WHERE tb_tk_id = ". $this->session->userdata('login')->tk_id ;
                                    //echo $sql;
                                    $thongbao = $this->db->query($sql)->row();
                                    //var_dump($thongbao->tb_noidung);
                                ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                            <?php if($num == 1){ ?>
                                    <li><a href="#" class = "text-primary" role="button" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-flag"></span>&nbsp; Bạn đã gửi liền hệ đến quản trị rồi <b> Nhấp để </b> xem nội dung </a></li>
                                <?php  }else{ ?>
                                <li><a href="<?php echo base_url(); ?>v_lienhe"><span class="glyphicon glyphicon-flag"></span>&nbsp; <span style="color: red;"> Tài Khoản của bạn đã bị khóa! </br><b> <span class="glyphicon glyphicon-exclamation-sign"></span> Do <?php echo $thongbao->tb_noidung; ?>  </b></span></br><b>Nhấp vào đây </b> để liên hệ quản trị viên  </a></li>
                            <?php } ?>
                            <li><a href="<?php echo base_url(); ?>home/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Thoát</a></li>
                            </ul>                            
                        </li>
                    </ul>


                <?php
                }else{

                    if($this->session->userdata('login')->tk_quyen == 2) { ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a data-toggle="dropdown" href="">
                                <span class="glyphicon glyphicon-user"></span>&nbsp; 
                                <?php echo $this->session->userdata('login')->tk_email; ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url(); ?>giasu/gs_quanly/<?php echo $this->session->userdata('login')->tk_id ?>"><span class="glyphicon glyphicon-user"></span>&nbsp; Xem thông tin</a></li>
                                <li><a href="<?php echo base_url(); ?>v_changeinfo_gs"><span class="glyphicon glyphicon-edit"></span>&nbsp; Cập nhật hồ sơ</a></li>
                                <!-- <li><a href="<?php //echo base_url(); ?>v_position_gs"><span class="glyphicon glyphicon-map-marker"></span>&nbsp; Xác định vị trí</a></li> -->
                                <li><a href="<?php echo base_url(); ?>v_changepass"><span class="glyphicon glyphicon-lock"></span>&nbsp; Đổi mật khẩu</a></li>
                                <div class="divider"></div>
                                <li><a href="<?php echo base_url(); ?>v_registerclass_gs"><span class="glyphicon glyphicon-flag"></span>&nbsp; Đăng ký lớp dạy</a></li>
                                <li><a href="<?php echo base_url();?>v_class_need_student"><span class="glyphicon glyphicon-search"></span>&nbsp; Tìm lớp dạy</a></li>
                                <li><a href="<?php echo base_url(); ?>v_classmap_gs"><span class="glyphicon glyphicon-globe"></span>&nbsp; Bản đồ lớp đang dạy</a></li>
                                <div class="divider"></div>
                                <li><a href="<?php echo base_url(); ?>home/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Thoát</a></li>
                            </ul>
                        </li>
                    </ul>

                <?php 
                } 
                ?>

                 <?php
                if($this->session->userdata('login')->tk_quyen == 3) { ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a data-toggle="dropdown" href="">
                                <span class="glyphicon glyphicon-user"></span>&nbsp; 
                                <?php echo $this->session->userdata('login')->tk_email; ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url(); ?>v_detail_ph"><span class="glyphicon glyphicon-user"></span>&nbsp; Quản lí thông tin</a></li>
                                <li><a href="<?php echo base_url(); ?>v_changeinfo_ph"><span class="glyphicon glyphicon-edit"></span>&nbsp; Cập nhật thông tin</a></li>
                                <li><a href="<?php echo base_url(); ?>v_changepass"><span class="glyphicon glyphicon-lock"></span>&nbsp; Đổi mật khẩu</a></li>
                                <div class="divider"></div>
                                <li><a href="<?php echo base_url(); ?>v_opennewclass"><span class="glyphicon glyphicon-flag"></span>&nbsp; Mở lớp tìm gia sư</a></li>
                                <div class="divider"></div>
                                <li><a href="<?php echo base_url(); ?>home/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Thoát</a></li>
                            </ul>
                        </li>
                    </ul>

                <?php 
                    }
                } 
            }
                ?>

                <div class="navbar-form navbar-right">
                    <?php if(!$this->session->userdata('login')) { ?>
                    <a href="<?php echo base_url(); ?>v_login" class="btn btn-primary hvr-shutter-in-horizontal" >Đăng nhập</a>
                    <a href="<?php echo base_url(); ?>v_register" class="" >Đăng kí</a>
                    <?php } ?>
                </div>
            </div>
            <!-- /.navbar-collapse -->

        </div>
        <!-- /.container -->
    </nav>

        </div>
        <!-- /.container -->
    </nav>

    <!-- BOX LOGIN-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Đăng nhập</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Tên người dùng:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="recipiennt-password" class="control-label">Mật khẩu:</label>
                <input type="password" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="forgot-password" class="control-label"><a href="#">Quên mật khẩu?</a></label>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary">Đăng nhập</button>
          </div>
        </div>
      </div>
    </div>
    <!--END BOX-->