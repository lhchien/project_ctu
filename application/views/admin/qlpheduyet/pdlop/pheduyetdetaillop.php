<?php $this->load->view("/admin/v_header");?>
<div class="container">

    <h1 class="text-muted">Thông tin chi tiết lớp học</h1>
    <hr>
    <?php
    if( empty($lopday) ){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo "Không có thông tin!"; ?>
        </div>
        <?php
    } 
    else {?>
    <div class="col-md-8">
    <div class="panel panel-primary">

        <div class="panel-heading">Thông tin lớp</div>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-lg-4">
                    <img src="<?php echo isset($lopday) ? base_url().$lopday->ld_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                    <h4 class="text-success text-center">
                    	<strong><?php echo $lopday->ld_tieude; ?></strong>
                    </h4>
                    <table class="table">
                    	<tr>
                    		<td>Môn:</td>
                    		<td class="text-right"><strong><?php echo $lopday->ld_mon; ?></strong></td>
                    	</tr>
                    </table>
                </div>
                <div class="col-lg-8">
                    <table class="table">
                    	<tr>
                    		<td>Khối lớp:</td>
                    		<td class="text-right"><strong><?php echo $lopday->ld_khoilop; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Số lượng:</td>
                    		<td class="text-right"><strong><?php echo $lopday->ld_soluong; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Buổi dạy:</td>
                    		<td class="text-right"><strong><?php echo $lopday->ld_buoiday; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Giờ dạy:</td>
                    		<td class="text-right"><strong><?php echo $lopday->ld_thoigian; ?></strong></td>
                    	</tr>

                    	<tr>
                    		<td>Giá tiền/buổi:</td>
                    		<td class="text-right"><strong><?php echo number_format($giasu->gs_giatien,0,",",".")." đồng"; ?></strong></td>
                    	</tr>
                    </table>
                </div>
                
                <div class="col-lg-8 text-justify">
                	<center><h4 class="text-muted">Thông tin tự giới thiệu</h4></center>
					<?php echo !empty($giasu->gs_gioithieu) ? $giasu->gs_gioithieu : "<center class=text-danger>Chưa cập nhật thông tin tự giới thiệu</center>";?>
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
        <div class="panel-heading">Đánh giá/Bình luận</div>
        <div class="panel-body">

            <table class="table table-striped" id="ttgv">

                <?php
                $total_item=10;
                $total_page=ceil($total_item/$item_per_page); //echo $total_page;

                if($total_item>0){ ?>
                <tbody id="tbody_ds_sp">
                    <?php
                    $result = $this->db->get('danhgia')->result(); //var_dump($result);
                    $i=0;
                    foreach ($result as $result){
                        $i++;?>
                        <tr> 
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result->dg_noidung; ?></td>
                        </tr>   
                        <?php
                    }//dong for ?>
                </tbody>
                <?php
                }//dong if($total_item>0) ?>
            
            </table>
            <?php
            $pagging="";
            if($total_page>1){
                for($i=1;$i<=$total_page; $i++){
                    $pagging.='<a href="javascript:" class="page_i" stt="'.$i.'" title="trang '.$i.'">'.$i.'</a>';
                }
                echo '<ul class="pagination"><li id="pagging">'.$pagging.'</li></ul>';
            }
            ?>

        </div> <!-- end panel body -->
    </div>
    <?php 
    } ?>

    </div>
 
   <div class="col-md-4">
   <div class="panel panel-primary">
         <div class="panel-heading">Vị trí gia sư</div>
                <div class="panel-body">
                	<?php if(!empty($giasu->gs_diadiem)){?>
                		<div id="map" style="height: 200px;">Loading map, please wait...</div>
                		<?php
                	} 
                	else
                		echo "<center class=text-danger>Chưa cập nhật vị trí</center>"; ?>
              </div>


   </div>

    </div> 


    

</div><!-- containter-->


<script type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    jQuery(document).ready(function($) {(

        function(){

        window.onload = function() {

            var locations = [
                <?php
                echo "['".$giasu->gs_motadiadiem."', ".$giasu->gs_diadiem.", ".$giasu->gs_tk_id."],";
                ?>
            ];

            var map = new google.maps.Map(document.getElementById('map'),{
                zoom: 12,
                center: new google.maps.LatLng(<?php echo $giasu->gs_diadiem; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for(i=0; i<locations.length; i++){
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    draggable:true,
                    animation: google.maps.Animation.DROP,
                    map: map
                }); //end marker

                google.maps.event.addListener(marker,'click',(function(marker,i){
                    return function(){
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map,marker);
                        if (marker.getAnimation() !== null) {
                            marker.setAnimation(null);
                        } else {
                            marker.setAnimation(google.maps.Animation.BOUNCE);
                        }
                        

                    }
                })(marker,i));

            }//end for

            var styles = [
                {
                  featureType: 'road.arterial',
                  elementType: 'all',
                  stylers: [
                    { hue: '#fff' },
                    { saturation: 100 },
                    { lightness: -48 },
                    { visibility: 'on' }
                  ]
                },
                {
                  featureType: 'road',
                  elementType: 'all',
                  stylers: []
                },
                {
                    featureType: 'water',
                    elementType: 'geometry.fill',
                    stylers: [
                        { color: '#adc9b8' }
                    ]
                },
                {
                    featureType: 'landscape.natural',
                    elementType: 'all',
                    stylers: [
                        { hue: '#809f80' },
                        { lightness: -35 }
                    ]
                }
            ];
             
            var styledMapType = new google.maps.StyledMapType(styles);
            map.mapTypes.set('Styled', styledMapType);
            
            // Getting values - Attaching click events to the buttons
            document.getElementById('getValues').onclick = function() {
                alert('Current Zoom level is ' + map.getZoom());
                alert('Current center is ' + map.getCenter());
                alert('The current mapType is ' + map.getMapTypeId());
            }

            google.maps.event.addListener(map, "rightclick", function(event) {
                var lat = event.latLng.lat();
                var lng = event.latLng.lng();

                alert("Lat=" + lat + "; Lng=" + lng);
                $('#element_3').val(lat);   
                $('#element_4').val(lng); 

            }); //end window onload

      	};
    })();

    }); //end jquery
    </script>
