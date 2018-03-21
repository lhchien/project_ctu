<?php if(!$this->session->userdata('login')) redirect(); ?>
<div class="container">
<link rel="stylesheet" href="<?php echo base_url(); ?>multibox/prism.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>multibox/chosen.css">
<div class="container">

    <h2 class="text-lg"><span class="text-muted">Chỉnh sửa thông tin</span> lớp cần gia sư</h2>
    <?php
    $where = array('ph_tk_id' => $this->session->userdata('login')->tk_id);
    $phuhuynh = $this->m_phuhuynh->getClassInfo($where);

    if($this->session->flashdata('message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
    } ?>

    <div class="panel panel-warning">
        <div class="panel-heading"><p>Vui lòng điền đầy đủ thông tin bên dưới / <i><small>Các trường có dấu <span class="text-danger"><strong>(*)</strong></span> không thể bỏ trống</small></i></p></div>
        <div class="panel-body">
            <div class="col-md-12">
                <form class="form-horizontal" action="<?php echo base_url(); ?>phuhuynh/opennewclass_change" method="post" enctype="multipart/form-data">

                <?php
                    foreach ($class as $ld) {
                ?>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtTitle">Tiêu đề: <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-7">
                            <input type="text" hidden="hidden" name="txt_id" value="<?php echo $ld->ld_id; ?>" /> 
                            <input type="text" class="form-control form-hg" name="txtTitle" placeholder="Nhập tiêu đề của lớp..."  value="<?php echo empty(set_value('txtTitle')) && isset($ld) ? $ld->ld_tieude :set_value('txtTitle')?>"/> 
                            <i class="text-danger"><?php echo form_error("txtTitle"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label" for="txtImage"></label>
                        <div class="col-lg-2">
                            <img src="<?php echo isset($ld) ? base_url().$ld->ld_hinhanh :  base_url().'img/no_img.jpg'; ?>" class="img-responsive">
                        </div>
                        
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="fileImg">Hình ảnh:</label>
                                <div class="col-lg-8">
                                    <input type="file" class="form-control" name="fileImg"/> 
                                    <i class="text-danger"><?php echo form_error("fileImg"); ?></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="txtSubject"> Môn học: <span class="text-danger"><strong>(*)</strong></span></label>
                                <div class="col-lg-8">
                                    <label class="sr-only" for="txtSubject">Subject</label>
                                    <?php empty(set_value('slSubject'))  && isset($ld) ? Mylibrary::showMon_ph($ld->ld_mon) : Mylibrary::showMon_ph(set_value('slSubject')); ?>
                                    <i class="text-danger"><?php echo form_error("slSubject"); ?></i>
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="Lop">Lớp: <span class="text-danger"><strong>(*)</strong></span></label>
                                <div class="col-lg-8">
                                    <label class="sr-only" for="exampleInputEmail3">Class</label>
                                     <?php empty(set_value('slClass')) && isset($ld) ? Mylibrary::showLop_ph($ld->ld_khoilop) : Mylibrary::showLop_ph(set_value('slClass')); ?>
                                    <i class="text-danger"><?php echo form_error("slClass"); ?></i>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="txtXNMatKhau">Số lượng: <span class="text-danger"><strong>(*)</strong></span></label>
                                <div class="col-lg-8">
                                    <label class="sr-only" for="exampleInputEmail3">Class</label>
                                   <?php empty(set_value('slMount')) && isset($ld) ? Mylibrary::showSoLuong($ld->ld_soluong) : Mylibrary::showSoLuong(set_value('slMount')); ?>
                                    <i class="text-danger"><?php echo form_error("slMount"); ?></i>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="multiBuoi">Các buổi có thể học <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-7">
                            <?php
                            empty(set_value('checkBuoi')) && isset($ld) ? Mylibrary::checkBuoiHoc(explode(',',$ld->ld_buoiday)) : Mylibrary::checkBuoiHoc(set_value('checkBuoi'));
                            //var_dump($ld->ld_buoiday);?>
                            <i class="text-danger"><?php echo form_error("checkBuoi[]"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="txtTime">Thời gian lớp bắt đầu: <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-3">
                            <input type="time" class="form-control form-hg" name="txtTime" value="<?php echo empty(set_value('txtTime')) && isset($ld) ? $ld->ld_thoigian :set_value('txtTime');?>"/>
                            <i class="text-danger"><?php echo form_error("txtTime"); ?></i>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label" for="description">Địa điểm: <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-7">
                            <?php 
                            $slTinh   = isset($_POST['slTinh']) ? $_POST['slTinh'] : NULL;
                            if(!empty($slTinh)){
                                $where    = array( "ID_TINH" => $slTinh);
                                $this->db->where($where);
                                $result   = $this->db->get('tinh')->row(); //var_dump($result);
                                $toado    = $result->GHICHU;
                            }
                            else
                                $toado    ="10.0345442,105.7214788"; //echo $toado;

                            $where    = array( "gs_tk_id" => $this->session->userdata('login')->tk_id);
                            $this->db->where($where);        
                            $q        = $this->db->get('giasu')->result(); //var_dump($q); echo $q[0]->gs_diadiem;
                            ?>
                            <i class="text-danger"><?php echo form_error("lat"); ?></i>
                            <p><i><label class="control-label"><small>Nhấp chuột phải trên bản đồ xác định vị trí lớp học.</small></label></i></p>
                            <input type="button" value="getValues" id="getValues" class="sr-only" />
                            <input id="pac-input" class="controls pull-right" type="text" placeholder="Tìm nhanh Tỉnh, Thành phố .../ Vi dụ: Cần Thơ" style="width: 60%; height: 40px;">
                            <div id="map" class="col-sm-8">ban do</div>
                        </div>
                    </div>

                    <?php $toa_do = (explode(',',$ld->ld_diadiem));?>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="lat"></label>
                        <div class="col-lg-3">
                            <input type="text" id="element_3" class="form-control" name="lat" placeholder="Kinh tuyến" maxlength="255" value="<?php echo empty(set_value('lat')) && isset($toa_do) ? $toa_do[0] : set_value('lat');?>" readonly="true"/> 
                            
                        </div>
                        <div class="col-lg-3">
                            <input type="text" id="element_4" class="form-control" name="lng" placeholder="Vĩ tuyến" maxlength="255" value="<?php echo empty(set_value('lat')) && isset($toa_do) ? $toa_do[1] : set_value('lng');?>" readonly="true"/> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label description" for="element_2">Mô tả chi tiết địa điểm: </label>
                        <div class="col-lg-7">
                            <textarea name="mota_diadiem" id="description" class="form-control" rows="2"><?php echo empty(set_value('mota_diadiem')) && isset($ld) ? $ld->ld_mota_diadiem : set_value('mota_diadiem');?>
                            </textarea> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="description">Yêu cầu khác: </label>
                        <div class="col-lg-7">
                            <textarea name="mota_yeucau" id="description" class="form-control" rows="5"><?php echo empty(set_value('mota_yeucau')) && isset($ld) ? $ld->ld_yeucau : set_value('mota_yeucau');?>
                            </textarea>
                        </div>
                    </div>

                    <div class="col-sm-7 pull-right">
                        <input type="submit" name="submit" class="btn btn-warning btn-lg" value="Hoàn tất cập nhật" >
                    </div>
                    <?php } ?>
                    
                </form>
            </div>
        </div>
    </div>

</div><!-- containter-->

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
                echo "['".$ld->ld_tieude.' Ở đây!'."', ".$ld->ld_diadiem.", ".$ld->ld_id."],";
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
