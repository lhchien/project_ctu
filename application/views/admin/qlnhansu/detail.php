<?php $this->load->view("/admin/v_header");?>
<div class="container">

    <h1 class="text-muted">Thông tin chi tiết nhân viên</h1>
    <hr>
    <?php
    if( empty($nhansu) ){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo "Không có thông tin!"; ?>
        </div>
        <?php
    } 
    else {?>
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="panel panel-primary">

        <div class="panel-heading">Thông tin tài khoản</div>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-lg-4">
                    <img height="150" width="150" src="<?php echo isset($nhansu) ? base_url().$nhansu->ns_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                                     
                </div>
                <div class="col-lg-8">
                    <table class="table">
                    
                    	<tr>                      
                    		</br><td>Quyền quản trị:</td>                                           		
                            <td class="text-right"><strong><?php echo ($nhansu->tk_quyen==1)? "<b class=text-danger>Admin</b>": (($nhansu->tk_quyen==-1) ? "<b class=text-info>Mod</b>": ""); ?></strong></td>
                        </tr>
                        <tr>
                    		<td>Họ tên:</td>
                    		<td class="text-right"><strong><?php echo ($nhansu->ns_hoten == "")?"Chưa cập nhật họ tên": $nhansu->ns_hoten; ?></strong></td>
                    	</tr>
                        <tr>
                    		<td>Giới tính:</td>
                    		<td class="text-right"><strong><?php echo ($nhansu->ns_gioitinh==0) ? "Nam" : (($nhansu->ns_gioitinh==1) ? "Nữ" : "<b>Chưa cập nhật</b>"); ?></strong></td>
                    	</tr>
                        <tr>
                    		<td>Điện thoại:</td>
                    		<td class="text-right"><strong><?php echo ($nhansu->ns_dienthoai =="")?"Chưa cập nhật số điện thoại": $nhansu->ns_dienthoai; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Địa chỉ:</td>
                    		<td class="text-right"><strong><?php echo ($nhansu->ns_diachi == "")?"Chưa cập nhật địa chỉ": $nhansu->ns_diachi; ?></strong></td>
                    	</tr>
                    	
                    </table>
                </div>
                
                <?php } ?>
                
            </div>          

        </div>
    </div>


    <style>
    panel panel-primary panel-body {
        color:#FFF !important;
        background-color:#337ab7 !important;
    }
    </style>
    
     </div> 

</div><!-- containter-->

