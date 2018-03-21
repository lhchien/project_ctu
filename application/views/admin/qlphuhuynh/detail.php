<style type="text/css">
/*Popup chi tiet ung vien*/
.chitiet {
    z-index:999;  
    background:#000;
    background-color: rgba(0, 0, 0, 0.5);
    height:100%;
    width:100%;
    position:fixed;
    /*display:none;*/
    top:0;
    right:0;
    /*overflow: scroll;*/
}
#ketqua {
    z-index:999;  
    background:#000;
    background-color: rgba(0, 0, 0, 0.5);
    height:100%;
    width:100%;
    position:fixed;
    display:none;
    top:0;
    right:0;
}
#tablechitiet {
    background-color:#FFF;
    z-index:999;
    width:60%;
    height:auto;
    top:8%;
    left:20%;
    position:absolute;
}
#img-map{
    height: 105px;
}
#wrapPopupMap{
    height:100%;
    width:100%;
}
#trai{
    float: left;
    padding-right: 5px;
}
#phai{
    float: right;
}

</style>
<?php $this->load->view("/admin/v_header");?>
<div class="container">

    <h1 class="text-muted">Thông tin chi tiết phụ huynh</h1>
    <hr>
    <div class="col-md-8">
    <div class="panel panel-primary">

        <div class="panel-heading">Thông tin tài khoản</div>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-lg-5">
                    <img src="<?php echo isset($phuhuynh) ? base_url().$phuhuynh->ph_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                    <h4 class="text-success text-center">
                    	
                    </h4>
                    <table class="table">
                      
                        
                    </table>
                </div>
                <div class="col-lg-7">
                    <table class="table">
                     <tr>
                    		<td>Họ tên:</td>
                    		<td class="text-right"><strong><?php echo ($phuhuynh->ph_hoten == "")?"Chưa cập nhật họ tên": $phuhuynh->ph_hoten; ?></strong></td>
                    	</tr>
                    <tr>
                   
                    		<td>Giới tính:</td>
                    		<td class="text-right"><strong><?php echo $phuhuynh->ph_gioitinh==0 ? "Nam" : "Nữ"; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Điện thoại:</td>
                    		<td class="text-right"><strong><?php echo ($phuhuynh->ph_dienthoai == "")?"Chưa cập nhật": $phuhuynh->ph_dienthoai; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Trình độ:</td>
                    		<td class="text-right"><strong><?php echo ($phuhuynh->ph_trinhdo == "")? "Chưa cập nhật": $phuhuynh->ph_trinhdo; ?></strong></td>
                    	</tr>
                            <tr>
                    		<td>Địa chỉ:</td>
                    		<td class="text-right"><strong><?php echo ($phuhuynh->ph_diadiem == "")? "Chưa cập nhật": $phuhuynh->ph_diadiem; ?></strong></td>
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

    </div> 



