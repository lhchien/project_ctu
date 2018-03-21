<div class="container">

    <h2 class="text-lg"><span class="text-muted">Liên hệ</span> quản trị viên</h2>
    <hr>
    <h4 class="text-danger"><span class="glyphicon glyphicon-flag"></span> Thông báo tài khoản của bạn đã bị khóa do vi phạm qui định của website hoặc vì lý do nào đó! </h4>
    <p>Vui lòng điền đầy đủ thông tin bên dưới để liên hệ với quản trị viên</p>
    <p><i><small>Các trường có dấu (*) không thể bỏ trống</small></i></p>

    <?php
    if($this->session->flashdata('message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
    } ?>
    
    <div class="col-md-10">
    <div class="panel panel-primary">
        <div class="panel-heading">Nội dung liên hệ</div>
        <div class="panel-body">

            <div class="col-md-9">
                <form class="form-horizontal" action="<?php echo base_url(); ?>phuhuynh/lienhe" method="post">

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tiêu đề <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="lh_tieude" placeholder="Nhập tiêu đề..."  value="<?php echo set_value('lh_tieude');?>"/> 
                            <i class="text-danger"><?php echo form_error("lh_tieude"); ?></i>
                            <input type="text" class="form-control sr-only" name="lh_tk_id" placeholder="Nhập tiêu đề..."  value="<?php echo $this->session->userdata('login')->tk_id;?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nội dung <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-10">
                            <textarea type="text" class="form-control" name="lh_noidung" placeholder="Nhập nội dung..." rows ="5"><?php echo set_value('lh_noidung');?></textarea>
                            <i class="text-danger"><?php echo form_error("lh_noidung"); ?></i>
                        </div>
                    </div>
                    

                    <div class="col-sm-7 pull-right">
                        <input type="submit" name="submit" class="btn btn-warning btn-lg" value="Gửi">
                    </div>
                    
                </form>
            </div>
           
        </div>
    </div>
    </div>
    


</div><!-- containter-->