
<!-- register page -->
<div class="container">
    <div class="row">
    <h2><span class="text-muted">Danh sách học viên / <small> Hiện có: <?php $where = array('ph_trangthai' => 1 ); echo $this->m_phuhuynh->getNumPhuHuynh($where); ?> học viên</small></samp></h2> 

    <div class="well">

        <!-- ************CLASS NEED TUTOR**********************  -->
         

        <div id="students-list">

                <div class="row subject">
                        
                    <?php   
                    $offset=$this->uri->segment(3);    
                    $limit= $this->m_admin->getPageSetting('user'); 
                    $where = array('ph_trangthai' => 1 );        
                    $phuhuynh = $this->m_phuhuynh->getAllPhuHuynh_s($where, $limit, $offset); 
                    //var_dump($phuhuynh);
                    //echo $this->db->last_query();  
                     
                    $config = MyLibrary::configPagination();
                    $config['base_url'] = base_url().'phuhuynh/pagination_ph_phuhuynh';
                    $config['total_rows'] = count($this->db->query("SELECT * FROM phuhuynh WHERE ph_trangthai = 1")->result()); //var_dump(count($this->db->query("SELECT * FROM phuhuynh")->result()));
                    $config['uri_segment']  = 3; //Xác định phân đoạn chứa số trang
                    $config['per_page'] = $limit;
                    
                    $this->pagination->initialize($config);
                    $paginator=$this->pagination->create_links();

                        foreach ($phuhuynh as $ph) { ?>
                            
                        <div class="col-lg-6">
                            <div class="col-md-7 col-md-push-5">
                                <h4><?php echo $ph->ph_hoten; ?></h4>
                                <p>
                                <span class="text-muted">Giới tính:</span><?php echo ($ph->ph_gioitinh==1) ? "Nữ" : "Nam";?><br/>
                                <span class="text-muted">Địa chỉ: </span><?php echo $ph->ph_diadiem; ?><br/>
                                
                                </p>
                                
                                <p><a class="btn btn-default" href="" role="button" data-toggle="modal" data-target="#myModal<?php echo $ph->ph_tk_id; ?>">Chi tiết &raquo;</a></p>
                                
                            </div>

                            <div class="col-md-5 col-md-pull-7 box-padding">
                                <img class="featurette-image img-responsive center-block" src="<?php echo base_url().$ph->ph_hinhanh; ?>" alt="Generic placeholder image">
                            </div>            
                        </div>  

                        <!-- Modal -->
                <div class="modal fade" id="myModal<?php echo $ph->ph_tk_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Thông tin học viên <span style="color:#f0ad4e;"> <?php echo $ph->ph_hoten; ?> </span></h4>
                      </div>
                      <div class="modal-body">
                            <div class="container">
                            <div class="col-lg-12">
                                <div class="col-md-4 col-md-push-2">
                                    <table class="table">
                                        <tr>
                                            <td>Họ tên:</td>
                                            <td><strong><?php echo $ph->ph_hoten; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Giới tính:</td>
                                            <td><strong><?php echo ($ph->ph_gioitinh==1) ? "Nữ" : "Nam"; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Điện thoại:</td>
                                            <td><strong><?php echo $ph->ph_dienthoai; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Địa điểm:</td>
                                            <td><strong><?php echo $ph->ph_diadiem; ?></strong></td>
                                        </tr>
                                </table>
                                </div>

                                <div class="col-md-2 col-md-pull-4 thumbnail">
                                    <img class="featurette-image img-responsive" src="<?php echo base_url().$ph->ph_hinhanh; ?>" alt="Generic placeholder image">
                                </div>            
                            </div>
                             <div class="col-lg-12">
                             </div> 
                            </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                      </div>
                    </div>
                  </div>
                </div> <!---End div model -->

                        <?php } ?>
                </div><!--End row subject-->
        </div>



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
