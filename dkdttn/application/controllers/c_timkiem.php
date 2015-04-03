<?php
class C_timkiem extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('m_timkiem');
        $this->load->helper("text");
        $this->load->library('form_validation');
    }
    public function tim_kiem()
    {
        $this->form_validation->set_rules('param_textbox', 'Từ khoá', 'required');
        $this->form_validation->set_message('required','Vui lòng nhập %s để tìm kiếm');
        if (!$this->form_validation->run())
        {
            $this->my_lib->display_thongbao('danger','Vui lòng nhập từ khoá để tìm kiếm');
        }
        else
        {
            $param_option = $_POST['param_option'];
            if ($param_option=="timkiemgiangvien")
            {
                $this->tim_kiem_giang_vien();
            }
            else if ($param_option=="timkiemsinhvien")
            {
                $this->tim_kiem_sinh_vien();
            }
            else if ($param_option=="timkiemdetai")
            {
                $this->tim_kiem_de_tai();
            }
        }
    }
    public function tim_kiem_giang_vien(){
        $str = $this->input->post('param_textbox');
        $param_txt = trim(strtolower(removesign($str)));
        $array = $this->m_timkiem->get_giang_vien($param_txt);
        $this->_data['query_danh_sach_giang_vien'] = $array['query'];
        $this->_data['total_record'] = $array['row_count'];  
        $this->_data['heading']="Giảng viên";
        $this->_data['str_param'] = $str;
        $this->_data['selected']="giangvien";
        $this->_data['path']=array('timkiem/tim_kiem_giang_vien');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Tìm kiếm giảng viên"  => ''
        );
        $this->load->view('layout/layout',$this->_data);
    }
    public function tim_kiem_sinh_vien(){
        $str_pos = $this->input->post('param_textbox');
        if (is_numeric($str_pos))
        {
           $param_txt = trim($str_pos);
           $array = $this->m_timkiem->get_sinh_vien_mssv($param_txt);
           $this->_data['query_danh_sach_sinh_vien'] = $array['query'];
           $this->_data['total_record'] = $array['row_count']; 
           $this->_data['str_param'] = $str_pos;
        }
        else
        {
            $param_txt = trim(strtolower(removesign($this->input->post('param_textbox'))));
            //$this->_data['query_danh_sach_sinh_vien'] = $this->m_timkiem->get_sinh_vien($param_txt);
            $array = $this->m_timkiem->get_sinh_vien($param_txt);
            $this->_data['query_danh_sach_sinh_vien'] = $array['query'];
            $this->_data['total_record'] = $array['row_count']; 
            $this->_data['str_param'] = $str_pos;
        }
        $this->_data['heading']="Sinh viên";
        $this->_data['selected']="sinhvien";
        $this->_data['path']=array('timkiem/tim_kiem_sinh_vien');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Tìm kiếm sinh viên"  => ''
        );
        $this->load->view('layout/layout',$this->_data);
    }
    public function tim_kiem_de_tai(){
        $param_txt = $_POST['param_textbox'];
        $cauhinh_detai = $_POST['group_loaidt'];
        if (is_numeric($param_txt))
        {
            $id_detai = $param_txt;
            $array = $this->m_timkiem->get_ct_detai($id_detai);
        }
        else
        {
            $ten_detai = strtolower(removesign($param_txt));
            //cau hình
            if (!empty($_POST['group_chuyennganh']) || !empty($_POST['group_tinhtrang'])  )
            {
                if (empty($_POST['group_chuyennganh']))
                {
                    $tinhtrang=$_POST['group_tinhtrang'];
                    $data  = array (
                    'ten_detai' => $ten_detai,
                    'loai_detai'  =>$cauhinh_detai,
                    'id_tinhtrang'     =>$tinhtrang
                    );
                }
                else if (empty($_POST['group_tinhtrang']))
                {
                    $chuyennganh = $_POST['group_chuyennganh'];
                    $data  = array (
                    'ten_detai' => $ten_detai,
                    'loai_detai'  =>$cauhinh_detai,
                    'id_chuyennganh'   =>$chuyennganh
                    );
                }
                else
                {
                    $tinhtrang=$_POST['group_tinhtrang'];
                    $chuyennganh = $_POST['group_chuyennganh'];
                    $data  = array (
                    'ten_detai' => $ten_detai,
                    'loai_detai'  =>$cauhinh_detai,
                    'id_chuyennganh'   =>$chuyennganh,
                    'id_tinhtrang'     =>$tinhtrang
                    );
                }
            }
            else
            {
                $data  = array ('ten_detai' => $ten_detai,'loai_detai'  =>$cauhinh_detai);
            }
            $array = $this->m_timkiem->get_de_tai($data);
        }
        $this->_data['query_ds_de_tai'] = $array['query'];
        $this->_data['total_record'] = $array['row_count']; 
         //đếm số thành viên
        $array_sothanhvien=array();
        $i=0;
        foreach ($array['query'] as $rows)
        {
            $array_sothanhvien[$rows->id] = $this->m_home->count_so_luong_sinhvien_detai($rows->id);
        }
        $this->_data['array_sothanhvien']=$array_sothanhvien;     
        $this->_data['heading']="Đề tài";
        $this->_data['luu_vet_de_tai']= $cauhinh_detai;
        $this->_data['selected']="detai";
        $this->_data['str_param'] = $param_txt;
        $this->_data['path']=array('timkiem/tim_kiem_de_tai');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Tìm kiếm đề tài"  => ''
        );
        $this->load->view('layout/layout',$this->_data);
    }
}
?>