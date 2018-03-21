<div class="container">

	<?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qlgiasu/deleteactive/<?php echo $gs_tk_id; ?>" method="POST">
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

	<h2 class="text-center text-info">Danh sách các gia sư đang hoạt động</h2>
	
	
	<!--Form tìm kiếm-->
	<div class="row">
				<div class="col-md-12 text-right">
					<form class="navbar-form navbar-right" role="search" method="post" action="<?php echo base_url(); ?>qlgiasu/active" id="form-search">
  							<div class="form-group ">
    							<input name="key" type="text" class="form-control" placeholder="Nhập tên gia sư tìm...">
 							
 								 <button type="submit" class="btn btn-primary" name="search_gs">Tìm kiếm</button> </div>
					</form>
				</div>
			</div>


	<table class="table table-striped table-hover table-bordered">

		<thead>
			<tr >
				<th class="text-center">STT</th>
				<th class="text-center">Tài khoản</th>
				<th class="text-center">Tên gia sư</th>
				<th class="text-center">Giới tính</th>
				<th class="text-center">Điện thoại</th>
				<th class="text-center">Trình độ</th>
				<th class="text-center">Chuyên ngành</th>
				<th class="text-center">Trạng thái</th>
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php      
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qlgiasu/active';
			$sql1 = "SELECT * FROM taikhoan t, giasu g WHERE t.tk_id=g.gs_tk_id AND gs_trangthai=1";
             $num = $this->db->query($sql1)->result();
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
				
				<tr class="text-center">
					<td><?php echo $i; ?></td>
					<td><?php echo $giasu->tk_email; ?></td>
					<td><?php echo $giasu->gs_hoten; ?></td>
					<td><?php echo $giasu->gs_gioitinh==0 ? "Nam" : ($giasu->gs_gioitinh==1 ? "Nữ" : "NULL");  ?></td>
					<td><?php echo $giasu->gs_dienthoai; ?></td>
					<td><?php echo $giasu->gs_trinhdo; ?></td>
					<td><?php echo $giasu->gs_chuyennganh; ?></td>
					<td><?php echo $giasu->gs_trangthai==0 ? "<b class=text-danger>Chưa active</b>" : "<b class=text-success>Active</b>"; ?></td>
					<td>
				
							<!-- Với tài khoản quyền Mod-->
						<?php if($this->session->userdata('a_login')->tk_quyen==-1){
							?>
									
							<a target="_blank" href="<?php echo base_url(); ?>qlgiasu/detail_gs/<?php echo $giasu->gs_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
							</a>
							<a target="_blank" href="<?php echo base_url(); ?>qlgiasu/editInfo_gs/<?php echo $giasu->gs_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
							</a>
							




							  <!-- Button -->
          					  <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#userModal"  onclick="get_id_block(<?php echo $giasu->gs_tk_id; ?>)" ><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Block</button>
 		
						
								<!--////////////////////////////-->

						<?php }
						

						// Với tài khoản quyền admin
						else { ?>

							<a target="_blank" href="<?php echo base_url(); ?>qlgiasu/detail_gs/<?php echo $giasu->gs_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
							</a>
							<a target="_blank" href="<?php echo base_url(); ?>qlgiasu/editInfo_gs/<?php echo $giasu->gs_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
							</a>

								<!--////////////////////////////-->

		
							  <!-- Button -->
           						 <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#userModal"  onclick="get_id_block(<?php echo $giasu->gs_tk_id; ?>,'<?php echo $giasu->tk_email ?>')" ><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Block</button>
 
           						 <!-- Modal -->
            
									<a href="<?php echo base_url(); ?>qlgiasu/deleteactive_gs/<?php echo $giasu->gs_tk_id; ?>">
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

	<div id="userModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
 
                    <!-- Modal content-->
					 <form method="post" id="modal fade">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Lý do block tài khoản <span id="tenem"></span> </h4>
                        </div>
                        <div class="modal-body">
						
                            <label>Lý do</label>
                
									  <input type="text" name="txtThongbao" id="txtThongbao" placeholder="Nhập lý do...." class="form-control" required/>
                    	
						</div>
                        <div class="modal-footer">
							<input type="button" name="action" class="btn btn-success" value="Block" onclick="block_user(<?php echo $giasu->gs_tk_id; ?>)" >
                            <input type="hidden" name="link" id="link_block" class="<?php echo base_url(); ?>qlgiasu/block_gs/">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
						</div>
					</form>
                    </div> <!--div class="modal-body" -->
                </div> <!--  div class="modal-content" -->
           

<script>
var id =""; var email ="";
function get_id_block(idblock,emailu)
{
	id = idblock;
	email = emailu;
	$("#tenem").html(email);
}
function block_user()
{
	var data = $("#txtThongbao").val();
	var link = $("#link_block").attr("class");
	$.ajax({
		url:"<?php echo base_url(); ?>qlthongbao/ajax_add",
		dataType:"text",
		type:"post",
		data:{"txtThongbao":data,"txtidblock":id},
		success:function(kq)
		{
			window.location = link+""+id;	
		}
	})
}
</script>
</div>
