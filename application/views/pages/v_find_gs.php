<!-- register page -->

<?php
    //GLOBAL $slmon, $sllop, $slnamkn, $sltinh, $slgioitinh, $sltrinhdo;
    $slmon  = isset($_POST['slMon']) ? $_POST['slMon'] : NULL;
    $sllop  = isset($_POST['slLop']) ? $_POST['slLop'] : NULL;
    $slnamkn  = isset($_POST['slNamKN']) ? $_POST['slNamKN'] : NULL;
    $sltinh  = isset($_POST['slTinh']) ? $_POST['slTinh'] : NULL;
    $slgioitinh  = isset($_POST['slGioiTinh']) ? $_POST['slGioiTinh'] : "";
    $sltrinhdo  = isset($_POST['slTrinhDo']) ? $_POST['slTrinhDo'] : NULL;

    $sql = "SELECT DISTINCT
                 `gs_tk_id`, `gs_hoten`, `gs_gioitinh`, `gs_namsinh`, `gs_dienthoai`, `gs_diadiem`, `gs_motadiadiem`, `gs_hinhanh`, `gs_gioithieu`, `gs_trinhdo`, `gs_chuyennganh`, `gs_congviec`, `gs_ngayday`, `gs_gioday`, `gs_kinhnghiem`, `gs_trangthai`, `dl_gs_id` 
                 FROM giasu a, daylop b 
                 WHERE a.gs_tk_id=b.dl_gs_id AND gs_trangthai=1"; 
    //$sql = "SELECT * FROM giasu WHERE gs_trangthai=1"; 
    if($slnamkn!=NULL){
        $sql .= " AND gs_kinhnghiem = '".$slnamkn."'";
    }
    if($sltinh!=NULL){
        $s1 = "SELECT TENTINH FROM tinh WHERE ID_TINH=$sltinh";
        $tinh = $this->db->query($s1)->row();
        $sql .= " AND gs_diachi like '".$tinh->TENTINH."'";
    }
    if($slgioitinh!=NULL){
        $sql .= " AND gs_gioitinh = '".$slgioitinh."'";
    }
    if($sltrinhdo!=NULL){
        $sql .= " AND gs_trinhdo = '".$sltrinhdo."'";
    }
    if($slmon!=NULL){
        $sql .= " AND dl_mon like '".$slmon."'";
    }
    if($sllop!=NULL){
        $sql .= " AND dl_lop like '".$sllop."'";
    }
    
    //echo $sql;            
    //var_dump($gia_su);

    $offset=$this->uri->segment(3); if ($offset == '') $offset =0;   
    $limit= $this->m_admin->getPageSetting('user');     
    //echo $this->db->last_query();  
    $sql .= " ORDER BY a.gs_tk_id desc"; 
    $sqltam = $sql;
    //$sql .= "  LIMIT $offset, $limit";
    $gia_su = $this->db->query($sql)->result(); 
     
    $config = MyLibrary::configPagination();
    $config['base_url'] = base_url().'giasu/pagination_findgs';
    $config['total_rows'] = count($this->db->query($sqltam)->result()); //var_dump(count($num));
    $config['uri_segment']  = 3; //Xác định phân đoạn chứa số trang
    $config['per_page'] = $limit;
    //echo $sql;
    
    $this->pagination->initialize($config);
    $paginator=$this->pagination->create_links();  
?>

