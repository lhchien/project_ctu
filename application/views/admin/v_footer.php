
<div style="min-height:180px"></div>
<footer  style="text-align:center">

	
    <div class="container">
      <div class="hidden-xs">
       <strong class="text-center">Copyright &copy; 2016-2017 .</strong>
      </div>
     

    </div>
    <!-- /.container -->
  </footer>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<!-- ckeditor -->
<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>

<!-- captcha google -->
<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript">
$(document).ready(function(){
	$(".dropdown").hover(function(){
		$(this).find('ul').slideDown('medium'); }
		,function(){
			$(this).find('ul').slideUp("slow");
	});

	$(".chkDongY").click(function(){
		$(".chkDongY").prop("checked", false);
		$('.btnDangKy').prop("disabled",true);
		$('.txtTrang').prop("disabled",true);
		var ma=$(this).attr('stt'); //alert(ma);
		$("#chkDongY"+ma).prop("checked", true);
		$('#btnDangKy'+ma).prop("disabled",false);
		$('#txtTrang'+ma).prop("disabled",false);
	});	
});
</script>
</body>
</html>