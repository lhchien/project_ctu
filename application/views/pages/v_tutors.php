<!-- register page -->
<div class="container">
    <div class="row">
    <h2 class="text-lg"><span class="text-muted">Gia sư / <small> Hiện có: <?php echo $this->m_giasu->getNumGiaSu(array('gs_trangthai' => 1)); ?> gia sư</small></samp></h2> 
    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#students-list">Danh sách gia sư</a></li>
    <!-- <li><a data-toggle="tab" href="#class-list">Lớp cần gia sư</a></li> -->
    
    </ul>

    <div class="tab-content">
        
    <div id="students-list" class="tab-pane fade in <?php if($this->uri->segment(2)=='pagination_gs' || $this->uri->segment(1)=='v_tutors') echo 'active'; ?>">
        <small><p><i>Tìm gia sư theo từ khóa.</i></p></small>
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
            <select name='slTinh' id="slTinh" class='form-control form-hg' style="width: 170px">
                <option value="">Chọn tỉnh</option>
                <?php
                $tinh=$this->db->get('tinh')->result();
                foreach ($tinh as $row) { ?>
                    <option value="<?php echo $row->ID_TINH; ?>" <?php //if($slTinh==$row->ID_TINH) echo "selected"; ?>>
                    <?php echo $row->TENTINH; ?></option>
                    <?php
                } ?>
            </select>
            <select name='slGioiTinh' id="slGioiTinh" class='form-control form-hg' style="width: 170px">
                <option value="">Giới tính</option>
                <option value="0">Nam</option>
                <option value="1">Nữ</option>
            </select>
            <?php Mylibrary::showTrinhDo(); ?>
            
            <input type="submit" name="submit" value="Tìm Gia sư" id="filterGS" class="btn btn-primary form-hg" />
        </form>

        <div class="row subject">
            <?php   
            //var_dump($giasu); //gia su duoc gui về khi nhan nut submit    
            $offset=$this->uri->segment(3);    
            $limit= $this->m_admin->getPageSetting('user'); ;        
            $where = array('gs_trangthai' => 1);
            $giasu = $this->m_giasu->getAllGiaSu($where, $limit, $offset); //var_dump($giasu);
            //echo $this->db->last_query();  
             
            $config = MyLibrary::configPagination();
            $config['base_url'] = base_url().'giasu/pagination_gs';
            $config['total_rows'] = count($this->db->query("SELECT * FROM giasu WHERE gs_trangthai=1")->result()); //var_dump(count($num));
            $config['uri_segment']  = 3; //Xác định phân đoạn chứa số trang
            $config['per_page'] = $limit;
            
            $this->pagination->initialize($config);
            $paginator=$this->pagination->create_links();  
            foreach ($giasu as $giasu) {
                ?>
                <div class="col-lg-6">
                    <a href="#">
                    <div class="col-md-7 col-md-push-5 text-justify">
                        <h4><a href="<?php echo base_url(); ?>giasu/detail/<?php echo $giasu->gs_tk_id; ?>"><?php echo $giasu->gs_hoten; ?></a></h4>
                        <p>
                        <span class="text-muted">Giới tính - Năm sinh: </span><?php echo ($giasu->gs_gioitinh==1) ? "Nữ" : "Nam"; echo " - ".$giasu->gs_namsinh?><br/>
                        <span class="text-muted">Điện thoại: </span><?php echo $giasu->gs_dienthoai; ?><br/>
                        <span class="text-muted">Trình độ: </span><?php echo $giasu->gs_trinhdo; ?><br/>
                        <span class="text-muted">Chuyên ngành: </span><?php echo $giasu->gs_chuyennganh; ?><br/>
                        <span class="text-muted">Dạy môn: </span>
                        <?php
                        $sql="SELECT DISTINCT dl_mon FROM daylop WHERE dl_gs_id=$giasu->gs_tk_id ORDER BY dl_mon desc";
                        $daylop = $this->db->query($sql)->result(); 
                        foreach ($daylop as $daylop) {
                            echo "- ".$daylop->dl_mon." ";
                        } 
                        ?>
                        <br/>

                        <span class="text-muted">Kinh nghiệm: </span><?php echo $giasu->gs_kinhnghiem." năm"; ?><br/> 
                        <span class="text-muted">Đánh giá: </span>
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
                        ?>
                        </p>
                        <p><a class="btn btn-default" href="<?php echo base_url(); ?>giasu/detail/<?php echo $giasu->gs_tk_id; ?>" role="button">Chi tiết &raquo;</a></p>
                    </div>
                    </a>
                    <div class="col-md-5 col-md-pull-7 box-padding">
                        <a href="<?php echo base_url(); ?>giasu/detail/<?php echo $giasu->gs_tk_id; ?>">
                        <img class="featurette-image img-responsive center-block" src="<?php echo base_url().$giasu->gs_hinhanh; ?>" alt="Generic placeholder image">
                        </a>
                    </div>

                </div>

                <?php
            } ?>

            <!-- Pagination -->
            <div class="col-lg-12 text-center">
                <ul class="pagination">
                    <li><?php echo $paginator; ?></li>   
                </ul>
            </div>
        </div>
    </div><!-- row -->
</div><!-- containter-->
<script type="text/javascript" charset="utf-8" async defer>     
    $(document).ready(function() {
        $("select").addClass( "form-hg" );
    });
</script>