<div class="container">
	<h2 class="text-center text-info">Danh sách các lớp ngừng hoạt động</h2>
	<table class="table table-striped table-hover table-bordered">

		<thead>
			<tr>
				<th>STT</th>
				<th>Tiêu đề</th>
				<th>Môn</th>
				<th>Khối lớp</th>
				<th>Số lượng</th>
				<th>Yêu cầu</th>
				<th>Buổi dạy</th>
				<th>Thời gian</th>
				<th>Trạng thái</th>
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php 
		
			$i=0;
			foreach ($lop as $lop) { 
				$i++; ?>
				
				<tr class="text-center">
					<td><?php echo $i; ?></td>
					<td><?php echo $lop->ld_tieude; ?></td>
					<td><?php echo $lop->ld_mon ?></td>
					<td><?php echo $lop->ld_khoilop; ?></td>
					<td><?php echo $lop->ld_soluong; ?></td>
					<td><?php echo $lop->ld_yeucau; ?></td>
					<td><?php echo $lop->ld_buoiday; ?></td>
					<td><?php echo $lop->ld_thoigian; ?></td>
					<td><?php echo $lop->ld_trangthai==0 ? "<b class=text-danger>Chưa active</b>" : "<b class=text-success>Active</b>"; ?></td>
					<td>
						<a href="<?php echo base_url(); ?>qllop/map/<?php echo $lop->ld_mota_diadiem; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Vị trí</button>
						</a>
						<a href="<?php echo base_url(); ?>qllop/editInfo_lop/<?php echo $lop->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>
						<a href="<?php echo base_url(); ?>admin/delete_lop/<?php echo $lop->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-danger" value="Xóa"><span class="glyphicon glyphicon-remove"></span>&nbsp;delete</button>
						</a>
					</td>
				</tr> 
				<?php
			}
			?>
			
		</tbody>
	</table>
	<!-- Pagination -->
    <center>
    <ul class="pagination">
        <li><a href="#">&laquo;</a></li>
        <li class="active"><a href="#">1</a></li>
        <li ><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">&raquo;</a></li>
    </ul>
    </center>

</div><!-- End container -->