  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/boxchat/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/boxchat/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/boxchat/dist/css/skins/_all-skins.min.css">
<style type="text/css">
body{
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px !important;
}
</style>
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
                <div class="col-lg-4">
                    <img src="<?php echo isset($giasu) ? base_url().$giasu->gs_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                    <h4 class="text-success text-center">
                    	<strong><?php echo $giasu->gs_hoten; ?></strong>
                    </h4>
                    <table class="table">
                    	<tr>
                    		<td>Giới tính:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_gioitinh==0 ? "Nam" : "Nữ"; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Năm sinh:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_namsinh; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Điện thoại:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_dienthoai; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Trình độ:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_trinhdo; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>K.Nghiệm:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_kinhnghiem." năm"; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Đánh giá:</td>
                    		<td><?php 
                            $sql = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND dk_trangthai = 1 AND b.dk_gs_id =".$giasu->gs_tk_id;
                            $gs = $this->db->query($sql)->result();
                            $row = ($this->db->query($sql)->num_rows()==0)?1:$this->db->query($sql)->num_rows();
                            $diem = 0;
                            foreach ($gs as $gs) {
                                $diem += $gs->ld_diem_cmt;
                            }
                            
                            $a = ($diem/$row <3)?3:$diem/$row;
                            for($i=1;$i<=$a;$i++){
                                echo'<span class="glyphicon glyphicon-star"></span>';
                            }
                        ?></td>
                    	</tr>
                    </table>
                </div>
                <div class="col-lg-8">
                    <table class="table">
                    	<tr>
                    		<td>Chuyên ngành:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_chuyennganh; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Công việc:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_congviec; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Dạy lớp:</td>
                    		<td class="text-right"><strong>
                            <?php
                            $sql="SELECT * FROM daylop WHERE dl_gs_id=$giasu->gs_tk_id ORDER BY dl_mon desc";
                            $daylop = $this->db->query($sql)->result(); 
                            foreach ($daylop as $daylop) {
                                echo "- ".$daylop->dl_lop." ";
                            }
                            ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Dạy môn:</td>
                    		<td class="text-right"><strong>
                            <?php
                            $sql="SELECT DISTINCT dl_mon FROM daylop WHERE dl_gs_id=$giasu->gs_tk_id ORDER BY dl_mon desc";
                            $daylop = $this->db->query($sql)->result(); 
                            foreach ($daylop as $daylop) {
                                echo "- ".$daylop->dl_mon." ";
                            } 
                            ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Dạy các buổi:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_ngayday; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Giờ dạy:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_gioday; ?></strong></td>
                    	</tr>
                    </table>
                </div>

                <div class="col-lg-8 text-justify">
                <?php 
                $where = array('dl_gs_id' => $giasu->gs_tk_id);
                $daylop = $this->m_giasu->getGiaSuDayLop($where);
                ?>
                <center><h4 class="text-muted">Bảng giá</h4></center>
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
                
                
                <div class="col-lg-8 text-justify pull-right">
                	<center><h4 class="text-muted">Thông tin tự giới thiệu</h4></center>
					<?php echo !empty($giasu->gs_gioithieu) ? $giasu->gs_gioithieu : "<center class=text-danger>Chưa cập nhật thông tin tự giới thiệu</center>";?>
                </div>
                <div class="col-lg-8 pull-right">
                	<center><h4 class="text-muted">Vị trí gia sư</h4></center>
                	<?php if(!empty($giasu->gs_diadiem)){?>
                		<div id="map" style="height: 200px;">ban do</div>
                		<?php
                	} 
                	else
                		echo "<center class=text-danger>Chưa cập nhật vị trí</center>"; ?>
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
        <div class="panel-heading"><h4>Các bài đánh giá</h4></div>
        <div class="panel-body">

            <table class="table table-striped" id="ttgv">
                <thead>
                    <th><strong>#</strong></th>
                    <th width="250px"><strong>Nội dung</strong></th>
                    <th width="200px"><strong>Đánh giá</strong></th>
                    <th width="400px"></th>
                    <th></th>
                </thead>

                <?php
                $total_item=10;
                $total_page=ceil($total_item/$item_per_page); //echo $total_page;

                if($total_item>0){ ?>

                <tbody id="tbody_ds_sp">
                    <?php
                    $sql = "SELECT * FROM lopday a, dangky b, phuhuynh c WHERE a.ph_tk_id = c.ph_tk_id AND a.ld_id = b.dk_ld_id AND (dk_trangthai = 1 OR dk_trangthai = -2) AND ld_diem_cmt is not null AND dk_gs_id =".$giasu->gs_tk_id;
                    //echo $sql;
                    $result = $this->db->query($sql)->result(); //var_dump($result);
                    $row = $this->db->query($sql)->num_rows(); 
                    if($row == 0 ){echo "<tr><td colspan = '4'><center class = 'text-warning'>Không có nhận xét nào</center></td></tr>";}
                    $stt=0;
                    foreach ($result as $result){?>
                        <tr> 
                            <td><?php echo ++$stt; //echo $result->ld_id;?></td>
                            <td><?php echo $result->ld_noidung_cmt;?></td>
                            <td><b><?php 
                            $sql = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND (dk_trangthai = 1 OR dk_trangthai = -2) AND ld_diem_cmt is not NULL  AND a.ld_id =".$result->ld_id; //echo $sql;
                            $gs = $this->db->query($sql)->result();
                            $row = ($this->db->query($sql)->num_rows()==0)?1:$this->db->query($sql)->num_rows();
                            $diem = 0;
                            foreach ($gs as $gs) {
                                $diem += $gs->ld_diem_cmt;
                            }
                            
                            $a = ($diem/$row <3)?3:$diem/$row;

                            for($i=1;$i<=$a;$i++){
                                echo'<span class="glyphicon glyphicon-star"></span>';
                            }
                            //echo " ".round($a, 1);
                        ?></b></td>
                            <td> 
                                <?php if(isset($this->session->userdata('login')->tk_id) && $this->session->userdata('login')->tk_id == 1){?>
                                <p><strong>Lớp: </strong><a href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $result->ld_id; ?>"><?php echo $result->ld_tieude;?></a></p>
                                <?php } else{?>
                                    <p><strong>Lớp: </strong><?php echo $result->ld_tieude; ?></p>
                                <?php } ?>
                                <p><strong>Nhận xét của: </strong><?php echo $result->ph_hoten;?></p>
                            </td>
                            <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal_cmt<?php echo $result->ld_id; ?>"><i class=" glyphicon glyphicon-comment"></i></button></td>
                        </tr> 
                            <!-- Modal detail-->
                            <div class="modal fade" id="myModal_cmt<?php echo $result->ld_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Trò chuyện</h4>
                                  </div>
                                  <div class="modal-body">

                                <!-- DIRECT CHAT PRIMARY -->
                                  <div class="box box-primary direct-chat direct-chat-primary">
                                    
                                    <div class="box-body">
                                      <!-- Conversations are loaded here -->
                                      <div class="direct-chat-messages">
                                        <!-- Message. Default to the left -->
                                        <?php 
                                            
                                            $sql_chat = "SELECT a.tk_id as tk_id, dg_noidung, dg_time, tk_quyen, ph_hoten as hoten, ph_hinhanh as hinhanh FROM danhgia a, phuhuynh b, taikhoan c WHERE a.tk_id = b.ph_tk_id AND a.tk_id = c.tk_id AND ld_id = $result->ld_id UNION SELECT a.tk_id as tk_id, dg_noidung, dg_time, tk_quyen, gs_hoten as hoten, gs_hinhanh as hinhanh FROM danhgia a, giasu b, taikhoan c WHERE a.tk_id = b.gs_tk_id AND a.tk_id = c.tk_id AND ld_id = $result->ld_id ORDER BY dg_time DESC"; 
                                            $binhluan = $this->db->query($sql_chat)->result();
                                            $row = 1;
                                            foreach ($binhluan as $chat) {
                                            
                                        if($row % 2 == 0){ ?>
                                        <div class="direct-chat-msg">
                                          <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left"><?php echo $chat->hoten ?></span>
                                            <span class="direct-chat-timestamp pull-right"><?php echo $chat->dg_time ?></span>
                                          </div>
                                          <!-- /.direct-chat-info -->
                                          <img class="direct-chat-img" src="<?php echo base_url(); ?>/<?php echo $chat->hinhanh ?>" alt="Message User Image"><!-- /.direct-chat-img -->
                                          <div class="direct-chat-text">
                                            <?php echo $chat->dg_noidung ?>
                                          </div>
                                          <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                        <?php }else{ ?>
                                        <!-- Message to the right -->
                                        <div class="direct-chat-msg right">
                                          <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right"><?php echo $chat->hoten ?></span>
                                            <span class="direct-chat-timestamp pull-left"><?php echo $chat->dg_time ?></span>
                                          </div>
                                          <!-- /.direct-chat-info -->
                                          <img class="direct-chat-img" src="<?php echo base_url(); ?>/<?php echo $chat->hinhanh ?>" alt="Message User Image"><!-- /.direct-chat-img -->
                                          <div class="direct-chat-text">
                                            <?php echo $chat->dg_noidung ?>
                                          </div>
                                          <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                    <?php } $row ++;
                                    } ?>
                                      </div>
                                      <!--/.direct-chat-messages-->
                                    </div>
                                    <!-- /.box-body -->
                                  </div>
                                  <!--/.direct-chat -->
                                                   
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                                  </div>
                                </div>
                              </div>
                            </div> <!---End div model -->  
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

        </div>
        </div>
    <?php 
    } ?>

    </div>

    <div>
        <?php 
        $data = array('giasu' => $giasu);
        $this->load->view("/layout/right_slidebar_gs", $data); ?>
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
