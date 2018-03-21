
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Qlthongbao extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('person_model','person');
        $this->load->model('m_admin');
        $this->load->model('m_giasu');
        $this->load->model('m_phuhuynh');
		$this->load->model('m_lop');
		$this->load->model('m_nhansu');
        $this->load->model('m_thongbao');
        		$this->load->model('m_lienhe');

    }
 
    public function index()
    {
        $this->load->helper('url');
        $this->load->view('person_view');
    }
 
    public function ajax_list()
    {
        $list = $this->person->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $thongbao) {
            $no++;
            $row = array();
            $row[] = $thongbao->tb_noidung;
            $row[] = $thongbao->tb_ngay;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->person->count_all(),
                        "recordsFiltered" => $this->person->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->person->get_by_id($id);
        $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $data = array(
                'tb_noidung' => $this->input->post('txtThongbao'),
                'tb_ngay' => date('y-m-d',strtotime("now")),
                'tb_tk_id' => $this->input->post('txtidblock')
            );
        $insert = $this->m_thongbao->save($data);
        //echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'firstName' => $this->input->post('firstName'),
                'lastName' => $this->input->post('lastName'),
                'gender' => $this->input->post('gender'),
                'address' => $this->input->post('address'),
                'dob' => $this->input->post('dob'),
            );
        $this->person->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->person->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
 
 
}



