
<div class="container">

    <h1 class="text-muted">Thông tin chi tiết lớp học</h1>
    <hr>
    <?php
    if(isset($confirm) && $confirm=="yes"){ ?>
        <form action="<?php echo base_url(); ?>phuhuynh/dk_day" method="POST">
            <div class="alert alert-block alert-warning">
                <input type="hidden" name="ld_id" value="<?php echo $ld_id ?>" >
                <input type="hidden" name="gs_tk_id" value="<?php echo $this->session->userdata('login')->tk_id ?>">
                <h4>Thông báo nộp đăng ký lớp dạy lớp này!</h4>
                <p>Nếu bạn đăng ký, hãy chắc chắn!
                    <input type="submit" name="submit" class="btn btn-warning" value="Đăng ký">
                    <a href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $ld_id ?>"><button type="button" name="cancelDel" id="cancelDel" class="btn btn-default">Hủy</button></a>
                </p>
            </div>
        </form>
    <?php } ?>

    <?php
    if( empty($class) ){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo "Không có thông tin!"; ?>
        </div>
        <?php
    } 
    else {
        foreach ($class as $ld) {
            $where = array('ph_tk_id' => $ld->ph_tk_id);
            $ph = $this->m_phuhuynh->getPhuHuynhInfo($where); 
        ?>
    <div class="col-md-7">
    <div class="panel panel-primary">

        <div class="panel-heading"><h4>Thông tin lớp "<b><?php echo $ld->ld_tieude; ?> </b>"</h4></div>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-lg-4">
                <p>
                    <img src="<?php echo isset($class) ? base_url().$ld->ld_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive" style="margin-top:40px "></p>

                    <?php 
                    $sql1 = "SELECT  dk_id, dk_ld_id,dk_trangthai FROM dangky  WHERE dk_ld_id =".$ld->ld_id." group by dk_ld_id,dk_trangthai";
                    $ld1 = $this->db->query($sql1)->result();


                    if (isset($this->session->userdata('login')->tk_id) && $this->session->userdata('login')->tk_quyen == 2){


                                if($this->db->query($sql1)->num_rows() == 0)
                                { ?>

                                     <form class="form-horizontal" action="<?php echo base_url(); ?>phuhuynh/ask_dk_day/<?php echo $ld->ld_id?>" method="post">
                                        <center><input type="submit" name="submit" class="btn btn-warning" value="Đăng ký dạy" style="margin-top:20px "></center>
                                    </form>

                                <?php 
                                }
                                else 

                           foreach ($ld1 as $ld1)
                           {

                                if($ld1->dk_trangthai == 1 )
                                {
                                    $sql2 = "SELECT * FROM dangky  WHERE dk_ld_id =".$ld->ld_id." AND dk_gs_id =".$this->session->userdata('login')->tk_id." and dk_trangthai = 1";
                                    if($this->db->query($sql2)->num_rows() == 1) 
                                    {?>
                                        <span class="text-success"><strong><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Bạn đang dạy lớp này</strong> </span>

                                    <?php 
                                    }else { ?>
                                        <span class="text-danger"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Lớp này đang học </span>
                                    <?php
                                        }
                                }
                                    
                                else if($ld1->dk_trangthai == 0 )
                                {
                                $sql2 = "SELECT * FROM dangky b WHERE dk_ld_id =".$ld->ld_id." AND dk_gs_id =".$this->session->userdata('login')->tk_id." and dk_trangthai = 0";
                                    if(  $this->db->query($sql2)->num_rows() == 1 )
                                    {?>
                                        <center>
                                        <strong><span class="text-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Đã đăng ký dạy</span></strong>

                                        <a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#myModal_huy_dk" data-toggle="tooltip" style="margin-top: 20px ">Hủy đăng ký</a></center>

                                        <!-- Modal detail-->
                                <div class="modal fade" id="myModal_huy_dk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Thông báo</h4>
                                      </div>
                                      <div class="modal-body">
                                            <center><strong>Bạn có chắc hủy đăng ký dạy lớp này không?</strong></center>          
                                      </div>
                                      <div class="modal-footer">
                                        
                                        <a href="<?php echo base_url(); ?>phuhuynh/huy_dangky/<?php echo $ld->ld_id;?>/<?php echo $this->session->userdata('login')->tk_id?>" class="btn btn-warning">Chắc chắn hủy</a>
                                        
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                                      </div>
                                    </div>
                                  </div>
                                </div> <!---End div model -->

                                    <?php 
                                    }
                                    else 
                                    {?>
                                         <form class="form-horizontal" action="<?php echo base_url(); ?>phuhuynh/ask_dk_day/<?php echo $ld->ld_id?>" method="post">
                                            <center><input type="submit" name="submit" class="btn btn-warning" value="Đăng ký dạy" style="margin-top:20px "></center>
                                        </form>

                                    <?php 
                                    }
                                }
                                   

                            } 
                        
                    }?>  
                </div>

                <div class="col-lg-8">
                    <h4 class="text-success text-center">
                        <strong><?php echo $ld->ld_tieude; ?></strong>
                    </h4>
                    <table class="table">
                        <tr>
                            <td>Môn:</td>
                            <td><strong><?php echo $ld->ld_mon; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Lớp:</td>
                            <td><strong><?php echo $ld->ld_khoilop; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Số lượng:</td>
                            <td><strong><?php echo $ld->ld_soluong; ?> Người</strong></td>
                        </tr>
                        <tr>
                            <td>Buổi dạy</td>
                            <td><strong><?php echo $ld->ld_buoiday; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Bắt đầu lúc:</td>
                            <td><strong><?php echo $ld->ld_thoigian; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Yêu Cầu:</td>
                            <td><strong><?php echo $ld->ld_yeucau; ?></strong></td>
                        </tr>
                        <tr class="info">
                            <td>Người đăng:</td>
                            <td><strong><?php echo $ph->ph_hoten; ?></strong></td>
                        </tr>
                        <tr class="info">
                            <td>Liên Hệ:</td>
                            <td><strong><?php echo $ph->ph_dienthoai; ?></strong></td>
                        </tr>
                        <tr class="info">
                            <td>Mô tả địa điểm: </td>
                            <td><strong><?php echo $ld->ld_mota_diadiem; ?></strong></td>
                        </tr>
                    </table>
                </div>
            </div> 
            <div class="col-md-12">
                    <?php if(!empty($ld->ld_diadiem)){?>
                        <div id="map" style="height: 300px;">ban do</div>
                        <?php
                    } 
                    else
                        echo "<center class=text-danger>Chưa cập nhật vị trí</center>"; ?>
            </div>         

        </div>
    </div>
    <?php } ?>
    <?php 
    } ?>

    </div>

    <div class="col-md-5">
    	<div class="panel panel-primary">
        <div class="panel-heading"><h4>Lớp đang cần gia sư khác</h4></div>
            <div class="panel-body">
            <?php
                if(isset($this->session->userdata('login')->tk_id)){
                $sql2 = "SELECT DISTINCT `ld_id`,`ld_tieude`, `ld_mon`, `ld_khoilop`, `ld_soluong`, `ld_yeucau`, `ld_buoiday`, `ld_thoigian`, `ld_diadiem`, `ld_mota_diadiem`, `ld_hinhanh`, `ld_trangthai`,dk_trangthai FROM lopday LEFT JOIN dangky ON lopday.ld_id = dangky.dk_ld_id WHERE (dk_trangthai = 0 OR dk_trangthai is NULL) AND (dk_gs_id is NULL OR dk_ld_id NOT IN (SELECT dk_ld_id FROM dangky WHERE dk_gs_id = ".$this->session->userdata('login')->tk_id.") ) LIMIT 0,4";
                }else{
                $sql2 = "SELECT DISTINCT `ld_id`,`ld_tieude`, `ld_mon`, `ld_khoilop`, `ld_soluong`, `ld_yeucau`, `ld_buoiday`, `ld_thoigian`, `ld_diadiem`, `ld_mota_diadiem`, `ld_hinhanh`, `ld_trangthai`,dk_trangthai FROM lopday LEFT JOIN dangky ON lopday.ld_id = dangky.dk_ld_id WHERE (dk_trangthai = 0 OR dk_trangthai is NULL) AND (dk_gs_id is NULL OR dk_ld_id NOT IN (SELECT dk_ld_id FROM dangky) ) LIMIT 0,4";
                }
                $ld2 = $this->db->query($sql2)->result();
                foreach ($ld2 as $ld2){?>

                        <div class="col-md-7 col-md-push-5">
                            <h4><?php echo $ld2->ld_tieude; ?></h4>
                            <p>
                            <span class="text-muted">Môn: </span><?php echo $ld2->ld_mon; ?><br/>
                            <span class="text-muted">Lớp: </span><?php echo $ld2->ld_khoilop; ?><br/>
                            <span class="text-muted">Số lượng: </span><?php echo $ld2->ld_soluong; ?><br/>
                            <span class="text-muted">Buổi dạy: </span><?php echo $ld2->ld_buoiday; ?><br/> 
                            <span class="text-muted">Thời gian bắt đầu: </span> <?php echo $ld2->ld_thoigian; ?><br/>
                            </p>
                            <p><a class="btn btn-default" href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $ld2->ld_id; ?>" role="button">Chi tiết &raquo;</a></p>

                         </div>
                         <div class="col-md-5 col-md-pull-7 box-padding">
                            <img class="featurette-image img-responsive center-block" src="<?php echo base_url().$ld2->ld_hinhanh; ?>" alt="Generic placeholder image">
                        </div>    
                <?php } ?>
        </div>   
    </div> 

