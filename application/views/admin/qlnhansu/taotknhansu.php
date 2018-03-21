<div class="container">

    <h2 class="text-lg"><span class="text-muted">Tạo tài khoản quản trị </span> </h2>
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
    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin tài khoản</div>
        <div class="panel-body">
            <div class="col-md-12">
                <form class="form-horizontal" action="<?php echo base_url(); ?>qlnhansu/taotk_ns" method="post">

                    <div class="form-group">
                        <label class="col-lg-4 control-label" for="txtEmail">Username<span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="txtEmail" placeholder="Nhập email..."  value="<?php echo set_value('txtEmail');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtEmail"); ?></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label" for="txtPassword">Password <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" name="txtPassword" placeholder="Nhập mật khẩu..." value="<?php echo set_value('txtPassword');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtPassword"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label" for="txtImportPassword">Nhập lại Password <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" name="txtImportPassword" placeholder="Nhập lại mật khẩu..." value="<?php echo set_value('txtImportPassword');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtImportPassword"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label" for="optTKquyen">Tài khoản quyền <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-8">
                            <!--<label class="radio-inline"><input title="Toàn quyền quản trị hệ thống" type="radio" name="optTKquyen" value="1" 
                            <?php if(set_value('optTKquyen')==1) echo "checked";?>><span title="Toàn quyền quản trị hệ thống">Admin</span></label>-->

                            <label class="radio-inline"><input title="Quyền quản trị hạn chế" type="radio" name="optTKquyen" value="-1" 
                            <?php if(set_value('optTKquyen')==-1) echo "checked";?>><span title="Quyền quản trị hạn chế">Mod</span></label> 
                            <i class="text-danger"><?php echo form_error("optTKquyen"); ?></i>
                        </div>
                    </div>


                    <div class="col-sm-8 pull-right">
                        <input type="submit" name="submit" class="btn btn-warning btn-lg" value="Tạo tài khoản">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    </div>

    

</div><!-- containter-->
