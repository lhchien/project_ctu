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
<!-- Popup xem chi tiết -->

<?php 
$slTinh = isset($_POST['slTinh']) ? $_POST['slTinh'] : NULL; 
$slMon  = isset($_POST['slMon']) ? $_POST['slMon'] : NULL; 
//echo $slTinh.", ".$slMon; //var_dump(empty($slTinh));
if($slTinh!=""){
    $where    = array( "ID_TINH" => $slTinh);
    $this->db->where($where);
    $result   = $this->db->get('tinh')->row(); //var_dump($result);
    $toado    = $result->GHICHU;
    $tentinh   = $result->TENTINH;
}
else
    $toado    ="10.0345442,105.7214788"; //echo $toado;

if(isset($_POST['submit'])){
    if($slMon!=""){  
        $s="SELECT DISTINCT
             `gs_tk_id`, `gs_hoten`, `gs_gioitinh`, `gs_namsinh`, `gs_dienthoai`, `gs_diadiem`, `gs_motadiadiem`, `gs_hinhanh`, `gs_gioithieu`, `gs_trinhdo`, `gs_chuyennganh`, `gs_congviec`, `gs_ngayday`, `gs_gioday`, `gs_kinhnghiem`, `gs_trangthai`, `dl_mon`, `dl_gs_id` 
             FROM giasu a, daylop b 
             WHERE a.gs_tk_id=b.dl_gs_id AND gs_trangthai=1 AND dl_mon like '".$slMon."'";

        if($slTinh!="")
            $s .= " AND gs_diachi like '%".$tentinh."'";

        $q=$this->db->query($s)->result();

    }
    else{
        $s="SELECT DISTINCT
             `gs_tk_id`, `gs_hoten`, `gs_gioitinh`, `gs_namsinh`, `gs_dienthoai`, `gs_diadiem`, `gs_motadiadiem`, `gs_hinhanh`, `gs_gioithieu`, `gs_trinhdo`, `gs_chuyennganh`, `gs_congviec`, `gs_ngayday`, `gs_gioday`, `gs_kinhnghiem`, `gs_trangthai`, `dl_mon`, `dl_gs_id` 
             FROM giasu a, daylop b 
             WHERE a.gs_tk_id=b.dl_gs_id AND gs_trangthai=1";

        if($slTinh!="")
            $s .= " AND gs_diachi like '%".$tentinh."'";

        $q=$this->db->query($s)->result();
    }
}
//var_dump($q);// die();
if(isset($_POST['slTinh']) || isset($_POST['slMon'])){ ?>
    <div class="chitiet">
        <table id="tablechitiet" class="table table-striped table-hover table-bordered tableData">
            <thead>
            <tr>
                <th colspan="2" class="text-center">Gia sư <?php //echo $s;?> khu vực <?php //echo $result->TENTINH; ?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></th>
            </tr>
            </thead>
            
            <tr>
                <td>
                <!--<input type="button" value="getValues" id="getValues" />-->
                <!-- <marquee behavior="alternate"> -->
                <!-- <b class="text-danger">Hướng dẫn:</b>
                <i class="text-primary">Click vào marker để xem thông tin gia sư<?php //echo $toado; ?></i> -->
                <!-- </marquee> -->
                <center>
                <form class="form-inline">
                    <?php empty($slmon) ? Mylibrary::showMonNonMulti() : Mylibrary::showMonNonMulti($slmon); ?>
                    <select data-placeholder="Chọn lớp học..." class="form-control form-hg" name="slLop" id="slLop" style="width: 150px;">
                        <option value="">Chọn lớp</option>
                        <?php
                        for($i=1; $i<=12; $i++){ ?>
                            <option value="<?php echo 'Lớp '.$i; ?>" <?php //if($slLop=="Lớp $i") echo "selected";?>><?php echo 'Lớp '.$i; ?></option>
                            <?php
                        } ?>
                        <option value='Luyện thi đại học' <?php //if($slLop=='Luyện thi đại học') echo "selected";?>>Luyện thi đại học</option>
                        <option value='Luyện thi HS giỏi' <?php //if($slLop=='Luyện thi HS giỏi') echo "selected";?>>Luyện thi HS giỏi</option>
                    </select>
                    <select name='slNamKN' id="slNamKN" class='form-control form-hg' style="width: 150px;">
                        <option value="">Chọn năm KN</option>
                        <option value="0">Chưa có KN</option>
                        <?php
                        for($i=1; $i<=20; $i++){ ?>
                            <option value="<?php echo $i; ?>" <?php //if($slnamkn==$i) echo "selected";?>><?php echo $i.' năm'; ?></option>
                            <?php
                        } ?>
                    </select>

                    <select name='slTinh' id="slTinh" class='form-control form-hg'>
                        <option value="">Chọn tỉnh</option>
                        <?php
                        $tinh=$this->db->get('tinh')->result();
                        foreach ($tinh as $row) { ?>
                            <option value="<?php echo $row->ID_TINH; ?>" <?php if($slTinh==$row->ID_TINH) echo "selected"; ?>>
                            <?php echo $row->TENTINH; ?></option>
                            <?php
                        } ?>
                    </select>
                    
                    <!-- <input type="button" value="Tìm" id="filterGS" class="btn btn-primary" /> -->
                </form><br/>
                </center>

                <div id="map" style="height: 380px;"></div>
                <input id="pac-input" class="controls" type="text" placeholder="Nhập địa điểm cần tìm" style="width: 300px; height: 30px;">
                </td>
            </tr>
            <tr>
                <td colspan="5" align="center">
                    <input type="button" value=" Đóng " name="close" class="btn btn-xs btn-info btnclose" />
                </td>
            </tr>
        </table>   
    </div>
    <?php
}?>
<div id="ketqua"></div>

    <!-- Page Content -->

    <div class="jumbotron">
      <div class="container">
        <center>
        <h1>Chào mừng đến với </br> Gia Sư Online!</h1>
        <h2>Tìm gia sư gần vị trí của bạn trên Google Maps</h2>
        <form class="form-inline" method="post" name="form" id="form1" action="">
             <a type="button" id="bntvitriht" class="btn btn-danger btn-lg detail" name="vitriht" style="margin-bottom: 70px; padding: 20px; "> <span class="glyphicon glyphicon-screenshot"></span> Tìm <b>gia sư</b> theo vị trí hiện tại</a>
             <a type="button" id="bntvitriht_ph" class="btn btn-success btn-lg detail" name="vitriht_ph" style="margin-bottom: 70px; padding: 20px; "> <span class="glyphicon glyphicon-screenshot"></span> Tìm <b>lớp</b> theo vị trí hiện tại</a>
             </br>

            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail3">Subject</label>
                <?php Mylibrary::showMonNonMulti(); //empty(set_value('slMon')) ? Mylibrary::showMonNonMulti() : Mylibrary::showMonNonMulti(set_value('slMon')); ?>
            </div>

            <div class="form-group">
                <label class="sr-only" for="exampleInputPassword3">Place</label>
                <?php $slTinh   = isset($_POST['slTinh']) ? $_POST['slTinh'] : NULL; ?>
                <select name='slTinh' id="slTinh" class='form-control form-hg'>
                    <option value="">Bạn ở đâu?</option>
                    <?php
                    $tinh=$this->db->get('tinh')->result();
                    foreach ($tinh as $row) { ?>
                        <option value="<?php echo $row->ID_TINH; ?>" <?php if($slTinh==$row->ID_TINH) echo "selected"; ?>>
                        <?php echo $row->TENTINH; ?></option>
                        <?php
                    } ?>
                </select>
            </div>
            <input type="submit" id="bntsubmit" class="btn btn-primary btn-lg detail" value="Tìm gia sư theo tỉnh thành" name="submit">
        </form>
        </center>
      </div>
    </div>

    <div class="container">

        <!-- Introduct Page -->

        <div class="row featurette">
            <div class="col-md-7 col-md-push-5">
                <h2 class="featurette-heading">Giới thiệu <span class="text-muted">Gia Sư Online.</span></h2>
                <p class="lead">Cám ơn bạn đã đến với web Gia Sư Online! Trang web hàng đầu về tìm kiếm gia sư trực tuyến tại Việt Nam. Bạn có thể dễ dàng tìm cho mình một gia sư dạy kèm tại nhà một cách nhanh chóng tiện lợi. Với đội ngũ gia sư đầy nhiệt huyết và kinh nghiệm sẽ giúp các bạn có được thành tích tốt nhất trong quá trình học tập. <br> Gia sư dễ dàng tìm cho mình lớp để giảng dạy nhanh chóng phù hợp. </p>
            </div>
            <div class="col-md-5 col-md-pull-7">
                <img class="featurette-image img-responsive center-block" src="img/presenter-talking-about-people-on-a-screen.png" alt="Generic placeholder image">
            </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END Introduct Page -->

    <!-- Best tutors ò the year -->
    <div class="container best-per">
        <div class="row">
            <center><h2 class="text-lg"><span style="color: #eea236">Gia sư xuất sắc </span> của năm</h2></center>
            <?php

            $sql2 = "SELECT * FROM giasu ORDER BY gs_tk_id";
            $giasu = $this->db->query($sql2)->result();


            $arr1 = array();
            $arr2 = array();
            foreach ($giasu as $giasu) {

                $sql = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND (dk_trangthai = 1 OR dk_trangthai = -2) AND ld_diem_cmt is not NULL  AND b.dk_gs_id =".$giasu->gs_tk_id;

                $gs = $this->db->query($sql)->result();
                $row = ($this->db->query($sql)->num_rows()==0)?1:$this->db->query($sql)->num_rows();
                $diem = 0;
                foreach ($gs as $gs) {
                    $diem += $gs->ld_diem_cmt;
                }
                
                $a = $diem/$row;

                array_push($arr1, $giasu->gs_tk_id);
                array_push($arr2, $a);
            }
            $arr3=array_combine($arr1,$arr2);
            arsort($arr3);

            $b=0;
            foreach ($arr3 as $key => $val) {
                $b++;
                if($b>3)
                    break;

                $sql = "SELECT * FROM giasu where gs_tk_id=$key";
                $giasu = $this->db->query($sql)->row();
                ?>
                <div class="col-lg-4">
                    <a href="<?php echo base_url(); ?>giasu/detail/<?php echo $giasu->gs_tk_id; ?>" role="button">
                    <img class="img-circle" src="<?php echo base_url().$giasu->gs_hinhanh;?>" alt="Generic placeholder image" width="140" height="140">
                    </a>
                    <h2><?php echo $giasu->gs_hoten; ?></h2>
                    <p><span class="text-muted">Trình độ: </span><?php echo $giasu->gs_trinhdo; ?></p>
                    <p><span class="text-muted">Chuyên ngành: </span><?php echo $giasu->gs_chuyennganh; ?></p>
                    <p><span class="text-muted">Kinh nghiệm: </span><?php echo $giasu->gs_kinhnghiem." năm"; ?></p>
                    <p><span class="text-muted">Liên lạc: </span><?php echo $giasu->gs_dienthoai; ?></p>
                    <p><span class="text-muted">Đánh giá: </span>
                    <?php 
                            $sql = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND (dk_trangthai = 1 OR dk_trangthai = -2) AND ld_diem_cmt is not NULL  AND b.dk_gs_id =".$giasu->gs_tk_id; //echo $sql;
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
                            echo " ".round($a, 1);
                        ?></p>
                    <p><a class="btn btn-default" href="<?php echo base_url(); ?>giasu/detail/<?php echo $giasu->gs_tk_id; ?>" role="button">Chi tiết &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <?php
            } 
            //var_dump($arr);
            ?>
        </div><!-- /.row -->
    </div><!-- End class container -->

    <hr class="featurette-divider">

    <!-- Class need tutor -->
    <div class="container">
        <div class="row subject">
            <a href="#"><center><h2 class="text-lg"><span class="text-muted">Các lớp </span> cần gia sư</h2></center></a>

            <?php
            $sql="SELECT * FROM lopday WHERE ld_trangthai=1 AND ld_id NOT IN 
                 (SELECT dk_ld_id FROM dangky WHERE dk_trangthai=1) ORDER BY ld_id desc LIMIT 4";
            //$sql="SELECT * FROM lopday ORDER BY ld_id desc LIMIT 6";
            //echo $sql;
            $lopday = $this->db->query($sql)->result();
            foreach ($lopday as $lopday) {
        
            ?>

            <div class="col-lg-6">
                <a href="<?php echo base_url(); ?>lopday/detail/<?php echo $lopday->ld_id; ?>">
                <div class="col-md-7 col-md-push-5">
                    <h4><?php echo $lopday->ld_tieude; ?></h4>
                    <p><span class="text-muted">Môn học: </span><?php echo $lopday->ld_mon; ?></p>
                    <p><span class="text-muted">Khối lớp: </span><?php echo $lopday->ld_khoilop; ?></p>
                    <p><span class="text-muted">Buổi dạy: </span><?php echo $lopday->ld_buoiday; ?></p>
                    <p><span class="text-muted">Số lượng: </span><?php echo $lopday->ld_soluong." học sinh"; ?></p>
                    <?php
                    $sql1 = "SELECT * FROM phuhuynh WHERE ph_tk_id=$lopday->ph_tk_id"; //echo $sql1;
                    $phuhuynh = $this->db->query($sql1)->row();
                    ?>
                    <p><span class="text-muted">Liên hệ: </span><?php echo $phuhuynh->ph_dienthoai; ?></p>
                    <p><a class="btn btn-default" href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $lopday->ld_id; ?>" role="button">Chi tiết &raquo;</a></p>
                </div>
                </a>

                <a href="<?php echo base_url(); ?>lopday/detail/<?php echo $lopday->ld_id; ?>">
                <div class="col-md-5 col-md-pull-7 box-padding">
                    <img class="featurette-image img-responsive center-block" src="<?php echo base_url().$lopday->ld_hinhanh;?>" alt="Generic placeholder image">
                </div>
                </a>
            </div>
            <?php
            }?>

        </div><!-- End row -->
    </div><!--End Class need tutor -->

