
<?php //if(!$this->session->userdata('admin/login')) redirect(); ?>
<div class="container">

    <h2 class="text-lg"><span class="text-muted">Cập nhật</span> thông tin</h2>
    <hr>
    <p>Vui lòng điền đầy đủ thông tin bên dưới.</p>
    <p><i><small>Các trường có dấu <span class="text-danger"><strong>(*)</strong></span> không thể bỏ trống</small></i></p>

    <?php
        $sql = "SELECT * FROM taikhoan t, phuhuynh p, lopday l, dangky d, giasu g WHERE t.tk_id =p.ph_tk_id AND p.ph_tk_id=l.ph_tk_id AND l.ld_id=d.dk_ld_id AND d.dk_gs_id = g.gs_tk_id AND ld_trangthai = 1 AND dk_trangthai = 1 AND l.ld_id = ".$this->uri->rsegment('3') ;
    	
        $lopday = $this->db->query($sql)->row();
    if($this->session->flashdata('message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
    } 
    ?>

    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin lớp dạy đang hoạt động</div>
        <div class="panel-body">
            <div class="col-md-11">
                <form class="form-horizontal" action="<?php echo base_url(); ?>qllopday/editInfo_ld/<?php echo $lopday->ld_id ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtHinh">Hình ảnh </label>
                        <div class="col-lg-3">
                            <img src="<?php echo isset($lopday) ? base_url().$lopday->ld_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                        </div>

                       <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-6 control-label" for="txtHotenph">Tài khoản phụ huynh </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="txtHoten"  value="<?php echo $lopday->tk_email;?>" disabled/> 
                                </div>
                            </div>
                        </div>

                         <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-6 control-label" for="txtHotenph">Phụ huynh </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="txtHoten"  value="<?php echo $lopday->ph_hoten;?>" disabled/> 
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-6 control-label" for="txtHotengs">Gia sư </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="txtHoten"  value="<?php echo $lopday->gs_hoten;?>" disabled/> 
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-6 control-label" for="txtPass">Trạng thái lớp học </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="txtTrangThai"  value="<?php echo $lopday->ld_trangthai==0 ? "Chưa có hiệu lực - Đang chờ duyệt" : "Đã được duyệt";?>" disabled/> 
                                </div>
                            </div>
                        </div>

                

                    </div>

                     <div class="form-group">
                        <label class="col-lg-3 control-label" for="fileImg">Ảnh mới </label>
                       <div class="col-lg-4">
                                    <input type="file" class="form-control" name="fileImg"/> 
                                    <i class="text-danger"><?php echo form_error("fileImg"); ?></i>
                                </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtTieude">Tiêu đề <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="txtTieude" placeholder="Nhập tiêu đề..."  value="<?php echo empty(set_value('txtTieude')) && isset($lopday) ? $lopday->ld_tieude : set_value('txtTieude');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtTieude"); ?></i>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtMon">Môn <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="txtMon" placeholder="Nhập tên môn..."  value="<?php echo empty(set_value('txtMon')) && isset($lopday) ? $lopday->ld_mon : set_value('txtMon');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtMon"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtSoluong">Số lượng học viên <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="txtSoluong" placeholder="Nhập số lượng học viên..."  value="<?php echo empty(set_value('txtSoluong')) && isset($lopday) ? $lopday->ld_soluong : set_value('txtSoluong');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtSoluong"); ?></i>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtBuoi">Buổi dạy <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                           <input type="text" class="form-control" name="txtBuoi" placeholder="Nhập buổi dạy..."  value="<?php echo empty(set_value('txtBuoi')) && isset($lopday) ? $lopday->ld_buoiday : set_value('txtBuoi');?>"/>
                            <i class="text-danger"><?php echo form_error("txtBuoi"); ?></i>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtGio">Giờ dạy <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                           <input type="text" class="form-control" name="txtGio" placeholder="Nhập giờ dạy..."  value="<?php echo empty(set_value('txtGio')) && isset($lopday) ? $lopday->ld_thoigian : set_value('txtGio');?>"/>
                            <i class="text-danger"><?php echo form_error("txtGio"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtDiachi">Địa chỉ </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="txtDiachi" placeholder="Nhập địa chỉ..."  value="<?php echo empty(set_value('txtDiachi')) && isset($lopday) ? $lopday->ld_mota_diadiem : set_value('txtDiachi');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtDiachi"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="description">Yêu cầu </label>
                        <div class="col-lg-9">
                            <textarea name="description" id="description" class="form-control"><?php echo empty(set_value('description')) && isset($lopday) ? $lopday->ld_yeucau : set_value('description'); ?></textarea>
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

</script>