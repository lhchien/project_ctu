<div>
	<?php if($chucnang == "Hủy đăng ký lớp dạy thành công!"){	?>
		<div class="alert alert-info" role="alert"><center><h4><?php if(isset($chucnang)) echo $chucnang ?> <b><i><?php if(isset($tieude)) echo $tieude ?>!</i></b></h4></center></div>
		<center><img src="<?php  echo base_url();?>/img/load.gif" class="img-responsive" alt="Responsive image" width="45%" height="45%"></center>
		<script>setTimeout(function(){window.location.href='<?php echo base_url(); ?>v_class_need_student'},1500);</script>

	<?php }else{ ?>

		<div class="alert alert-info" role="alert"><center><h4><?php if(isset($chucnang)) echo $chucnang ?> <b><i><?php if(isset($tieude)) echo $tieude ?>!</i></b></h4></center></div>
		<center><img src="<?php  echo base_url();?>/img/load.gif" class="img-responsive" alt="Responsive image" width="45%" height="45%"></center>
		<script>setTimeout(function(){window.location.href='<?php echo base_url(); ?>v_detail_ph'},1500);</script>

	<?php } ?>
</div>       
 