<div class="container">
    <div class="row">
    <h2 class="text-lg"><span class="text-muted">Gia sư / <small> Kết quả tìm kiếm: có <?php echo "<b class=text-danger>".count($gia_su)."</b>"; ?> gia sư</small></samp></h2> 
    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#students-list">Danh sách gia sư</a></li>
    
    </ul>

    <div class="tab-content">
        
    <div id="students-list" class="tab-pane fade in <?php if($this->uri->segment(2)=='find_gs' || $this->uri->segment(1)=='v_tutors') echo 'active'; ?>">
        <small><p><i>Tìm gia sư theo các tiêu chí.</i></p></small>
        <?php
        if($this->session->flashdata('message')){ ?>
            <div class="alert alert-warning fade in alertStyle">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <img src="<?php ?>"><?php echo $this->session->flashdata('message'); ?>
            </div>
            <?php
        } ?>




        <form class="form-inline" method="post" action="<?php echo base_url(); ?>giasu/find_gs">
            <?php empty($slmon) ? Mylibrary::showMonNonMulti() : Mylibrary::showMonNonMulti($slmon); ?>
            <select data-placeholder="Chọn lớp học..." class="form-control form-hg" name="slLop" id="slLop" style="width: 150px;">
                <option value="">Chọn lớp</option>
                <?php
                for($i=1; $i<=12; $i++){ ?>
                    <option value="<?php echo 'Lớp '.$i; ?>" <?php if($sllop=="Lớp $i") echo "selected";?>><?php echo 'Lớp '.$i; ?></option>
                    <?php
                } ?>
                <option value='Luyện thi đại học' <?php if($sllop=='Luyện thi đại học') echo "selected";?>>Luyện thi đại học</option>
                <option value='Luyện thi HS giỏi' <?php if($sllop=='Luyện thi HS giỏi') echo "selected";?>>Luyện thi HS giỏi</option>
            </select>
            <select name='slNamKN' id="slNamKN" class='form-control form-hg' style="width: 150px;">
                <option value="">Chọn năm KN</option>
                <option value="0">Chưa có KN</option>
                <?php
                for($i=1; $i<=20; $i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($slnamkn==$i) echo "selected";?>><?php echo $i.' năm'; ?></option>
                    <?php
                } ?>
            </select>
            <select name='slTinh' id="slTinh" class='form-control form-hg' style="width: 170px">
                <option value="">Chọn tỉnh</option>
                <?php
                $tinh=$this->db->get('tinh')->result();
                foreach ($tinh as $row) { ?>
                    <option value="<?php echo $row->ID_TINH; ?>" <?php if($sltinh==$row->ID_TINH) echo "selected"; ?>>
                    <?php echo $row->TENTINH; ?></option>
                    <?php
                } ?>
            </select>
            <select name='slGioiTinh' id="slGioiTinh" class='form-control form-hg' style="width: 170px">
                <option value="" <?php if($slgioitinh=="") echo "selected";?>>Giới tính</option>
                <option value="0" <?php if($slgioitinh=='0') echo "selected";?>>Nam</option>
                <option value="1" <?php if($slgioitinh==1) echo "selected";?>>Nữ</option>
            </select>
            <?php empty($sltrinhdo) ? Mylibrary::showTrinhDo() : Mylibrary::showTrinhDo($sltrinhdo); ?>
            
            <input type="submit" name="submit" value="Tìm" id="filterGS" class="btn btn-primary btn-lg" />
        </form>

        <div class="row subject">
            <?php     
            // $limit=$this->m_admin->getPageSetting('user');
            // $offset=empty($this->uri->segment(3)) ? 0 : $this->uri->segment(3);  
            // $config['uri_segment']  = 3; //Xác định phân đoạn chứa số trang
            //echo "key ".$key."-off ".$offset."-con ".$config['uri_segment']."-limit ".$limit."<br/>";

           

            if(!empty($gia_su)){
                foreach ($gia_su as $gia_su) { 

                    $mon = "<span class='text-muted'>Dạy môn:</span>"; 
                    $s2="SELECT DISTINCT dl_mon FROM daylop WHERE dl_gs_id=$gia_su->gs_tk_id ORDER BY dl_mon"; 
                    $dm = $this->db->query($s2)->result(); 
                    foreach ($dm as $dm) { 
                        $lop = "";
                        $mon .="- ".$dm->dl_mon." (";

                        $s1="SELECT DISTINCT dl_lop FROM daylop WHERE dl_gs_id=$gia_su->gs_tk_id AND dl_mon like '".$dm->dl_mon."' ORDER BY dl_lop"; 
                        $dl = $this->db->query($s1)->result(); 
                        foreach ($dl as $dl) { 
                            $lop .="- ".$dl->dl_lop;
                        } 
                        $lop .= ")<br/>";
                        $mon .= $lop;
                    }
                    ?>
                    <div class="col-lg-6">
                        <a href="#">
                        <div class="col-md-7 col-md-push-5 text-justify">
                            <h4><?php echo $gia_su->gs_hoten; ?></h4>
                            <p>
                            <span class="text-muted">Giới tính - Năm sinh: </span><?php echo ($gia_su->gs_gioitinh==1) ? "Nữ" : "Nam"; echo " - ".$gia_su->gs_namsinh?><br/>
                            <span class="text-muted">Điện thoại: </span><?php echo $gia_su->gs_dienthoai; ?><br/>
                            <span class="text-muted">Trình độ: </span><?php echo $gia_su->gs_trinhdo; ?><br/>
                            
                            <?php echo $mon; ?>
                            <span class="text-muted">Đánh giá: </span>
                            <?php 
                            $sql = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND (dk_trangthai = 1 OR dk_trangthai = -2) AND ld_diem_cmt is not NULL  AND b.dk_gs_id =".$gia_su->gs_tk_id; //echo $sql;
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
                        ?>
                            </p>
                            <p><a class="btn btn-default" target="_blank" href="<?php echo base_url(); ?>giasu/detail/<?php echo $gia_su->gs_tk_id; ?>" role="button">Chi tiết &raquo;</a></p>
                        </div>
                        </a>
                        <div class="col-md-5 col-md-pull-7 box-padding">
                            <img class="featurette-image img-responsive center-block" src="<?php echo base_url().$gia_su->gs_hinhanh; ?>" alt="Generic placeholder image">
                        </div>

                    </div>
                    <?php
                } 
            }
            else {?>
                <div class="alert alert-warning fade in alertStyle">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <img src="<?php ?>"><?php echo "Không tìm thấy dữ liệu nào phù hợp!"; ?>
                </div>
                <?php
            } ?>

            <!-- Pagination -->
            <div class="col-lg-12 text-center">
                <ul class="pagination">
                    <li><?php //echo $paginator; ?></li>   
                </ul>
            </div>

        </div>
    </div>

    </div><!-- row -->
</div><!-- containter-->
<script type="text/javascript">
$(document).ready(function(){
    $( "#slTrinhDo" ).addClass( "form-hg" );
});
</script>
