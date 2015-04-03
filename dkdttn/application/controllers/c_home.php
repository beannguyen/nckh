<?php
class C_home extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_home');
        $this->load->model('m_user');
        $this->load->helper("text");
        header('Content-Type: text/html;charset=utf-8');  
    }
    public function checkSession() {
        if ($this->session->userdata('username') == NULL)
        {
            redirect('user/dang-nhap');
        }
    }
    
    public function index()
    {  
        
        $this->_data['ds_thongbao']=$this->m_home->get_thongbao();
        $this->_data['heading']="Thông báo";
        $this->_data['path']=array('frontend/trangchu');
        
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Thông báo"  => ''
        );
        $this->_data['cur_page'] = 'home';
        $this->load->view('layout/layout',$this->_data);
    }
    public function page404()
    {
        $this->_data['heading']="404 Page Not Found";
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "404 Error"  => ''
        );
        $this->_data['path']=array('page_error/404_page');
        $this->load->view('layout/layout',$this->_data);
    }
    public function download_log($file)
    {
        //echo $this->uri->uri_string();
        $name = $file;
        $link = 'application/logs/'.$name;
        $this->load->helper('download');
        $data = file_get_contents($link); // Read the file's contents
        force_download($name, $data);
        echo $name.'<br>'.$link;
    }
    public function huong_dan()
    {
        $this->_data['heading']="Hướng dẫn đăng ký";
        $this->_data['path']=array('frontend/huong_dan');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Hướng dẫn đăng ký"  => ''
        );
        $this->_data['cur_page'] = 'huongdan';
        $this->load->view('layout/layout',$this->_data);
    }
    public function thong_ke()
    {
        $this->_data['heading']="Thống kê";             
        $this->_data['ds_loaidt'] = $this->m_home->get_danh_sach_loai_de_tai();
        $this->_data['ds_giangvien'] = $this->m_home->get_all_giangvien();
        $this->_data['path']=array('frontend/thongke'); 
        $this->_data['arr_luuvet'] = array(             
        "Home"     => base_url(),                       
        "Thống kê"  => ''                               
        );                                              
        $cauhinh_id = '38';                             
        $my_array = ('');                               
        $ds_cn = $this->m_user->get_chuyen_nganh();     
        $i=0;                                           
        $total = 0;                                     
        foreach($ds_cn as $rows)                        
        {                                               
            $my_array[$rows->id] = $this->m_home->count_detai_sinhvien_cauhinh($cauhinh_id,$rows->id);
            $total += $my_array[$rows->id];             
            $i++;                                       
        }                                               
        $this->_data['total'] = $total;                 
        $this->_data['query'] = $my_array;              
        $this->_data['cur_page'] = 'thongke';           
        $this->load->view('layout/layout',$this->_data);  
    }
    public function thong_ke_sinh_vien()
    {
        if (isset($_POST['thongke_sv']))
        {
            $cauhinh_id = $_POST['cauhinh_id_sv'];
            $my_array = ('');
            $ds_cn = $this->m_user->get_chuyen_nganh();
            $i=0;
            $total = 0;
            foreach($ds_cn as $rows)
            {
                $my_array[$rows->id] = $this->m_home->count_detai_sinhvien_cauhinh($cauhinh_id,$rows->id);
                $total += $my_array[$rows->id];
                $i++;
            }
            $this->_data['total'] = $total;
            $this->_data['query'] = $my_array;
            $this->load->view('thongke/thongke_sinhvien_ajax',$this->_data);
        }
    }
    public function thong_ke_de_tai()
    {
        if (isset($_POST['thongke_detai']))
        {
            $cauhinh_id = $_POST['cauhinh_id_dt'];
            $my_array = ('');
            $ds_cn = $this->m_user->get_chuyen_nganh();
            $i=0;
            $total = 0;
            foreach($ds_cn as $rows)
            {
                $my_array[$rows->id] = $this->m_home->count_detai_cauhinh($cauhinh_id,$rows->id);
                $total += $my_array[$rows->id];
                $i++;
            }
            $this->_data['total'] = $total;
            $this->_data['query_tk_detai'] = $my_array;
            $this->_data['count_detai_dangky'] = $this->m_home->count_detai_truongnhom_cauhinh($cauhinh_id);
            $this->load->view('thongke/thongke_detai_ajax',$this->_data);
        }
    }
    public function thong_ke_giang_vien()
    {
        if (isset($_POST['thongke_gv']))
        {
            $giangvien_id = $_POST['id_gv'];
            $my_array = ('');
            $query_cauhinh = $this->m_home->get_danh_sach_loai_de_tai();
            $i=0;
            $tong_detai_gv = 0;
            $tong_detai = 0;
            foreach ($query_cauhinh as $rows)
            {
                $my_array['value'][$i] = $this->m_home->count_giangvien_detai($giangvien_id,$rows->id);
                $tong_detai_gv += $my_array['value'][$i]; 
                $my_array['ten_cauhinh'][$i] = $rows->tenloai.' '.$rows->TenNK;
                $my_array['tong_detai'][$i] = $this->m_home->count_giangvien_detai('0',$rows->id);
                $tong_detai += $my_array['tong_detai'][$i];
                $i++;
            }
            $cauhinh_id = '38';
            $this->_data['tong_detai_gv'] = $tong_detai_gv;
            $this->_data['tong_detai'] = $tong_detai;
            $this->_data['query_tk_giangvien'] = $my_array;
            $this->load->view('thongke/thongke_giangvien_ajax',$this->_data);
        }
    }
    public function chi_tiet_tin_tuc()
    {
        $str = $this->uri->segment(2);
        $str_exp=explode('-',$str);
        $matin = $str_exp[count($str_exp)-1];
        $this->_data['query_ct_tin']=$this->m_home->get_chi_tiet_tin($matin);
        $this->_data['tin_lien_quan']=$this->m_home->get_tin_lien_quan($matin);
        $this->_data['heading']="Tin từ giáo vụ";
        $this->_data['path']=array('frontend/chi_tiet_tin');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Tin từ giáo vụ"  => ''
        );
        $this->_data['cur_page'] = 'home';
        $this->load->view('layout/layout',$this->_data);
    }
    public function danh_sach_loai_de_tai()
    {
        $this->_data['heading']="Danh sách loại đề tài";
        $this->_data['query_ds_loai_de_tai']= $this->m_home->get_danh_sach_loai_de_tai();
        //$this->_data['query_count_ds_loai_de_tai']= $this->m_home->count_all_ds_loai_de_tai();
        $this->_data['path']=array('frontend/danh_sach_loai_de_tai');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Danh sách loại đề tài"  => ''
        );
        $this->_data['cur_page'] = 'dsdt';
        $this->load->view('layout/layout',$this->_data);
    }
    /* ==============================================================*/
    public function danh_sach_sinh_vien()
    {
        $this->checkSession();
        $this->_data['selected']=-1;
        $this->_data['selected_nk']=-1;
        $this->_data['ds_chuyen_nganh']=$this->m_user->get_chuyen_nganh();
        $this->_data['ds_nien_khoa']=$this->m_user->get_nien_khoa();
        $param=3;
        $per_pg=20;
        $total=$this->m_home->count_danh_sach_sinh_vien();
        $page=$this->uri->segment($param);
        if ($page==true) $page=(int)$page; else $page=1;
        $offset=($page-1)*$per_pg;
        //config
        $config['base_url']=base_url('danh-sach-sinh-vien/page/');
        $this->my_lib->pre_config_pagination($param,$per_pg,$total);
        $this->pagination->initialize($config);
        $this->_data['pagination']=$this->pagination->create_links();
        //$this->_data['query_ds_de_tai']=$this->m_home->get_danh_sach_de_tai();
        $this->_data['query_danh_sach_sinh_vien']=$this->m_home->get_danh_sach_sinh_vien($per_pg,$offset);
        $this->_data['total_record'] = $total;
        $this->_data['heading']="Danh sách sinh viên";
        $this->_data['path']=array('user/danh_sach_sinh_vien');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Thông tin sinh viên"  => ''
        );
        $this->_data['cur_page'] = 'dssv';
        $this->load->view('layout/layout',$this->_data);
    }
    /*---------------- Loc sinh vien ------------*/
    public function loc_sinhvien_chuyenganh()
    {
        $this->checkSession();
        $str=$this->uri->segment(2);
        $str_exp=explode('-',$str);
        //$id_chuyen_nganh=$str_exp[0];
        $id_chuyen_nganh = $str_exp[count($str_exp)-1];
        if ($id_chuyen_nganh=='') $id_chuyen_nganh=$str;
        //Phân trang
        $param=4;
        $per_pg=20;
        $total=$this->m_home->count_sinh_vien_chuyen_nganh($id_chuyen_nganh);
        $page=$this->uri->segment($param);
        if ($page==true) $page=(int)$page; else $page=1;
        $offset=($page-1)*$per_pg;
        //config
        $this->my_lib->pre_config_pagination($param,$per_pg,$total);
        $config['base_url']=base_url('sinh-vien-chuyen-nganh/'.$str.'/'.'/page'.'/');
        $this->pagination->initialize($config);
        $this->_data['pagination']=$this->pagination->create_links();
        $this->_data['query_danh_sach_sinh_vien']=$this->m_home->get_sinh_vien_chuyen_nganh($id_chuyen_nganh,$per_pg,$offset);  
        
        $this->_data['ds_chuyen_nganh']=$this->m_user->get_chuyen_nganh();
        $this->_data['ds_nien_khoa']=$this->m_user->get_nien_khoa();
        //$this->_data['query_danh_sach_sinh_vien']=$this->m_user->get_sinh_vien_chuyen_nganh($id_chuyen_nganh);        
        $this->_data['heading']="Danh sách sinh viên";
        $this->_data['selected']=$id_chuyen_nganh;
        $this->_data['selected_nk']=-1;
        $this->_data['total_record'] = $total;
        $this->_data['path']=array('user/danh_sach_sinh_vien');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Thông tin sinh viên"  => ''
        );
        $this->_data['cur_page'] = 'dssv';
        $this->load->view('layout/layout',$this->_data);
    }
    public function loc_sinhvien_nienkhoa()
    {
        $this->checkSession();
        $id_chuyen_nganh=$this->uri->segment(2);
        $id_nienkhoa=$this->uri->segment(3);
         //Phân trang
        $param=5;
        $per_pg=20;
        $total=$this->m_home->count_sinh_vien_nien_khoa($id_chuyen_nganh,$id_nienkhoa);
        $page=$this->uri->segment($param);
        if ($page==true) $page=(int)$page; else $page=1;
        $offset=($page-1)*$per_pg;
        //config
        $this->my_lib->pre_config_pagination($param,$per_pg,$total);
        $config['base_url']=base_url('sinh-vien-nien-khoa/'.$id_chuyen_nganh.'/'.$id_nienkhoa.'/'.'page/');
        $this->pagination->initialize($config);
        $this->_data['pagination']=$this->pagination->create_links();
        $this->_data['query_danh_sach_sinh_vien']=$this->m_home->get_sinh_vien_nien_khoa($id_chuyen_nganh,$id_nienkhoa,$per_pg,$offset);
        $this->_data['heading']="Danh sách sinh viên";
        $this->_data['ds_chuyen_nganh']=$this->m_user->get_chuyen_nganh();
        $this->_data['ds_nien_khoa']=$this->m_user->get_nien_khoa();
        $this->_data['selected_nk']=$id_nienkhoa;
        $this->_data['selected']=$id_chuyen_nganh;
        $this->_data['total_record'] = $total;
        $this->_data['path']=array('user/danh_sach_sinh_vien');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Thông tin sinh viên"  => ''
        );
        $this->_data['cur_page'] = 'dssv';
        $this->load->view('layout/layout',$this->_data);
    }
    /* ================================================================*/
    public function danh_sach_giang_vien()
    {
        $this->checkSession();
        if ($this->session->userdata('username') == NULL)
        {
            redirect('user/dang-nhap');
        }
        $this->_data['selected']=-1;
        $this->_data['ds_chuyen_nganh']=$this->m_user->get_chuyen_nganh();
        $param=3;
        $per_pg=10;
        $total=$this->m_home->count_danh_sach_giang_vien();
        $page=$this->uri->segment($param);
        if ($page==true) $page=(int)$page; else $page=1;
        $offset=($page-1)*$per_pg;
        //config
        $this->my_lib->pre_config_pagination($param,$per_pg,$total);
        $config['base_url']=base_url('danh-sach-giang-vien/page/');
        $this->pagination->initialize($config);
        $this->_data['pagination']=$this->pagination->create_links();
        $this->_data['query_danh_sach_giang_vien']=$this->m_home->get_danh_sach_giang_vien($per_pg,$offset);
        $this->_data['heading']="Danh sách giảng viên";
        $this->_data['total_record'] = $total;
        $this->_data['path']=array('user/danh_sach_giang_vien');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Thông tin giảng viên"  => ''
        );
        $this->_data['cur_page'] = 'dsgv';
        $this->load->view('layout/layout',$this->_data);
    }
    public function loc_danh_sach_giang_vien_chuyen_nganh()
    {
        $this->checkSession();
        $str=$this->uri->segment(2);
        $str_exp=explode('-',$str);
        $count = count($str_exp);
        $id_chuyen_nganh=$str_exp[$count-1];
        $this->_data['ds_chuyen_nganh']=$this->m_user->get_chuyen_nganh();
        $query = $this->m_home->get_giang_vien_chuyen_nganh($id_chuyen_nganh);
        $this->_data['query_danh_sach_giang_vien']= $query['result'];
        $this->_data['total_record'] = $query['row_count'];
        $this->_data['heading']="Danh sách giảng viên";
        $this->_data['selected']=$id_chuyen_nganh;
        $this->_data['path']=array('user/danh_sach_giang_vien');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Thông tin giảng viên"  => ''
        );
        $this->_data['cur_page'] = 'dsgv';
        $this->load->view('layout/layout',$this->_data);
    }
    public function danh_sach_de_tai()
    {
        $this->_data['selected']=-1;
        $cauhinh_id = $this->uri->segment(2);
        $param=4;
        $per_pg=12;
        $total=$this->m_home->count_danh_sach_de_tai_loai_de_tai($cauhinh_id);
        $page=$this->uri->segment($param);
        if ($page==true) $page=(int)$page; else $page=1;
        $offset=($page-1)*$per_pg;
        //Load cấu hình phân trang        
        $this->my_lib->pre_config_pagination($param,$per_pg,$total);
        $config['base_url']=base_url('danh-sach-de-tai/'.$cauhinh_id.'/page');
        $this->pagination->initialize($config);
        $this->_data['pagination']=$this->pagination->create_links();
        //$this->_data['query_ds_de_tai']=$this->m_home->get_danh_sach_de_tai();
        $this->_data['query_ds_de_tai']=$this->m_home->get_danh_sach_de_tai_loai_de_tai($cauhinh_id,$per_pg,$offset);
        $this->_data['cauhinh_id']=$cauhinh_id;
        //Lấy heading
        $query_heading=$this->m_home->get_ten_loai_de_tai($cauhinh_id);
        $this->_data['heading']=$query_heading->tenloai.' K'.$query_heading->TenNK;
        //đếm số thành viên
        $array_sothanhvien=array();
        $query_temp = $this->m_home->get_danh_sach_de_tai_loai_de_tai($cauhinh_id,$per_pg,$offset);
        $i=0;
        foreach ($query_temp as $rows)
        {
            $array_sothanhvien[$rows->id] = $this->m_home->count_so_luong_sinhvien_detai($rows->id);
        }
        $this->_data['array_sothanhvien']=$array_sothanhvien;   
        $this->_data['total_record'] = $total;     
        $this->_data['path']=array('frontend/danh_sach_de_tai');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Danh sách loại đề tài"  => site_url('danh-sach-loai-de-tai'),
        "$query_heading->tenloai Khoá $query_heading->TenNK"        =>''
        );
        $this->_data['cur_page'] = 'dsdt';
        $this->load->view('layout/layout',$this->_data);
    }
    public function danh_sach_de_tai_chuyen_nganh()
    {
        $cauhinh_id = $this->uri->segment(2);
        $id_chuyennganh=$this->uri->segment(3);
        //liet ke danh sach giang vien chuyen nganh
        $ds_giangvien = $this->m_home->get_giangvien_chuyennganh_co_detai($id_chuyennganh,$cauhinh_id);
        $this->_data['ds_giangvien'] = $ds_giangvien;
        $this->_data['selected']=$id_chuyennganh;
        //Phân trang
        $param=5;
        $per_pg=12;
        $total=$this->m_home->count_danh_sach_de_tai_loai_de_tai_theo_chuyen_nganh($cauhinh_id,$id_chuyennganh);
        $page=$this->uri->segment($param);
        if ($page==true) $page=(int)$page; else $page=1;
        $offset=($page-1)*$per_pg;
        //config
        $this->my_lib->pre_config_pagination($param,$per_pg,$total);
        $config['base_url']=base_url('de-tai-chuyen-nganh/'.$cauhinh_id.'/'.$id_chuyennganh.'/page');
        $this->pagination->initialize($config);
        $this->_data['pagination']=$this->pagination->create_links();
        $this->_data['query_ds_de_tai'] = $this->m_home->get_danh_sach_de_tai_loai_de_tai_chuyen_nganh($cauhinh_id,$id_chuyennganh,$per_pg,$offset);
        $this->_data['cauhinh_id']=$cauhinh_id;
         //Lấy heading
        $query_heading=$this->m_home->get_ten_loai_de_tai($cauhinh_id);
        $this->_data['heading']=$query_heading->tenloai.' K'.$query_heading->TenNK;
        //đếm số thành viên
        $array_sothanhvien=array();
        $query_temp = $this->m_home->get_danh_sach_de_tai_loai_de_tai_chuyen_nganh($cauhinh_id,$id_chuyennganh,$per_pg,$offset);
        $i=0;
        foreach ($query_temp as $rows)
        {
            $array_sothanhvien[$rows->id] = $this->m_home->count_so_luong_sinhvien_detai($rows->id);
        }
        $this->_data['array_sothanhvien']=$array_sothanhvien; 
        $this->_data['total_record'] = $total;  
        $this->_data['path']=array('frontend/danh_sach_de_tai');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Danh sách loại đề tài"  => base_url('danh-sach-loai-de-tai'),
        "$query_heading->tenloai Khoá $query_heading->TenNK"        =>''
        );
        $this->_data['cur_page'] = 'dsdt';
        $this->load->view('layout/layout',$this->_data);
    }
    public function giangvien_detai()
    {
        $giangvien_id = $_POST['gv_id'];
        $cauhinh_id = $_POST['cauhinh_id'];
        $chuyennganh_id = $_POST['cn_id'];
        $query_tmp = $this->m_home->get_detai_giangvien_chuyennganh($giangvien_id,$cauhinh_id,$chuyennganh_id);
        $query = $query_tmp['result'];
        $count = $query_tmp['row_count'];
        $array_sothanhvien=array();
        $i=0;
        foreach ($query as $rows)
        {
            $array_sothanhvien[$rows->id] = $this->m_home->count_so_luong_sinhvien_detai($rows->id);
        }
        $this->_data['count'] = $count;
        $this->_data['query'] = $query;
        $this->_data['array_sothanhvien'] = $array_sothanhvien;
        $this->load->view('frontend/danh_sach_de_tai_ajax',$this->_data);
    }
    public function chi_tiet_de_tai()
    {
        $str = $this->uri->segment(2);
        $str_exp=explode('-',$str);
        $count = count($str_exp);
        $id_detai = $str_exp[$count-1]; 
        if (!$this->m_home->kt_detai_trong_danhsach($id_detai))
        {
            $this->my_lib->display_thongbao('danger','Thông tin đề tài không hợp lệ');
        }
        else
        {
            $arr_detail = $this->m_home->get_chi_tiet_de_tai($id_detai);
            if (!empty($arr_detail))
            {
                $arr_nhomtruong = $this->m_home->get_ten_truong_nhom($arr_detail->truongnhom);
                if (!empty($arr_detail->truongnhom))
                {
                    $arr_thanhvien = $this->m_home->get_ten_thanh_vien($id_detai,$arr_detail->truongnhom);
                    //echo $arr_thanhvien[0]->id;
                }
                else
                {
                    $arr_thanhvien = "";
                }
                $arr_giangvien_huongdan = $this->m_home->get_ten_giang_vien($id_detai);
                $arr_giangvien_phanbien = $this->m_home->get_ten_giang_vien_phan_bien($id_detai);
                $soluong_thanhvien_dadangky=$this->m_home->count_thanh_vien($id_detai);
                $this->_data['arr_detail']= $arr_detail;
                $this->_data['soluong_thanhvien_dadangky']= $soluong_thanhvien_dadangky;
                $this->_data['arr_nhomtruong']= $arr_nhomtruong;
                $this->_data['arr_thanhvien']= $arr_thanhvien;
                $this->_data['arr_giangvien_huongdan']= $arr_giangvien_huongdan;
                $this->_data['arr_giangvien_phanbien']= $arr_giangvien_phanbien;
                $this->_data['diem_detai'] = $this->m_home->get_diem_detai($id_detai);
                $this->_data['heading']="Chi tiết đề tài";
                $this->_data['path']=array('frontend/chi_tiet_de_tai');
                $this->_data['arr_luuvet'] = array(
                "Home"     => base_url(),
                "Danh sách loại đề tài"  => base_url('danh-sach-loai-de-tai'),
                "Chi tiết đề tài"       =>''
                );
                $this->_data['cur_page'] = 'dsdt';
                $this->load->view('layout/layout',$this->_data);
            }
            else
            {
                //Tài nguyên không tồn tại
                $this->my_lib->display_thongbao('warning','Dữ liệu không tồn tại');
            }
        }
    }
}
?>