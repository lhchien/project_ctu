<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Phuhuynh extends CI_Controller{

    public function __construct(){
       parent::__construct();
       $this->load->model('m_phuhuynh'); 
       $this->load->model('m_admin');
       $this->load->model('m_giasu');
    }



    public function upImage(){

        if($this->input->post('submit')){
            //Cau hinh cac tham so
            $config = array();
            $config['upload_path']   = './img/ph_img';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size']      = '600'; //500Kb
            $config['max_width']     = '1028';
            $config['max_height']    = '1028';
            $config['remove_spaces'] = TRUE;

            //load thư viện upload
            $this->upload->initialize($config); //var_dump($_FILES['fileImg']['name']);

            $data = array();
            if(!empty($_FILES['fileImg']['name'])){
                //thuc hien upload
                if($this->upload->do_upload('fileImg')){
                    //chua mang thong tin upload thanh cong
                    $data = $this->upload->data(); //print_r($data);

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './img/ph_img/'.$data['file_name'];
                    $config['maintain_ratio'] = FALSE;
                    $config['width']     = 530;
                    $config['height']   = 600;
                    $config['x_axis'] = ($data['image_width'] - $config['width'])/2; //left
                    $config['y_axis'] = ($data['image_height'] - $config['height'])/2; //top
                    //echo  $config['x_axis']."-".$config['y_axis'];
                    $this->image_lib->initialize($config);
                    $this->image_lib->crop();
                }
                else{
                    //hien thi lỗi nếu có
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', $error); //echo $error;
                }
            }

        }
        return $data;
    }

    public function changeInfo_ph(){
        if( $this->input->post('submit') ){
            $this->form_validation->set_rules('txtName', 'Họ tên', 'required|trim|xss_clean');
            $this->form_validation->set_rules('optSex', 'Giới tính', 'required');
            $this->form_validation->set_rules('txtPhone', 'Điện thoại', 'required|min_length[7]|max_length[11]');
            $this->form_validation->set_rules('txtAddress', 'Địa chỉ', 'required');

            $this->form_validation->set_message('required', '%s không được bỏ trống!');
            $this->form_validation->set_message('min_length', '%s không hợp lệ, tối thiểu 7 số!');
            $this->form_validation->set_message('max_length', '%s không hợp lệ, tối đa 11 số!');
            

            if( $this->form_validation->run() ){
                $image          = $this->upImage();
                $ph_hoten       = $this->input->post('txtName');
                $ph_gioitinh    = $this->input->post('optSex');
                $ph_dienthoai   = $this->input->post('txtPhone');
                $ph_diadiem     = $this->input->post('txtAddress');
                
                $ph_hinhanh     = empty($image['file_name']) 
                                  ? 'img/no_img.jpg' 
                                  : 'img/ph_img/'.$image['file_name']; 

                $where          = array('ph_tk_id' => $this->session->userdata('login')->tk_id);
                $phuhuynh          = $this->m_phuhuynh->getPhuHuynhInfo($where);

                //xoa file cu
                if(!empty($image) && $phuhuynh->ph_hinhanh!='img/no_img.jpg')
                    @unlink("./".$phuhuynh->ph_hinhanh);

                $ph_hinhanh = empty($image['file_name']) 
                              ? $phuhuynh->ph_hinhanh 
                              : 'img/ph_img/'.$image['file_name'];
                $dong       = array(  "ph_hoten"        => $ph_hoten,
                                      "ph_gioitinh"     => $ph_gioitinh,
                                      "ph_dienthoai"    => $ph_dienthoai,
                                      "ph_hinhanh"      => $ph_hinhanh,
                                      "ph_diadiem"       => $ph_diadiem
                                    );
                $this->m_phuhuynh->updatePhuHuynh($this->session->userdata('login')->tk_id, $dong);
                if(!empty($image))
                    $this->session->set_flashdata('message', 'Update thành công');

                $data=array('chucnang'=>'Cập nhật thành công thông tin của ',
                    'tieude'=>$ph_hoten);
                $this->load->view("/pages/load",$data);
                
            }
        }
 
        $this->load->view("/layout/header");
        $this->load->view("/pages/v_changeinfo_ph");
        $this->load->view("/layout/footer");
    }

    public function locationMap(){

        if( $this->input->post('submit') ){
            $this->form_validation->set_rules('lat', 'Tọa độ Lat', 'required|trim|xss_clean');
            $this->form_validation->set_rules('lng', 'Tọa độ Long', 'required|trim|xss_clean');

            $this->form_validation->set_message('required', '%s không được bỏ trống!');

            if($this->form_validation->run()){

                $where      = array( "gs_tk_id" => $this->session->userdata('login')->tk_id);
                $giasu      = $this->m_giasu->getGiaSuInfo($where);
                $lat        = $_POST['lat'];
                $lng        = $_POST['lng'];
                $gs_diadiem = $lat.",".$lng;
                $note       = $_POST['note'];
                $dong       = array( "gs_diadiem"       => $gs_diadiem,
                                     "gs_motadiadiem"   => $note,
                                    );
                $this->m_giasu->updateGiaSu($this->session->userdata('login')->tk_id,$dong);
                
                if(empty($giasu->gs_diadiem)){
                    $this->session->set_flashdata('message', 'Thêm địa điểm thành công');
                }
                else{
                    $this->session->set_flashdata('message', 'Update địa điểm thành công');
                }

            }//end form_validation
        }//end post('submit')

        //file_put_contents("test.txt", $lat.", ".$lng.", ".$name.", ".$note);
        $data=array('title'=>'Check địa điểm');
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_position_gs", $data);
        $this->load->view("/layout/footer");
    }//end function


     public function upImageClass(){

        if($this->input->post('submit')){
            //Cau hinh cac tham so
            $config = array();
            $config['upload_path']   = './img/class_img';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size']      = '600'; //500Kb
            $config['max_width']     = '1028';
            $config['max_height']    = '1028';
            $config['remove_spaces'] = TRUE;

            //load thư viện upload
            $this->upload->initialize($config); //var_dump($_FILES['fileImg']['name']);

            $data = array();
            if(!empty($_FILES['fileImg']['name'])){
                //thuc hien upload
                if($this->upload->do_upload('fileImg')){
                    //chua mang thong tin upload thanh cong
                    $data = $this->upload->data(); //print_r($data);

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './img/class_img/'.$data['file_name'];
                    $config['maintain_ratio'] = FALSE;
                    $config['width']     = 530;
                    $config['height']   = 600;
                    $config['x_axis'] = ($data['image_width'] - $config['width'])/2; //left
                    $config['y_axis'] = ($data['image_height'] - $config['height'])/2; //top
                    //echo  $config['x_axis']."-".$config['y_axis'];
                    $this->image_lib->initialize($config);
                    $this->image_lib->crop();
                }
                else{
                    //hien thi lỗi nếu có
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', $error); //echo $error;
                }
            }

        }
        return $data;
    }
    public function opennewclass(){

        if( $this->input->post('submit') ){
            $this->form_validation->set_rules('txtTitle', 'Tiêu đề', 'required|trim|xss_clean');
            $this->form_validation->set_rules('slSubject', 'Môn', 'required|trim|xss_clean');
            $this->form_validation->set_rules('slClass', 'Lớp', 'required|trim|xss_clean');
            $this->form_validation->set_rules('slMount', 'Số lượng', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtTime', 'Thời gian ', 'required|trim|xss_clean');
            $this->form_validation->set_rules('checkBuoi[]', 'Buổi', 'required|trim|xss_clean');
            $this->form_validation->set_rules('lat', 'Địa điểm', 'required|trim|xss_clean');

            $this->form_validation->set_message('required', '%s không được bỏ trống!');

            if($this->form_validation->run() ){
                $image          = $this->upImageClass();
                $class_tieude   = $this->input->post('txtTitle');
                $class_mon      = $this->input->post('slSubject');
                $class_lop      = $this->input->post('slClass');
                $class_soluong  = $this->input->post('slMount');
                $class_thoigian = $this->input->post('txtTime');
                $class_buoi     = $this->input->post('checkBuoi[]');
                $class_buoi     = implode(',', $class_buoi); // Tạo Mảng cho Multi Buổi
                $class_yeucau = $this->input->post('mota_yeucau');

                // XU LI DIA DIEM
                $lat        = $this->input->post('lat');
                $lng        = $this->input->post('lng');
                $class_diadiem = $lat.",".$lng;
                $class_mota_diadiem = $this->input->post('mota_diadiem');
                 
                //XU LY HINH ANH
                $class_hinhanh     = empty($image['file_name']) 
                                  ? 'img/no_img.jpg' 
                                  : 'img/class_img/'.$image['file_name']; 


                //XU LY CAC DU LIEU CON LAI
                $data   = array("ld_tieude"        => $class_tieude,
                                "ld_mon"           => $class_mon,
                                "ld_khoilop"       => $class_lop,
                                "ld_soluong"       => $class_soluong,
                                "ld_thoigian"      => $class_thoigian,
                                "ld_buoiday"          => $class_buoi,
                                "ld_yeucau"        => $class_yeucau,
                                "ld_diadiem"       => $class_diadiem,
                                "ld_mota_diadiem"  => $class_mota_diadiem,
                                "ld_hinhanh"       => $class_hinhanh,
                                "ph_tk_id"         => $this->session->userdata('login')->tk_id
                                );

                $this->m_phuhuynh->insertClass($data);
                $data=array('chucnang'=>'Tạo thành công',
                    'tieude'=>'mở lớp mới');
                $this->load->view("/pages/load",$data);
            }
        }

        $this->load->view("/layout/header");
        $this->load->view("/pages/v_opennewclass");
        $this->load->view("/layout/footer");
    }

     public function changeClass(){
        /*echo site_url(); echo "<br/>".base_url(); echo "<br/>".$this->uri->segment(3);*/
        $ld_id =  $this->uri->segment(3);
        $where = array('ld_id' => $ld_id);
        $class = $this->m_phuhuynh->getClassInfo($where); //var_dump($class); //echo $this->db->last_query();
        $data = array('class'=>$class); 

        $this->load->view("/layout/header");
        $this->load->view("/pages/v_opennewclass_change",$data);
        $this->load->view("/layout/footer");
    }

    public function detail(){
        /*echo site_url(); echo "<br/>".base_url(); echo "<br/>".$this->uri->segment(3);*/
        $ph_tk_id =  $this->uri->segment(3);
        $where = array('ph_tk_id' => $ph_tk_id);
        $phuhuynh = $this->m_phuhuynh->getPhuHuynhInfo($where); //var_dump($giasu); //echo $this->db->last_query();
        
        $data=array('title'=>'Thông tin học viên',
                    'phuhuynh'=>$phuhuynh
                   );
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_detail_ph", $data);
        $this->load->view("/layout/footer");
    }

    // _______________________20/3__________________-

    public function opennewclass_change(){
        if( $this->input->post('submit') ){ 
            $this->form_validation->set_rules('txtTitle', 'Tiêu đề', 'required|trim|xss_clean');
            $this->form_validation->set_rules('slSubject', 'Môn', 'required|trim|xss_clean');
            $this->form_validation->set_rules('slClass', 'Lớp', 'required|trim|xss_clean');
            $this->form_validation->set_rules('slMount', 'Số lượng', 'required|trim|xss_clean');
            $this->form_validation->set_rules('txtTime', 'Thời gian ', 'required|trim|xss_clean');
            $this->form_validation->set_rules('checkBuoi[]', 'Buổi', 'required|trim|xss_clean');
            $this->form_validation->set_rules('lat', 'Địa điểm', 'required|trim|xss_clean');

            $this->form_validation->set_message('required', '%s không được bỏ trống!');

            if($this->form_validation->run() ){
                $image          = $this->upImageClass();
                $ld_id          = $this->input->post('txt_id');
                $class_tieude   = $this->input->post('txtTitle');
                $class_mon      = $this->input->post('slSubject');
                $class_lop      = $this->input->post('slClass');
                $class_soluong  = $this->input->post('slMount');
                $class_thoigian = $this->input->post('txtTime');
                $class_buoi     = $this->input->post('checkBuoi[]');
                $class_buoi     = implode(',', $class_buoi); // Tạo Mảng cho Multi Buổi
                $class_yeucau = $this->input->post('mota_yeucau');

                // XU LI DIA DIEM
                $lat        = $this->input->post('lat');
                $lng        = $this->input->post('lng');
                $class_diadiem = $lat.",".$lng;
                $class_mota_diadiem = $this->input->post('mota_diadiem');
                 
                //XU LY HINH ANH
                $class_hinhanh     = empty($image['file_name']) 
                                  ? 'img/no_img.jpg' 
                                  : 'img/class_img/'.$image['file_name']; 


                //XU LY CAC DU LIEU CON LAI
                $data   = array(
                                "ld_tieude"        => $class_tieude,
                                "ld_mon"           => $class_mon,
                                "ld_khoilop"       => $class_lop,
                                "ld_soluong"       => $class_soluong,
                                "ld_thoigian"      => $class_thoigian,
                                "ld_buoiday"       => $class_buoi,
                                "ld_yeucau"        => $class_yeucau,
                                "ld_diadiem"       => $class_diadiem,
                                "ld_mota_diadiem"  => $class_mota_diadiem,
                                "ld_hinhanh"       => $class_hinhanh,
                                "ph_tk_id"         => $this->session->userdata('login')->tk_id
                                );

                $this->m_phuhuynh->updateClass($ld_id,$data);
                
            }
        }
        $data=array('chucnang'=>'Cập nhật thành công',
                    'tieude'=>$class_tieude);
        $this->load->view("/layout/header");
        $this->load->view("/pages/load",$data);
        $this->load->view("/layout/footer");
    }

    public function ask_deleteClass() {
        $ld_id =  $this->uri->segment(3);
        $data = array('ld_id' => $ld_id,'confirm' => 'yes');
        
        $this->load->view("/layout/header");
        $this->load->view("/pages/v_detail_ph",$data);
        $this->load->view("/layout/footer");
        
    }



    public function deleteClass(){
        $ld_id =  $this->uri->segment(3);
        $class = $this->m_phuhuynh->deleteClass($ld_id); //var_dump($giasu); //echo $this->db->last_query();
        
        $data=array('chucnang'=>'Xóa thành công');
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/load", $data);
        $this->load->view("/layout/footer");
    }

    public function find_class(){
        if( $this->input->post('submit') ){
                $class_key = $this->input->post('class_key'); 
                $slSubject = $this->input->post('slSubject');
                $slClass = $this->input->post('slClass');
                $txt_trangthai = $this->input->post('txt_trangthai'); //echo $txt_trangthai;

                if($txt_trangthai == 1){
                    $trang_thai=" dk_trangthai like '".$txt_trangthai."'";
                }
                if($txt_trangthai == 0){
                    $trang_thai=" (dk_trangthai = 0 OR dk_trangthai is NULL)";
                }
                if($txt_trangthai == NULL){
                    $trang_thai=" (dk_trangthai >= 0 OR dk_trangthai is NULL)";
                }


                $sql = "SELECT DISTINCT ld_id, `ld_tieude`, `ld_mon`, `ld_khoilop`, `ld_soluong`, `ld_yeucau`, `ld_buoiday`, `ld_thoigian`, `ld_diadiem`, `ld_mota_diadiem`, `ld_hinhanh`, `ld_trangthai`, `ld_diem_cmt`, `ld_noidung_cmt`, dk_trangthai FROM lopday LEFT JOIN dangky ON lopday.ld_id = dangky.dk_ld_id WHERE ". $trang_thai." AND lopday.ld_trangthai = 1";
                if($class_key != NULL){
                    $sql.=" AND ld_tieude like '%".$class_key."%'";
                }
                if($slSubject !=NULL){
                    $sql.=" AND ld_mon like '".$slSubject."'";
                }
                if($slClass !=NULL){
                    $sql.=" AND ld_khoilop like '".$slClass."'";
                }

                //echo $sql;
                $class = $this->db->query($sql)->result();
                $num_row = $this->db->query($sql)->num_rows();

            //     $this->db->like('ld_tieude', $class_key);
            //     $class = $this->m_phuhuynh-> getClassInfo();
            //     $this->db->like('ld_tieude', $class_key);
            //     $num_row = $this->m_phuhuynh->getNumClass();
            // }
            if(isset($class)){
                $data=array('num_row' => $num_row,'class'=>$class,'txt_trangthai'=> $txt_trangthai);
                $this->load->view("/layout/header");
                $this->load->view("/pages/v_find_class",$data);
                $this->load->view("/layout/footer");
            }else{
                $this->load->view("/layout/header");
                $this->load->view("/pages/v_class_need_student");
                $this->load->view("/layout/footer");
            }  
        }     
    }

    public function detail_class(){
        $ld_id =  $this->uri->segment(3);
        $where = array('ld_id' => $ld_id);
        $class = $this->m_phuhuynh->getClassInfo($where); //var_dump($giasu); //echo $this->db->last_query();
        
        $data=array('title'=>'Thông tin lớp học',
                    'class'=>$class,'ld_id' => $ld_id
                   );
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_detail_class", $data);
        $this->load->view("/layout/footer");
    }

    public function studying_class(){
        $ld_id =  $this->uri->segment(3);
        $where = array('ld_id' => $ld_id);
        $class = $this->m_phuhuynh->getClassInfo($where); //var_dump($giasu); //echo $this->db->last_query();
        
        $data=array('title'=>'Thông tin lớp học đang học',
                    'class'=>$class,'ld_id' => $ld_id
                   );
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_class_studying", $data);
        $this->load->view("/layout/footer");
    }

    public function ask_dk_day() {
        $ld_id =  $this->uri->segment(3);
        $where = array('ld_id' => $ld_id);
        $class = $this->m_phuhuynh->getClassInfo($where);
        $data = array('ld_id' => $ld_id,'confirm' => 'yes','class'=>$class);

        $this->load->view("/layout/header");
        $this->load->view("/pages/v_detail_class",$data);
        $this->load->view("/layout/footer");
        
    }

    public function dk_day(){
        if($this->input->post('submit')){
            
            $ld_id = $this->input->post('ld_id');
            $gs_tk_id = $this->input->post('gs_tk_id');

            $data1 = array('dk_ld_id' => $ld_id , 'dk_gs_id' => $gs_tk_id);
            $this->m_phuhuynh->insert_dk_day($data1);

            $where = array('ld_id' => $ld_id);
            $class = $this->m_phuhuynh->getClassInfo($where);
            $data3 = array('success' => 'yes','class'=>$class);
            $this->load->view("/layout/header");
            $this->load->view("/pages/v_detail_class",$data3);
            $this->load->view("/layout/footer");

        }
    }

    public function pagination_ph(){
        /*echo site_url(); echo "<br/>".base_url(); echo "<br/>".$this->uri->segment(3);*/
        
        $data=array('title'=>'Lớp học');
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_class_need_student");
        $this->load->view("/layout/footer");
        
    }

    public function pagination_ph_phuhuynh(){
        /*echo site_url(); echo "<br/>".base_url(); echo "<br/>".$this->uri->segment(3);*/
        
        $data=array('title'=>'Phu Huynh');
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_students");
        $this->load->view("/layout/footer");
        
    }

    public function update_dangky(){
        $dk_gs_id =  $this->uri->segment(3);
        $dk_ld_id =  $this->uri->segment(4);

        $sql_update = "UPDATE dangky set dk_trangthai = -1 WHERE dk_ld_id =".$dk_ld_id;
        $this->db->query($sql_update);
        $sql_update = "UPDATE dangky set dk_trangthai = 1 WHERE dk_gs_id =".$dk_gs_id." AND dk_ld_id =".$dk_ld_id;
        $this->db->query($sql_update);

        $where = array('ld_id' => $dk_ld_id);
        $class = $this->m_phuhuynh->getClassInfo($where);
        $data = array('class'=>$class,'ld_id' => $dk_ld_id);
        
        $this->load->view("/layout/header");
        $this->load->view("/pages/v_class_studying",$data);
        $this->load->view("/layout/footer");
    }

    public function danhGia(){
        $ld_id =  $this->uri->segment(3); 
        $where = array('ld_id' => $ld_id);
        
        $ld_diem_cmt        = $this->input->post('ld_diem_cmt');
        $ld_noidung_cmt     = $this->input->post('ld_noidung_cmt');

        $data1   = array(    "ld_diem_cmt"        => $ld_diem_cmt,
                            "ld_noidung_cmt"     => $ld_noidung_cmt
                        );
        $this->m_phuhuynh->updateClass($ld_id,$data1);
        $class = $this->m_phuhuynh->getClassInfo($where);
        $data   = array(    "ld_id"              => $ld_id,
                            'class'              => $class 
                        );
        $this->load->view("/layout/header");
        $this->load->view("/pages/v_class_studying",$data);
        $this->load->view("/layout/footer");
    }

     public function capnhat_danhGia(){
        $ld_id =  $this->uri->segment(3); 
        $where = array('ld_id' => $ld_id);
        
        $ld_diem_cmt        = $this->input->post('ld_diem_cmt');
        $ld_noidung_cmt     = $this->input->post('ld_noidung_cmt');

        $data1   = array(    "ld_diem_cmt"        => $ld_diem_cmt,
                            "ld_noidung_cmt"     => $ld_noidung_cmt
                        );
        $this->m_phuhuynh->updateClass($ld_id,$data1);
        
        $this->load->view("/layout/header");
        $this->load->view("/pages/v_detail_ph");
        $this->load->view("/layout/footer");
    }

     public function huy_dangky(){
        $ld_id =  $this->uri->segment(3);
        $gs_id =  $this->uri->segment(4);
        $where = array('dk_gs_id' => $gs_id , 'dk_ld_id' => $ld_id, 'dk_trangthai' => 0 ); //var_dump($where);
        $class = $this->m_phuhuynh->delete_dangky($where); //var_dump($giasu); //echo $this->db->last_query();
        
        $data=array('chucnang'=>'Hủy đăng ký lớp dạy thành công!','page'=>'quanli');
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/load", $data);
        $this->load->view("/layout/footer");
    }

    public function chat(){
        $ld_id =  $this->uri->segment(3);
        $this->form_validation->set_rules('txt_message', '', 'required|trim|xss_clean');

        $this->form_validation->set_message('required', ' Vui lòng nhắn nội dung trước khi gửi!');

        if($this->form_validation->run() ){
            $dg_noidung     = $this->input->post('txt_message');
            $tk_id          = $this->input->post('txt_tk_id');
        
            $sql = "INSERT INTO `danhgia` (`dg_id`, `dg_noidung`, `dg_time`, `ld_id`, `tk_id`) VALUES (NULL, '$dg_noidung', CURRENT_TIMESTAMP, $ld_id, $tk_id)";
            $this->db->query($sql);
            
        }

        $where = array('ld_id' => $ld_id);
        $class = $this->m_phuhuynh->getClassInfo($where); //var_dump($giasu); //echo $this->db->last_query();
        
        $data=array('title'=>'Thông tin lớp học đang học',
                    'class'=>$class,'ld_id' => $ld_id
                   );
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_class_studying", $data);
        $this->load->view("/layout/footer");

    }

    public function endclass(){
        $ld_id =  $this->uri->segment(3); 
        $where = array('ld_id' => $ld_id);
        
        $sql = "UPDATE `dangky` SET dk_trangthai = -2 WHERE `dk_ld_id` =".$ld_id." AND dk_trangthai = 1";
        $this->db->query($sql);

        $class = $this->m_phuhuynh->getClassInfo($where);
        $data   = array(    "ld_id"              => $ld_id,
                            "class"              => $class 
                        );
        $this->load->view("/layout/header");
        $this->load->view("/pages/v_class_studying",$data);
        $this->load->view("/layout/footer");
    }

    public function lienhe(){

        $this->form_validation->set_rules('lh_tieude', 'Tiêu đề', 'required|trim|xss_clean');
        $this->form_validation->set_rules('lh_noidung', 'Nội dung', 'required|trim|xss_clean');

        $this->form_validation->set_message('required', ' không được bỏ trống');
        //echo "Hello!";
        if($this->form_validation->run() ){
            $lh_tk_id      = $this->input->post('lh_tk_id'); 
            $lh_tieude     = $this->input->post('lh_tieude');
            $lh_noidung    = $this->input->post('lh_noidung');
        
            $sql = "INSERT INTO `lienhe` (`lh_tk_id`, `lh_tieude`, `lh_noidung`) VALUES ($lh_tk_id, '$lh_tieude', '$lh_noidung')"; //var_dump($sql);
            $this->db->query($sql);
            $this->load->view("/layout/header");
            ?>
            <div class="container">
            <div class="col-md-12" style="margin: 100px 0px 100px 0px ">
                 <div class="panel panel-primary">
                    <div class="panel-heading"><h4>Thông báo </h4></div>
                    <div class="panel-body">

                        <div class="col-md-9">
                            <center>
                            <h3 class="text-success"><span class="glyphicon glyphicon-ok"></span> Bạn đã gửi liên hệ đến quản trị viên thành công. Trở về <a href="<?php echo base_url();?>v_home""> trang chủ </a> </h3>
                            </center>
                        </div>
                       
                    </div>
                </div>
            </div>
            </div>

            <?php 
            $this->load->view("/layout/footer");
            return;
            
        }

        $this->load->view("/layout/header");
        $this->load->view("/pages/v_lienhe");
        $this->load->view("/layout/footer");

    }



}
?>