<div class="container">
	<h2 class="text-center text-info">Danh sách nhân sự quản trị</h2>

	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr >
				<th class="text-center">STT</th>
				<th class="text-center">Tên tài khoản</th>
				<th class="text-center">Trạng thái</th>
				<th class="text-center">Tùy chọn</th>
				
			</tr>
		</thead>
		<tbody>
			<?php 
			   
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qlnhansu/index';
            $sql1 = "SELECT * FROM taikhoan WHERE tk_id AND tk_quyen=1";
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
					<td><?php echo $nhansu->tk_trangthai==0 ? "<b class=text-danger>Chưa active</b>" : "<b class=text-success>Active</b>"; ?></td>
					<td class="text-center">
						<a href="<?php echo base_url(); ?>qlnhansu/detail_ns">
							<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
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