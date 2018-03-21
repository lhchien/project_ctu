<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Giasu extends CI_Controller{

    public function __construct(){
       parent::__construct();
       $this->load->model('m_giasu'); //$this->lang->load('vi', 'vietnamese');
       $this->load->model('m_admin');
    }

    public function upImage(){

        if($this->input->post('submit')){
            //Cau hinh cac tham so
            $config = array();
            $config['upload_path']   = './img/gs_img';
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
                    $config['source_image'] = './img/gs_img/'.$data['file_name'];
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

    public function changeInfo(){
        if( $this->input->post('submit') ){
            $this->form_validation->set_rules('txtName', 'Họ tên', 'required|trim|xss_clean');
            $this->form_validation->set_rules('optSex', 'Giới tính', 'required');
            $this->form_validation->set_rules('slNamSinh', 'Năm sinh', 'required');
            $this->form_validation->set_rules('txtPhone', 'Điện thoại', 'required|min_length[7]|max_length[11]|numeric');
            $this->form_validation->set_rules('slTrinhDo', 'Trình độ', 'required');
            $this->form_validation->set_rules('txtChuyenNganh', 'Chuyên ngành', 'required|xss_clean');
            $this->form_validation->set_rules('lat', 'Kinh tuyến', 'required|trim|xss_clean');
            $this->form_validation->set_rules('lng', 'Vĩ tuyến', 'required|trim|xss_clean');
            $this->form_validation->set_rules('tinh', 'Tỉnh thành', 'required|trim|xss_clean');

            $this->form_validation->set_message('required', '%s không được bỏ trống!');
            $this->form_validation->set_message('min_length', '%s không hợp lệ, tối thiểu 7 số!');
            $this->form_validation->set_message('max_length', '%s không hợp lệ, tối đa 11 số!');

            if( $this->form_validation->run() ){
                $image          = $this->upImage();
                $gs_hoten       = $this->input->post('txtName');
                $gs_gioitinh    = $this->input->post('optSex');
                $gs_namsinh     = $this->input->post('slNamSinh');
                $gs_diachi      = $this->input->post('txtAddress');
                $gs_dienthoai   = $this->input->post('txtPhone');
                $gs_gioithieu   = $this->input->post('description');
                $gs_trinhdo     = $this->input->post('slTrinhDo');
                $gs_chuyennganh = $this->input->post('txtChuyenNganh');
                $gs_congviec    = $this->input->post('txtCongViec');
                $gs_hinhanh     = empty($image['file_name']) 
                                  ? 'img/no_img.jpg' 
                                  : 'img/gs_img/'.$image['file_name'];

                $where          = array('gs_tk_id' => $this->session->userdata('login')->tk_id);
                $giasu          = $this->m_giasu->getGiaSuInfo($where);

                $lat        = $this->input->post('lat');
                $lng        = $this->input->post('lng');
                $gs_diadiem = $lat.",".$lng;
                $gs_diachi  = $this->input->post('tinh');
                $note       = $this->input->post('note');

                //xoa file cu
                if(!empty($image) && $giasu->gs_hinhanh!='img/no_img.jpg')
                    @unlink("./".$giasu->gs_hinhanh);

                $gs_hinhanh = empty($image['file_name']) 
                              ? $giasu->gs_hinhanh 
                              : 'img/gs_img/'.$image['file_name'];
                $dong       = array(  "gs_hoten"        => $gs_hoten,
                                      "gs_gioitinh"     => $gs_gioitinh,
                                      "gs_namsinh"      => $gs_namsinh,
                                      "gs_dienthoai"    => $gs_dienthoai,
                                      "gs_diadiem"      => $gs_diadiem,
                                      "gs_diachi "      => $gs_diachi,
                                      "gs_motadiadiem"  => $note,
                                      "gs_hinhanh"      => $gs_hinhanh,
                                      "gs_gioithieu"    => $gs_gioithieu,
                                      "gs_trinhdo"      => $gs_trinhdo,
                                      "gs_chuyennganh"  => $gs_chuyennganh,
                                      "gs_congviec"     => $gs_congviec,
                                    );
                $this->m_giasu->updateGiaSu($this->session->userdata('login')->tk_id, $dong);
                $this->session->set_flashdata('message', 'Update thành công');
                if(!empty($image))
                    $this->session->set_flashdata('message', 'Update thành công');
                
            }
        }

        $data=array('title'=>'Cập nhật thông tin');
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_changeinfo_gs", $data);
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

    public function registerClass(){

        if( $this->input->post('submit') ){

            // $this->form_validation->set_rules('multiLop[]', 'Lớp dạy', 'required|trim|xss_clean');
            // $this->form_validation->set_rules('multiMon[]', 'Môn dạy', 'required|trim|xss_clean');
            //$this->form_validation->set_rules('multiDay[]', 'Ngày dạy', 'required|trim|xss_clean');
            $this->form_validation->set_rules('checkNgay[]', 'Ngày dạy', 'required|trim|xss_clean');
            $this->form_validation->set_rules('multiTime[]', 'Giờ dạy', 'required|trim|xss_clean');
            // $this->form_validation->set_rules('txtGia', 'Giá tiền', 'required|min_length[5]|max_length[7]');

            $this->form_validation->set_message('required', '%s không được bỏ trống!');
            // $this->form_validation->set_message('min_length', '%s không hợp lệ, tối thiểu 5 số!');
            // $this->form_validation->set_message('max_length', '%s không hợp lệ, tối đa 7 số!');

            if($this->form_validation->run()){
                // $gs_lop         = $this->input->post('multiLop[]');
                // $gs_mon         = $this->input->post('multiMon[]');
                //$gs_ngayday     = $this->input->post('multiDay[]');
                $gs_ngayday     = $this->input->post('checkNgay[]');
                $gs_gioday      = $this->input->post('multiTime[]');
                // $gs_giatien     = $this->input->post('txtGia');
                $gs_kinhnghiem  = $this->input->post('slNamKN');

                // $gs_lop         = implode(',', $gs_lop);
                // $gs_mon         = implode(',', $gs_mon);
                $gs_ngayday     = implode(',', $gs_ngayday);
                $gs_gioday      = implode(',', $gs_gioday);
 
                $dong = array(  "gs_ngayday"    => $gs_ngayday,
                                "gs_gioday"     => $gs_gioday,
                                "gs_kinhnghiem" => $gs_kinhnghiem
                             );
                $this->m_giasu->updateGiaSu($this->session->userdata('login')->tk_id, $dong);
                $this->session->set_flashdata('message', 'Cập nhật thời gian dạy thành công');
            }
        }

        $data=array('title'=>'Đăng ký lớp dạy');
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_registerclass_gs", $data);
        $this->load->view("/layout/footer");
    }

    public function pagination_gs(){
        /*echo site_url(); echo "<br/>".base_url(); echo "<br/>".$this->uri->segment(3);*/
        
        $data=array('title'=>'Gia sư');
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_tutors");
        $this->load->view("/layout/footer");
        
    }

    public function pagination_findgs(){
        /*echo site_url(); echo "<br/>".base_url(); echo "<br/>".$this->uri->segment(3);*/
        
        $data=array('title'=>'Gia sư');
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_find_gs");
        $this->load->view("/layout/footer");
        
    }

    public function find_gs(){
        // $slmon  = isset($_POST['slMon']) ? $_POST['slMon'] : NULL;
        // $sllop  = isset($_POST['slLop']) ? $_POST['slLop'] : NULL;
        // $slnamkn  = isset($_POST['slNamKN']) ? $_POST['slNamKN'] : NULL;
        // $sltinh  = isset($_POST['slTinh']) ? $_POST['slTinh'] : NULL;
        // $slgioitinh  = isset($_POST['slGioiTinh']) ? $_POST['slGioiTinh'] : NULL;
        // $sltrinhdo  = isset($_POST['slTrinhDo']) ? $_POST['slTrinhDo'] : NULL;
         
        $data=array('title'=>'Tìm kiếm gia sư',
                    // 'slmon'=>$slmon,
                    // 'sllop'=>$sllop,
                    // 'slnamkn'=>$slnamkn,
                    // 'sltinh'=>$sltinh,
                    // 'slgioitinh'=>$slgioitinh,
                    // 'sltrinhdo'=>$sltrinhdo
                   );
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_find_gs",$data);
        $this->load->view("/layout/footer");
        
    }

    public function detail(){
        /*echo site_url(); echo "<br/>".base_url(); echo "<br/>".$this->uri->segment(3);*/
        $gs_tk_id =  $this->uri->segment(3);
        $where = array('gs_tk_id' => $gs_tk_id);
        $giasu = $this->m_giasu->getGiaSuInfo($where); //var_dump($giasu); //echo $this->db->last_query();
        
        $data=array('title'=>'Thông tin Gia sư',
                    'giasu'=>$giasu
                   );
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_detail_gs", $data);
        $this->load->view("/layout/footer");
    }

    public function gs_quanly(){
        /*echo site_url(); echo "<br/>".base_url(); echo "<br/>".$this->uri->segment(3);*/
        $gs_tk_id =  $this->uri->segment(3);
        $where = array('gs_tk_id' => $gs_tk_id);
        $giasu = $this->m_giasu->getGiaSuInfo($where); //var_dump($giasu); //echo $this->db->last_query();
        
        $data=array('title'=>'Thông tin Gia sư',
                    'giasu'=>$giasu
                   );
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_gs_quanly", $data);
        $this->load->view("/layout/footer");
    }

    public function delFeeTable(){
        $dl_id =  $this->uri->segment(3); //echo $dl_id;

        if($this->input->post("submit")){
            //$query = $this->db->query("delete from daylop where dl_id = $dl_id");
            $this->db->delete('daylop', array('dl_id' => $dl_id));
            redirect('v_registerclass_gs','refresh');
        }

        $data=array('title'=>'Đăng ký lớp dạy',
                    'dl_id' => $dl_id,
                    'confirm' => 'yes');
        $this->load->view("/layout/header", $data);
        $this->load->view("/pages/v_registerclass_gs", $data);
        $this->load->view("/layout/footer");
    }

}
?>