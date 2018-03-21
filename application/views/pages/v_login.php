<div class="container">

    <h2 class="text-lg"><span class="text-muted">Đăng nhập</span> tài khoản</h2>
    <hr>
    <p>Vui lòng điền đầy đủ thông tin bên dưới.</p>
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
                <form class="form-horizontal" action="<?php echo base_url(); ?>home/login" method="post">

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="txtEmail">Email <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="txtEmail" placeholder="nhập email..."  value="<?php echo set_value('txtEmail');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtEmail"); ?></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="txtMatKhau">Mật khẩu <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="txtMatKhau" placeholder="nhập mật khẩu..." value=""/> 
                            <i class="text-danger"><?php echo form_error("txtMatKhau"); ?></i>
                        </div>
                    </div>

                    <div class="col-sm-7 pull-right">
                        <input type="submit" name="submit" class="btn btn-warning btn-lg" value="Đồng ý">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    </div>

    <?php $this->load->view("/layout/right_slidebar"); ?>

</div><!-- containter-->