<?php if(!$this->session->userdata('login')) redirect(); ?>
<div class="container">

    <h2 class="text-lg"><span class="text-muted">Cập nhật</span> thông tin</h2>
    <hr>
    <p>Vui lòng điền đầy đủ thông tin bên dưới.</p>
    <p><i><small>Các trường có dấu (*) không thể bỏ trống. Right click vào bản đồ để nhận tọa độ</small></i></p>

    <?php
    $where = array('gs_tk_id' => $this->session->userdata('login')->tk_id);
    $giasu = $this->m_giasu->getGiaSuInfo($where); //var_dump($giasu);

    if($this->session->flashdata('message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
    } 
    ?>

    <div class="col-md-8">
    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin tài khoản</div>
        <div class="panel-body">
            <div class="col-md-12">
                <form class="form-horizontal" action="<?php echo base_url(); ?>giasu/changeInfo" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtEmail">Hình ảnh </label>
                        <div class="col-lg-3">
                            <img src="<?php echo isset($giasu) ? base_url().$giasu->gs_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="txtEmail">Email </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="txtEmail"  value="<?php echo $this->session->userdata('login')->tk_email;?>" disabled/> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="txtPass">T.Thái </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="txtTrangThai"  value="<?php echo $giasu->gs_trangthai==0 ? "Chưa có hiệu lực - Đang chờ duyệt" : "Đã được duyệt";?>" disabled/> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label" for="fileImg">Ảnh </label>
                                <div class="col-lg-9">
                                    <input type="file" class="form-control" name="fileImg"/> 
                                    <i class="text-danger"><?php echo form_error("fileImg"); ?></i>
                                </div>
                            </div>
                        </div>

                    </div>

                    

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtName">Họ tên <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="txtName" placeholder="nhập họ tên..."  value="<?php echo empty(set_value('txtName')) && isset($giasu) ? $giasu->gs_hoten : set_value('txtName');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtName"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="optSex">Giới tính <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <label class="radio-inline"><input type="radio" name="optSex" value=0 
                                <?php 
                                $val = strlen((set_value('optSex')))==0 && isset($giasu) ? $giasu->gs_gioitinh : set_value('optSex'); 
                                if($val==0 && $val!="") echo "checked";?>>Nam
                            </label>

                            <label class="radio-inline"><input type="radio" name="optSex" value=1
                            <?php 
                                $val = strlen((set_value('optSex')))==0 && isset($giasu) ? $giasu->gs_gioitinh : set_value('optSex'); 
                                if($val==1 && $val!="") echo "checked";?>>Nữ 
                            </label>
                            <i class="text-danger"><?php echo form_error("optSex"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="slNamSinh">Năm sinh <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <?php empty(set_value('slNamSinh')) && isset($giasu) ? Mylibrary::showYearOfBirth($giasu->gs_namsinh) : Mylibrary::showYearOfBirth(set_value('slNamSinh')); ?>
                            <i class="text-danger"><?php echo form_error("slNamSinh"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtPhone">Điện thoại <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" name="txtPhone" placeholder="nhập số điện thoại..."  value="<?php echo empty(set_value('txtPhone')) && isset($giasu) ? $giasu->gs_dienthoai : set_value('txtPhone');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtPhone"); ?></i>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="slTrinhDo">Trình độ <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <?php empty(set_value('slTrinhDo')) && isset($giasu) ? Mylibrary::showTrinhDo($giasu->gs_trinhdo) : Mylibrary::showTrinhDo(set_value('slTrinhDo')); ?>
                            <i class="text-danger"><?php echo form_error("slTrinhDo"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtChuyenNganh">Chuyên ngành <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="txtChuyenNganh" placeholder="nhập chuyên ngành.."  value="<?php echo empty(set_value('txtChuyenNganh')) && isset($giasu) ? $giasu->gs_chuyennganh : set_value('txtChuyenNganh');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtChuyenNganh"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtCongViec">Công việc </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="txtCongViec" placeholder="công việc hiện tại..."  value="<?php echo empty(set_value('txtCongViec')) && isset($giasu) ? $giasu->gs_congviec : set_value('txtCongViec');?>"/> 
                            <i class="text-danger"><?php echo form_error("txtCongViec"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php
                        $lat="";
                        $lng="";
                        if(!empty($giasu->gs_diadiem)){
                            $dd=explode(',', $giasu->gs_diadiem); //var_dump($dd);
                            $lat=$dd[0];
                            $lng=$dd[1];
                        }                  
                        ?>
                        <label class="col-lg-3 control-label" for="lat">Tọa độ <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-4">
                            <input type="text" id="element_3" class="form-control" name="lat" placeholder="R_Click vào bản đồ nhận tọa độ..." maxlength="255" readonly="true" value="<?php echo $lat; ?>"/> 
                            <i class="text-danger"><?php echo form_error("lat"); ?></i>
                        </div>

                        <div class="col-lg-5">
                            <input type="text" id="element_4" class="form-control" name="lng" placeholder="R_Click vào bản đồ nhận tọa độ..." maxlength="255" readonly="true" value="<?php echo $lng; ?>" /> 
                            <i class="text-danger"><?php echo form_error("lng"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label descriptionAddress" for="element_5">Tỉnh thành <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <input type="text" id="element_5" class="form-control" name="tinh" placeholder="R_Click vào bản đồ nhận địa chỉ..." maxlength="255" readonly="true" value="<?php echo $giasu->gs_diachi;?>"/> 
                            <i class="text-danger"><?php //echo form_error("tinh"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="lat">Bản đồ <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-9">
                            <!-- <input type="button" value="getValues" id="getValues" /> -->
                            <input id="pac-input" class="controls" type="text" placeholder="Nhập địa điểm cần tìm" style="width: 300px; height: 30px;">
                            <div id="map">ban do</div>
                        </div>
                    </div>
                     
                    <div class="form-group">
                        <label class="col-lg-3 control-label descriptionAddress" for="element_2">Mô tả địa điểm </label>
                        <div class="col-lg-9">
                            <textarea class="form-control" data-toggle="tooltip" data-placement="top" title="Bạn hãy ghi những điểm hay nổi bật của địa điểm, cũng như những điều cần lưu ý về địa điểm này ví dụ như giờ làm việc, phải liên hệ trước,..." name="note" rows="3"><?php echo $giasu->gs_motadiadiem; ?></textarea> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="description">Nội dung </label>
                        <div class="col-lg-9">
                            <textarea name="description" id="description" class="form-control"><?php  echo empty(set_value('description')) && isset($giasu) ? $giasu->gs_gioithieu : set_value('description'); ?></textarea>
                        </div>
                    </div>

                    <div class="col-sm-8 pull-right">
                        <input type="submit" name="submit" class="btn btn-warning btn-lg" value="Đồng ý">
                    </div>
                    
                </form>


            </div>
        </div>
    </div>
    </div>

    <?php $this->load->view("/layout/right_slidebar"); ?>

</div><!-- containter-->
<script>
    $(document).ready(function() {
        CKEDITOR.replace('description');
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<?php 
//$slTinh   = isset($_POST['slTinh']) ? $_POST['slTinh'] : NULL;
// if(!empty($slTinh)){
//     $where    = array( "ID_TINH" => $slTinh);
//     $this->db->where($where);
//     $result   = $this->db->get('tinh')->row(); //var_dump($result);
//     $toado    = $result->GHICHU;
// }
// else
if(!empty($giasu->gs_diadiem))
    $toado = $giasu->gs_diadiem;
else
    $toado    ="10.0345442,105.7214788"; //echo $toado;

$where    = array( "gs_tk_id" => $this->session->userdata('login')->tk_id);
$this->db->where($where);        
$q        = $this->db->get('giasu')->result(); //var_dump($q); echo $q[0]->gs_diadiem;
?>
<script type="text/javascript" charset="utf-8" async defer>
jQuery(document).ready(function($) {(

    function(){

    window.onload = function() {

        var locations = [
            <?php
            foreach ($q as $row) {
                echo "['".$row->gs_motadiadiem."', ".$row->gs_diadiem.", ".$row->gs_tk_id."],";
            }
            ?>
        ];

        // <?php
        // if(!$this->input->post('submit1') && !empty($q[0]->gs_diadiem))
        //     $toado = $row->gs_diadiem;
        // ?>

        var map = new google.maps.Map(document.getElementById('map'),{
            zoom: 12,
            center: new google.maps.LatLng(<?php echo $toado; ?>),
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
                title: 'Right Click to delete',
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
    

        var geocoder = new google.maps.Geocoder;
        google.maps.event.addListener(map, "rightclick", function(event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();

            //alert("Lat=" + lat + "; Lng=" + lng);
            $('#element_3').val(lat);   
            $('#element_4').val(lng); 
            geocodeLatLng(geocoder, map, infowindow);

        }); //end window onload
        

        // document.getElementById('submit').addEventListener('click', function() {
        //     geocodeLatLng(geocoder, map, infowindow);
        // });


        function geocodeLatLng(geocoder, map, infowindow) {
            var lat = document.getElementById('element_3').value;
            var lng = document.getElementById('element_4').value;
            var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
            geocoder.geocode({'location': latlng}, function(results, status) {
              if (status === 'OK') {
                if (results[1]) {
                  // map.setZoom(11);
                  // var marker = new google.maps.Marker({
                  //   position: latlng,
                  //   map: map
                  // });
                  // infowindow.setContent(results[1].formatted_address);
                  // infowindow.open(map, marker);
                  var arr = new Array();
                  $arr = results[1].formatted_address.split(", ");

                  $('#element_5').val($arr[$arr.length-2]); 
                } else {
                  window.alert('No results found');
                }
              } else {
                window.alert('Geocoder failed due to: ' + status);
              }
            });
        }

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