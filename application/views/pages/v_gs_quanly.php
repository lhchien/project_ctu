<?php if(!$this->session->userdata('login')) redirect(); ?>
<div class="container">

    <h1 class="text-muted">Quản lý thông tin</h1>
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
    <div class="col-md-12">
    <div class="panel panel-primary">

        <div class="panel-heading"><h4>Thông tin tài khoản</h4></div>

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
                    		<td>Chuyên ngành học:</td>
                    		<td class="text-right"><strong><?php echo $giasu->gs_chuyennganh; ?></strong></td>
                    	</tr>
                    	<tr>
                    		<td>Công việc hiện tại:</td>
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
                
                
                <div class="col-lg-8 text-justify">
                	<center><h4 class="text-muted">Thông tin tự giới thiệu</h4></center>
					<?php echo !empty($giasu->gs_gioithieu) ? $giasu->gs_gioithieu : "<center class=text-danger>Chưa cập nhật thông tin tự giới thiệu</center>";?>
                </div>
                <div class="col-lg-8">
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


    
    </div>

    <div class="col-md-12">
        <div class="panel panel-primary">
        <div class="panel-heading"><h4>Danh sách lớp học</h4></div>
        <div class="panel-body">
            <?php 
            //$sql = "select * from lopday a, dangky b WHERE a.ld_id = b.dk_ld_id and a.ph_tk_id = ".$this->session->userdata('login')->tk_id." and a.ld_id not in (select dk_ld_id from dangky)";
            $sql = "SELECT DISTINCT ph_tk_id,`ld_id`,`ld_tieude`, `ld_mon`, `ld_khoilop`, `ld_soluong`, `ld_yeucau`, `ld_buoiday`, `ld_thoigian`, `ld_diadiem`, `ld_mota_diadiem`, `ld_hinhanh`, `ld_trangthai`,dk_trangthai FROM lopday LEFT JOIN dangky ON lopday.ld_id = dangky.dk_ld_id WHERE(dk_trangthai !=-1 OR dk_trangthai is NULL) AND dangky.dk_gs_id = ".$this->session->userdata('login')->tk_id." ORDER BY dk_trangthai DESC";
            $class = $this->db->query($sql)->result();
            $row = $this->db->query($sql)->num_rows(); 
            ?>
            <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tiêu đề lớp học</th>
                    <th width="200px">Trạng thái </th>
                    <th width="80px"></th>
                </tr>
            </thead>
                <tbody>
                <?php 
                $stt = 1; 
                foreach ($class as $ld) { ?>
                    
                        <tr <?php if($ld->dk_trangthai == -2) echo "style = 'opacity:0.3'"; ?> >
                            <td><?php echo $stt++; ?></td>    
                            <td><img src="<?php  echo base_url().$ld->ld_hinhanh;?>" width="6%" height="6%">
                            <span> <?php echo $ld->ld_tieude; ?></span></td>
                            <?php 
                                if($ld->dk_trangthai == -1){ ?>
                                    <td><span style='color:red'><strong> Lớp đang học.</strong></span></br> <span><small><i> Gia sư khác đang dạy lớp này</i></small></span></td>
                                    <td><span class="glyphicon glyphicon-lock" style='color:red'></span></td>
                                <?php } 
                                else if($ld->dk_trangthai == 0){?>
                                    <td><span class='text-primary'>Bạn đã đăng ký</span></br> <span><small><i> Đợi học viên chấp nhận ...</i></small></span></td>
                                    <td><a class="glyphicon glyphicon-search" href="<?php echo base_url(); ?>phuhuynh/studying_class/<?php echo $ld->ld_id; ?>" role="button" data-toggle="tooltip" title="Chi tiết lớp học"></a></span></td>
                                <?php } 
                                else if($ld->dk_trangthai == -2){?>
                                    <td><span class='text-danger'><i class="glyphicon glyphicon-lock"></i> Lớp học đã kết thúc</span></td>
                                    <td><a class="glyphicon glyphicon-search" href="<?php echo base_url(); ?>phuhuynh/studying_class/<?php echo $ld->ld_id; ?>" role="button" data-toggle="tooltip" title="Chi tiết lớp học"></a></span></td>    
                                <?php }else{ ?>
                                    <td><span class='text-success'><strong>Bạn đang dạy lớp này</strong></span></td>
                                    <td><a class="glyphicon glyphicon-search text-success" href="<?php echo base_url(); ?>phuhuynh/studying_class/<?php echo $ld->ld_id; ?>" role="button" data-toggle="tooltip" title="Chi tiết lớp học"></a></span></td>
                                    <?php } ?>  
                        </tr>
                <?php } ?> 
                </tbody>       
            </table>

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

    <div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading"><h4>Các bài đánh giá về bạn</h4></div>
        <div class="panel-body">

            <table class="table table-striped" id="ttgv">
                <thead>
                    <th><strong>#</strong></th>
                    <th width="250px"><strong>Nội dung</strong></th>
                    <th><strong>Đánh giá</strong></th>
                    <th width="300px"></th>
                </thead>

                <?php
                $total_item=10;
                $total_page=ceil($total_item/$item_per_page); //echo $total_page;

                if($total_item>0){ ?>

                <tbody id="tbody_ds_sp">
                    <?php
                    $sql = "SELECT * FROM lopday a, dangky b, phuhuynh c WHERE a.ph_tk_id = c.ph_tk_id AND a.ld_id = b.dk_ld_id AND (dk_trangthai = 1 OR dk_trangthai = -2) AND dk_gs_id =".$giasu->gs_tk_id;
                    $result = $this->db->query($sql)->result(); //var_dump($result);
                    $row = $this->db->query($sql)->num_rows(); 
                    if($row == 0 ){echo "<tr><td colspan = '4'><center class = 'text-warning'>Không có nhận xét nào</center></td></tr>";}
                    $i=0;
                    foreach ($result as $result){
                        $i++;?>
                        <tr> 
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result->ld_noidung_cmt;?></td>
                            <td><b><?php 
                                if($result->ld_diem_cmt == 1){ ?> <span class="text-danger"> Quá tệ </span> <?php }
                                if($result->ld_diem_cmt == 2){ ?> <span class="text-warning"> Hơi thất vọng </span> <?php }
                                if($result->ld_diem_cmt == 3){ ?> <span class="text-primary"> Tạm được </span> <?php }
                                if($result->ld_diem_cmt == 4){ ?> <span class="text-info"> Hài lòng </span> <?php }
                                if($result->ld_diem_cmt == 5){ ?> <span class="text-success"> Hoàn toàn hài lòng </span> <?php } 
                                ?></b></td>
                            <td> 
                                <?php if($this->session->userdata('login')->tk_id == 2){?>
                                <p><strong>Lớp: </strong><a href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $result->ld_id; ?>"><?php echo $result->ld_tieude;?></a></p>
                                <?php } else{?>
                                    <p><strong>Lớp: </strong><?php echo $result->ld_tieude; ?></p>
                                <?php } ?>
                                <p><strong>Nhận xét của: </strong><?php echo $result->ph_hoten;?></p>
                            </td>
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

        </div>
        </div>
    <?php 
    } ?>


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
