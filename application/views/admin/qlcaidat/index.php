<div class="container">
<?php if($this->session->flashdata('a_message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('a_message'); ?>
        </div>
        <?php
    } 
?>
<h2 class="text-center text-info">Danh mục cài đặt</h2>
<table width="100%" border="1" cellpadding="5" class="table table-striped table-hover table-bordered">
	<thead>  
    <tr>
		<th>Số TT</th>
        <th>Tên loại</th>
		<th>Mô tả</th>
		<th>Số dòng dữ liệu</th>
        <th>Sửa</th>
		<th>Đồng ý</th>
    </tr>
	</thead>
	<?php	
	// $sql = "SELECT * FROM caidat";
	// $rs=mysqli_query($con, $sql);
	// if(!$rs) die("Lỗi truy vấn CSDL!");
	$i=1;
	foreach ($setting as $setting) {
	?>
	<form method="POST" action="<?php echo base_url(); ?>admin/setting/<?php echo $setting->cd_ma; ?>">
		<tr>
			<td class="cotSTT"><?php echo $i; ?></td>
            <td><?php echo $setting->cd_ten; ?></a></td>
			<td><?php echo $setting->cd_mota; ?></td>
			<td style="text-align: center">
				<input type="number" value='<?php echo $setting->cd_trang; ?>' name="txtTrang" disabled id="txtTrang<?php echo $setting->cd_ma; ?>" class="txtTrang">
			</td>
            <td align='center'>
				<input type="radio" name="chkDongY" class="chkDongY" stt="<?php echo $setting->cd_ma; ?>" id="chkDongY<?php echo $setting->cd_ma; ?>" />
				<input type="hidden" name="ma" value="<?php echo $setting->cd_ma; ?>">
			</td>
            <td align='center'>
				<a href="<?php echo base_url(); ?>admin/setting/<?php echo $setting->cd_ma; ?>">
				<button  type="submit" name="btnDangKy" class="btn btn-xs btn-success btnDangKy" id="btnDangKy<?php echo $setting->cd_ma; ?>" disabled><span class="glyphicon glyphicon-remove"></span>&nbsp;Đồng ý</button>
				</a>
			</td>
        </tr>
		</form>
        <?php
		$i++;
	}
	?>
</table>
</div>

