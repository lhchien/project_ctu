<?php $this->load->view("/admin/v_header");?>
<div class="container">

    <h1 class="text-muted">Thông tin chi tiết gia sư</h1>
    <hr>
    <?php
    if( empty($giasu) ){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo "Không có thông tin!"; ?>
        </div>
        <?php
    } 
    else {?>

				
    <div class="col-md-8">
    <div class="panel panel-primary">

        <div class="panel-heading">Thông tin tài khoản</div>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-lg-5">
                    
                    <img src="<?php echo isset($giasu) ? base_url().$giasu->gs_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                    <h4 class="text-success text-center">
                    	<strong><?php echo ($giasu->gs_hoten == "")?"Chưa cập nhật họ tên": $giasu->gs_hoten; ?></strong>
                    </h4>
                    <table class="table">
                    	<tr>
                    		<td>Giới tính:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_gioitinh==0 ? "Nam" : "Nữ"; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Năm sinh:</td>
                    		<td class="text-right"><strong><?php echo ($giasu->gs_namsinh == "")?"Chưa cập nhật": $giasu->gs_namsinh; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Điện thoại:</td>
                    		<td class="text-right"><strong><?php echo ($giasu->gs_dienthoai == "")?"Chưa cập nhật": $giasu->gs_dienthoai; ?></strong></td>
                    	</tr>
                        
                    	<tr>
                    		<td>Đánh giá tổng :</td>
                             
                    		<td class="text-right"><?php 
                           
                            $sql = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND dk_trangthai = 1 AND b.dk_gs_id =".$giasu->gs_tk_id;
                            $gs = $this->db->query($sql)->result();
                            $row = ($this->db->query($sql)->num_rows()==0)?1:$this->db->query($sql)->num_rows();
                            $diem = 0;
                            
                            
                                foreach ($gs as $gs) {
                                    $diem += $gs->ld_diem_cmt;
                                }
                               
                                $a = $diem/$row;

                                
                                for($i=1;$i<=$a;$i++){
                                    
                                    echo'<span class="glyphicon glyphicon-star-empty"></span>';
                                }
                            
                           
                        ?></td>
                    	</tr>

                        <tr>
                    		<td>Mô tả đánh giá:</td>
                    		<td class="text-right"><?php 
                            $sql = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND dk_trangthai = 1 AND b.dk_gs_id =".$giasu->gs_tk_id;
                            $gs = $this->db->query($sql)->result();
                            $row = ($this->db->query($sql)->num_rows()==0)?1:$this->db->query($sql)->num_rows();
                            $diem = 0;
                            foreach ($gs as $gs) {
                                $diem += $gs->ld_diem_cmt;
                            }
                            
                            $a =$diem/$row;
                            if($a==0){
                                echo 'Chưa có đánh giá';   
                            }
                            
                            else if($a==1){
                                echo 'Quán tệ';
                            }
                            else if ($a==2){
                                echo 'Hơi thất vọng'; 
                            }
                              else if ($a==3){
                                echo '<span class="text-right"><strong>Tạm được</strong></span>';
                            }
                             else if ($a==4){
                                echo 'Hài lòng';
                            }
                             else if ($a==5){
                                echo 'Hoàn toàn hài lòng';
                            }
                             ?></td>
                    	</tr>
                    </table>
                </div>
                <div class="col-lg-7">
                    <table class="table">

                         <tr>
                    		<td>Tài khoản:</td>
                    		<td class="text-right"><strong><?php echo $giasu->tk_email ?></strong></td>
                    	</tr>
                          <tr>
                    		<td>Trạngthái:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_trangthai==0 ? "<b class=text-danger>Block</b>" : "<b class=text-info>Đang hoạt động</b>"; ?></strong></td>
                    	</tr>
                        <tr>
                    		<td>Địa chỉ:</td>
                    		<td class="text-right"><strong><?php echo ($giasu->gs_diachi == "")?"Chưa cập nhật": $giasu->gs_diachi; ?></strong></td>
                    	</tr>
                    	
                    	<tr>
                    		<td>K.Nghiệm:</td>
                    		<td class="text-right"><strong><?php echo ($giasu->gs_kinhnghiem == "")?"Chưa cập nhật": $giasu->gs_kinhnghiem." năm"; ?></strong></td>
                    	</tr>
                        <tr>
                    		<td>Trình độ:</td>
                    		<td class="text-right"><strong><?php echo ($giasu->gs_trinhdo == "")?"Chưa cập nhật": $giasu->gs_trinhdo; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Chuyên ngành học:</td>
                    		<td class="text-right"><strong><?php echo ($giasu->gs_chuyennganh == "")?"Chưa cập nhật": $giasu->gs_chuyennganh; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Công việc hiện tại:</td>
                    		<td class="text-right"><strong><?php echo ($giasu->gs_congviec == "")?"Chưa cập nhật": $giasu->gs_congviec; ?></strong></td>
                    	</tr>
                    	
                    </table>
                </div>

                 <div class="col-lg-7 text-justify">
                <?php 
                $sql2 =" SELECT dl_mon, dl_lop, dl_giatien FROM giasu g, daylop d WHERE g.gs_tk_id = d.dl_gs_id AND d.dl_gs_id =".$giasu->gs_tk_id;
                $daylop = $this->db->query($sql2)->result();
                
                ?>
                
                <center><h4 class="text-muted">Bảng giá lớp dạy</h4></center>
                <table class="table table-striped table-hover table-bordered">

                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Lớp</th>
                            <th>Môn</th>
                            <th>Giá</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                    $stt = 1; 
                    foreach ($daylop as $dl) { ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>    
                            <td><?php echo $dl->dl_lop; ?></td>
                            <td><?php echo $dl->dl_mon; ?></td>
                            <td><?php echo $dl->dl_giatien." đồng/buổi"; ?></td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
                </div>
                
                <div class="col-lg-5 text-justify">
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
   
    <div class="col-md-12">
   <div class="panel panel-primary">
        <div class="panel-heading"><h4>Danh sách lớp dạy</h4></div>
        <div class="panel-body">

            <table class="table " id="ttgv">
                <thead>
                    <th class="text-center">STT</th>
                    <th class="text-center">Lớp</th>
                    <th class="text-center">Môn</th>
                    <th class="text-center"><strong>Phụ huynh</strong></th>
                    <th class="text-center"><strong>Điểm đánh giá/ Mô tả</strong></th>
                    <th class="text-center" width="240px"><strong>Nội dung comment</strong></th>
                    
                    
                    
                </thead>

                <?php
                $total_item=10;
                $total_page=ceil($total_item/$item_per_page); //echo $total_page;

                if($total_item>0){ ?>

                <tbody id="tbody_ds_sp">
                    <?php
                    $sql = "SELECT * FROM lopday a, dangky b, phuhuynh c WHERE a.ph_tk_id = c.ph_tk_id AND a.ld_id = b.dk_ld_id AND (dk_trangthai = 1 OR dk_trangthai = -2) AND dk_gs_id =".$giasu->gs_tk_id;
                    $giasu1 = $this->db->query($sql)->result(); //var_dump($result);
                    $row = $this->db->query($sql)->num_rows(); 
                    if($row == 0 ){echo "<tr><td colspan = '4'><center class = 'text-warning'>Không có nhận xét nào</center></td></tr>";}
                    $i=0;
                    foreach ($giasu1 as $giasu1){
                        $i++;?>
                        <tr> 
                            <td><?php echo $i; ?><a target="_blank" title="Đến lớp học" href="<?php echo base_url(); ?>qllopday/detail_ld/<?php echo $giasu1->ld_id; ?>"><span class="glyphicon glyphicon-share-alt"></a></td>
                            <td class="text-center"><?php echo $giasu1->ld_khoilop; ?></td>
                            <td class="text-center"><?php echo $giasu1->ld_mon; ?></td>
                            <td class="text-center"><?php echo $giasu1->ph_hoten; ?></td>
                          
                            <td class="text-center"><b><?php 
                            $sql = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND dk_trangthai = 1 AND b.dk_gs_id =".$giasu->gs_tk_id;
                            $gs = $this->db->query($sql)->result();
                           
                            $diem = 0;
                            foreach ($gs as $gs) {
                                $diem += $gs->ld_diem_cmt;
                            }
                            
                            $a = $diem;
                            for($i=1;$i<=$a;$i++){
                                echo'<span class="glyphicon glyphicon-star-empty"></span>';
                            }
                             if($diem==1){
                                echo '/ Quán tệ';
                            }
                            else if ($diem==2){
                                echo '/ Hơi thất vọng'; 
                            }
                              else if ($diem==3){
                                echo '/ Tạm được';
                            }
                             else if ($diem==4){
                                echo '/ Hài lòng';
                            }
                             else if ($diem==5){
                                echo '/ Hoàn toàn hài lòng';
                            }
                                ?></b></td>
                             <td><?php echo $giasu1->ld_noidung_cmt;?></td>
                          
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
                for($i=5;$i<=$total_page; $i++){
                    $pagging.='<a href="javascript:" class="page_i" stt="'.$i.'" title="trang '.$i.'">'.$i.'</a>';
                }
                echo '<ul class="pagination"><li id="pagging">'.$pagging.'</li></ul>';
            }
            ?>

        </div>
        </div>
    <?php 
    } ?>

    </div>

    <div>
        <!-- slidebar here -->
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
