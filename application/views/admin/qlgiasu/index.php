<div class="container">

	<?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qlgiasu/delete_gs/<?php echo $gs_tk_id; ?>" method="POST">
			<div class="alert alert-block alert-danger">
				<h4>Cảnh báo xóa!</h4>
				<p>Nếu bạn xóa, hãy chắc chắn!
					<input type="submit" name="submit" class="btn btn-danger" value="Xóa">
					<a href="<?php echo base_url(); ?>qlgiasu/index"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
				</p>
			</div>
		</form>
		<?php
	} 
	?>

	<h2 class="text-center text-info">Danh sách các gia sư</h2>
	<div class="row">
		<div class="col-md-12 text-right">
			<a href="?page=qltuvien&act=add">
				<button type="button" class="btn btn-xs btn-success" value="Thêm mới"><span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm mới</button>
			</a>
		</div>
	</div>
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tài khoản</th>
				<th>Tên gia sư</th>
				<th>Giới</th>
				<th>Điện thoại</th>
				<th>Trình độ</th>
				<th>Thông tin lớp</th>
				<th>Trạng thái</th>
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//var_dump($giasu); 
            $offset=($this->uri->segment(2)=="index" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
            $limit= $this->m_admin->getPageSetting('admin');        
            $sql = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id ORDER BY gs_tk_id desc LIMIT $offset, $limit";
            $giasu = $this->db->query($sql)->result();
            //echo $this->db->last_query();  
             
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qlgiasu/index';
            $config['total_rows'] = $this->db->count_all('giasu');
            $config['uri_segment']  = 3; //Xác định phân đoạn chứa số trang
            $config['per_page'] = $limit;
            
            $this->pagination->initialize($config);
            $paginator=$this->pagination->create_links();  
			$i=0;
			foreach ($giasu as $giasu) { 
				$i++; ?>
				<tr>
					<?php
					if(empty($giasu->gs_hoten)) { ?>
						<td><?php echo (!empty($offset)) ? $i+$offset : $i; ?></td>
						<td><?php echo $giasu->tk_email; ?></td>
						<td colspan="4" class=" text-center"><b class="text-info">Tài khoản này chưa cập nhật thông tin cá nhân</b></td>
						<?php
					} //end if
					else { ?>
						<td><?php echo (!empty($offset)) ? $i+$offset : $i; ?></td>
						<td><?php echo $giasu->tk_email; ?></td>
						<td><?php echo $giasu->gs_hoten; ?></td>
						<td><?php echo $giasu->gs_gioitinh==0 ? "Nam" : "Nữ";  ?></td>
						<td><?php echo $giasu->gs_dienthoai; ?></td>
						<td><?php echo $giasu->gs_trinhdo; ?></td>
						<?php
					} //end else ?>

					<td><?php echo empty($giasu->gs_lop) ? "<b class=text-info>Chưa cập nhật</b>" : "<b class=text-success>Đã cập nhật</b>"; ?></td>
					<td><?php echo $giasu->gs_trangthai==0 ? "<b class=text-danger>Chưa active</b>" : "<b class=text-success>Đã active</b>"; ?></td>
					<td class="text-center">
						<a href="<?php echo base_url(); ?>qlgiasu/detail_gs/<?php echo $giasu->gs_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						<a href="<?php echo base_url(); ?>qlgiasu/edit/<?php //echo $row['tv_id']; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>
						<!-- <a href="?page=qltuvien&act=editimg&tv_id=<?php //echo $row['tv_id']; ?>">
							<button type="button" class="btn btn-xs btn-default" value="Ảnh"><span class="glyphicon glyphicon-picture"></span>&nbsp;Vị trí</button>
						</a> -->
						<a href="<?php echo base_url(); ?>qlgiasu/active_gs/<?php echo $giasu->gs_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-primary" value="Active" <?php echo  empty($giasu->gs_hoten) || empty($giasu->gs_lop) ? "disabled" : "";?>><span class="glyphicon glyphicon-star"></span>&nbsp;Active</button>
						</a>
						</a>
						<a href="<?php echo base_url(); ?>qlgiasu/delete_gs/<?php echo $giasu->gs_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-danger" value="Xóa"><span class="glyphicon glyphicon-remove"></span>&nbsp;Xóa</button>
						</a>
					</td>
				</tr> 
				<?php
			}//end for
			?>
			
		</tbody>
	</table>
    <!-- Pagination -->
    <div class="col-lg-12 text-center">
        <ul class="pagination">
            <li><?php echo $paginator; ?></li>   
        </ul>
    </div>

</div><!-- End container -->