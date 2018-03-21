<?php if(!$this->session->userdata('login')) redirect(); ?>


<div class="container">

    <h2 class="text-lg"><span class="text-muted">Thêm địa điểm</span> vào bản đồ</h2>
    <hr>
    <p>Vui lòng điền đầy đủ thông tin bên dưới.</p>
    <p><i><small>Các trường có dấu (*) không thể bỏ trống</small></i></p>

    <?php
    if($this->session->flashdata('message')){ ?>
        <div class="alert alert-warning fade in alertStyle">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
    } ?>

    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin tài khoản</div>
        <div class="panel-body">
            <div class="col-md-7">
                <form class="form-horizontal" action="<?php echo base_url(); ?>giasu/locationMap" method="post">

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="lat">Tọa độ Lat <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-4">
                            <input type="text" id="element_3" class="form-control" name="lat" placeholder="R_Click vào bản đồ nhận tọa độ..." maxlength="255" value="" readonly="true"/> 
                            <i class="text-danger"><?php echo form_error("lat"); ?></i>
                        </div>

                        <label class="col-lg-2 control-label" for="lng">Tọa độ Long <span class="text-danger"><strong>(*)</strong></span></label>
                        <div class="col-lg-4">
                            <input type="text" id="element_4" class="form-control" name="lng" placeholder="R_Click vào bản đồ nhận tọa độ..." maxlength="255" value="" readonly="true"/> 
                            <i class="text-danger"><?php echo form_error("lng"); ?></i>
                        </div>
                    </div>
                     
                    <div class="form-group">
                        <label class="col-lg-2 control-label description" for="element_2">Mô tả địa điểm </label>
                        <div class="col-lg-10">
                            <textarea class="form-control" data-toggle="tooltip" data-placement="top" title="Bạn hãy ghi những điểm hay nổi bật của địa điểm, cũng như những điều cần lưu ý về địa điểm này ví dụ như giờ làm việc, phải liên hệ trước,..." name="note" rows="3"></textarea> 
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8 pull-right">
                            <input type="submit" name="submit" class="btn btn-warning" value="Đồng ý">
                        </div>
                    </div>
                    
                </form>

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
                <form class="form-horizontal" method="post" action="">

                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group ">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3">

                                    <select name='slTinh' id="slTinh" class='form-control'>
                                        <option value="">Chọn Tỉnh thành</option>
                                        <?php
                                        $tinh=$this->db->get('tinh')->result();
                                        foreach ($tinh as $row) { ?>
                                            <option value="<?php echo $row->ID_TINH; ?>" <?php if($slTinh==$row->ID_TINH) echo "selected"; ?>>
                                            <?php echo $row->TENTINH; ?></option>
                                            <?php
                                        } ?>
                                    </select>
                                    <i class="text-danger"><?php echo form_error("slTinh"); ?></i>
                                </div>
                                <div class="col-lg-1 text-center">
                                    <input type="submit" class="btn btn-warning" name="submit1" value="Tìm">
                                </div>
                                <div class="col-lg-3"></div>
                            </div>

                        </div>
                    </div>
                </form>
                <input type="button" value="getValues" id="getValues" />
                <input id="pac-input" class="controls" type="text" placeholder="Nhập địa điểm cần tìm" style="width: 300px; height: 30px;">
                <div id="map">ban do</div>

                <script type="text/javascript" charset="utf-8" async defer>
                $(document).ready(function(){
                    $('[data-toggle="tooltip"]').tooltip();
                });

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

                        <?php
                        if(!$this->input->post('submit1') && !empty($q[0]->gs_diadiem))
                            $toado = $row->gs_diadiem;
                        ?>

                        var map = new google.maps.Map(document.getElementById('map'),{
                            zoom: 12,
                            center: new google.maps.LatLng(<?php echo $toado; ?>),
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



            </div>
        </div>
    </div>

</div><!-- containter-->