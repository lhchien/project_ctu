<div class="container">

	<?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qldangkylop/deletedk_ld/<?php echo $ld_id; ?>" method="POST">
			<div class="alert alert-block alert-danger">
				<h4>Cảnh báo xóa!</h4>
				<p>Nếu bạn xóa, hãy chắc chắn!
					<input type="submit" name="submit" class="btn btn-danger" value="Xóa">
					<a href="<?php echo base_url(); ?>qldangkylop/dangkylop_dk"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
				</p>
			</div>
		</form>
		<?php
	} ?>

	<h2 class="text-center text-info">Danh sách các lớp đang chờ phê duyệt</h2>

	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên lớp</th>
				<th>Tên môn</th>
				<th>Lớp</th>
				<th>Số học viên</th>
				<!-- <th>Gia sư</th> -->
				<th>Trạng thái</th>
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php 
	
             
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qldangkylop/dangkylop_dk';
			$sql1 = "SELECT * FROM lopday WHERE ld_id AND ld_trangthai=0";
             $num = $this->db->query($sql1)->result();
            $config['total_rows'] =  count($num);
            $config['uri_segment']  = 3; //Xác định phân đoạn chứa số trang
            $config['per_page'] = $limit;
            
            $this->pagination->initialize($config);
            $paginator=$this->pagination->create_links();  
			$i=0;
			foreach ($lopday as $lopday) { 
				$i++; ?>
				<tr>
					<td><?php echo (!empty($offset)) ? $i+$offset : $i; ?></td>
					<td><?php echo $lopday->ld_tieude; ?></td>
					<td><?php echo $lopday->ld_mon; ?></td>
					<td><?php echo $lopday->ld_khoilop;  ?></td>
					<td><?php echo $lopday->ld_soluong; ?></td>
			
					<td><?php echo $lopday->ld_trangthai==0 ? "<b class=text-danger>Chưa duyệt</b>" : "<b class=text-success>Đã duyệt</b>"; ?></td>

					<td class="text-center">
					


									<?php if($this->session->userdata('a_login')->tk_quyen==-1){
							?>
									
						<a target="_blank" href="<?php echo base_url(); ?>qldangkylop/detail_dk/<?php echo $lopday->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						<a target="_blank" href="<?php echo base_url(); ?>qllop/edit/<?php //echo $row['tv_id']; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>
					
						<a href="<?php echo base_url(); ?>qlpheduyet/pdactive_ld/<?php echo $lopday->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-primary" <?php echo $lopday->ld_trangthai==1 ? "disabled" : ''; ?>><span class="glyphicon glyphicon-star"></span>&nbsp;Duyệt</button>
						</a>
						

						
								

						<?php }
						
						else { ?>

							<a target="_blank" href="<?php echo base_url(); ?>qldangkylop/detail_dk/<?php echo $lopday->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						<a target="_blank" href="<?php echo base_url(); ?>qllop/edit/<?php //echo $row['tv_id']; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>
					
						<a href="<?php echo base_url(); ?>qldangkylop/active_ld/<?php echo $lopday->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-primary"  value="Active" <?php echo  (empty($lopday->ld_tieude) || empty($lopday->ld_mon) || empty($lopday->ld_khoilop)) ? "disabled" : "";?>><span class="glyphicon glyphicon-star"></span>&nbsp;Duyệt</button>
						</a>
						
						<a href="<?php echo base_url(); ?>qldangkylop/deletedk_ld/<?php echo $lopday->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-danger" value="Xóa"><span class="glyphicon glyphicon-remove"></span>&nbsp;delete</button>
						</a>
									

							<?php
						}


						?>
	



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