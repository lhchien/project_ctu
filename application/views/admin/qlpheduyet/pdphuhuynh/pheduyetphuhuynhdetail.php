<?php $this->load->view("/admin/v_header");?>
<div class="container">

    <h1 class="text-muted">Thông tin chi tiết phụ huynh</h1>
    <hr>
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="panel panel-primary">

        <div class="panel-heading">Thông tin tài khoản</div>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-lg-5">
                    <img src="<?php echo isset($phuhuynh) ? base_url().$phuhuynh->ph_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                    <h4 class="text-success text-center">
                    	<strong><?php echo ($phuhuynh->ph_hoten == "")?"Chưa cập nhật họ tên": $phuhuynh->ph_hoten; ?></strong>
                    </h4>
                    <table class="table">
                    
                    </table>
                </div>
                <div class="col-lg-7">
                    <table class="table">
                        	<tr>
                    		<td>Giới tính:</td>
                    		<td class="text-right"><strong><?php echo $phuhuynh->ph_gioitinh==0 ? "Nam" : "Nữ"; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Điện thoại:</td>
                    		<td class="text-right"><strong><?php echo ($phuhuynh->ph_dienthoai == "")?"Chưa cập nhật": $phuhuynh->ph_dienthoai; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Trình độ:</td>
                    		<td class="text-right"><strong><?php echo ($phuhuynh->ph_trinhdo == "")? "Chưa cập nhật": $phuhuynh->ph_trinhdo; ?></strong></td>
                    	</tr>
                            <tr>
                    		<td>Địa chỉ:</td>
                    		<td class="text-right"><strong><?php echo ($phuhuynh->ph_diadiem == "")? "Chưa cập nhật": $phuhuynh->ph_diadiem; ?></strong></td>
                    	</tr>
                    
                    </table>
                </div>
                
            
                
            </div>          

        </div>
    </div>

    </div> 

    </div>  -->

</div><!-- containter-->

