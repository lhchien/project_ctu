<?php if(!$this->session->userdata('login')) redirect(); ?>
<div class="container">
    <div>
    <span class="pull-left">  
        <p class="text-lg"><span class="text-muted">Cập nhật</span> thông tin</p>
    </span>  
    <span class="pull-right">
        <p>Vui lòng điền đầy đủ thông tin bên dưới.</p>
        <p><i><small>Các trường có dấu (*) không thể bỏ trống</small></i></p>
    </span>
    </div>
    <div class="clear"></div>
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

    <div class="panel panel-primary">
        <div class="panel-heading"><h4>Thông tin tài khoản</h4></div>
        <div class="panel-body">
            <div class="col-md-9">
                <form class="form-horizontal" action="<?php echo base_url(); ?>Phuhuynh/changeInfo_ph" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtEmail">Hình ảnh </label>
                        <div class="col-lg-3">
                            <img src="<?php echo isset($phuhuynh) ? base_url().$phuhuynh->ph_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="txtEmail">Email </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="txtEmail"  value="<?php echo $this->session->userdata('login')->tk_email;?>" disabled/> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="txtPass">Trạng thái </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="txtTrangThai"  value="<?php echo $phuhuynh->ph_trangthai==0 ? "Chưa có hiệu lực - Đang chờ duyệt" : "Đã được duyệt";?>" disabled/> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="fileImg">Ảnh mới </label>
                                <div class="col-lg-9">
                                    <input type="file" class="form-control" name="fileImg"/> 
                                    <i class="text-danger"><?php echo form_error("fileImg"); ?></i>
                                </div>
                            </div>
                        </div>

                    </div>

                    

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtName">Họ tên <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="txtName" placeholder="nhập họ tên..."  value="<?php echo empty(set_value('txtName')) && isset($phuhuynh) ? $phuhuynh->ph_hoten : set_value('txtName');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtName"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="optSex">Giới tính <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <label class="radio-inline"><input type="radio" name="optSex" value=0 
                                <?php 
                                $val = strlen((set_value('optSex')))==0 && isset($phuhuynh) ? $phuhuynh->ph_gioitinh : set_value('optSex'); 
                                if($val==0 && $val!="") echo "checked";?>>Nam
                            </label>

                            <label class="radio-inline"><input type="radio" name="optSex" value=1
                            <?php 
                                $val = strlen((set_value('optSex')))==0 && isset($phuhuynh) ? $phuhuynh->ph_gioitinh : set_value('optSex'); 
                                if($val==1 && $val!="") echo "checked";?>>Nữ 
                            </label>
                            <i class="text-danger"><?php echo form_error("optSex"); ?></i>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtPhone">Điện thoại <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="txtPhone" placeholder="nhập số điện thoại..."  value="<?php echo empty(set_value('txtPhone')) && isset($phuhuynh) ? $phuhuynh->ph_dienthoai : set_value('txtPhone');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtPhone"); ?></i>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtName">Địa chỉ: <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="txtAddress" placeholder="nhập địa chỉ..."  value="<?php echo empty(set_value('txtAddress')) && isset($phuhuynh) ? $phuhuynh->ph_diadiem : set_value('txtAddress');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtAddress"); ?></i>
                        </div>
                    </div>

                    <div class="col-sm-8 pull-right">
                        <input type="submit" name="submit" class="btn btn-warning btn-lg" value="Đồng ý">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

</div><!-- containter-->
