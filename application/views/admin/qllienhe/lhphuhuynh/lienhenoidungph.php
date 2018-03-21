<?php $this->load->view("/admin/v_header");?>
<div class="container">

    <h1 class="text-muted">Nội dung liên hệ</h1>
    <hr>
    <?php
    if( empty($lienhe) ){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo "Không có thông tin!"; ?>
        </div>
        <?php
    } 
    else {?>

				
    <div class="col-md-12">
    <div class="panel panel-primary">

        <div class="panel-heading">Người dùng</div>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-lg-12">
                    <table class="table">
                        <tr>
                    		 <td><strong><?php echo $lienhe->ph_hoten.":"; ?></strong></td>
            
                    	</tr>
                    	<tr>
                    		
                    		<td><?php echo $lienhe->lh_noidung; ?></td>
                           
                    	</tr>
                    	<tr>
                             <td class="text-right"><strong>Ngày gửi: <?php echo $lienhe->lh_ngay; ?></strong></td>
                        </tr>
                     
                   
                   
                    </table>
                </div>
                
    
                
            </div>          

        </div>
    </div>


    <style type="text/css">
    .active-pagination{
        color:#FFF !important;
        background-color:#337ab7 !important;
    }
    </style>
    <?php
    $item_per_page=5;
    echo '<script>';
    echo 'var item_per_page='.$item_per_page;
    echo '</script>';
    ?>
    <script language="javascript">
    $(document).ready(function() {

        $('#tbody_ds_sp tr').hide();
        $('#pagging a:first').addClass('active-pagination');
        
        for(var i=0;i<(item_per_page);i++) {
             $('#tbody_ds_sp tr:eq('+i+')').show();
        }
        
        $('#pagging a').click(function(){
            $('#pagging a').removeClass('active-pagination')
            $(this).addClass('active-pagination')
            $('#tbody_ds_sp tr').hide();
            var stt=$(this).attr('stt');
            var start=(stt-1)*item_per_page;
            var end=start+item_per_page;
            if(start>=0){
                for(var i=(start);i<end;i++) {
                    $('#tbody_ds_sp tr:eq('+i+')').show();
                }
            }
        });

    });
    </script>

<div class="panel panel-primary">
        <div class="panel-heading">Admin</div>
        <div class="panel-body">
                    <table class="table">
                        <tr>
                           <td><?php echo $lienhe->lh_phanhoi; ?></td>
                        </tr>
                    </table>
        </div> <!-- end panel body -->
    </div>
  



    <div class="panel panel-primary">
        <div class="panel-heading">Trả lời</div>
        <div class="panel-body">
         <form class="form-horizontal" action="<?php echo base_url(); ?>qllienhe/phuhuynhnoidung_lh/<?php echo $this->uri->segment(3);?>" method="post" enctype="multipart/form-data">
             
                <div class="form-group">
                        <label class="col-lg-3 control-label" for="description">Nội dung </label>
                        <input type="hidden" value="<?php echo $lienhe->lh_id;?>" name="lh_id">
                        <div class="col-lg-9">
                            <textarea name="description" id="description" class="form-control"><?php // echo empty(set_value('description')) && isset($giasu) ? $giasu->gs_gioithieu : set_value('description'); ?></textarea>
                        </div>
                    </div>


             <div class="col-sm-8 pull-right">
                        <input type="submit" name="submit" class="btn btn-warning btn-lg" value="Đồng ý">
                    </div>
                   
            </form>
        </div> <!-- end panel body -->
    </div>
    <?php 
    } ?>

    </div>
                <script>
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });
                </script>


   


    

</div><!-- containter-->

