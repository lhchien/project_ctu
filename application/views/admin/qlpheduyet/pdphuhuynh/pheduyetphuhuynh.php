<div class="container">
	<?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qlpheduyet/deletepheduyet_ph/<?php echo $ph_tk_id; ?>" method="POST">
			<div class="alert alert-block alert-danger">
				<h4>Cảnh báo xóa!</h4>
				<p>Nếu bạn xóa, hãy chắc chắn!
					<input type="submit" name="submit" class="btn btn-danger" value="Xóa">
					<a href="<?php echo base_url(); ?>qlpheduyet/pdphuhuynh/pheduyetphuhuynh"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
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
	<h2 class="text-center text-info">Danh sách các phụ huynh đang chờ phê duyệt</h2>
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr >
				<th class="text-center">STT</th>
				<th class="text-center">Tài khoản</th>
				<th class="text-center">Tên phụ huynh</th>
				<th class="text-center">Địa chỉ</th>
				<th class="text-center">Giới tính</th>
				<th class="text-center">Số điện thoại</th>				
				
				<th class="text-center">Trình độ</th>
				<th class="text-center">Trạng thái</th>
				
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//var_dump($giasu);
			   
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qlpheduyet/pheduyetphuhuynh';
            $sql1 = "SELECT * FROM taikhoan t, phuhuynh p WHERE t.tk_id=p.ph_tk_id AND ph_trangthai=0";
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
			foreach ($phuhuynh as $phuhuynh) { 
				$i++; ?>
				
				<tr class="text-center">
				<?php
					if(empty($phuhuynh->ph_hoten)) { ?>
						<td><?php echo (!empty($offset)) ? $i+$offset : $i; ?></td>
						<td><?php echo $phuhuynh->tk_email; ?></td>
						
						<td><?php echo ($phuhuynh->ph_hoten =="")?"<b class=text-info>Chưa cập nhật</b>":$phuhuynh->ph_hoten; ?></td>
						<td><?php  echo($phuhuynh->ph_diadiem =="")?"<b class=text-info>Chưa cập nhật</b>":$phuhuynh->ph_diadiem; ?></td>
						<td colspan="3" class=" text-center"><b class="text-info">Tài khoản chưa cập nhật thông tin cá nhân</b></td>
						<?php
					} //end if

					else{ ?>
					<td><?php echo (!empty($offset)) ? $i+$offset : $i; ?></td>
					<td><?php echo $phuhuynh->tk_email; ?></td>
					
					<td><?php echo $phuhuynh->ph_gioitinh==0 ? "Nam" : ($phuhuynh->ph_gioitinh==1 ? "Nữ" : "NULL");  ?></td>
					<td><?php echo $phuhuynh->ph_dienthoai; ?></td>
					
					<td><?php echo $phuhuynh->ph_trinhdo; ?></td>
					<?php
					} ?>
					<td><?php echo $phuhuynh->ph_trangthai==0 ? "<b class=text-danger>Chưa duyệt</b>" : "<b class=text-success>Active</b>"; ?></td>
	
					<td>
					


						<?php if($this->session->userdata('a_login')->tk_quyen==-1){
							?>
					<a target="_blank" href="<?php echo base_url(); ?>qlpheduyet/pheduyetdetail_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						<a target="_blank" href="<?php echo base_url(); ?>qlpheduyet/pheduyeteditInfo_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>
							<a href="<?php echo base_url(); ?>qlpheduyet/pdactive_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-primary" value="Active" ><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Active</button>
						</a>
						
								

						<?php }
						
						else { ?>
						<a target="_blank" href="<?php echo base_url(); ?>qlpheduyet/pheduyetdetail_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						<a target="_blank" href="<?php echo base_url(); ?>qlpheduyet/pheduyeteditInfo_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>
							<a href="<?php echo base_url(); ?>qlpheduyet/pdactive_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-primary" value="Active" <?php echo  empty($phuhuynh->ph_hoten)|| empty($phuhuynh->ph_diachi) ? "disabled" : "";?> ><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Active</button>
						</a>
						<a href="<?php echo base_url(); ?>qlpheduyet/deletepheduyet_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-danger" value="Xóa"><span class="glyphicon glyphicon-remove"></span>&nbsp;delete</button>
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