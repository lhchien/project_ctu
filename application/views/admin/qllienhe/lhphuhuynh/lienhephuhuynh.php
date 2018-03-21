<div class="container">

	<?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qlgiasu/deleteactive_gs/<?php echo $gs_tk_id; ?>" method="POST">
			<div class="alert alert-block alert-danger">
				<h4>Cảnh báo xóa!</h4>
				<p>Nếu bạn xóa, hãy chắc chắn!
					<input type="submit" name="submit" class="btn btn-danger" value="Xóa">
					<a href="<?php echo base_url(); ?>qlgiasu/active"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
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

	<h2 class="text-center text-info">Danh sách các liên hệ của phụ huynh</h2>
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Ngày gửi</th>
				<th>Giờ gửi</th>
				<th>Tài khoản</th>
				<th>Tên phụ huynh</th>
                <th>Tiêu đề</th>
				<th>Trạng thái của phụ huynh</th>
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//var_dump($giasu);

              
            //echo $this->db->last_query();  
             
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qllienhe/lienhephuhuynh';
            $sql1 = "SELECT * FROM lienhe l, taikhoan t, phuhuynh p WHERE l.lh_tk_id = t.tk_id AND t.tk_id=p.ph_tk_id";
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
            foreach ($lienhe as $lienhe) { 
				$i++;
                 ?>

				<tr class="text-center">
					<td><?php echo $i; ?></td>
					<td><?php echo $lienhe->lh_ngay; ?></td>
					<td><?php echo $lienhe->lh_gio; ?></td>
					<td><?php echo $lienhe->tk_email; ?></td>
					<td><?php echo $lienhe->ph_hoten; ?></td>
					<td><?php echo $lienhe->lh_tieude; ?></td>
					<td><?php echo $lienhe->ph_trangthai==0 ? "<b class=text-danger>Chưa active</b>" : (  $lienhe->ph_trangthai==1 ? "<b class=text-success>Active</b>" : "<b class=text-success>Block</b>"); ?></td>
					<td class="text-center">
					

						
									<?php if($this->session->userdata('a_login')->tk_quyen==-1){
							?>
									
					<a target="_blank" href="<?php echo base_url(); ?>qllienhe/phuhuynhnoidung_lh/<?php echo $lienhe->lh_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-retweet"></span>&nbsp;Nội dung</button>
						</a>

						
								

						<?php }
						
						else { ?>

						<a target="_blank" href="<?php echo base_url(); ?>qllienhe/phuhuynhnoidung_lh/<?php echo $lienhe->lh_tk_id; ?>">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-retweet"></span>&nbsp;Nội dung</button>
						</a>
						<a href="<?php echo base_url(); ?>qlgiasu/deleteactive_gs/<?php //echo $giasu->gs_tk_id; ?>">
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