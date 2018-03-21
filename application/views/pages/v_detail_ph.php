<?php if(!$this->session->userdata('login')) redirect(); ?>
<div class="container">

    <h1 class="text-muted">Quản lí thông tin</h1>
    <hr>
    <?php
    $where = array('ph_tk_id' => $this->session->userdata('login')->tk_id);
    $phuhuynh = $this->m_phuhuynh->getPhuHuynhInfo($where); //var_dump($phuhuynh);

    if($this->session->flashdata('message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
    } 
    ?>

    <?php
    if(isset($confirm) && $confirm=="yes"){ ?>
        <form action="<?php echo base_url(); ?>phuhuynh/deleteClass/<?php echo $ld_id?>" method="POST">
            <div class="alert alert-block alert-danger">
                <h4>Cảnh báo xóa!</h4>
                <p>Nếu bạn xóa, hãy chắc chắn!
                    <input type="submit" name="submit" class="btn btn-danger" value="Xóa">
                    <a href="<?php echo base_url(); ?>v_detail_ph"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
                </p>
            </div>
        </form>
        <?php
    } 
    ?>

    <div class="col-md-3">
    <div class="panel panel-primary"> 

        <div class="panel-heading">
            <h4>
                <span>Thông tin cá nhân</span> 
                <a href="<?php echo base_url(); ?>v_changeinfo_ph" role="button" data-toggle="tooltip" title="Sửa bài thông tin cá nhân" style="color:#fff;"><span class="glyphicon glyphicon-pencil pull-right"></span></a>
            </h4>
        </div>

        <div class="panel-body">
                    <img src="<?php echo isset($phuhuynh) ? base_url().$phuhuynh->ph_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                    <h4 class="text-warning text-center">
                    	<strong><?php echo $phuhuynh->ph_hoten; ?></strong>
                    </h4>
                    <table class="table">
                        <thead>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                        	<tr>
                        		<td >Giới tính:</td>
                        		<td class="text-right"><strong><?php echo $phuhuynh->ph_gioitinh==0 ? "Nam" : "Nữ"; ?></strong></td>
                        	</tr>
                        	<tr>
                        		<td>Phone:</td>
                        		<td class="text-right"><strong><?php echo $phuhuynh->ph_dienthoai; ?></strong></td>
                        	</tr>
                            <tr>
                                <td>Email:</td>
                                <td class="text-right"><small><strong><?php echo $this->session->userdata('login')->tk_email; ?></strong></small></td>
                            </tr>
                        	<tr>
                        		<td>Địa chỉ:</td>
                        		<td class="text-right"><strong><?php echo $phuhuynh->ph_diadiem; ?></strong></td>
                        	</tr>
                        </tbody>
                    </table>
        </div>
    </div>
    </div>

    <!-- ________________CLASS______________ -->

    <?php
            $this->load->model('m_phuhuynh');
            $class = $this->m_phuhuynh->getClassInfo();
            //var_dump($class);
    ?>

    <div class="col-md-9">
        <div class="panel panel-primary">
        <div class="panel-heading"><h4>Danh sách lớp học</h4></div>
        <div class="panel-body">
            <?php 
            //$sql = "select * from lopday a, dangky b WHERE a.ld_id = b.dk_ld_id and a.ph_tk_id = ".$this->session->userdata('login')->tk_id." and a.ld_id not in (select dk_ld_id from dangky)";
            $sql = "SELECT DISTINCT ph_tk_id,`ld_id`,`ld_tieude`, `ld_mon`, `ld_khoilop`, `ld_soluong`, `ld_yeucau`, `ld_buoiday`, `ld_thoigian`, `ld_diadiem`, `ld_mota_diadiem`, `ld_hinhanh`, `ld_trangthai`,dk_trangthai FROM lopday LEFT JOIN dangky ON lopday.ld_id = dangky.dk_ld_id WHERE(dk_trangthai !=-1 OR dk_trangthai is NULL) AND lopday.ph_tk_id = ".$this->session->userdata('login')->tk_id." ORDER BY dk_trangthai DESC";
            $class = $this->db->query($sql)->result();
            $row = $this->db->query($sql)->num_rows(); 
            ?>
            <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tiêu đề lớp học</th>
                    <th width="200px">Trạng thái </th>
                    <th width="80px"></th>
                </tr>
            </thead>
                <tbody>
                <?php 
                $stt = 1; 
                foreach ($class as $ld) { ?>
                    
                        <tr <?php if($ld->dk_trangthai == -2) echo "style = 'opacity:0.3'"; ?> >
                            <td><?php echo $stt++; ?></td>    
                            <td><img src="<?php  echo base_url().$ld->ld_hinhanh;?>" width="6%" height="6%">
                            <span> <?php echo $ld->ld_tieude; ?></span></td>
                            <td><?php 
                                if($ld->dk_trangthai == NULL) echo "<span style='color:red'>Đang chờ ...</span>";
                                else if($ld->dk_trangthai == 0) echo "<span class='thongbaocolor'>Có gia sư đăng ký</span>";
                                else if($ld->dk_trangthai == -2) echo "<span class=''>Lớp đã kết thúc</span>";
                                else echo "<span class='text-success'><strong>Lớp đang học</strong></span>";
                            ?></td>
                            <td>
                                
                                <a class="glyphicon glyphicon-search" href="<?php echo base_url(); ?>phuhuynh/studying_class/<?php echo $ld->ld_id; ?>" role="button" data-toggle="tooltip" title="Chi tiết lớp học"></a>
                                <?php if($ld->dk_trangthai !=-2) {  ?>
                                <a href="<?php echo base_url(); ?>phuhuynh/changeClass/<?php echo $ld->ld_id; ?>" class="glyphicon glyphicon-pencil " role="button" data-toggle="tooltip" title="Sửa bài đăng lớp học"></a>

                                <a href="<?php echo base_url(); ?>phuhuynh/ask_deleteClass/<?php echo $ld->ld_id; ?>" class="glyphicon glyphicon-remove <?php if($ld->dk_trangthai != NULL){ echo"sr-only";}?>" role="button" data-toggle="tooltip" data-target="deleteClass" title="Xóa bài đăng lớp học" style="color:red;" data-toggle="modal" data-target=".bs-example-modal-sm"></a> 
                                <?php } ?>  
                            </td>
                        </tr>
                <?php } ?> 
                </tbody>       
            </table>

         </div>
        </div>
    </div> 


    <style type="text/css">
    .active-pagination{
        color:#FFF !important;
        background-color:#337ab7 !important;
    }
    </style>
    <?php
    $item_per_page=5;
    echo '<script>';
    echo 'var item_per_page='.$item_per_page;
    echo '</script>';
    ?>
    <script language="javascript">
    $(document).ready(function() {

        $('#tbody_ds_sp tr').hide();
        $('#pagging a:first').addClass('active-pagination');
        
        for(var i=0;i<(item_per_page);i++) {
             $('#tbody_ds_sp tr:eq('+i+')').show();
        }
        
        $('#pagging a').click(function(){
            $('#pagging a').removeClass('active-pagination')
            $(this).addClass('active-pagination')
            $('#tbody_ds_sp tr').hide();
            var stt=$(this).attr('stt');
            var start=(stt-1)*item_per_page;
            var end=start+item_per_page;
            if(start>=0){
                for(var i=(start);i<end;i++) {
                    $('#tbody_ds_sp tr:eq('+i+')').show();
                }
            }
        });

    });
    </script>

    <div class="col-md-9">
    	<div class="panel panel-primary">
        <div class="panel-heading"><h4>Các bài đánh giá</h4></div>
        <div class="panel-body">

            <table class="table table-striped" id="ttgv">
                <thead>
                    <th><strong>#</strong></th>
                    <th width="300px"><strong>Nội dung</strong></th>
                    <th width="200px"><strong>Đánh giá</strong></th>
                    <th width="300px"><strong></strong></th>
                    <th width="150px">Trạng thái</th>
                    <th></th>
                </thead>

                <?php
                $sql = "SELECT DISTINCT ld_tieude, ld_diem_cmt, gs_hoten, dk_trangthai, ld_noidung_cmt FROM lopday a, dangky b, giasu c WHERE a.ld_id = b.dk_ld_id AND b.dk_gs_id = c.gs_tk_id AND (b.dk_trangthai = 1 OR b.dk_trangthai = -2)  AND a.ph_tk_id =".$this->session->userdata('login')->tk_id;
                    $count = count($this->db->query($sql)->result());
                //echo $count;
                $total_item=$count;
                $total_page=ceil($total_item/$item_per_page); //echo $total_page;

                if($total_item>0){ ?>

                <tbody id="tbody_ds_sp">
                    <?php
                    $sql = "SELECT * FROM lopday a, dangky b, giasu c WHERE a.ld_id = b.dk_ld_id AND b.dk_gs_id = c.gs_tk_id AND (b.dk_trangthai = 1 OR b.dk_trangthai = -2) AND a.ph_tk_id =".$this->session->userdata('login')->tk_id;
                    $result = $this->db->query($sql)->result(); //var_dump($result);
                    $i=0;
                    foreach ($result as $result){
                        $i++;?>
                        <tr> 
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result->ld_noidung_cmt;?></td>
                            <td><b><?php 
                                if($result->ld_diem_cmt == 1){ ?> <span class="text-danger"><img src="<?php echo base_url() ?>/img/1-rating.png" width="10%"/> Quá tệ </span> <?php }
                                if($result->ld_diem_cmt == 2){ ?> <span class="text-warning"><img src="<?php echo base_url() ?>/img/2-rating.png" width="10%"/> Hơi thất vọng </span> <?php }
                                if($result->ld_diem_cmt == 3){ ?> <span class="text-primary"><img src="<?php echo base_url() ?>/img/3-rating.png" width="10%"/> Tạm được </span> <?php }
                                if($result->ld_diem_cmt == 4){ ?> <span class="text-info"><img src="<?php echo base_url() ?>/img/4-rating.png" width="10%"/> Hài lòng </span> <?php }
                                if($result->ld_diem_cmt == 5){ ?> <span class="text-success"><img src="<?php echo base_url() ?>/img/5-rating.png" width="10%"/> Hoàn toàn hài lòng </span> <?php } 
                                ?></b></td>        
                            <td> 
                                <p><strong>Lớp: </strong><?php echo $result->ld_tieude;?></p>
                                <p><strong>Gia sư: </strong><?php echo $result->gs_hoten;?></p>
                            </td>
                            <td><?php 
                                if($result->dk_trangthai == NULL) echo "<span style='color:red'>Đang chờ ...</span>";
                                else if($result->dk_trangthai == 0) echo "<span class='thongbaocolor'>Có gia sư đăng ký</span>";
                                else if($result->dk_trangthai == -2) echo "<span>Lớp đã kết thúc</span>";
                                else echo "<span class='text-success'><strong>Lớp đang học</strong></span>";
                            ?></td>
                            <td>
                                <center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal<?php echo $result->ld_id; ?>">
                                <i class="glyphicon glyphicon-pencil"></i>
                                </button></center>

                                <!-- Modal -->
                                <div class="modal fade" id="myModal<?php echo $result->ld_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Đánh giá giáo viên</h4>
                                      </div>
                                      <div class="modal-body">
                                            <form method="POST" action="<?php echo base_url(); ?>phuhuynh/capnhat_danhGia/<?php echo $result->ld_id ?>"> 
                                        <p><strong>Mức độ hài lòng của bạn về giáo viên này như thế nào?</strong></p>
                                        <center>
                                            <div class="rating">
                                              <input type="radio" name="ld_diem_cmt" id="1<?php echo $result->ld_id ?>" <?php if($result->ld_diem_cmt == 1){echo 'checked="checked"';}?>class="input-hidden ld_diem_cmt" value="1" />
                                              <label for="1<?php echo $result->ld_id ?>">
                                                <img src="<?php echo base_url() ?>/img/1-rating.png" data-toggle="tooltip" title="Quá tệ"/>
                                              </label>

                                              <input 
                                                type="radio" name="ld_diem_cmt" id="2<?php echo $result->ld_id ?>" <?php if($result->ld_diem_cmt == 2){echo 'checked="checked"';}?> class="input-hidden" value="2" />
                                              <label for="2<?php echo $result->ld_id ?>">
                                                <img src="<?php echo base_url() ?>/img/2-rating.png" data-toggle="tooltip" title="Hơi thất vọng"/>
                                              </label>

                                              <input type="radio" name="ld_diem_cmt" id="3<?php echo $result->ld_id ?>" <?php if($result->ld_diem_cmt == 3){echo 'checked="checked"';}?> class="input-hidden" value="3" />
                                              <label for="3<?php echo $result->ld_id ?>">
                                                <img src="<?php echo base_url() ?>/img/3-rating.png" data-toggle="tooltip" title="Tạm được"/>
                                              </label>

                                              <input type="radio" name="ld_diem_cmt" id="4<?php echo $result->ld_id ?>" <?php if($result->ld_diem_cmt == 4){echo 'checked="checked"';}?> class="input-hidden" value="4" />
                                              <label for="4<?php echo $result->ld_id ?>">
                                                <img src="<?php echo base_url() ?>/img/4-rating.png" data-toggle="tooltip" title="Hài lòng"/>
                                              </label>

                                              <input type="radio" name="ld_diem_cmt" id="5<?php echo $result->ld_id ?>" <?php if($result->ld_diem_cmt == 5){echo 'checked="checked"';}?> class="input-hidden" value="5" />
                                              <label for="5<?php echo $result->ld_id ?>">
                                                <img src="<?php echo base_url() ?>/img/5-rating.png" data-toggle="tooltip" title="Hoàn toàn hài lòng"/>
                                              </label>
                                              <i><p id="error" style="color: red"></p></i>
                                            </div>
                                        </center>
                                        <p><strong>Hãy viết trải nghiệm của bạn về lớp học này</strong></p>
                                        <div><textarea class="form-control" rows="3" placeholder="Viết tối đa 100 ký tự" name="ld_noidung_cmt"><?php if(isset($result->ld_noidung_cmt)){echo $result->ld_noidung_cmt;}?></textarea></div>
                                        <center><input type="submit" class="btn btn-warning" style="margin-top:20px" value="<?php if(isset($result->ld_diem_cmt)) echo 'Cập nhật đánh giá'; else echo 'Gửi đánh giá';  ?>" onclick="return kt_danhgia()"></center>
                                        </form>
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div><!-- END MODAL -->
                            </td>
                        </tr>   
                        <?php
                    }//dong for ?>
                </tbody>
                <?php
                }//dong if($total_item>0) ?>
            
            </table>
            <?php
            $pagging="";
            if($total_page>1){
                for($i=1;$i<=$total_page; $i++){
                    $pagging.='<a href="javascript:" class="page_i" stt="'.$i.'" title="trang '.$i.'">'.$i.'</a>';
                }
                echo '<ul class="pagination"><li id="pagging">'.$pagging.'</li></ul>';
            }
            ?>

        </div>
        </div>
    </div>

</div><!-- containter-->

