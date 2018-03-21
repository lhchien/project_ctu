<div class="container">

	<?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qlphuhuynh/delete_gs/<?php echo $ph_tk_id; ?>" method="POST">
			<div class="alert alert-block alert-danger">
				<h4>Cảnh báo xóa!</h4>
				<p>Nếu bạn xóa, hãy chắc chắn!
					<input type="submit" name="submit" class="btn btn-danger" value="Xóa">
					<a href="<?php echo base_url(); ?>qlphuhuynh/index"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
				</p>
			</div>
		</form>
		<?php
	} ?>

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
				<th>Giới tính</th>
				<th>Điện thoại</th>
				<th>Trình độ</th>
				<!-- <th>Chuyên ngành</th> -->
				<th>Trạng thái</th>
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//var_dump($phuhuynh); 
            $offset=(empty($this->uri->segment(3))) ? 0 : $this->uri->segment(3);   //var_dump($offset); 
            $limit= $this->m_admin->getPageSetting('admin');        
            $sql = "SELECT * FROM taikhoan t, phuhuynh g WHERE t.tk_id=g.ph_tk_id ORDER BY ph_tk_id desc LIMIT $offset, $limit";
            $phuhuynh = $this->db->query($sql)->result();
            //echo $this->db->last_query();  
             
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qlphuhuynh/index';
            $config['total_rows'] = $this->db->count_all('phuhuynh');
            $config['uri_segment']  = 3; //Xác định phân đoạn chứa số trang
            $config['per_page'] = $limit;
            
            $this->pagination->initialize($config);
            $paginator=$this->pagination->create_links();  
			$i=0;
			foreach ($phuhuynh as $phuhuynh) { 
				$i++; ?>
				<tr>
					<?php
					if(empty($phuhuynh->ph_hoten)) { ?>
						<td><?php echo (!empty($offset)) ? $i+$offset : $i; ?></td>
						<td><?php echo $phuhuynh->tk_email; ?></td>
						<td colspan="5" class=" text-center"><b class="text-info">Tài khoản này chưa cập nhật Thông Tin</b></td>
						<?php
					} //end if
					else { ?>
						<td><?php echo (!empty($offset)) ? $i+$offset : $i; ?></td>
						<td><?php echo $phuhuynh->tk_email; ?></td>
						<td><?php echo $phuhuynh->ph_hoten; ?></td>
						<td><?php echo $phuhuynh->ph_gioitinh==0 ? "Nam" : "Nữ";  ?></td>
						<td><?php echo $phuhuynh->ph_dienthoai; ?></td>
						<td><?php echo $phuhuynh->ph_trinhdo; ?></td>
						<!-- <td><?php echo $phuhuynh->ph_chuyennganh; ?></td> -->
						<td><?php echo $phuhuynh->ph_trangthai==0 ? "<b class=text-danger>Chưa active</b>" : "<b class=text-success>Đã active</b>"; ?></td>
						<?php
					} //end else ?>

					<td class="text-center">
						<a href="<?php echo base_url(); ?>qlphuhuynh/detail_gs/<?php echo $phuhuynh->ph_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						<a href="<?php echo base_url(); ?>qlphuhuynh/edit/<?php //echo $row['tv_id']; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>
						<a href="?page=qltuvien&act=editimg&tv_id=<?php //echo $row['tv_id']; ?>">
							<button type="button" class="btn btn-xs btn-primary" value="Ảnh"><span class="glyphicon glyphicon-picture"></span>&nbsp;Vị trí</button>
						</a>
						<a href="<?php echo base_url(); ?>qlphuhuynh/active_gs/<?php echo $phuhuynh->ph_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-default" value="Active" <?php echo  empty($phuhuynh->ph_hoten) ? "disabled" : "";?>><span class="glyphicon glyphicon-star"></span>&nbsp;Active</button>
						</a>
						</a>
						<a href="<?php echo base_url(); ?>qlphuhuynh/delete_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-danger" value="Xóa"><span class="glyphicon glyphicon-remove"></span>&nbsp;delete</button>
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