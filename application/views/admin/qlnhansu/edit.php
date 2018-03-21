
<?php //if(!$this->session->userdata('admin/login')) redirect(); ?>
<div class="container">

    <h2 class="text-lg"><span class="text-muted">Cập nhật</span> thông tin</h2>
    <hr>
    <p>Vui lòng điền đầy đủ thông tin bên dưới.</p>
    <p><i><small>Các trường có dấu <span class="text-danger"><strong>(*)</strong></span> không thể bỏ trống</small></i></p>

    <?php 
   $sql = "SELECT * FROM taikhoan t, nhansu n WHERE t.tk_id=n.ns_tk_id AND ns_tk_id = ".$this->uri->rsegment('3') ;
    	$nhansu = $this->db->query($sql)->row();
		
    if($this->session->flashdata('message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
    } 
    ?>

    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin tài khoản</div>
        <div class="panel-body">

            <div class="col-md-9">
                <form class="form-horizontal" action="<?php echo base_url(); ?>qlnhansu/editInfo_ns/<?php echo $nhansu->ns_tk_id ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtHinh">Hình ảnh </label>
                        <div class="col-lg-3">
                            <img src="<?php echo isset($nhansu) ? base_url().$nhansu->ns_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                            
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="txtEmail">Email </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="txtEmail"  value="<?php echo $nhansu->tk_email;?>" disabled/> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="txtPass">Quyền </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="txtQuyen"  value="<?php echo $nhansu->tk_quyen==-1 ? "Mod" : "Admin";?>" disabled/> 
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="txtPass">Trạng thái </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="txtTrangThai"  value="<?php echo $nhansu->ns_trangthai==0 ? "Ngừng hoạt động" : "Đang hoạt động";?>" disabled/> 
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
                            <input type="text" class="form-control" name="txtName" placeholder="Nhập họ tên..."  value="<?php echo empty(set_value('txtName')) && isset($nhansu) ? $nhansu->ns_hoten : set_value('txtName');?>" required/> 
                            <i class="text-danger"><?php echo form_error("txtName"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="optSex">Giới tính <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <label class="radio-inline"><input type="radio" name="optSex" value=1 
                                <?php 
                                $val = strlen((set_value('optSex')))==0 && isset($nhansu) ? $nhansu->ns_gioitinh : set_value('optSex'); 
                                if($val==1 && $val!="") echo "checked";?>>Nam
                            </label>

                            <label class="radio-inline"><input type="radio" name="optSex" value=0
                            <?php 
                                $val = strlen((set_value('optSex')))==0 && isset($nhansu) ? $nhansu->ns_gioitinh : set_value('optSex'); 
                                if($val==0 && $val!="") echo "checked";?>>Nữ 
                            </label>
                            <i class="text-danger"><?php echo form_error("optSex"); ?></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtPhone">Điện thoại <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="txtPhone" placeholder="Nhập số điện thoại..."  value="<?php echo empty(set_value('txtPhone')) && isset($nhansu) ? $nhansu->ns_dienthoai : set_value('txtPhone');?>" required/> 
                            <i class="text-danger"><?php echo form_error("txtPhone"); ?></i>
                        </div>
                    </div>

                   <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtDiaChi">Địa chỉ<span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="txtDiaChi" placeholder="Nhập địa chỉ..."  value="<?php echo empty(set_value('txtĐịachỉ')) && isset($nhansu) ? $nhansu->ns_diachi : set_value('txtĐịachỉ');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtDiaChi"); ?></i>
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
<script>
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });

    /*CKEDITOR.replace( 'description', {
        uiColor: '#cccccc',
        toolbar: [
                 [ 'Bold', 'Italic', ,'Underline', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
                 [ 'FontSize', 'TextColor', 'BGColor' ],
                 ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']
                 ]
    });*/
</script>