<div class="container">

  <?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qlnhansu/delete_ns/<?php echo $ns_tk_id; ?>" method="POST">
			<div class="alert alert-block alert-danger">
				<h4>Cảnh báo xóa!</h4>
				<p>Nếu bạn xóa, hãy chắc chắn!
					<input type="submit" name="submit" class="btn btn-danger" value="Xóa">
					<a href="<?php echo base_url(); ?>qlnhansu/active"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
				</p>
			</div>
		</form>
		<?php
	} 
	 if($this->session->flashdata('a_message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('a_message'); ?>
        </div>
        <?php
    } 
    ?>
	<h2 class="text-center text-info">Danh sách nhân sự quản trị</h2>


	<?php if($this->session->userdata('a_login')->tk_quyen==1){ ?>


			<div class="row">
				<div class="col-md-12 text-right">
					<a target="_blank" href="<?php echo base_url(); ?>qlnhansu/taotk_ns">
						<button type="button" class="btn btn-xs btn-success" value="Thêm mới"><span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm mới</button>
					</a>
				</div>
			</div>
 	<?php }
	 	 ?>


	
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr >
				<th class="text-center">STT</th>
				<th class="text-center">Tên tài khoản</th>
				<th class="text-center">Họ tên</th>
				<th class="text-center">Quyền quản trị</th>
				<th class="text-center">Trạng thái</th>
				<th class="text-center">Tùy chọn</th>
				
			</tr>
		</thead>
		<tbody>
			<?php 
			   
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qlnhansu/active';		
            $sql1 = "SELECT * FROM taikhoan t, nhansu n WHERE t.tk_id=n.ns_tk_id AND ns_trangthai=1";
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
			foreach ($nhansu as $nhansu) { 
				$i++; ?>
				
				<tr class="text-center">
					<td><?php echo $i; ?></td>
					<td><?php echo $nhansu->tk_email; ?></td>
					<td><?php echo ($nhansu->ns_hoten == "")?"<strong>Chưa cập nhật họ tên</strong>": $nhansu->ns_hoten; ?></td>
					<td><?php echo ($nhansu->tk_quyen==1)? "<b class=text-danger>Admin</b>": (($nhansu->tk_quyen==-1) ? "<b class=text-info>Mod</b>": ""); ?></td>
					<td><?php echo $nhansu->tk_trangthai==0 ? "<b class=text-danger>Chưa active</b>" : "<b class=text-success>Đang hoạt động</b>"; ?></td>
					<td class="text-center">
						
                                   <!-- Phân quyền nếu quyền = -1 "Mod" thì chỉ show ra "xem"-->
						<?php if($this->session->userdata('a_login')->tk_quyen==-1){
							?>
									
						<a target="_blank" href="<?php echo base_url(); ?>qlnhansu/detail_ns/<?php echo $nhansu->ns_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						
						                 <!-- Trong quyền Mod  hiển thị sửa của Mod -->
									<!--<?php if($nhansu->tk_quyen==-1){ ?>

									<a target="_blank" href="<?php echo base_url(); ?>qlnhansu/editInfo_ns/<?php echo $nhansu->ns_tk_id; ?>">
										<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
									</a>
									 <?php }
									?>-->

						<?php }
						// nếu quyền quản trị = 1 "Admin" thì show toàn bộ " Xem, Sửa, "
						else { ?>

							<a target="_blank" href="<?php echo base_url(); ?>qlnhansu/detail_ns/<?php echo $nhansu->ns_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
							</a>
										
							<a target="_blank" href="<?php echo base_url(); ?>qlnhansu/editInfo_ns/<?php echo $nhansu->ns_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
							</a>

                                            <!-- trong quyền admin chỉ hiện ra "xóa" của thằng tài khoản có quyền =-1 "Mod" -->
									<?php if($nhansu->tk_quyen==-1){ ?>

									
										<a href="<?php echo base_url(); ?>qlnhansu/delete_ns/<?php echo $nhansu->ns_tk_id; ?>">
											<button type="button" class="btn btn-xs btn-danger" value="Xóa"><span class="glyphicon glyphicon-remove"></span>&nbsp;delete</button>
										</a>
							 		<?php }
									?>

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