<script>
$(document).ready(function(){

    var lat = -1;
    var lon = -1;
    var arr = new Array();
    var geocoder = new google.maps.Geocoder;
    var infowindow = new google.maps.InfoWindow();
    
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else { 
            alert("Trình duyệt của bạn không hỗ trợ xác định vị trí hiện tại.");
        }
    }

    function showPosition(position) {
        lat = position.coords.latitude;
        lon = position.coords.longitude;
        latlon = new google.maps.LatLng(lat, lon);
        map = document.getElementById('map');

        var myOptions = {
        center:latlon,zoom:14,
        mapTypeId:google.maps.MapTypeId.ROADMAP,
        mapTypeControl:false,
        navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
        }
        
        
        function geocodeLatLng(geocoder, map, infowindow) {
            var latlng = {lat: parseFloat(lat), lng: parseFloat(lon)};
            geocoder.geocode({'location': latlng}, function(results, status) {
              if (status === 'OK') {
                if (results[1]) {
                  $arr = results[1].formatted_address.split(", ");
                  //alert($arr[$arr.length-2]);
                  //tinh=$arr[$arr.length-2]; 
                } else {
                  window.alert('No results found');
                }
              } else {
                window.alert('Geocoder failed due to: ' + status);
              }
            });
        }

        geocodeLatLng(geocoder, map, infowindow);
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("Bạn đã từ chối cấp quyền định vị.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Không có thông tin vị trí này.");
                break;
            case error.TIMEOUT:
                alert("Hết thời gian gửi yêu cầu định vị.");
                break;
            case error.UNKNOWN_ERROR:
                alert("Lỗi chưa xác định.");
                break;
        }
    }
    getLocation();



    // $(window).load(function() {
    //     getLocation();
    // });

    $("#bntsubmit").click(function(){
        var sltinh = document.getElementById("slTinh");
        var slmon = document.getElementById("slMon");
        /*&& lat==-1 && lon==-1*/
        if(sltinh.value==""){
            alert("Bạn phải chọn tỉnh cần tìm!");
            return false;
        }
        return true;
    });

    // $("#slMon").change(function(){
    //     getLocation();
    // });

    $("#bntvitriht").click(function(){
        var slmon = document.getElementById("slMon");
        // if( slmon.value==""){
        //     alert("Bạn phải chọn môn cần tìm!");
        //     return false;
        // }
        //getLocation();
        if(lat==-1 && lon==-1){
            alert("Bạn phải cho phép truy cập vị trí!");
            return false;
        }
        else{ 
            //alert($arr[$arr.length-2]);
            $.ajax({
                url : "<?php echo base_url('a_thisposition/submit'); ?>",
                type : "get",
                dateType:"text",
                data : {
                     lat : lat,
                     lon : lon,
                     tinh: $arr[$arr.length-2],
                     slmon: slmon.value
                },
                success : function (result){
                    //alert(result);
                    $('#ketqua').html(result);
                }
            });
            $('#ketqua').show('slow'); 
            //$('#slTinh').attr('disabled', 'disabled');
        }
    });

    /**************/
    $("#bntvitriht_ph").click(function(){
        if(lat==-1 && lon==-1){
            alert("Bạn phải cho phép truy cập vị trí!");
            return false;
        }
        else{ 
            //alert(lon);
            $.ajax({
                url : "<?php echo base_url('a_thisposition_ph/submit'); ?>",
                type : "get",
                dateType:"text",
                data : {
                     lat : lat,
                     lon : lon
                },
                success : function (result){
                    //alert(result);
                    $('#ketqua').html(result);
                }
            });
            $('#ketqua').show('slow'); 
            //$('#slTinh').attr('disabled', 'disabled');
        }
    });
    /**************/


    $("#slMon, #slNamKN, #slLop, #slTinh").change(function(){
        var slmon = document.getElementById("slMon");
        var slnamkn = document.getElementById("slNamKN");
        var sllop = document.getElementById("slLop");
        var sltinh = document.getElementById("slTinh");
        //alert(slmon.value+"-"+slnamkn.value+"-"+sllop.value+"-"+sltinh.value);

        $.ajax({
            url : "<?php echo base_url('a_thisposition1/submit'); ?>",
            type : "get",
            dateType:"text",
            data : {
                slmon: slmon.value,
                sllop: sllop.value,
                slnamkn: slnamkn.value,
                sltinh: sltinh.value,
            },
            success : function (result){
                //alert(result);
                $('#map').html(result);
            }
        });
        //$('#ketqua').show('slow'); 
    });

    
});
</script>

