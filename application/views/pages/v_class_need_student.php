<!-- register page -->
<div class="container">
    <div class="row">
    <h2><span class="text-muted">Danh sách lớp cần gia sư / <small> Hiện có: <?php echo $this->m_phuhuynh->getNumClass(); ?> lớp</small></samp></h2> 

    <div class="well">

        <!-- ************CLASS NEED TUTOR**********************  --> 

        <div id="class-list" class="tab-pane fade in active">
            

            <form class="form-inline" method="post" action="<?php echo base_url(); ?>phuhuynh/find_class">
                <small><p><i>Tìm lớp theo từ khóa/ Môn học/ Lớp/ Trạng thái.</i></p></small>
                <div class="form-group" >
                    <input type="input" class="form-control form-hg" id="exampleInputEmail3" name="class_key" placeholder="Từ khóa / Ví dụ: Toán">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="txtSubject">Subject</label>
                    <?php empty(set_value('slSubject')) ? Mylibrary::showMon_ph() : Mylibrary::showMon_ph(set_value('slSubject')); ?>
                </div>

                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3">Class</label>
                     <?php empty(set_value('slClass')) ? Mylibrary::showLop_ph() : Mylibrary::showLop_ph(set_value('slClass')); ?>
                </div>
                <div class="form-group">
                    <select name='txt_trangthai' class='form-control form-hg'>
                       <option value="">--Trạng thái--</option>
                        <option value='1'>Đang dạy</option>
                        <option value='0'>Cần gia sư</option>
                    </select>
                </div>
            <input type="submit" class="btn btn-primary form-hg" name="submit" data-toggle="modal" data-target=".bs-example-modal-lg" value="Tìm lớp học">
                <i class="text-danger"><?php echo form_error("class_key"); ?></i>
            </form>

            <hr>

            <div class="row subject">
                    <?php   
                    //var_dump($giasu); //gia su duoc gui về khi nhan nut submit    
                    $offset=$this->uri->segment(3); if ($offset == '') $offset =0;     
                    $limit= $this->m_admin->getPageSetting('user');        
                    // $class = $this->m_phuhuynh->getAllClass('', $limit, $offset); //var_dump($giasu);
                    //echo $this->db->last_query();
                    $sql = "SELECT DISTINCT ld_id, `ld_tieude`, `ld_mon`, `ld_khoilop`, `ld_soluong`, `ld_yeucau`, `ld_buoiday`, `ld_thoigian`, `ld_diadiem`, `ld_mota_diadiem`, `ld_hinhanh`, `ld_trangthai`, `ld_diem_cmt`, `ld_noidung_cmt`, dk_trangthai FROM lopday LEFT JOIN dangky ON lopday.ld_id = dangky.dk_ld_id WHERE (dk_trangthai >=0 OR dk_trangthai is null) AND lopday.ld_trangthai = 1  ORDER BY lopday.ld_id DESC limit ".$offset." , ".$limit;
                    $class = $this->db->query($sql)->result();
                   // echo $sql;


                     
                    $config = MyLibrary::configPagination();
                    $config['base_url'] = base_url().'phuhuynh/pagination_ph';
                    $config['total_rows'] = count($this->db->query("SELECT DISTINCT ld_id, `ld_tieude`, `ld_mon`, `ld_khoilop`, `ld_soluong`, `ld_yeucau`, `ld_buoiday`, `ld_thoigian`, `ld_diadiem`, `ld_mota_diadiem`, `ld_hinhanh`, `ld_trangthai`, `ld_diem_cmt`, `ld_noidung_cmt`, dk_trangthai FROM lopday LEFT JOIN dangky ON lopday.ld_id = dangky.dk_ld_id WHERE (dk_trangthai >=0 OR dk_trangthai is null) AND lopday.ld_trangthai = 1  ORDER BY lopday.ld_id DESC")->result()); //var_dump(count($num));
                    $config['uri_segment']  = 3; //Xác định phân đoạn chứa số trang
                    $config['per_page'] = $limit;
                    
                    $this->pagination->initialize($config);
                    $paginator=$this->pagination->create_links(); 

                    foreach ($class as $ld) { ?>
                    
                    <?php 
                    $sql1 = "SELECT  dk_id, dk_ld_id, dk_trangthai FROM dangky  WHERE dk_ld_id =".$ld->ld_id." group by dk_ld_id, dk_trangthai";
                    $ld1 = $this->db->query($sql1)->result();
                                
                    // $test = $this->db->query($sql1)->row();
                    // if ($test ->dk_trangthai == 2) { echo "cfgdfgh";
                    //     # code...
                    // }
                    ?>
                    <div class="col-lg-6">
                        <div class="col-md-7 col-md-push-5">
                            <h4><?php echo $ld->ld_tieude; ?></h4>
                            <p>
                            <span class="text-muted">Môn: </span><?php echo $ld->ld_mon; ?><br/>
                            <span class="text-muted">Lớp: </span><?php echo $ld->ld_khoilop; ?><br/>
                            <span class="text-muted">Số lượng: </span><?php echo $ld->ld_soluong; ?><br/>
                            <span class="text-muted">Buổi dạy: </span><?php echo $ld->ld_buoiday; ?><br/> 
                            <span class="text-muted">Thời gian bắt đầu: </span> <?php echo $ld->ld_thoigian; ?><br/> 
                            </p>
                    <?php 
                    if (isset($this->session->userdata('login')->tk_id) && $this->session->userdata('login')->tk_quyen == 2){


                                if($this->db->query($sql1)->num_rows() == 0)
                                { ?>

                                    <p><a class="btn btn-default" href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $ld->ld_id; ?>" role="button">Chi tiết &raquo;</a></p>

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
                                        <p><a class="btn btn-default" href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $ld->ld_id; ?>" role="button">Chi tiết &raquo;</a></p>

                                    <?php 
                                    }else { ?>
                                        <strong><span class="text-danger"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Đang học </span></strong>
                                    <?php
                                        }
                                }
                                    
                                else if($ld1->dk_trangthai == 0 )
                                {
                                    $sql2 = "SELECT * FROM dangky b WHERE dk_ld_id =".$ld->ld_id." AND dk_gs_id =".$this->session->userdata('login')->tk_id." and dk_trangthai = 0";
                                    if(  $this->db->query($sql2)->num_rows() == 1 )
                                    {?>
                                        <strong><span class="text-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Đã đăng ký dạy</span></strong>
                                        <p><a class="btn btn-default" href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $ld->ld_id; ?>" role="button">Chi tiết &raquo;</a></p>

                                    <?php 
                                    }
                                    else 
                                    {?>
                                        <p><a class="btn btn-default" href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $ld->ld_id; ?>" role="button">Chi tiết &raquo;</a></p>

                                    <?php 
                                    }
                                }
                                   

                            } 
                        
                    }else{?>

                        <?php if($this->db->query($sql1)->num_rows() == 0)
                                { ?>

                                    <p><a class="btn btn-default" href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $ld->ld_id; ?>" role="button">Chi tiết &raquo;</a></p>

                                <?php 
                                }
                                else 

                           foreach ($ld1 as $ld1)
                           {

                                if($ld1->dk_trangthai == 1 ){?>
                        
                                <strong><span class="text-danger"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Đang học </span></strong>
                                <p><a class="btn btn-default" href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $ld->ld_id; ?>" role="button">Chi tiết &raquo;</a></p>
                                   
                               <?php }
                                    
                                else if($ld1->dk_trangthai == 0){?>
                                    <p><a class="btn btn-default" href="<?php echo base_url(); ?>phuhuynh/detail_class/<?php echo $ld->ld_id; ?>" role="button">Chi tiết &raquo;</a></p>
                                    <?php 
                                }
                            }
                     } ?>

                               
                        </div>

                        <div class="col-md-5 col-md-pull-7 box-padding">
                            <img class="featurette-image img-responsive center-block" src="<?php echo base_url().$ld->ld_hinhanh; ?>" alt="Generic placeholder image">
                        </div>            
                    </div> 

                    <?php } ?>
            </div><!--End row subject-->

            <!-- Pagination -->
            <div class="col-lg-12 text-center">
                <ul class="pagination">
                    <li><?php echo $paginator; ?></li>   
                </ul>
            </div>

        </div><!-- End Class need tutor -->
    
       

    </div>


    </div><!-- row -->
</div><!-- containter-->