</div><!-- containter-->
<div class="clear"></div>


<script src="<?php echo base_url(); ?>multibox/chosen.jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>multibox/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var config = {  '.chosen-select'           : {},
                    '.chosen-select-deselect'  : {allow_single_deselect:true},
                    '.chosen-select-no-single' : {disable_search_threshold:10},
                    '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                    '.chosen-select-width'     : {width:"100%"}
                 }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

</script>

<script type="text/javascript" charset="utf-8" async defer>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

jQuery(document).ready(function($) {(

    function(){

    window.onload = function() {

        var locations = [
            <?php
                echo "['".'Lớp '.$ld->ld_tieude.' Ở đây!'."', ".$ld->ld_diadiem.", ".$ld->ld_id."],";
            ?>
        ];


        var map = new google.maps.Map(document.getElementById('map'),{
            zoom: 12,
            center: new google.maps.LatLng(<?php echo $ld->ld_diadiem; ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        /* Make new marker when click map */
        google.maps.event.addListener(map, "rightclick", function(event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();
            var marker1 = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                map: map,
                icon: './img/iconmap.png',
                title: 'Nhấn chuột phải để xóa',
            });  
            var infowindow = new google.maps.InfoWindow();
            infowindow.setContent('Right Click to delete');
            infowindow.open(map, marker1);  

            marker1.addListener("rightclick", function() {
                marker1.setMap(null);
            });   
        });
        /* end make new marker when click map */

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

        /*search box google map*/
        var infowindow = new google.maps.InfoWindow();
        var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
        google.maps.event.addListener(searchBox, 'places_changed', function() {
         searchBox.set('map', null);
            var image = './img/iconmap.png';
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;
            for (i = 0; place = places[i]; i++) {
                (function(place) {
                 var marker = new google.maps.Marker({
                   position: place.geometry.location,
                   icon: image
                 });
                 marker.bindTo('map', searchBox, 'map');

                //show thong tin khi click vao marker
                marker.addListener('click', function() {
                    infowindow.setContent(place.name+"<br/>"+place.formatted_address);
                    infowindow.open(map, marker);
                });
                 
                 google.maps.event.addListener(marker, 'map_changed', function() {
                   if (!this.getMap()) {
                     this.unbindAll();
                   }
                 });
                 bounds.extend(place.geometry.location);

                }(place));

            }// end for
            map.fitBounds(bounds);
            searchBox.set('map', map);
            map.setZoom(Math.min(map.getZoom(),12));

        });/*end search box google map*/

  };
})();

}); //end jquery
</script>
