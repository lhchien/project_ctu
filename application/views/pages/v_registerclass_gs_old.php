<?php if(!$this->session->userdata('login')) redirect(); ?>
<div class="container">
<link rel="stylesheet" href="<?php echo base_url(); ?>multibox/prism.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>multibox/chosen.css">
<h2 class="text-lg"><span class="text-muted">Cập nhật thông tin </span> lớp dạy</h2>
<hr>
<p>Vui lòng điền đầy đủ thông tin bên dưới.</p>
<p><i><small>Các trường có dấu (*) không thể bỏ trống</small></i></p>

<div class="col-md-8">
<form class="form-horizontal" action="<?php echo base_url(); ?>giasu/registerClass" method="post" id="form" name="form">

    <div class="row">
        
        <div class="col-md-12">

            <?php
            $where = array('gs_tk_id' => $this->session->userdata('login')->tk_id);
            $giasu = $this->m_giasu->getGiaSuInfo($where);

            if($this->session->flashdata('message')){ ?>
                <div class="alert alert-warning fade in alertStyle">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
                </div>
                <?php
            } 
            ?>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Thông tin lớp dạy</div>
                
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="multiLop">Lớp dạy <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <?php empty(set_value('multiLop')) && isset($giasu) ? Mylibrary::showLop(explode(',',$giasu->gs_lop)) : Mylibrary::showLop(set_value('multiLop')); ?>
                            <i class="text-danger"><?php echo form_error("multiLop[]"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="multiMon">Môn dạy <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <?php empty(set_value('multiMon')) && isset($giasu) ? Mylibrary::showMon(explode(',',$giasu->gs_mon)) : Mylibrary::showMon(set_value('multiMon'));?>
                            <i class="text-danger"><?php echo form_error("multiMon[]"); ?></i>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label class="col-lg-3 control-label" for="multiDay">Ngày dạy <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <?php //empty(set_value('multiDay')) && isset($giasu) ? Mylibrary::showDay(explode(',',$giasu->gs_ngayday)) : Mylibrary::showDay(set_value('multiDay'));?>
                            <i class="text-danger"><?php //echo form_error("multiDay[]"); ?></i>
                        </div>
                    </div> -->

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
                        <label class="col-lg-3 control-label" for="txtGia">Giá tiền <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="txtGia" placeholder="Giá tiền 1 buổi dạy..."  value="<?php echo empty(set_value('txtGia')) && isset($giasu) ? $giasu->gs_giatien : set_value('txtGia');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtGia"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="slNamKN">Kinh nghiệm <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <?php empty(set_value('slNamKN')) ? Mylibrary::showNamKinhNghiem() : Mylibrary::showNamKinhNghiem(set_value('slNamKN')); ?>
                            <i class="text-danger"><?php echo form_error("slNamKN"); ?></i>
                        </div>
                    </div>

                    <!--<div class="form-group" id="ketqua">
                        <label class="col-lg-3 control-label" for="txtTungDay">Từng dạy </label>
                        <div class="col-lg-9">
                            <textarea id="textarea" class="form-control" <?php //if(empty(set_value('slNamKN'))) echo "disabled "; ?>rows="5"></textarea>
                        </div>
                    </div>-->
                                        
                    <div class="form-group">
                        <div class="col-lg-12 text-center">
                            <input type="submit" class="btn btn-warning" name="submit" value="Đồng ý">
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
        
    </div>

</form>
</div>
<?php $this->load->view("/layout/right_slidebar"); ?>

</div>

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

    /*ajax textarea
    $(document).ready(function() {
        $('#slNamKN').change(function() {
           $.post('./ajax/a_registerclass_gs.php', $('#slNamKN').serialize(), function(e) {
                if( e ) {
                    $('#ketqua').html(e);
                    alert("asa");
                } 
            })
        });
    });*/
</script>