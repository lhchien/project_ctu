
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/boxchat/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/boxchat/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/boxchat/dist/css/skins/_all-skins.min.css">

<?php if(!$this->session->userdata('login')) redirect(); ?>
<div class="container">

    <h1 class="text-muted">Thông tin chi tiết lớp học</h1>

        
    <div class="clear"></div>
    <hr>
    <?php
    if(isset($confirm) && $confirm=="yes"){ ?>
        <form action="<?php echo base_url(); ?>phuhuynh/dk_day" method="POST">
            <div class="alert alert-block alert-warning">
                <input type="hidden" name="ld_id" value="<?php echo $ld_id ?>" >
                <input type="hidden" name="gs_tk_id" value="<?php echo $this->session->userdata('login')->tk_id ?>">
                <h4>Thông báo đăng ký lớp dạy lớp này!</h4>
                <p>Nếu bạn đăng ký, hãy chắc chắn!
                    <input type="submit" name="submit" class="btn btn-warning" value="Đăng ký">
                    <a href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $ld_id ?>"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
                </p>
            </div>
        </form>
    <?php } ?>

    <?php
    if( empty($class) ){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo "Không có thông tin!"; ?>
        </div>
        <?php
    } 
    else {
        foreach ($class as $ld) {
            $where = array('ph_tk_id' => $ld->ph_tk_id);
            $ph = $this->m_phuhuynh->getPhuHuynhInfo($where); 
        ?>
    <div class="col-md-6">
    <div class="panel panel-primary">

        <div class="panel-heading"><h4>Thông tin lớp "<b><?php echo $ld->ld_tieude; ?> </b>"</h4></div>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-lg-4">
                <p><img src="<?php echo isset($class) ? base_url().$ld->ld_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive" style="margin-top:40px "></p>

                <?php 
                    $sql1 = "SELECT  dk_id, dk_ld_id,dk_trangthai FROM dangky  WHERE dk_ld_id =".$ld->ld_id." group by dk_ld_id,dk_trangthai";
                    $ld1 = $this->db->query($sql1)->result();


                    if (isset($this->session->userdata('login')->tk_id) && $this->session->userdata('login')->tk_quyen == 2){


                                if($this->db->query($sql1)->num_rows() == 0)
                                { ?>

                                     <form class="form-horizontal" action="<?php echo base_url(); ?>phuhuynh/ask_dk_day/<?php echo $ld->ld_id?>" method="post">
                                        <center><input type="submit" name="submit" class="btn btn-warning" value="Đăng ký dạy" style="margin-top:20px "></center>
                                    </form>

                                <?php 
                                }
                                else 

                           foreach ($ld1 as $ld1)
                           {

                                if($ld1->dk_trangthai == 1 )
                                {
                                    $sql2 = "SELECT * FROM dangky  WHERE dk_ld_id =".$ld->ld_id." AND dk_gs_id =".$this->session->userdata('login')->tk_id." and dk_trangthai = 1";
                                    if($this->db->query($sql2)->num_rows() == 1) 
                                    {?>
                                        <span class="text-success"><strong><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Bạn đang dạy lớp này</strong> </span>

                                    <?php 
                                    }else { ?>
                                        <span class="text-danger"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Lớp này đang học </span>
                                    <?php
                                        }
                                }
                                    
                                else if($ld1->dk_trangthai == 0 )
                                {
                                $sql2 = "SELECT * FROM dangky b WHERE dk_ld_id =".$ld->ld_id." AND dk_gs_id =".$this->session->userdata('login')->tk_id." and dk_trangthai = 0";
                                    if(  $this->db->query($sql2)->num_rows() == 1 )
                                    {?>
                                        <strong><span class="text-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Đã đăng ký dạy</span></strong>
                                    
                                        <center><a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#myModal_huy_dk" data-toggle="tooltip" style="margin-top: 20px ">Hủy đăng ký</a></center>

                                        <!-- Modal detail-->
                                <div class="modal fade" id="myModal_huy_dk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Thông báo</h4>
                                      </div>
                                      <div class="modal-body">
                                            <center><strong>Bạn có chắc hủy đăng ký dạy lớp này không?</strong></center>          
                                      </div>
                                      <div class="modal-footer">
                                        
                                        <a href="<?php echo base_url(); ?>phuhuynh/huy_dangky/<?php echo $ld->ld_id;?>/<?php echo $this->session->userdata('login')->tk_id?>" class="btn btn-warning">Chắc chắn hủy</a>
                                        
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                                      </div>
                                    </div>
                                  </div>
                                </div> <!---End div model -->
                                    <?php 
                                    }
                                    else 
                                    {?>
                                         <form class="form-horizontal" action="<?php echo base_url(); ?>phuhuynh/ask_dk_day/<?php echo $ld->ld_id?>" method="post">
                                            <center><input type="submit" name="submit" class="btn btn-warning" value="Đăng ký dạy" style="margin-top:20px "></center>
                                        </form>

                                    <?php 
                                    }
                                }
                                   

                            } 
                        
                    }?>  
                </div>

                <div class="col-lg-8">
                    <h4 class="text-success text-center">
                        <strong><?php echo $ld->ld_tieude; ?></strong>
                    </h4>
                    <table class="table">
                        <tr>
                            <td>Môn:</td>
                            <td><strong><?php echo $ld->ld_mon; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Lớp:</td>
                            <td><strong><?php echo $ld->ld_khoilop; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Số lượng:</td>
                            <td><strong><?php echo $ld->ld_soluong; ?> Người</strong></td>
                        </tr>
                        <tr>
                            <td>Buổi dạy</td>
                            <td><strong><?php echo $ld->ld_buoiday; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Bắt đầu lúc:</td>
                            <td><strong><?php echo $ld->ld_thoigian; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Yêu Cầu:</td>
                            <td><strong><?php echo $ld->ld_yeucau; ?></strong></td>
                        </tr>
                        <tr class="info">
                            <td>Người đăng:</td>
                            <td><strong><?php echo $ph->ph_hoten; ?></strong></td>
                        </tr>
                        <tr class="info">
                            <td>Liên Hệ:</td>
                            <td><strong><?php echo $ph->ph_dienthoai; ?></strong></td>
                        </tr>
                        <tr class="info">
                            <td>Mô tả địa điểm: </td>
                            <td><strong><?php echo $ld->ld_mota_diadiem; ?></strong></td>
                        </tr>
                    </table>
                </div>
            </div> 
            <div class="col-md-12">
                    <?php if(!empty($ld->ld_diadiem)){?>
                        <div id="map" style="height: 300px;">ban do</div>
                        <?php
                    } 
                    else
                        echo "<center class=text-danger>Chưa cập nhật vị trí</center>"; ?>
            </div>         

        </div>
    </div>
    <?php } ?>

    <?php } ?>

    </div>

    <?php  
        $sql1 = "SELECT * FROM giasu a, dangky b WHERE a.gs_tk_id = b.dk_gs_id AND  dk_ld_id =".$ld->ld_id;
        $giasu1 = $this->db->query($sql1)->result();
        $kt = 0;
        foreach ($giasu1 as $gs1){
            if($gs1->dk_trangthai == 1 || $gs1->dk_trangthai == -2){
                $kt = 1;
            }
        } 
    ?>

    <div class="col-md-6">
        <?php if($this->db->query($sql1)->num_rows() == 0){ ?> 
            <div class="panel panel-primary">
            <div class="panel-heading"><h4>Gia sư đăng kí dạy</h4></div>
                <div class="panel-body">
                Chưa có gia sư đăng ký...

                </div>
        </div><!-- END DIV -->
        <?php }else if($kt == 1 ){?>
            <div class="panel panel-primary">
            <div class="panel-heading"><h4>Thông tin gia sư</h4></div>
            <div class="panel-body">

                    <?php if($this->session->userdata('login')->tk_quyen == 3){?>

                    <!-- Button trigger modal -->
                    <?php if ($gs1->dk_trangthai == -2 ){?> 
                        <center style="margin-bottom: 50px;"><button type="button" class="btn btn-warning pull-left" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-thumbs-up"></i> Đánh giá giáo viên
                        </button>
                        <b><div class="text-danger pull-right"><span class="glyphicon glyphicon-lock"></span> <span style="font-size: 15px">LỚP HỌC ĐÃ KẾT THÚC</span></div></b></center>

                    <?php }else{?>
                        <center style="margin-bottom: 50px;"><button type="button" class="btn btn-warning pull-left" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-thumbs-up"></i> Đánh giá giáo viên
                        </button>
                        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal_endclass"><i class="glyphicon glyphicon-lock"></i> Kết thúc lớp học</button></center>
                    <?php } ?>
                    
                    <div class="clear"><hr></div>
                    <!-- Modal end class -->
                    <div class="modal fade" id="myModal_endclass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Thông báo!</h4>
                          </div>

                          <div class="modal-body">
                            <p>Bạn có chắc kết thúc lớp học này không?</p>
                          </div>

                           <div class="modal-footer">
                            <form method="POST" action="<?php echo base_url(); ?>phuhuynh/endclass/<?php echo $ld->ld_id ?>"> 
                            <input type="submit" class="btn btn-warning" value="Chắc chắn">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </form>
                            
                          </div>

                        </div>
                      </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Đánh giá giáo viên</h4>
                          </div>
                          <div class="modal-body">
                                <form method="POST" action="<?php echo base_url(); ?>phuhuynh/danhGia/<?php echo $ld->ld_id ?>"> 
                            <p><strong>Mức độ hài lòng của bạn về giáo viên này như thế nào?</strong></p>
                            <center>
                                <div class="rating">
                                  <input type="radio" name="ld_diem_cmt" id="1" <?php if($ld->ld_diem_cmt == 1){echo 'checked="checked"';}?>class="input-hidden ld_diem_cmt" value="1" />
                                  <label for="1">
                                    <img src="<?php echo base_url() ?>/img/1-rating.png" data-toggle="tooltip" title="Quá tệ"/>
                                  </label>

                                  <input 
                                    type="radio" name="ld_diem_cmt" id="2" <?php if($ld->ld_diem_cmt == 2){echo 'checked="checked"';}?> class="input-hidden" value="2" />
                                  <label for="2">
                                    <img src="<?php echo base_url() ?>/img/2-rating.png" data-toggle="tooltip" title="Hơi thất vọng"/>
                                  </label>

                                  <input type="radio" name="ld_diem_cmt" id="3" <?php if($ld->ld_diem_cmt == 3){echo 'checked="checked"';}?> class="input-hidden" value="3" />
                                  <label for="3">
                                    <img src="<?php echo base_url() ?>/img/3-rating.png" data-toggle="tooltip" title="Tạm được"/>
                                  </label>

                                  <input type="radio" name="ld_diem_cmt" id="4" <?php if($ld->ld_diem_cmt == 4){echo 'checked="checked"';}?> class="input-hidden" value="4" />
                                  <label for="4">
                                    <img src="<?php echo base_url() ?>/img/4-rating.png" data-toggle="tooltip" title="Hài lòng"/>
                                  </label>

                                  <input type="radio" name="ld_diem_cmt" id="5" <?php if($ld->ld_diem_cmt == 5){echo 'checked="checked"';}?> class="input-hidden" value="5" />
                                  <label for="5">
                                    <img src="<?php echo base_url() ?>/img/5-rating.png" data-toggle="tooltip" title="Hoàn toàn hài lòng"/>
                                  </label>
                                  <i><p id="error" style="color: red"></p></i>
                                </div>
                            </center>
                            <p><strong>Hãy viết trải nghiệm của bạn về lớp học này</strong></p>
                            <div><textarea class="form-control" rows="3" placeholder="Viết tối đa 100 ký tự" name="ld_noidung_cmt"><?php if(isset($ld->ld_noidung_cmt)){echo $ld->ld_noidung_cmt;}?></textarea></div>
                            <center><input type="submit" class="btn btn-warning" style="margin-top:20px" value="<?php if(isset($ld->ld_diem_cmt)) echo 'Cập nhật đánh giá'; else echo 'Gửi đánh giá';  ?>" onclick="return kt_danhgia()"></center>
                        </form>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                        <?php }else{ ?>

                        <div class="col-md-12">    
                        <div class="well">
                        <form method="POST" action="<?php echo base_url(); ?>phuhuynh/danhGia/<?php echo $ld->ld_id ?>"> 
                            <p><strong>Mức độ hài lòng của học viên: </strong>

                                <?php if($ld->ld_diem_cmt == 1){?>
                                    <img src="<?php echo base_url() ?>/img/1-rating.png" data-toggle="tooltip" title="Quá tệ"/>
                                <?php } ?> 

                                <?php if($ld->ld_diem_cmt == 2){?>
                                    <img src="<?php echo base_url() ?>/img/2-rating.png" data-toggle="tooltip" title="Hơi thất vọng"/>
                                <?php } ?> 

                                <?php if($ld->ld_diem_cmt == 3){?> 
                                    <img src="<?php echo base_url() ?>/img/3-rating.png" data-toggle="tooltip" title="Tạm được"/>
                                <?php } ?> 

                                <?php if($ld->ld_diem_cmt == 4){?>
                                    <img src="<?php echo base_url() ?>/img/4-rating.png" data-toggle="tooltip" title="Hài lòng"/>
                                <?php } ?> 

                                <?php if($ld->ld_diem_cmt == 5){?>
                                    <img src="<?php echo base_url() ?>/img/5-rating.png" data-toggle="tooltip" title="Hoàn toàn hài lòng"/>
                                <?php } ?>
                            </p>
                                  <i><p id="error" style="color: red"></p></i>

                            <p><strong>Nhận xét của học viên:</strong></p>
                            <div><textarea disabled="disabled" class="form-control" rows="3" placeholder="Viết tối đa 100 ký tự" name="ld_noidung_cmt"><?php if(isset($ld->ld_noidung_cmt)){echo $ld->ld_noidung_cmt;}?></textarea></div>
                        </form>
                        </div> 
                        </div>
                        <?php } ?>


                <?php
                $sql = "SELECT * FROM giasu a, dangky b WHERE a.gs_tk_id = b.dk_gs_id AND  dk_ld_id =".$ld->ld_id." AND (dk_trangthai = 1 OR dk_trangthai = -2) ";
                $giasu = $this->db->query($sql)->result();
                foreach ($giasu as $gs) { ?>
                        <div class="col-md-12">
                            <div class="col-lg-4">
                                <img class="img-responsive" src="<?php echo base_url().$gs->gs_hinhanh; ?>" alt="Generic placeholder image" style="margin-top:40px">
                            </div>
                            <div class="col-lg-8">
                                <table class="table">
                                    <h4 class="text-success text-center">
                                        <strong><?php echo $gs->gs_hoten; ?></strong>
                                    </h4>
                                    <tr>
                                        <td>Giới tính - Năm sinh: </td>
                                        <td><strong><?php echo ($gs->gs_gioitinh==1) ? "Nữ" : "Nam"; echo " - ".$gs->gs_namsinh?></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Điện thoại: </td>
                                        <td><strong><?php echo $gs->gs_dienthoai; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Trình độ: </td>
                                        <td><strong><?php echo $gs->gs_trinhdo; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Chuyên ngành: </td>
                                        <td><strong><?php echo $gs->gs_chuyennganh; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Giá tiền/buổi:  </td>
                                        <td><strong>
                                        <?php 
                                        $where = array('dl_gs_id' => $gs->gs_tk_id);
                                        $daylop = $this->m_giasu->getGiaSuDayLop($where);
                                        $stt = 1; 
                                        foreach ($daylop as $dl) { ?>
                                            <tr>
                                                <td><?php echo $stt++; ?></td>    
                                                <td><?php echo $dl->dl_lop; ?></td>
                                                <td><?php echo $dl->dl_mon; ?></td>
                                                <td><?php echo $dl->dl_giatien." đồng/buổi"; ?></td>
                                            </tr>
                                            <?php
                                        } ?>
                                        </strong></td>
                                    </tr>
                                    <tr>
                                        <td>Đánh giá: </td>
                                        <td><strong>
                                            <?php 
                                                $sql = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND (dk_trangthai = 1 OR dk_trangthai = -2) AND ld_diem_cmt is not NULL  AND b.dk_gs_id =".$gs->gs_tk_id; //echo $sql;
                                                $gs = $this->db->query($sql)->result();
                                                $row = ($this->db->query($sql)->num_rows()==0)?1:$this->db->query($sql)->num_rows();
                                                $diem = 0;
                                                foreach ($gs as $gs) {
                                                    $diem += $gs->ld_diem_cmt;
                                                }
                                                
                                                $a = ($diem/$row <3)?3:$diem/$row;

                                                for($i=1;$i<=$a;$i++){
                                                    echo'<span class="glyphicon glyphicon-star"></span>';
                                                }
                                                echo " ".round($a, 1);
                                            ?>
                                        </strong></td>
                                    </tr>
                                </table>
                            </div>        
                    </div>
                <div class="clear"> <hr></div> 

                <div class="col-md-12">
                  <!-- DIRECT CHAT PRIMARY -->
                  <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Trò chuyện</h3>
                    </div>
                    <!-- /.box-header -->
                    
                    <div class="box-body">
                      <!-- Conversations are loaded here -->
                      <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                        <?php 
                            
                            $sql_chat = "SELECT a.tk_id as tk_id, dg_noidung, dg_time, tk_quyen, ph_hoten as hoten, ph_hinhanh as hinhanh FROM danhgia a, phuhuynh b, taikhoan c WHERE a.tk_id = b.ph_tk_id AND a.tk_id = c.tk_id AND ld_id = $ld_id UNION SELECT a.tk_id as tk_id, dg_noidung, dg_time, tk_quyen, gs_hoten as hoten, gs_hinhanh as hinhanh FROM danhgia a, giasu b, taikhoan c WHERE a.tk_id = b.gs_tk_id AND a.tk_id = c.tk_id AND ld_id = $ld_id ORDER BY dg_time DESC"; 
                            $binhluan = $this->db->query($sql_chat)->result();
                            foreach ($binhluan as $chat) {
                            
                        ?>  
                        <?php if($chat->tk_id != $this->session->userdata('login')->tk_id){  ?>
                        <div class="direct-chat-msg">
                          <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left"><?php echo $chat->hoten ?></span>
                            <span class="direct-chat-timestamp pull-right"><?php echo $chat->dg_time ?></span>
                          </div>
                          <!-- /.direct-chat-info -->
                          <img class="direct-chat-img" src="<?php echo base_url(); ?>/<?php echo $chat->hinhanh ?>" alt="Message User Image"><!-- /.direct-chat-img -->
                          <div class="direct-chat-text">
                            <?php echo $chat->dg_noidung ?>
                          </div>
                          <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                        <?php }else{ ?>
                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                          <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-right"><?php echo $chat->hoten ?></span>
                            <span class="direct-chat-timestamp pull-left"><?php echo $chat->dg_time ?></span>
                          </div>
                          <!-- /.direct-chat-info -->
                          <img class="direct-chat-img" src="<?php echo base_url(); ?>/<?php echo $chat->hinhanh ?>" alt="Message User Image"><!-- /.direct-chat-img -->
                          <div class="direct-chat-text">
                            <?php echo $chat->dg_noidung ?>
                          </div>
                          <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                    <?php }
                    } ?>
                      </div>
                      <!--/.direct-chat-messages-->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <form action="<?php echo base_url(); ?>phuhuynh/chat/<?php echo $ld_id ?>" method="post">
                        <div class="input-group">
                            <input type="text" name="txt_message" placeholder="Nhập tin nhắn ..." class="form-control">
                            <input type="text" name="txt_tk_id" hidden="hidden" value="<?php echo $this->session->userdata('login')->tk_id ?>">
                            <input type="text" name="txt_ld_id" hidden="hidden" value="<?php echo $ld_id ?>">
                              <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flat">Gửi</button>
                              </span>
                        </div>
                        <i class="txt_message" style="color: red"><?php echo form_error("txt_message"); ?></i>
                      </form>
                    </div>
                    <!-- /.box-footer-->
                  </div>
                  <!--/.direct-chat -->

                </div>

     
            </div> <?php } ?>
        </div><!-- END DIV -->


        <script type="text/javascript">
            function kt_danhgia(){ 
                var kt = false;
                for(var i=1;i<=5;i++)
                    if( $("#"+i).is(":checked") )
                        kt =  true;
                    if(kt == true)
                        return true;
                     else{
                        $("#error").html("Hãy chọn mức độ hài lòng của bạn về lớp học này!</br> Trước khi gửi đánh giá của bạn.");
                        return false;    
                    }
            }
        </script>

        <?php }else{?>

    	<div class="panel panel-primary">
        <div class="panel-heading"><h4>Gia sư đăng kí dạy</h4></div>
            <div class="panel-body">
            <?php
            $sql = "SELECT * FROM giasu a, dangky b WHERE a.gs_tk_id = b.dk_gs_id AND  dk_ld_id =".$ld->ld_id;
            $giasu = $this->db->query($sql)->result();
            ?>
            <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Họ tên</th>
                    <th></th>
                </tr>
            </thead>
                <tbody>
                <?php 
                $stt = 1; 
                foreach ($giasu as $gs) { ?>
                    
                        <tr>
                            <td><?php echo $stt++; ?></td>    
                            <td><img src="<?php  echo base_url().$gs->gs_hinhanh;?>" width="10%" height="10%">
                            <span> <?php echo $gs->gs_hoten; ?></span></td>
                            <td>
                                 <a class="btn btn-default" href="#" role="button" data-toggle="modal" data-target="#myModal<?php echo $gs->gs_tk_id; ?>" data-toggle="tooltip" >Chi tiết &raquo;</a>

                                 <!-- Modal detail-->
                                <div class="modal fade" id="myModal<?php echo $gs->gs_tk_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Thông tin gia sư</h4>
                                      </div>
                                      <div class="modal-body">
                                            <div class="container">
                                            <div class="col-lg-12">
                                                <div class="col-md-4 col-md-push-2">
                                                    <table class="table">
                                                        <tr>
                                                            <td>Họ tên:</td>
                                                            <td><strong><?php echo $gs->gs_hoten; ?></strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Giới tính - Năm sinh: </td>
                                                            <td><strong><?php echo ($gs->gs_gioitinh==1) ? "Nữ" : "Nam"; echo " - ".$gs->gs_namsinh?></strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Điện thoại: </td>
                                                            <td><strong><?php echo $gs->gs_dienthoai; ?></strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trình độ: </td>
                                                            <td><strong><?php echo $gs->gs_trinhdo; ?></strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Chuyên ngành: </td>
                                                            <td><strong><?php echo $gs->gs_chuyennganh; ?></strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Giá tiền/buổi:  </td>
                                                            <td><strong><?php 
                                                                $where = array('dl_gs_id' => $gs->gs_tk_id);
                                                                $daylop = $this->m_giasu->getGiaSuDayLop($where);
                                                                $stt = 1; 
                                                                foreach ($daylop as $dl) { ?>
                                                                    <tr>
                                                                        <td><?php echo $stt++; ?></td>    
                                                                        <td><?php echo $dl->dl_lop; ?></td>
                                                                        <td><?php echo $dl->dl_mon; ?></td>
                                                                        <td><?php echo $dl->dl_giatien." đồng/buổi"; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                } ?></strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Đánh giá: </td>
                                                            <td><strong>
                                                                <?php 
                                                                    $sql2 = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND (dk_trangthai = 1 OR dk_trangthai = -2) AND ld_diem_cmt is not NULL  AND b.dk_gs_id =".$gs->gs_tk_id; //echo $sql;
                                                                    $gs2 = $this->db->query($sql2)->result();
                                                                    $row2 = ($this->db->query($sql2)->num_rows()==0)?1:$this->db->query($sql2)->num_rows();
                                                                    $diem = 0;
                                                                    foreach ($gs2 as $gs2) {
                                                                        $diem += $gs2->ld_diem_cmt;
                                                                    }
                                                                    
                                                                    $a = ($diem/$row2 <3)?3:$diem/$row2;

                                                                    for($i=1;$i<=$a;$i++){
                                                                        echo'<span class="glyphicon glyphicon-star"></span>';
                                                                    }
                                                                    echo " ".round($a, 1);
                                                                ?>
                                                            </strong></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="col-md-2 col-md-pull-4 thumbnail">
                                                    <img class="featurette-image img-responsive" src="<?php echo base_url().$gs->gs_hinhanh; ?>" alt="Generic placeholder image">
                                                </div>            
                                            </div>
                                             <div class="col-lg-12">
                                             </div> 
                                            </div>

                                      </div>
                                      <div class="modal-footer">
                                        <?php if($this->session->userdata('login')->tk_quyen != 2){?>
                                        <a href="<?php echo base_url(); ?>phuhuynh/update_dangky/<?php echo $gs->gs_tk_id;?>/<?php echo $ld->ld_id;?>" class="btn btn-warning">Chọn</a>
                                        <?php  }?>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                                      </div>
                                    </div>
                                  </div>
                                </div> <!---End div model --> 
                            </td>
                        </tr>


                         
                    <?php } ?> 
                </tbody>       
            </table>

            </div>
        </div> 
        <?php } ?>
        
