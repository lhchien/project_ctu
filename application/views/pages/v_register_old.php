    <!-- Login box-->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Đăng nhập</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Tên người dùng:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="recipiennt-password" class="control-label">Mật khẩu:</label>
                <input type="password" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="forgot-password" class="control-label"><a href="#">Quên mật khẩu?</a></label>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Đăng nhập</button>
          </div>
        </div>
      </div>
    </div>

        <!-- register page -->

    <div class="container">

    <h2 class="text-lg"><span class="text-muted">Đăng kí tham gia </span> Gia sư online</h2>
    <hr>
    <p>Vui lòng điền đầy đủ thông tin bên dưới. Thông tin các nhân của bạn sẽ được hiển thị giúp người dùng có thể liên lạc dễ dàng hơn. </p>
    <p><i><small>Các trường có dấu (*) có thể bỏ trống</small></i></p>

    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin cá nhân</div>
        <div class="panel-body">
            <div class="col-md-7">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 control-label">Gia sư/Học viên:</label>
                        <div class="col-sm-8">
                            <select class="form-control">
                                <option>Bạn là ai?</option>
                                <option>Tôi là gia sư</option>
                                <option>Tôi là học viên</option>
                                <option>Tôi là phụ huynh</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-sm-3 control-label">Giới tính:</label>
                        <div class="col-sm-8">
                            <select class="form-control">
                                <option>--Chọn--</option>
                                <option>Nam</option>
                                <option>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 control-label">Họ:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="First name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 control-label">Tên:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 control-label">Địa chỉ Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3" class="col-sm-3 control-label">Tỉnh/Thành phố:</label>
                        <div class="col-sm-8">
                            <select class="form-control">
                                <option>Bạn ở đâu?</option>
                                <option>Hà Nội</option>
                                <option>Đà Nẵng</option>
                                <option>Hồ Chí Minh</option>
                                <option>Cần Thơ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 control-label">Địa chỉ:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Adsress">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword3" class="col-sm-3 control-label">Ngày sinh:</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="exampleInputEmail1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 control-label">Số điện thoại:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Phone number">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin tài khoản</div>
        <div class="panel-body">
            <div class="col-md-7">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 control-label">Tên đăng nhập:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 control-label">Mật khẩu:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 control-label">Nhập lại mật khẩu:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Confirm Password">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">Tự giới thiệu</div>
        <div class="panel-body">
            <div class="col-md-7">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-3 control-label">Tự giới thiệu bản thân: </label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-sm-3 control-label">Yêu cầu cá nhân *:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label class="col-sm-8 control-label">
                                <input type="checkbox"> Tôi đồng ý với các <a href="#">điều khoản</a> mà Gia Sư Online đã đề ra
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-8 pull-right">
                        <button type="submit" class="btn btn-warning btn-lg">Hoàn tất & Đăng kí</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div><!-- containter-->
