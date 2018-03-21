<div class="container">
	<?php
	if(isset($confirm) && $confirm=="yes"){ ?>
		<form action="<?php echo base_url(); ?>qlphuhuynh/deleteactive_ph/<?php echo $ph_tk_id; ?>" method="POST">
			<div class="alert alert-block alert-danger">
				<h4>Cảnh báo xóa!</h4>
				<p>Nếu bạn xóa, hãy chắc chắn!
					<input type="submit" name="submit" class="btn btn-danger" value="Xóa">
					<a href="<?php echo base_url(); ?>qlphuhuynh/active"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
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
	<h2 class="text-center text-info">Danh sách các phụ huynh đang hoạt động</h2>

		<!--Form tìm kiếm-->
	<div class="row">
				<div class="col-md-12 text-right">
					<form class="navbar-form navbar-right" role="search" method="post" action="<?php echo base_url(); ?>qlphuhuynh/active" id="form-search">
  							<div class="form-group ">
    							<input name="key" type="text" class="form-control" placeholder="Nhập tên phụ huynh tìm...">
 							
 								 <button type="submit" class="btn btn-primary" name="search_ph">Tìm kiếm</button> </div>
					</form>
				</div>
			</div>


	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr >
				<th class="text-center">STT</th>
				<th class="text-center">Tài khoản</th>
				<th class="text-center">Tên phụ huynh</th>				
				<th class="text-center">Địa chỉ</th>
				<th class="text-center">Trạng thái</th>
				
				<th class="text-center">Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//var_dump($giasu);
			   
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'qlphuhuynh/active';
          $sql1 = "SELECT * FROM taikhoan t, phuhuynh p WHERE t.tk_id=p.ph_tk_id AND ph_trangthai=1";
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
			foreach ($phuhuynh as $phuhuynh) { 
				$i++; ?>
				
				<tr class="text-center">
					<td><?php echo $i; ?></td>
					<td><?php echo $phuhuynh->tk_email; ?></td>
					<td><?php echo $phuhuynh->ph_hoten; ?></td>
					<td><?php echo $phuhuynh->ph_diadiem; ?></td>
					<td><?php echo $phuhuynh->ph_trangthai==2 ? "<b class=text-danger>Block</b>" : "<b class=text-success>Đang hoạt động</b>"; ?></td>
	
					<td class="text-center">
					


							<?php if($this->session->userdata('a_login')->tk_quyen==-1){
							?>
									
							<a target="_blank" href="<?php echo base_url(); ?>qlphuhuynh/detail_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
							</a>
							<a target="_blank" href="<?php echo base_url(); ?>qlphuhuynh/editInfo_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
							</a>
							<a href="<?php echo base_url(); ?>qlphuhuynh/block_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-primary" value="Block" ><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Block</button>
							</a>

						
								

						<?php }
						
						else { ?>

							<a target="_blank" href="<?php echo base_url(); ?>qlphuhuynh/detail_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-info" value="Xem"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Xem</button>
							</a>
							<a target="_blank" href="<?php echo base_url(); ?>qlphuhuynh/editInfo_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
								<button type="button" class="btn btn-xs btn-warning" value="Sửa"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sửa</button>
							</a>



                                   <!-- Button -->                                                                                                         
								 <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#userModal"  onclick="get_id_block(<?php echo $phuhuynh->ph_tk_id; ?>,'<?php echo $phuhuynh->tk_email ?>')" ><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Block</button>
							

							<!--////////////////////////////-->
							<a href="<?php echo base_url(); ?>qlphuhuynh/deleteactive_ph/<?php echo $phuhuynh->ph_tk_id; ?>">
							
							
							
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

	<div id="userModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
 
                    <!-- Modal content-->
					 <form method="post" id="modal fade">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Lý do block tài khoản <span id="TenEmail"></span></h4>
                        </div>
                        <div class="modal-body">
						
                            <label>Lý do</label>
                
									  <input type="text" name="txtThongbao" id="txtThongbao" placeholder="Nhập lý do...." class="form-control" required/>
                    	
						</div>
                        <div class="modal-footer">
							<input type="button" name="action" class="btn btn-success" value="Block" onclick="block_user(<?php echo $phuhuynh->ph_tk_id; ?>)" >
                            <input type="hidden" name="link" id="link_block" class="<?php echo base_url(); ?>qlphuhuynh/block_ph/">
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
	$("#TenEmail").html(email);
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
