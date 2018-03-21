 <!-- FOOTER -->
 <!-- Modal -->
 <?php  if($this->session->userdata('login')){?>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Thông tin liên hệ</h4>
          </div>
          <div class="modal-body">
                <div class="container">
                <div class="col-lg-5">
                <?php
                    $sql = "SELECT * FROM lienhe WHERE lh_tk_id =".$this->session->userdata('login')->tk_id;
                    $lh = $this->db->query($sql)->result(); //var_dump($lh);
                    foreach ($lh as $lh) {?>
                        <table class="table">
                            <tr>
                                <td>Tiêu đề:</td>
                                <td><strong><?php echo $lh->lh_tieude; ?></strong></td>
                            </tr>
                            <tr>
                                <td>Nội dung:</td>
                                <td><strong><?php echo ($lh->lh_noidung); ?></strong></td>
                            </tr>
                            <tr>
                                <td>Phản hồi của quản trị:</td>
                                <td><strong><?php if(isset($lh_phanhoi)){echo $lh->lh_phanhoi;}else echo " Chưa có phản hồi"  ?></strong></td>
                            </tr>
                        </table>      
                <?php } ?>
                    
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
    <hr>
    <div class="container"> 
        <footer>
            <p class="pull-right"><a href="#">Lên trên</a></p>
            <p>&copy; 2017 Tiểu luận chuyên ngành Công Nghệ Thông Tin - ĐHCT, Inc. &middot; <a href="#">Riêng tư</a> &middot; <a href="#">Nội qui</a></p>
        </footer>

    </div><!-- /.container -->
    

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

    <!-- ckeditor -->
    <script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>

    <!-- captcha google -->
    <script src='https://www.google.com/recaptcha/api.js'></script>


</body>

</html>