<div class="col-md-4">
   <div class="panel panel-primary">
         <div class="panel-heading">Vị trí lớp học</div>
                <div class="panel-body">
                	<?php if(!empty($phuhuynh->ld_diadiem)){?>
                		<div id="map" style="height: 200px;">Chưa có lớp học</div>
                		<?php
                	} 
                 ?>
              </div>


   </div>

    </div>  
    
   
   
   
      <div class="col-md-12">
      <div class="panel panel-primary">
      <div class="panel-heading">Bảng lớp học của phụ huynh</div>
      <div class="panel-body">
                    <?php
            $this->load->model('m_phuhuynh');
            $class = $this->m_phuhuynh->getClassInfo();
            //var_dump($class);
    ?>
                    <div class="col-lg-12 text-justify">
                    
                <?php 
            //$sql = "select * from lopday a, dangky b WHERE a.ld_id = b.dk_ld_id and a.ph_tk_id = ".$this->session->userdata('login')->tk_id." and a.ld_id not in (select dk_ld_id from dangky)";
            $sql = "SELECT DISTINCT l.ph_tk_id ,ld_mota_diadiem, ld_id ,gs_hoten, ld_tieude, ld_mon,ld_diadiem,dl_mon, ld_khoilop, ld_soluong, ld_yeucau, ld_buoiday, ld_thoigian, ld_mota_diadiem,ld_hinhanh, ld_trangthai, dk_trangthai ,dl_giatien FROM phuhuynh p, lopday l, dangky d, giasu g, daylop y WHERE  p.ph_tk_id = l.ph_tk_id AND l.ld_id = d.dk_ld_id AND d.dk_gs_id = g.gs_tk_id AND g.gs_tk_id = y.dl_gs_id AND ld_trangthai = 1 AND p.ph_tk_id = ".$phuhuynh->ph_tk_id."  GROUP BY dk_trangthai DESC";
          
          
         
            $lopday = $this->db->query($sql)->result(); 
            $row = $this->db->query($sql)->num_rows(); 


            
            ?>
                
                <table class="table">

                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên gia sư</th>
                            <th>Khối lớp</th>
                            <th>Môn học</th>
                            <th>Lịch học</th>
                            <th>Thời gian học</th>
                            <th>Giá tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                    if( empty($lopday)){?>
                            <tr>
                                <td colspan="8" class="text-center">
                                    <?php echo "<span class=text-danger>Chưa có gia sư đăng ký dạy.</span>"; ?>
                                </td>
                            </tr>

                  <?php  }

                    else {
                    
                    $stt = 1; 
                    foreach ($lopday as $row) { ?>
                    
                        <tr>
                            <td><?php echo $stt++; ?>&nbsp<a target="_blank" title="Đến lớp học" href="<?php echo base_url(); ?>qllopday/detail_ld/<?php echo $row->ld_id; ?>"><span class="glyphicon glyphicon-share-alt"></span></a></td> 
                            <td><?php echo $row->gs_hoten; ?></td>   
                            <td><?php echo $row->ld_khoilop; ?></td>
                            <td><?php echo $row->ld_mon; ?></td>
                            <td><?php echo $row->ld_buoiday; ?></td>
                            <td><?php echo $row->ld_thoigian; ?></td>
                            <td><?php echo $row->dl_giatien." đồng/buổi"; ?></td>
                            <td><?php
                                
                                    $b = $row->dk_trangthai;
                               if($b==1){
                                   echo 'Lớp đang học';
                               }
                                else if($b==-2){
                                   echo 'Lớp đả kết thúc ';
                               }
                                if($b==0){
                                   echo 'Lớp có gia sư đăng ký';
                               }
                            
                            
                      
                            ?></td>
                        </tr>
                        <?php
                    } ?>
                      <?php } ?>
                    </tbody>
                </table>
                
                </div>
                   
                    </div>
                    
                    </div>
    </div>



  <div class="col-md-12">
      <div class="panel panel-primary">
      <div class="panel-heading">Bảng đăng ký lớp học của phụ huynh</div>
      <div class="panel-body">
                    <?php
            $this->load->model('m_phuhuynh');
            $class = $this->m_phuhuynh->getClassInfo();
            //var_dump($class);
    ?>
                    <div class="col-lg-12 text-justify">
                    
                <?php 
            
            $sql1 = "SELECT a.ld_tieude, a.ld_khoilop, a.ld_mon, a.ld_buoiday, a.ld_id, a.ld_trangthai FROM lopday a, phuhuynh c WHERE a.ph_tk_id = c.ph_tk_id AND a.ld_trangthai = 1 AND a.ph_tk_id = ".$phuhuynh->ph_tk_id." GROUP BY ld_id NOT IN (select dk_ld_id FROM dangky)  ";     
            $lopday1 = $this->db->query($sql1)->result(); 
            $row1 = $this->db->query($sql1)->num_rows(); 


            
            ?>
                
                <table class="table">

                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Khối lớp</th>
                            <th>Môn học</th>
                            <th>Lịch học</th>
                                                    
                            <th>Trạng thái</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                    $stt = 1; 
                    foreach ($lopday1 as $row1) { ?>
                        <tr>
                            <td><?php echo $stt++; ?>&nbsp<a target="_blank" title="Đến lớp học" href="<?php echo base_url(); ?>qllopday/detail_ld/<?php echo $row1->ld_id; ?>"><span class="glyphicon glyphicon-share-alt"></span></a></td> 
                            <td><?php echo $row1->ld_tieude; ?></td>   
                            <td><?php echo $row1->ld_khoilop; ?></td>
                            <td><?php echo $row1->ld_mon; ?></td>
                            <td><?php echo $row1->ld_buoiday; ?></td>
                           
                           
                            <td><?php
                                
                                    $b = $row1->ld_trangthai;
                               if($b==1){
                                   echo 'Lớp tìm gia sư';
                               }
                               
                            
                            
                      
                            ?></td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
                
                </div>
                    </div>
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
                // var_dump($lopday);
                  foreach ($lopday as $lopday) { 
                         $mota = "<div id=wrapPopupMap>";
                    $mota.= "<div id=trai><img src=\"../../".$lopday->ld_hinhanh."\" id=img-map></div>";
                    $mota.= "<b>Tên gia sư: </b>".$lopday->gs_hoten."<br/>";
                    $mota.= "<b>Khối lớp: </b>".$lopday->ld_khoilop."-".$lopday->ld_mon."<br/>";
                    $mota.= "<b>Buổi: </b>".$lopday->ld_buoiday."<br/>";
                    $mota.= "<b>Thời gian: </b>".$lopday->ld_thoigian."<br/>";
                    $mota.= "<b>Giá tiền: </b>".$lopday->dl_giatien." đồng/buổi <br/>";
                    //$mota.= "<b>Dạy lớp: </b>".$lop."<br/>";
                    //$mota.= "<b>Dạy môn: </b>".$mon."<br/>";
                    $mota.= "<b>Mô tả địa điểm: </b>".$lopday->ld_mota_diadiem."<br/>";
                    
                    $mota.= "</div>";
                    $mota.= "</div>";
                    echo "['".$mota."', ".$lopday->ld_diadiem.",'".Mylibrary::getIconImg($lopday->dl_mon)."'],"; 
                           
                           
                       
                    } 
                   
                echo "['".$lopday->ld_diadiem."', ".$lopday->ld_diadiem.", ".$lopday->ph_tk_id."]";
                ?>
            ];

            var map = new google.maps.Map(document.getElementById('map'),{
                zoom: 12,
                center: new google.maps.LatLng(<?php echo $phuhuynh->ld_diadiem; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for(i=0; i<locations.length; i++){
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    draggable:false,
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
