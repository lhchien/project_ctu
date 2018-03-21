<?php if(!$this->session->userdata('login')) redirect(); ?>
<div class="container">

    <h2 class="text-lg"><span class="text-muted">Đổi mật khẩu </span> Gia sư online</h2>
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
    <form class="form-horizontal" action="<?php echo base_url(); ?>home/changePass" method="post">
    	<div class="row">
        
        <div class="col-md-12">

   		<div class="panel panel-primary">
	        <div class="panel-heading">Đổi mật khẩu tài khoản</div>

	        <div class="panel-body">
                <div class="form-group">
					<label class="col-lg-3 control-label" for="txtMKCu">MK cũ <span class="text-danger"><strong>(*)</strong></span></label>
					<div class="col-lg-9">
						<input type="password" name="txtMKCu" placeholder="Nhập mật khẩu cũ..." class="form-control" value="<?php echo set_value('txtMKCu');?>">
						<i class="text-danger"><?php echo form_error("txtMKCu"); ?></i>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-lg-3 control-label" for="txtMKMoi">MK mới <span class="text-danger"><strong>(*)</strong></span></label>
					<div class="col-lg-9">
						<input type="password" name="txtMKMoi" placeholder="Nhập mật khẩu mới..." class="form-control" value="<?php echo set_value('txtMKMoi');?>">
						<i class="text-danger"><?php echo form_error("txtMKMoi"); ?></i>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-lg-3 control-label" for="txtXNMatKhau">Xác nhận MK<span class="text-danger"><strong>(*)</strong></span></label>
					<div class="col-lg-9">
						<input type="password" name="txtXNMatKhau" placeholder="Xác nhận mật khẩu mới..." class="form-control" value="<?php echo set_value('txtXNMatKhau');?>">
						<i class="text-danger"><?php echo form_error("txtXNMatKhau"); ?></i>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-lg-12 text-center">
                        <input type="submit" class="btn btn-primary" name="submit" value="Đồng ý">
                    </div>
				</div>
                
            </div><!-- end panel body -->

        </div>
        </div>
    	</div>
    </form>
    </div>

    <?php $this->load->view("/layout/right_slidebar"); ?>

</div><!-- containter-->