</div><!-- containter-->
<div class="clear"></div>


<script src="<?php echo base_url(); ?>multibox/chosen.jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>multibox/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var config = {  '.chosen-select'           : {},
                    '.chosen-select-deselect'  : {allow_single_deselect:true},
                    '.chosen-select-no-single' : {disable_search_threshold:10},
                    '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                    '.chosen-select-width'     : {width:"100%"}
                 }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

</script>

<script type="text/javascript" charset="utf-8" async defer>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

jQuery(document).ready(function($) {(

    function(){

    window.onload = function() {

        var locations = [
            <?php
                echo "['".'Lớp '.$ld->ld_tieude.' Ở đây!'."', ".$ld->ld_diadiem.", ".$ld->ld_id."],";
            ?>
        ];


        var map = new google.maps.Map(document.getElementById('map'),{
            zoom: 12,
            center: new google.maps.LatLng(<?php echo $ld->ld_diadiem; ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        /* Make new marker when click map */
        google.maps.event.addListener(map, "rightclick", function(event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();
            var marker1 = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                map: map,
                icon: './img/iconmap.png',
                title: 'Nhấn chuột phải để xóa',
            });  
            var infowindow = new google.maps.InfoWindow();
            infowindow.setContent('Right Click to delete');
            infowindow.open(map, marker1);  

            marker1.addListener("rightclick", function() {
                marker1.setMap(null);
            });   
        });
        /* end make new marker when click map */

        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        for(i=0; i<locations.length; i++){

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                draggable:true,
                animation: google.maps.Animation.DROP,
                map: map
            }); //end marker

            google.maps.event.addListener(marker,'click',(function(marker,i){
                return function(){
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map,marker);
                    if (marker.getAnimation() !== null) {
                        marker.setAnimation(null);
                    } else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                    

                }
            })(marker,i));

        }//end for
        

        var styles = [
            {
              featureType: 'road.arterial',
              elementType: 'all',
              stylers: [
                { hue: '#fff' },
                { saturation: 100 },
                { lightness: -48 },
                { visibility: 'on' }
              ]
            },
            {
              featureType: 'road',
              elementType: 'all',
              stylers: []
            },
            {
                featureType: 'water',
                elementType: 'geometry.fill',
                stylers: [
                    { color: '#adc9b8' }
                ]
            },
            {
                featureType: 'landscape.natural',
                elementType: 'all',
                stylers: [
                    { hue: '#809f80' },
                    { lightness: -35 }
                ]
            }
        ];
         
        var styledMapType = new google.maps.StyledMapType(styles);
        map.mapTypes.set('Styled', styledMapType);
        
        // Getting values - Attaching click events to the buttons
        document.getElementById('getValues').onclick = function() {
            alert('Current Zoom level is ' + map.getZoom());
            alert('Current center is ' + map.getCenter());
            alert('The current mapType is ' + map.getMapTypeId());
        }

        google.maps.event.addListener(map, "rightclick", function(event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();

            alert("Lat=" + lat + "; Lng=" + lng);
            $('#element_3').val(lat);   
            $('#element_4').val(lng); 

        }); //end window onload

        /*search box google map*/
        var infowindow = new google.maps.InfoWindow();
        var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
        google.maps.event.addListener(searchBox, 'places_changed', function() {
         searchBox.set('map', null);
            var image = './img/iconmap.png';
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;
            for (i = 0; place = places[i]; i++) {
                (function(place) {
                 var marker = new google.maps.Marker({
                   position: place.geometry.location,
                   icon: image
                 });
                 marker.bindTo('map', searchBox, 'map');

                //show thong tin khi click vao marker
                marker.addListener('click', function() {
                    infowindow.setContent(place.name+"<br/>"+place.formatted_address);
                    infowindow.open(map, marker);
                });
                 
                 google.maps.event.addListener(marker, 'map_changed', function() {
                   if (!this.getMap()) {
                     this.unbindAll();
                   }
                 });
                 bounds.extend(place.geometry.location);

                }(place));

            }// end for
            map.fitBounds(bounds);
            searchBox.set('map', map);
            map.setZoom(Math.min(map.getZoom(),12));

        });/*end search box google map*/

  };
})();

}); //end jquery
</script>

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

    