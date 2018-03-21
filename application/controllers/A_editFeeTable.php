<?php
class A_editFeeTable extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('m_giasu');
    }
         
    function submit() {
    	$loi = NULL;
    	$slmon = isset($_GET['slmon']) ? $_GET['slmon'] : NULL;
    	$sllop = isset($_GET['sllop']) ? $_GET['sllop'] : NULL;
    	$txtgia = isset($_GET['txtgia']) ? $_GET['txtgia'] : NULL;
        $dl_id = isset($_GET['dl_id']) ? $_GET['dl_id'] : NULL;

    	if(empty($slmon) || empty($sllop) || empty($txtgia)){
    		$loi = "Điền tất cả các trường!";
    	}

    	if(!empty($loi)){ ?>
            <div class="alert alert-warning fade in alertStyle">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <img src="<?php ?>"><?php echo $loi; ?>
            </div>
            <?php
        } 
        else{
        	$data = array('dl_lop' => $sllop, 
        				  'dl_mon' => $slmon, 
        				  'dl_giatien' => $txtgia, 
        				 );
        	$this->m_giasu->updateGiaSuDayLop($dl_id, $data);
        	?>
        	<script>
	        	alert('Cập nhật bảng giá học phí thành công');
	        	window.location.href='<?php echo base_url(); ?>v_registerclass_gs';
        	</script>
        	<?php
        }
    }
}