<div class="container">

    <h2 class="text-lg"><span class="text-muted">Đăng kí tham gia </span> Gia sư online</h2>
    <hr>
    <p>Vui lòng điền đầy đủ thông tin bên dưới. Thông tin các nhân của bạn sẽ được hiển thị giúp người dùng có thể liên lạc dễ dàng hơn. </p>
    <p><i><small>Các trường có dấu (*) không thể bỏ trống</small></i></p>

    <?php
    if($this->session->flashdata('message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
    } ?>

    <div class="col-md-8">
    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin tài khoản</div>
        <div class="panel-body">
            <div class="col-md-12">
                <form class="form-horizontal" action="<?php echo base_url(); ?>home/register" method="post">

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtEmail">Email <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="txtEmail" placeholder="nhập email..."  value="<?php echo set_value('txtEmail');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtEmail"); ?></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtMatKhau">Mật khẩu <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="txtMatKhau" placeholder="nhập mật khẩu..." value="<?php echo set_value('txtMatKhau');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtMatKhau"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtXNMatKhau">Xác nhận MK <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="txtXNMatKhau" placeholder="Xác nhận mật khẩu..." value="<?php echo set_value('txtXNMatKhau');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtXNMatKhau"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="optLoaiTK">Loại tài khoản <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <label class="radio-inline"><input type="radio" name="optLoaiTK" value="2" 
                            <?php if(set_value('optLoaiTK')==2) echo "checked";?>>Gia sư</label>

                            <label class="radio-inline"><input type="radio" name="optLoaiTK" value="3" 
                            <?php if(set_value('optLoaiTK')==3) echo "checked";?>>Phụ huynh</label> 
                            <i class="text-danger"><?php echo form_error("optLoaiTK"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="optLoaiTK">Robot <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <div class="g-recaptcha" data-sitekey="6LeqwhYUAAAAAJu9fKPwbIMrYQAfMIJ6a9YC24DG"></div>
                        </div>
                    </div>

                    <div class="col-sm-8 pull-right">
                        <input type="submit" name="submit" class="btn btn-warning btn-lg" value="Hoàn tất & Đăng kí">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    </div>

    <?php $this->load->view("/layout/right_slidebar"); ?>

</div><!-- containter-->
