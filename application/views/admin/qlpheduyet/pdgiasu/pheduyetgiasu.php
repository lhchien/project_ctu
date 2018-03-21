<div class="container">

	<?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qlpheduyet/deletepheduyet_gs/<?php echo $gs_tk_id; ?>" method="POST">
			<div class="alert alert-block alert-danger">
				<h4>Cảnh báo xóa!</h4>
				<p>Nếu bạn xóa, hãy chắc chắn!
					<input type="submit" name="submit" class="btn btn-danger" value="Xóa">
					<a href="<?php echo base_url(); ?>qlpheduyet/pheduyetgiasu"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
				</p>
			</div>
		</form>
		<?php
	} 
	?>

	<h2 class="text-center text-info">Danh sách các gia sư đang chờ phê duyệt</h2>
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tài khoản</th>
				<th>Tên gia sư</th>
				<th>Giới tính</th>
				<th>Trình độ</th>
				<th>Chuyên ngành</th>
				<th>Công việc</th>
				<th>Trạng thái</th>
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			
			
			<?php      
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qlpheduyet/pheduyetgiasu';
            $sql1 = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id AND gs_trangthai=0";
            $num = $this->db->query($sql1)->result(); //var_dump(count($num));
            $config['total_rows'] = count($num);
            $config['uri_segment']  = 3; //Xác định phân đoạn chứa số trang
            $config['per_page'] = $limit;
            //echo $offset;
            $this->pagination->initialize($config);
            $paginator=$this->pagination->create_links();  
			if( $limit != 0)
				$i= $offset ;
				else $i =0;
            foreach ($giasu as $giasu) { 
				$i++;
                 ?> 
		    <tr>     
				
			<?php
					if(empty($giasu->gs_hoten)) { ?>
						<td><?php echo (!empty($offset)) ? $i+$offset : $i; ?></td>
						<td><?php echo $giasu->tk_email; ?></td>
						<td colspan="5" class=" text-center"><b class="text-info">Tài khoản này chưa cập nhật thông tin cá nhân</b></td>
						<?php
					} //end if
					else { ?>
						<td><?php echo (!empty($offset)) ? $i+$offset : $i; ?></td>
						<td><?php echo $giasu->tk_email; ?></td>
						<td><?php echo $giasu->gs_hoten; ?></td>
						<td><?php echo $giasu->gs_gioitinh==0 ? "Nam" : ($giasu->gs_gioitinh==1 ? "Nữ" : "NULL");  ?></td>
						<td><?php echo $giasu->gs_trinhdo; ?></td>
						<td><?php echo $giasu->gs_chuyennganh; ?></td>
						<td><?php echo ($giasu->gs_congviec == "")?"<span class= text-info><strong>Chưa cập nhật</strong></span>": $giasu->gs_congviec; ?></td>
						<?php
					} //end else ?>
						
					
					<td><?php echo $giasu->gs_trangthai==0 ? "<b class=text-danger>Chưa duyệt</b>" : "<b class=text-success>Active</b>"; ?></td>
					<td class="text-center">
					

						
							<?php if($this->session->userdata('a_login')->tk_quyen==-1){
							?>
									
					<a target="_blank" href="<?php echo base_url(); ?>qlpheduyet/pheduyetdetail_gs/<?php echo $giasu->gs_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						<!--<a target="_blank" href="<?php echo base_url(); ?>qlgiasu/editInfo_gs/<?php echo $giasu->gs_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>-->
						<a href="<?php echo base_url(); ?>qlpheduyet/pdactive_gs/<?php echo $giasu->gs_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-primary" value="Active" <?php echo  empty($giasu->gs_hoten) || empty($giasu->gs_trinhdo) || empty($giasu->gs_chuyennganh) ? "disabled" : "";?>><span class="glyphicon glyphicon-star"></span>&nbsp;Active</button>
						</a>	

						
								

						<?php }
						
						else { ?>

								<a target="_blank" href="<?php echo base_url(); ?>qlpheduyet/pheduyetdetail_gs/<?php echo $giasu->gs_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						<!--<a target="_blank" href="<?php echo base_url(); ?>qlgiasu/editInfo_gs/<?php echo $giasu->gs_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>-->
						<a href="<?php echo base_url(); ?>qlpheduyet/pdactive_gs/<?php echo $giasu->gs_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-primary" value="Active" <?php echo  empty($giasu->gs_hoten) || empty($giasu->gs_trinhdo) || empty($giasu->gs_chuyennganh) ? "disabled" : "";?>><span class="glyphicon glyphicon-star"></span>&nbsp;Active</button>
						</a>
						
						<a href="<?php echo base_url(); ?>qlpheduyet/deletepheduyet_gs/<?php echo $giasu->gs_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-danger" value="Xóa"><span class="glyphicon glyphicon-remove"></span>&nbsp;Xóa</button>
						</a>
									

							<?php
						}


						?>
	



					</td>
				</tr> 
				<?php
			}
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