<script type="text/javascript" charset="utf-8" async defer>     
    $(document).ready(function() {
        
        //dong table dang nhap
        $('.close, .btnclose').click(function() {
            $('.chitiet').hide('slow');
            $('#ketqua').hide('slow');
            //$('#slTinh').removeAttr('disabled');
        });

        $('#tablechitiet').click(function(e){
                e.stopPropagation();
        });

    });
    jQuery(document).ready(function($) {(

        function(){

        window.onload = function() {
            // var locations = [
            // ['Le bao trang, 0936 701 279, hocthuatcanban.com', 10.04441595395967,105.75593948364258,1],
            // ['def', 10.022948394510141,105.8477783203125,2]
            // ];

            var locations = [
                <?php
                
                foreach ($q as $row) {

                    // $lop = $mon = "";
                    // $s1="SELECT DISTINCT dl_lop FROM daylop WHERE dl_gs_id=$row->gs_tk_id ORDER BY dl_lop";
                    // $dl = $this->db->query($s1)->result(); 
                    // foreach ($dl as $dl) {
                    //     $lop .="- ".$dl->dl_lop." ";
                    // }

                    // $s2="SELECT DISTINCT dl_mon FROM daylop WHERE dl_gs_id=$row->gs_tk_id ORDER BY dl_mon";
                    // $dm = $this->db->query($s2)->result(); 
                    // foreach ($dm as $dm) {
                    //     $mon .="- ".$dm->dl_mon." ";
                    // }

                    $mon = "<b>Dạy môn: </b>"; 
                    $s2="SELECT DISTINCT dl_mon FROM daylop WHERE dl_gs_id=$row->gs_tk_id ORDER BY dl_mon"; 
                    $dm = $this->db->query($s2)->result(); 
                    foreach ($dm as $dm) { 
                        $lop = "";
                        $mon .="- ".$dm->dl_mon." (";

                        $s1="SELECT DISTINCT dl_lop FROM daylop WHERE dl_gs_id=$row->gs_tk_id AND dl_mon like '".$dm->dl_mon."' ORDER BY dl_lop"; 
                        $dl = $this->db->query($s1)->result(); 
                        foreach ($dl as $dl) { 
                            $lop .="- ".$dl->dl_lop;
                        } 
                        $lop .= ")<br/>";
                        $mon .= $lop;
                    } 

                    $mota = "<div id=wrapPopupMap>";
                    $mota.= "<div id=trai><img src=./".$row->gs_hinhanh." id=img-map></div>";
                    $mota.= "<div id=phai>";
                    $mota.= "<b>Họ tên/Năm sinh: </b>".$row->gs_hoten."-".$row->gs_namsinh."<br/>";
                    $mota.= "<b>Điện thoại: </b>".$row->gs_dienthoai."<br/>";
                    $mota.= "<b>Trình độ: </b>".$row->gs_trinhdo."<br/>";
                    //$mota.= "<b>Dạy lớp: </b>".$lop."<br/>";
                    //$mota.= "<b>Dạy môn: </b>".$mon."<br/>";
                    $mota.= $mon;
                    $mota.= "<b>Mô tả địa điểm: </b>".$row->gs_motadiadiem."<br/>";
                    $mota.= "<b>Kinh nghiệm: </b>".$row->gs_kinhnghiem." năm <br/>";
                    $mota.= "</div>";
                    $mota.= "</div>";
                    echo "['".$mota."', ".$row->gs_diadiem.",'".Mylibrary::getIconImg($row->dl_mon)."'],"; 
                    //echo "['".$mota."', ".$row->gs_diadiem.", ".$row->gs_tk_id."],";
                }
                ?>
            ];

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
                    icon:locations[i][3],
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
                        } 
                        // else {
                        //     marker.setAnimation(google.maps.Animation.BOUNCE);
                        // }
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
            // document.getElementById('getValues').onclick = function() {
            //     alert('Current Zoom level is ' + map.getZoom());
            //     alert('Current center is ' + map.getCenter());
            //     alert('The current mapType is ' + map.getMapTypeId());
            // }

            google.maps.event.addListener(map, "rightclick", function(event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();

            alert("Lat=" + lat + "; Lng=" + lng);
            $('#element_3').val(lat);
            //$("#element_3").attr("disabled", "disabled");    

            $('#element_4').val(lng);
            //$("#element_4").attr("disabled", "disabled");    

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