<div class="container">

	<?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qllop/delete_ld/<?php echo $ld_id; ?>" method="POST">
			<div class="alert alert-block alert-danger">
				<h4>Cảnh báo xóa!</h4>
				<p>Nếu bạn xóa, hãy chắc chắn!
					<input type="submit" name="submit" class="btn btn-danger" value="Xóa">
					<a href="<?php echo base_url(); ?>qlpheduyet/pdlop/pheduyetlop"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
				</p>
			</div>
		</form>
		<?php
	} ?>

	<h2 class="text-center text-info">Danh sách các lớp đang chờ phê duyệt</h2>
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
				<th>Tên lớp</th>
				<th>Tên môn</th>
				<th>Lớp</th>
				<th>Người đăng</th>
				<!-- <th>Gia sư</th> -->
				<th>Trạng thái</th>
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//var_dump($lopday); 
          //  $offset=($this->uri->segment(2)=="pheduyetlop" && !empty($this->uri->segment(3))) ? $this->uri->segment(3) : 0;   //var_dump($offset); 
           // $limit= $this->m_admin->getPageSetting('admin');        
           // $sql = "SELECT * FROM lopday t, phuhuynh g WHERE t.ph_tk_id=g.ph_tk_id ORDER BY ld_id desc LIMIT $offset, $limit";
            //$lopday = $this->db->query($sql)->result();
            //echo $this->db->last_query();  
             
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qlpheduyet/pheduyetlop';
            $config['total_rows'] = $this->db->count_all('lopday');
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
			
			
				<!--	<?php
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
					?> -->
					


					<td><?php echo $lopday->ld_trangthai==0 ? "<b class=text-danger>Chưa duyệt</b>" : "<b class=text-success>Đã duyệt</b>"; ?></td>

					<td class="text-center">
						

									<?php if($this->session->userdata('a_login')->tk_quyen==-1){
							?>
									
						<a href="<?php echo base_url(); ?>qllop/detail_ld/<?php echo $lopday->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						<a href="<?php echo base_url(); ?>qllop/edit/<?php //echo $row['tv_id']; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>
					
						<a href="<?php echo base_url(); ?>qlpheduyet/pdactive_ld/<?php echo $lopday->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-primary" <?php echo $lopday->ld_trangthai==1 ? "disabled" : ''; ?>><span class="glyphicon glyphicon-star"></span>&nbsp;Duyệt</button>
						</a>
						

						
								

						<?php }
						
						else { ?>

							<a href="<?php echo base_url(); ?>qllop/detail_ld/<?php echo $lopday->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
						</a>
						<a href="<?php echo base_url(); ?>qllop/edit/<?php //echo $row['tv_id']; ?>">
							<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
						</a>
					
						<a href="<?php echo base_url(); ?>qlpheduyet/pdactive_ld/<?php echo $lopday->ld_id; ?>">
							<button type="button" class="btn btn-xs btn-primary" <?php echo $lopday->ld_trangthai==1 ? "disabled" : ''; ?>><span class="glyphicon glyphicon-star"></span>&nbsp;Duyệt</button>
						</a>
						
						<a href="<?php echo base_url(); ?>qllop/delete_ld/<?php echo $lopday->ld_id; ?>">
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