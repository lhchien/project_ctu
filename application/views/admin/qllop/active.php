<div class="container">

	<?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qllopday/delete_ld/<?php echo $ld_id; ?>" method="POST">
			<div class="alert alert-block alert-danger">
				<h4>Cảnh báo xóa!</h4>
				<p>Nếu bạn xóa, hãy chắc chắn!
					<input type="submit" name="submit" class="btn btn-danger" value="Xóa">
					<a href="<?php echo base_url(); ?>qllopday/active"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
				</p>
			</div>
		</form>
		<?php
	} ?>



	<!--Form tìm kiếm-->
	



	<h2 class="text-center text-info">Danh sách các lớp đang hoạt động</h2>


<div class="row">
				<div class="col-md-12 text-right">
					<form class="navbar-form navbar-right" role="search" method="post" action="">
  							<div class="form-group ">
    							<input name="key_mon" type="text" class="form-control" placeholder="Nhập tên môn cần tìm...">
 							
							 	<input name="key_lop" type="text" class="form-control" placeholder="Nhập tên lớp cần tìm...">
 								 <button type="submit" class="btn btn-primary" name="search_ld">Tìm kiếm</button> </div>
					</form>
				</div>
			</div>



	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên lớp</th>
				<th>Tên môn</th>
				<th>Lớp</th>
				<th>Số học viên</th>
				<th>Gia sư</th>
				<th>Trạng thái</th>
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php 
            //echo $this->db->last_query();  
             
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qllopday/active'; 
			$sql1 = "SELECT * FROM lopday l, dangky d WHERE l.ld_id = d.dk_ld_id AND ld_trangthai=1 AND dk_trangthai=1";
			$num = $this->db->query($sql1)->result();
            $config['total_rows'] = count($num);
            $config['uri_segment']  = 3; //Xác định phân đoạn chứa số trang
            $config['per_page'] = $limit;
            
            $this->pagination->initialize($config);
            $paginator=$this->pagination->create_links();  
			if( $limit != 0)
				$i= $offset ;
				else $i =0;
			foreach ($lopday as $lopday) { 
				$i++; ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $lopday->ld_tieude; ?></td>
					<td><?php echo $lopday->ld_mon; ?></td>
					<td><?php echo $lopday->ld_khoilop;  ?></td>
					<td><?php echo $lopday->ld_soluong; ?></td>
					<?php
					$sql1="SELECT * FROM dangky WHERE dk_ld_id=$lopday->ld_id AND dk_trangthai=1";
					$dangky = $this->db->query($sql1)->row(); //var_dump($dangky);
					if(!empty($dangky)){
						$sql2 = "SELECT gs_tk_id, gs_hoten FROM giasu WHERE gs_tk_id=$dangky->dk_gs_id";
						$giasu = $this->db->query($sql2)->row(); ?>
						<td class="text-info"><strong><?php echo $giasu->gs_hoten; ?></strong></td>
						<?php
					}
					else
						echo "<td class=text-danger>Chưa giao</td>";
					?>
					
					<td><?php echo $lopday->ld_trangthai==0 ? "<b class=text-danger>Chưa duyệt</b>" : "<b class=text-success>Đang hoạt động</b>"; ?></td>

					<td class="text-center">
					




							<?php if($this->session->userdata('a_login')->tk_quyen==-1){
							?>
									
							<a target="_blank" href="<?php echo base_url(); ?>qllopday/detail_ld/<?php echo $lopday->ld_id; ?>">
								<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
							</a>
							<a target="_blank" href="<?php echo base_url(); ?>qllopday/ktkheditInfo_ld/<?php echo $lopday->ld_id; ?>">
								<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
							</a>

						
								

						<?php }
						
						else { ?>

							<a target="_blank" href="<?php echo base_url(); ?>qllopday/detail_ld/<?php echo $lopday->ld_id; ?>">
								<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
							</a>
							<a target="_blank" href="<?php echo base_url(); ?>qllopday/ktkheditInfo_ld/<?php echo $lopday->ld_id; ?>">
								<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
							</a>
				
						
							<a href="<?php echo base_url(); ?>qllopday/delete_ld/<?php echo $lopday->ld_id; ?>">
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