<?php if(!$this->session->userdata('a_login')) redirect(); ?>
<div class="container">

    <h2 class="text-lg"><span class="text-muted">Đổi mật khẩu </span></h2>
    <hr>
    <p>Vui lòng điền đầy đủ thông tin bên dưới.</p>
    <p><i><small>Các trường có dấu <span class="text-danger"><strong>(*)</strong></span> không thể bỏ trống</small></i></p>

    <?php
    if($this->session->flashdata('message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
    } ?>
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <form class="form-horizontal" action="<?php echo base_url(); ?>qlnhansu/changepass_ns" method="post">
    	<div class="row">
        
        <div class="col-md-12">

   		<div class="panel panel-primary">
	        <div class="panel-heading">Đổi mật khẩu tài khoản</div>

	        <div class="panel-body">
                <div class="form-group">
					<label class="col-lg-4 control-label" for="txtOldPass">Password hiện tại <span class="text-danger"><strong>(*)</strong></span></label>
					<div class="col-lg-8">
						<input type="password" name="txtOldPass" placeholder="Nhập mật khẩu hiện tại..." class="form-control" value="<?php echo set_value('txtOldPass');?>">
						<i class="text-danger"><?php echo form_error("txtOldPass"); ?></i>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-lg-4 control-label" for="txtNewPass">Password mới <span class="text-danger"><strong>(*)</strong></span></label>
					<div class="col-lg-8">
						<input type="password" name="txtNewPass" placeholder="Nhập mật khẩu mới..." class="form-control" value="<?php echo set_value('txtNewPass');?>">
						<i class="text-danger"><?php echo form_error("txtNewPass"); ?></i>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-lg-4 control-label" for="txtImportPass">Nhập lại Password mới <span class="text-danger"><strong>(*)</strong></span></label>
					<div class="col-lg-8">
						<input type="password" name="txtImportPass" placeholder="Nhập lại mật khẩu mới..." class="form-control" value="<?php echo set_value('txtImportPass');?>">
						<i class="text-danger"><?php echo form_error("txtImportPass"); ?></i>
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

  

</div><!-- containter-->