<?php if(!$this->session->userdata('login')) redirect(); ?>
<div class="container">
<link rel="stylesheet" href="<?php echo base_url(); ?>multibox/prism.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>multibox/chosen.css">
<h2 class="text-lg"><span class="text-muted">Thông tin bảng học phí</span> lớp dạy</h2>
<hr>
<p>Vui lòng điền đầy đủ thông tin bên dưới.</p>
<p><i><small>Các trường có dấu (*) không thể bỏ trống</small></i></p>

<div class="col-md-8">

    <div class="row">
        
        <div class="col-md-12">

            <?php
            $where = array('gs_tk_id' => $this->session->userdata('login')->tk_id);
            $giasu = $this->m_giasu->getGiaSuInfo($where);

            $where = array('dl_gs_id' => $this->session->userdata('login')->tk_id);
            $daylop = $this->m_giasu->getGiaSuDayLop($where); //var_dump($daylop);

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
                <form action="<?php echo base_url(); ?>giasu/delFeeTable/<?php echo $dl_id; ?>" method="POST">
                    <div class="alert alert-block alert-danger">
                        <h4>Cảnh báo xóa!</h4>
                        <p>Nếu bạn xóa, hãy chắc chắn!
                            <input type="submit" name="submit" class="btn btn-danger" value="Xóa">
                            <a href="<?php echo base_url(); ?>v_registerclass_gs"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
                        </p>
                    </div>
                </form>
                <?php
            } 
            ?>

            <form class="form-horizontal" action="<?php echo base_url(); ?>giasu/registerClass" method="post" id="form" name="form">

            <div class="panel panel-primary">
                <div class="panel-heading">Thông tin thời gian dạy</div>
                
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="multiBuoi">Ngày dạy <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <?php
                            empty(set_value('checkNgay')) && isset($giasu) ? Mylibrary::checkNgay(explode(',',$giasu->gs_ngayday)) : Mylibrary::checkNgay(set_value('checkNgay'));?>
                            <i class="text-danger"><?php echo form_error("checkNgay[]"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="multiTime">Giờ dạy <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <?php empty(set_value('multiTime')) && isset($giasu) ? Mylibrary::showTime(explode(',',$giasu->gs_gioday)) : Mylibrary::showTime(set_value('multiTime'));?>
                            <i class="text-danger"><?php echo form_error("multiTime[]"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="slNamKN">Kinh nghiệm <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <?php empty(set_value('slNamKN') && isset($giasu)) ? Mylibrary::showNamKinhNghiem($giasu->gs_kinhnghiem) : Mylibrary::showNamKinhNghiem(set_value('slNamKN')); ?>
                            <i class="text-danger"><?php echo form_error("slNamKN"); ?></i>
                        </div>
                    </div>
                                        
                    <div class="form-group" style="margin-bottom: 0px;">
                        <div class="col-lg-12 text-center">
                            <!-- <input type="submit" class="hvr-shutter-in-horizontal btn btn-warning" name="submit" value="Đồng ý"/> -->
                            <button type="submit" class="hvr-shutter-in-horizontal btn btn-primary" value="Đồng ý" name="submit">Đồng ý</button>
                        </div>
                    </div>
                    
                </div>
            </div>

            </form>

            <div class="row" style="margin-bottom: 5px;">
                <div class="col-md-12 text-right">
                    <a role="button" data-toggle="modal" data-target="#myModal">
                        <button type="button" class="thongbaocolor btn btn-xs btn-success" style="padding: 3px 5px; border-radius: 3px;" value="Thêm mới"><span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm mới</button>
                    </a>
                </div>
            </div>            
            <div class="panel panel-primary">
                <div class="panel-heading">Bảng học phí</div>
                <div class="panel-body">
                <?php //$row = $this->db->query($sql)->num_rows(); ?>
                <table class="table">

                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Lớp</th>
                            <th>Môn</th>
                            <th>Giá</th>
                            <th width="80px"></th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                    $stt = 1; 
                    foreach ($daylop as $dl) { ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>    
                            <td><?php echo $dl->dl_lop; ?></td>
                            <td><?php echo $dl->dl_mon; ?></td>
                            <td><?php echo $dl->dl_giatien." đồng/buổi"; ?></td>
                            <td>
                                <a role="button" data-toggle="modal" data-target="#myModalEdit<?php echo $dl->dl_id; ?>" class="glyphicon glyphicon-pencil rotate360" data-toggle="tooltip" title="Cập nhật thời gian dạy"></a>

                                <a href="<?php echo base_url(); ?>giasu/delFeeTable/<?php echo $dl->dl_id; ?>" class="glyphicon glyphicon-remove rotate360" role="button" data-toggle="tooltip" data-target="deleteClass" title="Xóa" style="color:red;" data-toggle="modal" data-target=".bs-example-modal-sm"></a>    
                            </td>

                            <td>

<!-- Modal edit-->
<div class="modal fade" id="myModalEdit<?php echo $dl->dl_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cập nhật thông tin giá lớp <span style="color:#f0ad4e;"> <?php //echo $ph->ph_hoten; ?> </span></h4>
      </div>
      <div class="modal-body">
            <div class="container">
            <div class="col-lg-6" style="margin-left: -2% !important">
                <div id="errorSubmit"></div>
                <form class="form-horizontal" action="" method="post" id="form" name="form">
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <td>Dạy môn:</td>
                            <td>

                                <select data-placeholder="Chọn môn học..." class="form-control form-hg" id="slMon<?php echo $dl->dl_id; ?>">
                                    <option value="" <?php if($dl->dl_mon=='') echo "selected";?>>Chọn môn học</option>
                                    <option value="Toán học" <?php if($dl->dl_mon=='Toán học') echo "selected";?>>Toán học</option>
                                    <option value="Vật lý" <?php if($dl->dl_mon=='Vật lý') echo "selected";?>>Vật lý</option>
                                    <option value="Hóa học" <?php if($dl->dl_mon=='Hóa học') echo "selected";?>>Hóa học</option>
                                    <option value="Sinh học" <?php if($dl->dl_mon=='Sinh học') echo "selected";?>>Sinh học</option>
                                    <option value="Tiếng Anh" <?php if($dl->dl_mon=='Tiếng Anh') echo "selected";?>>Tiếng Anh</option>
                                    <option value="Tiếng Pháp" <?php if($dl->dl_mon=='Tiếng Pháp') echo "selected";?>>Tiếng Pháp</option>
                                    <option value="Tin học" <?php if($dl->dl_mon=='Tin học') echo "selected";?>>Tin học</option>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td>Dạy lớp:</td>
                            <td>
                            <select data-placeholder="Chọn lớp học..." class="form-control" id="slLop<?php echo $dl->dl_id; ?>">
                                <?php
                                for($i=1; $i<=12; $i++){ ?>
                                    <option value="<?php echo 'Lớp '.$i; ?>" <?php if($dl->dl_lop=="Lớp $i") echo "selected";?>><?php echo 'Lớp '.$i; ?></option>
                                    <?php
                                } ?>
                                <option value='Luyện thi đại học' <?php if($dl->dl_lop=='Luyện thi đại học') echo "selected";?>>Luyện thi đại học</option>
                                <option value='Luyện thi HS giỏi' <?php if($dl->dl_lop=='Luyện thi HS giỏi') echo "selected";?>>Luyện thi HS giỏi</option>
                            </select>
                            <?php  //Mylibrary::showLopNonMulti($dl->dl_lop); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Giá/buổi:</td>
                            <td>
                                <input type="number" class="form-control" name="txtGia" placeholder="nhập giá tiền/buổi..." id="txtGia<?php echo $dl->dl_id; ?>" value="<?php echo $dl->dl_giatien;?>"/> 
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2"><input type="button" class="btn btn-warning btnDongYEdit" name="submit" id="<?php echo $dl->dl_id; ?>" value="Đồng ý"></td>
                        </tr>
                    </table>
                </form>
                
       
            </div>
             <div class="col-lg-12">
             </div> 
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
      </div>
    </div>
  </div>
</div> <!---End div model edit-->


                            </td>

                        </tr>

                        <?php 
                    } ?> 
                    </tbody>       
                </table>

                </div>
            </div><!--end panel panel-primary-->

        </div>
        
    </div>

</div>
<?php $this->load->view("/layout/right_slidebar"); ?>
</div>


<!-- Modal add-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Điền thông tin giá lớp <span style="color:#f0ad4e;"> <?php //echo $ph->ph_hoten; ?> </span></h4>
      </div>
      <div class="modal-body">
            <div class="container">
            <div class="col-lg-6" style="margin-left: -2% !important">
                <div id="errorSubmit1"></div>
                <div id="errorSubmit"></div>
                <form class="form-horizontal" action="" method="post" id="form" name="form">
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <td>Dạy môn:</td>
                            <td><?php Mylibrary::showMonNonMulti(); ?></td>
                        </tr>
                        <tr>
                            <td>Dạy lớp:</td>
                            <td><?php  Mylibrary::showLopNonMulti(); ?></td>
                        </tr>
                        <tr>
                            <td>Giá/buổi:</td>
                            <td>
                                <input type="number" class="form-control" name="txtGiaAdd" placeholder="nhập giá tiền/buổi..."  value="<?php //echo set_value('txtGia');?>"/> 
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2"><input type="button" class="btn btn-warning" id="btnDongY" name="submit" value="Đồng ý"></td>
                        </tr>
                    </table>
                </form>
                
       
            </div>
             <div class="col-lg-12">
             </div> 
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
      </div>
    </div>
  </div>
</div> <!---End div model add-->




<script src="<?php echo base_url(); ?>multibox/chosen.jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>multibox/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var config = {  '.chosen-select'           : {},
                    '.chosen-select-deselect'  : {allow_single_deselect:true},
                    '.chosen-select-no-single' : {disable_search_threshold:10},
                    '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                    '.chosen-select-width'     : {width:"95%"}
                 }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>
<script type="text/javascript">
$(document).ready(function(){

    $("#btnDongY").click(function(){
        var slmon = document.getElementsByName("slMon");
        var sllop = document.getElementsByName("slLop");
        var txtgia = document.getElementsByName("txtGiaAdd");
        //alert(slmon[0].value+"-"+sllop[0].value+"-"+txtgia[0].value);

        $.ajax({
            url : "<?php echo base_url('A_addFeeTable/submit'); ?>",
            type : "get",
            dateType:"text",
            data : {
                 slmon: slmon[0].value,
                 sllop: sllop[0].value,
                 txtgia: txtgia[0].value
            },
            success : function (result){
                //alert(result);
                $('#errorSubmit1').html(result);
            }
        });
        //$('#ketqua').show('slow'); 
        //$('#slTinh').attr('disabled', 'disabled');
    });

    $(".btnDongYEdit").click(function(){  
        var dl_id = $(this).attr('id');
        //alert($('#slLop'+dl_id).val())
        var slmon = $('#slMon'+dl_id).val();
        var sllop = $('#slLop'+dl_id).val();
        var txtgia = $('#txtGia'+dl_id).val();

        $.ajax({
            url : "<?php echo base_url('A_editFeeTable/submit'); ?>",
            type : "get",
            dateType:"text",
            data : {
                 slmon: slmon,
                 sllop: sllop,
                 txtgia: txtgia,
                 dl_id: dl_id
            },
            success : function (result){
                //alert(result);
                $('#errorSubmit').html(result);
            }
        });
    });
    
});
</script>

