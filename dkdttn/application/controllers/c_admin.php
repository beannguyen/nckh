<?php
class C_admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_dangdetai_gv');
        $this->load->model('m_dangkydetai');
        header('Content-Type: text/html;charset=utf-8');  
    }
    public function trang_quan_tri()
    {
        $this->_data['heading']="Quản trị hệ thống";
        $this->_data['path']=array('includes_admin/trang_quan_tri');
        $this->_data['avatar'] = $this->m_user->get_info_user($this->session->userdata('username'))->avatar;
        $this->_data['arr_luuvet'] = array(
        "Home"     => site_url('user/admin'),
        "Quản trị hệ thống"  => ''
        );
        $this->_data['cur_page'] = 'admin_page';
        $this->load->view('layout/backend-layout',$this->_data);
    }
    public function quan_tri_cau_hinh()
    {
        $this->_data['heading']="Quản trị cấu hình";
        $this->_data['ds_cauhinh'] = $this->m_admin->get_danh_sach_loai_de_tai();
        $this->_data['path']=array('backend/quanly_cauhinh/quan_tri_cau_hinh_index');
        $this->_data['arr_luuvet'] = array(
        "Home"     => site_url('user/admin'),
        "Quản trị cấu hình"  => ''
        );
        $this->_data['cur_page'] = 'quan_tri_cau_hinh';
        $this->load->view('layout/backend-layout',$this->_data);
    }
    public function chi_tiet_cau_hinh()
    {
        $id_cauhinh = $this->uri->segment(3);
        if (!empty($id_cauhinh))
        {
            $this->_data['heading']="Chi tiết cấu hình";
            $this->_data['info_cauhinh'] = $this->m_admin->get_chi_tiet_cau_hinh($id_cauhinh);
            $this->_data['path']=array('backend/quanly_cauhinh/chi_tiet_cau_hinh');
            $this->_data['arr_luuvet'] = array(
            "Home"     => site_url('user/admin'),
            "Quản trị cấu hình" => site_url('user/manager-config'),
            "Chi tiết cấu hình"  => ''
            );
            $this->_data['cur_page'] = 'quan_tri_cau_hinh';
            $this->load->view('layout/backend-layout',$this->_data);
        }   
    }
    public function them_cau_hinh()
    {
        if (isset($_POST['btn_them_ch'])) 
        {
            $sv_start = strtotime($_POST['thoigianSVbatdaudk']);
            $sv_end   = strtotime($_POST['thoigianSVketthucdk']);
            $gv_start = strtotime($_POST['thoigianGVbatdaudk']);
            $gv_end   = strtotime($_POST['thoigianGVketthucdk']);
            if ($sv_start>$sv_end)
            {
                echo 'Thời gian sinh viên bắt đầu đăng ký phải nhỏ hơn thời gian sinh viên kết thúc đăng ký';
            }
            else if ($gv_start>$gv_end)
            {
                echo 'Thời gian giảng viên bắt đầu đăng ký phải nhỏ hơn thời gian sinh viên kết thúc đăng ký';
            }
            else if ($sv_start<$gv_end)
            {
                echo 'Thời gian sinh viên bắt đầu đăng ký phải nhỏ hơn thời gian sinh giảng kết thúc đăng ký';
            }
            else
            {
                $loai_detai = $_POST['loai_detai'];
                if ($loai_detai == 1)  $hocky=2;
                else $hocky = 1;
                $data = array (
                    'soluongSVtoida'        =>  $_POST['max_sv'],
                    'thoigianSVbatdaudk'    =>  $_POST['thoigianSVbatdaudk'],
                    'thoigianSVketthucdk'   =>  $_POST['thoigianSVketthucdk'],
                    'thoigianGVbatdaudk'    =>  $_POST['thoigianGVbatdaudk'],
                    'thoigianGVketthucdk'   =>  $_POST['thoigianGVketthucdk'],
                    'loaidetai_id'          =>  $loai_detai,
                    'nienkhoa'              =>  $_POST['nienkhoa'],
                    'namhoc'                =>  $_POST['namhoc1'].' - '.$_POST['namhoc2'],
                    'hocky'                 =>  $hocky,
                    'diemTB'                =>  $_POST['diemtb'],
                    'diemKHA'               =>  $_POST['diemkha'],
                    'diemGIOI'              =>  $_POST['diemgioi']
                );
                $this->m_admin->them_cauhinh($data);
                echo 'ok';
            }
        }
        else
        {
            $this->_data['heading']="Thêm cấu hình";
            $this->_data['arr_nienkhoa'] = $this->m_admin->get_nienkhoa();
            $this->_data['path']=array('backend/quanly_cauhinh/them_cau_hinh');
            $this->_data['arr_luuvet'] = array(
            "Home"     => site_url('user/admin'),
            "Quản trị cấu hình" => site_url('user/manager-config'),
            "Thêm cấu hình"  => ''
            );
            $this->_data['cur_page'] = 'quan_tri_cau_hinh';
            $this->load->view('layout/backend-layout',$this->_data);
        }
    }
    public function sua_cau_hinh()
    {
        if (isset($_POST['btn_sua_ch'])) 
        {
            $id_cauhinh = $_POST['cauhinh_id'];
            $sv_start = strtotime($_POST['thoigianSVbatdaudk']);
            $sv_end   = strtotime($_POST['thoigianSVketthucdk']);
            $gv_start = strtotime($_POST['thoigianGVbatdaudk']);
            $gv_end   = strtotime($_POST['thoigianGVketthucdk']);
            if ($sv_start>$sv_end)
            {
                $this->my_lib->display_thongbao('warning','Thời gian sinh viên bắt đầu đăng ký phải nhỏ hơn thời gian sinh viên kết thúc đăng ký');
                $this->output->set_header('refresh:1; url='.site_url('user/sua-cau-hinh/'.$id_cauhinh)); 
            }
            else if ($gv_start>$gv_end)
            {
                $this->my_lib->display_thongbao('warning','Thời gian giảng viên bắt đầu đăng ký phải nhỏ hơn thời gian giảng viên kết thúc đăng ký');
                $this->output->set_header('refresh:1; url='.site_url('user/sua-cau-hinh/'.$id_cauhinh)); 
            }
            else if ($sv_start<$gv_end)
            {
                $this->my_lib->display_thongbao('warning','Thời gian sinh viên bắt đầu đăng ký phải nhỏ hơn thời gian giảng viên kết thúc đăng ký');
                $this->output->set_header('refresh:1; url='.site_url('user/sua-cau-hinh/'.$id_cauhinh)); 
            }
            else
            {
                $loai_detai = $_POST['loai_detai'];
                if ($loai_detai == 1)  $hocky=2;
                else $hocky = 1;
                $data = array (
                    'soluongSVtoida'        =>  $_POST['max_sv'],
                    'thoigianSVbatdaudk'    =>  $_POST['thoigianSVbatdaudk'],
                    'thoigianSVketthucdk'   =>  $_POST['thoigianSVketthucdk'],
                    'thoigianGVbatdaudk'    =>  $_POST['thoigianGVbatdaudk'],
                    'thoigianGVketthucdk'   =>  $_POST['thoigianGVketthucdk'],
                    'loaidetai_id'          =>  $loai_detai,
                    'nienkhoa'              =>  $_POST['nienkhoa'],
                    'namhoc'                =>  $_POST['namhoc'],
                    'hocky'                 =>  $hocky,
                    'diemTB'                =>  $_POST['diemtb'],
                    'diemKHA'               =>  $_POST['diemkha'],
                    'diemGIOI'              =>  $_POST['diemgioi'],
                    'dateupdate'            =>  date("Y-m-d H:i:s"),
                );
                $this->m_admin->sua_cauhinh($id_cauhinh,$data);
                $this->my_lib->display_thongbao('success','Cập nhật thành công');
                $this->output->set_header('refresh:1; url='.site_url('user/sua-cau-hinh/'.$id_cauhinh)); 
            }
        }
        else
        {
            $id_cauhinh = $this->uri->segment(3);
            $this->_data['heading']="Sửa cấu hình";
            $this->_data['arr_nienkhoa'] = $this->m_admin->get_nienkhoa();
            $this->_data['info_cauhinh'] = $this->m_admin->get_chi_tiet_cau_hinh($id_cauhinh);
            $this->_data['path']=array('backend/quanly_cauhinh/sua_cau_hinh');
            $this->_data['arr_luuvet'] = array(
            "Home"     => site_url('user/admin'),
            "Quản trị cấu hình" => site_url('user/manager-config'),
            "Sửa cấu hình"  => ''
            );
            $this->_data['cur_page'] = 'quan_tri_cau_hinh';
            $this->load->view('layout/backend-layout',$this->_data);
        }
    }
    public function sinhvien_cauhinh()
    {
        $cauhinh_id = $this->uri->segment(3);
        $this->_data['cauhinh_id'] = $cauhinh_id;
        $this->_data['ten_cauhinh']= $this->m_admin->get_chi_tiet_cau_hinh($cauhinh_id)->tenloai.' Khóa '.$this->m_admin->get_chi_tiet_cau_hinh($cauhinh_id)->NamBD;
        $this->_data['heading']="Quản lý sinh viên vào cấu hình";
        $this->_data['sinhvien_cauhinh'] = $this->m_admin->get_sinhvien_cauhinh($cauhinh_id);
        $this->_data['path']=array('backend/quanly_cauhinh/quanly_sinhvien_cauhinh');
        $this->_data['arr_luuvet'] = array(
        "Home"     => site_url('user/admin'),
        "Quản trị cấu hình" => site_url('user/manager-config'),
        "Quản lý sinh viên và cấu hình"  => ''
        );
        $this->_data['cur_page'] = 'quan_tri_cau_hinh';
        $this->load->view('layout/backend-layout',$this->_data);
    }
    public function xoa_sinhvien_cauhinh()
    {
        $cauhinh_id = $this->uri->segment(3);
        $sinhvien_id = $this->uri->segment(4);
        $this->m_admin->delete_sinhvien_cauhinh($cauhinh_id,$sinhvien_id);
        $this->session->set_userdata('mess', '<div class="alert alert-success">Xóa thành công sinh viên : '.$this->m_user->get_info_user($sinhvien_id)->name.' - '.$this->m_user->get_info_user($sinhvien_id)->username.'</div>');
        $this->sinhvien_cauhinh();
        //$this->my_lib->display_thongbao('success','Xóa thành công');
        //$this->output->set_header('refresh:1; url='.site_url('user/quan-ly-sinh-vien-cau-hinh/'.$cauhinh_id)); 
    }
    public function xoa_tatca_sinhvien_cauhinh()
    {
        $cauhinh_id = $this->uri->segment(3);
        $this->m_admin->delete_all_sinhvien_cauhin($cauhinh_id);
        $this->session->set_userdata('mess', '<div class="alert alert-success">Xóa thành công danh sách</div>');
        $this->sinhvien_cauhinh();
       
    }
    public function them_sinhvien_cauhinh()
    {
        if (isset($_POST['submit_mssv']))
        {
            $mssv = $_POST['mssv'];
            $cauhinh = $_POST['cauhinh_id'];
            if ($this->m_admin->check_tontai_sv($mssv) === 0)
            {
                $this->my_lib->display_thongbao('warning','Sinh viên không tồn tại trong hệ thống');
                $this->output->set_header('refresh:1; url='.site_url('user/quan-ly-sinh-vien-cau-hinh/'.$cauhinh)); 
            }
            else
            {
                $id_sinhvien = $this->m_admin->check_tontai_sv($mssv)->id;
                $data = array('user_id' =>  $id_sinhvien,'cauhinh_id'   =>$cauhinh);
                if ($this->m_admin->check_exist_data($data) === 0)
                {
                    $this->my_lib->display_thongbao('warning','Sinh viên này đã có trong danh sách đăng ký');
                }
                else
                {
                    $this->m_admin->them_sinhvien_cauhinh($data);
                    $this->my_lib->display_thongbao('success','Thêm thành công');
                }
                $this->output->set_header('refresh:1; url='.site_url('user/quan-ly-sinh-vien-cau-hinh/'.$cauhinh)); 
            }
        }
        else if (isset($_POST['submit_ds_mssv']))
        {
            $cauhinh = $_POST['cauhinh_id'];
            $excel = $_FILES['ds_sinhvien']['tmp_name'];
            //print_r($excel);
            $this->load->library('excel');
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($excel);
            //$objPHPExcel->setActiveSheetIndex(10);
            $objPHPExcel->setActiveSheetIndexByName('DSDK');
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            foreach ($sheetData as $rows)
            {
                $mssv = $rows['A'];
                if (is_numeric($mssv))
                {
                    if (strlen($mssv) === 7)
                    {
                        $mssv = '0'.$mssv;
                    }
                    else if(strlen($mssv) === 8)
                    {
                        $mssv= $mssv;
                    }
                        if ($this->m_admin->check_tontai_sv($mssv) === 0)
                        {
                            $this->my_lib->display_thongbao('warning','Sinh viên '.$mssv.' không tồn tại trong hệ thống');
                            break;
                        }
                        else
                        {
                            $id_sinhvien = $this->m_admin->check_tontai_sv($mssv)->id;
                            $data = array('user_id' =>  $id_sinhvien,'cauhinh_id'   =>$cauhinh);
                            if ($this->m_admin->check_exist_data($data) === 0)
                            {
                                //$this->my_lib->display_thongbao('warning','Sinh viên này đã có trong danh sách đăng ký');
                            }
                            else
                            {
                                $this->m_admin->them_sinhvien_cauhinh($data);
                            }
                        }
                }
                //echo $mssv.'<br>';
            }
            $this->output->set_header('refresh:1; url='.site_url('user/quan-ly-sinh-vien-cau-hinh/'.$cauhinh)); 
        }
    }
    public function export_cauhinh_detai()
    {
        $cauhinh_id = $this->uri->segment(3);
        $this->my_lib->write_excel_data($cauhinh_id);
    }
    # ===================================== Quan tri thong bao ================================ #
    public function index_thongbao()
    {
        $this->_data['heading']="Quản trị thông báo";
        $this->_data['ds_thongbao'] = $this->m_admin->get_all_thongbao();
        $this->_data['path']=array('backend/quanly_thongbao/index');
        $this->_data['arr_luuvet'] = array(
        "Home"     => site_url('user/admin'),
        "Quản trị thông báo" => site_url('user/quan-ly-thong-bao')
        );
        $this->_data['cur_page'] = 'quan_tri_thongbao';
        $this->load->view('layout/backend-layout',$this->_data);
    }
    public function them_thongbao()
    {
        if (!isset($_POST['title']))
        {
            $this->_data['heading']="Thêm thông báo";
            $this->_data['path']=array('backend/quanly_thongbao/them_thongbao');
            $this->_data['arr_luuvet'] = array(
            "Home"     => site_url('user/admin'),
            "Quản trị thông báo" => site_url('user/quan-ly-thong-bao'),
            "Thêm thông báo"  => ''
            );
            $this->_data['cur_page'] = 'quan_tri_thongbao';
            $this->load->view('layout/backend-layout',$this->_data);
        }
        else
        {
            $title = $_POST['title'];
            $noidung = $_POST['noidung'];
            $data = array(
            'id'            =>  date('Ymd').time(),
            'tenthongbao'   =>  $title,
            'noidung'       =>  $noidung,
            'nguoidang'     =>  $this->session->userdata('id_user'),
            'ngaycapnhat'   =>  date('Y-m-d H:i:s'),
            'cotinmoi'      =>  '1',
            'trangthai'     =>  '0',//khong ro de lam gi
            );
            $this->m_admin->them_thongbao($data);
            $this->index_thongbao();
        }
    }
    public function xoa_thongbao()
    {
        $id_thongbao = $this->uri->segment(3);
        if ($this->m_admin->xoa_thongbao($id_thongbao) === 0)
        {
            $this->session->set_userdata('mess','<div class="alert alert-warning">Thông báo không tồn tại</div>');
            $this->index_thongbao();
        }
        else
        {
            $this->session->set_userdata('mess','<div class="alert alert-success">Xóa thành công</div>');
            $this->index_thongbao();
        }
    }
    public function capnhat_tinmoi()
    {
        $id_thongbao = $this->uri->segment(3);
        $cotinmoi = $this->uri->segment(4);
        $data = array(
        'cotinmoi'    =>  $cotinmoi,
        'ngaycapnhat' =>  date('Y-m-d H:i:s'),
        );
        $this->m_admin->capnhat_thongbao($id_thongbao,$data);
        $this->session->set_userdata('mess','<div class="alert alert-success">Cập nhật thành công</div>');
        $this->index_thongbao();
    }
    public function sua_thongbao()
    {
        if (!isset($_POST['id_thongbao']))
        {
            $id_thongbao = $this->uri->segment(3);
            $this->_data['chitiet_tb'] = $this->m_admin->get_chitiet_thongbao($id_thongbao);
            $this->_data['heading']="Sửa thông báo";
            $this->_data['path']=array('backend/quanly_thongbao/sua_thongbao');
            $this->_data['arr_luuvet'] = array(
            "Home"     => site_url('user/admin'),
            "Quản trị thông báo" => site_url('user/quan-ly-thong-bao'),
            "Sửa thông báo"  => ''
            );
            $this->_data['cur_page'] = 'quan_tri_thongbao';
            $this->load->view('layout/backend-layout',$this->_data);
        }
        else
        {
            $id_thongbao = $_POST['id_thongbao'];
            $data = array(
            'tenthongbao'   =>  $_POST['title'],
            'noidung'       =>  $_POST['noidung'],
            'ngaycapnhat'   =>  date("Y-m-d H:i:s"),
            );
            $this->m_admin->capnhat_thongbao($id_thongbao,$data);
            $this->my_lib->display_thongbao('success','Cập nhật thành công');
            $this->output->set_header('refresh:1; url='.site_url('user/sua-thong-bao/'.$id_thongbao)); 
        }
    }
    /*========================== Quản trị người dùng =============================*/
    public function index_nguoidung()
    {
        $this->_data['heading']="Quản trị người dùng";
        $this->_data['path']=array('backend/quanly_nguoidung/index');
        $this->_data['arr_luuvet'] = array(
        "Home"     => site_url('user/admin'),
        "Quản trị người dùng" => site_url('user/quan-ly-nguoi-dung')
        );
        $this->_data['ds_lop']=$this->m_admin->get_lop();
        $this->_data['ds_cn']=$this->m_user->get_chuyen_nganh();
        $this->_data['cur_page'] = 'quan_tri_nguoi_dung';
        $this->load->view('layout/backend-layout',$this->_data);
    }
    public function info_nguoidung()
    {
        if (isset($_POST['info_nguoidung']))
        {
            $user_id = $_POST['user_id'];
            $this->_data['cn_list'] = $this->m_user->get_chuyen_nganh();
            $this->_data['heading']="Quản trị người dùng";
            $this->_data['path']=array('backend/quanly_nguoidung/index','backend/quanly_nguoidung/info_nguoidung');
            $this->_data['info_nguoidung'] = $this->m_admin->find_user($user_id);
            $this->_data['arr_luuvet'] = array(
            "Home"     => site_url('user/admin'),
            "Quản trị người dùng" => site_url('user/quan-ly-nguoi-dung')
            );
            $this->_data['cur_page'] = 'quan_tri_nguoi_dung';
            $this->load->view('layout/backend-layout',$this->_data);
        }
        else if (isset($_POST['doi_thongtin']))
        {
            $username = $_POST['username'];
            $data = array(
            'email'         =>  $_POST['email'],
            'usertype'      =>  $_POST['usertype'],
            'phone'         =>  $_POST['phone'],
            'chuyennganh'   =>  $_POST['chuyennganh'],
            );
            $this->m_user->doi_thong_tin_ca_nhan($username,$data);
            $this->_data['cn_list'] = $this->m_user->get_chuyen_nganh();
            $this->_data['heading']="Quản trị người dùng";
            $this->_data['path']=array('backend/quanly_nguoidung/index','backend/quanly_nguoidung/info_nguoidung');
            $this->_data['info_nguoidung'] = $this->m_admin->find_user($username);
            $this->_data['arr_luuvet'] = array(
            "Home"     => site_url('user/admin'),
            "Quản trị người dùng" => site_url('user/quan-ly-nguoi-dung')
            );
            $this->_data['cur_page'] = 'quan_tri_nguoi_dung';
            $this->load->view('layout/backend-layout',$this->_data);
        }
        else if(isset($_POST['reset_mk']))
        {
            $username = $new_pass = $_POST['username'];
            $crypted_new_pass=$this->my_lib->Create_salt($new_pass);
            $this->m_user->doimatkhau($username,$crypted_new_pass);
            echo 'Reset mật khẩu thành công';
        }
        else if(isset($_POST['submit_ds_nguoidung']))
        {
            //var_dump($_POST['ds_users_sinhvien']);
            $excel = $_FILES['ds_users_sinhvien']['tmp_name'];
            $this->load->library('excel');
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($excel);
            $objPHPExcel->setActiveSheetIndexByName('DSSV');
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            $t = 1;
            echo '<table style="border:1px solid;text-align:center;margin:0 auto;">';
            echo '<tr><th><h3>Danh sách sinh viên được thêm vào</h3></th><td><button onclick="window.history.go(-1); return false;">Back</button></td></tr>';
            echo '<tr><td style="border:1px solid;">Username</td><td style="border:1px solid;">Name</td></tr>';
            foreach ($sheetData as $rows)
            {
                if(is_numeric($rows['A']))
                {
                    $data = array(
                        'name'          =>  $rows['B'],
                        'username'      =>  $rows['A'],
                        'email'         =>  $rows['C'],
                        'password'      =>  $this->my_lib->Create_salt($rows['A']),
                        'usertype'      =>  'sinhvien',
                        'registerDate'  =>  date('Y-m-d H:i:s'),
                        'lastvisitDate' =>  date('Y-m-d H:i:s'),
                        'chuyennganh'   =>  $rows['E'],
                        'lop'           =>  $rows['F'],
                        'chucvu_id'     =>  '1',
                        //'diem'          =>  '',
                        //'TongTC'        =>  '',
                    );
                    echo '<tr>';
                    echo '<td style="border:1px solid;"> ' . $data['username'] . '</td>';
                    echo '<td style="border:1px solid;"> ' . $data['name'] . ' ---- ' . date('Ymd').(time() + $t)  . '</td>';
                    echo '</tr>';
                    $this->m_admin->them_ds_nguoidung($data);
                    $t++;
                }
            }
            echo '<table>';
        }
        else if (isset($_POST['reg_account']))
        {
            $data = array(
                        'name'          =>  $_POST['name'],
                        'username'      =>  $_POST['u_name'],
                        'email'         =>  $_POST['email'],
                        'phone'         =>  $_POST['phone'],
                        'password'      =>  $this->my_lib->Create_salt($_POST['u_name']),
                        'usertype'      =>  $_POST['usertype'],
                        'registerDate'  =>  date('Y-m-d H:i:s'),
                        'lastvisitDate' =>  date('Y-m-d H:i:s'),
                        'chuyennganh'   =>  $_POST['c_nganh'],
                        'lop'           =>  $_POST['lop'],
                        'chucvu_id'     =>  '1',
                        //'diem'          =>  '',
                        //'TongTC'        =>  '',
                    );
            if (!$this->m_admin->them_ds_nguoidung($data))
            {
                echo 'Thêm thất bại';
            }
            else
            {
                echo 'Thêm thành công người dùng : '.$data['name'];
            }
        }
    }
    /*====================== Quản trị chung ==========================*/
    public function index_chung()
    {
        $this->_data['heading']="Quản trị chung";
        $this->_data['path']=array('backend/quanly_chung/index_chung');
        $this->_data['arr_luuvet'] = array(
        "Home"     => site_url('user/admin'),
        "Quản trị chung" => site_url('user/quan-ly-chung')
        );
        $this->_data['ds_nienkhoa'] = $this->m_admin->get_nienkhoa();
        $this->_data['ds_lop'] = $this->m_admin->get_lop();
        $this->_data['ds_chuyennganh'] = $this->m_user->get_chuyen_nganh();
        $this->_data['cur_page'] = 'quan_tri_chung';
        $this->load->view('layout/backend-layout',$this->_data);
    }
    public function quantri_nienkhoa()
    {
        //Thêm niên khóa
        if (isset($_POST['them_nk']))
        {
            $ten_nk = $_POST['tennk'];
            if (is_numeric($ten_nk) && strlen($ten_nk) == 2 && $ten_nk > 0)
            {
                $data = array(
                    'TenNK'     =>  $ten_nk,
                    'NamBD'     =>  '20'.$ten_nk,
                    'NamKT'     =>  '20'.($ten_nk + 5),
                );
                if (!$this->m_admin->them_nk($data))
                {
                    $this->session->set_userdata('mess','<div class="alert alert-danger">Thêm không thành công</div>');
                    $this->index_chung();
                }
                else
                {
                    $this->session->set_userdata('mess','<div class="alert alert-success">Thêm thành công</div>');
                    $this->index_chung();
                }
            }
            else
            {
                $this->session->set_userdata('mess','<div class="alert alert-warning">Thông tin nhập vào không hợp lệ</div>');
                $this->index_chung();
            }
        }
        else if (isset($_POST['sua_nk']))
        {
            $id = $_POST['id_nk'];
            $data = array(
                'TenNK'     =>  $_POST['tennk'],
                'NamBD'     =>  $_POST['nambd'],
                'NamKT'     =>  $_POST['namkt'],
            );
            if(!$this->m_admin->sua_nk($data,$id))
            {
                $this->session->set_userdata('mess','<div class="alert alert-warning">Niên khóa đã tồn tại hoặc không hợp lệ</div>');
                $this->index_chung();
                print_r($data);
                echo $id;
            }
            else
            {
                $this->session->set_userdata('mess','<div class="alert alert-success">Cập nhật thành công</div>');
                $this->index_chung();
            }
        }
        else if (isset($_POST['xoa_nk']))
        {
            $id = $_POST['id'];
            if (!$this->m_admin->xoa_nk($id))
            {
                echo 'Vui lòng xóa tất cả thông tin liên quan niên khóa trong lớp trước ';
            }
            else
            {
                echo 'ok';
            }
        }
    }
    public function quan_tri_lop()
    {
        //Thêm lớp
        if (isset($_POST['them_lop']))
        {
            $nienkhoa_id = $_POST['nienkhoa_id'];
            $tenlop = $_POST['tenlop'];
            $data = array(
                'TenLop'    =>  $tenlop,
                'nienkhoa'  =>  $nienkhoa_id
            );
            if (!$this->m_admin->them_lop($data))
            {
                $this->session->set_userdata('mess','<div class="alert alert-warning">Lớp đã tồn tại hoặc không hợp lệ</div>');
                $this->index_chung();
            }
            else
            {
                $this->session->set_userdata('mess','<div class="alert alert-success">Thêm lớp mới thành công</div>');
                $this->index_chung();
            }
        }
        else if (isset($_POST['sua_lop']))
        {
            $lop_id = $_POST['lop_id'];
            $data = array(
                'TenLop'    =>  $_POST['tenlop'],
                'nienkhoa'  =>  $_POST['nienkhoa_id']
            );
            if (!$this->m_admin->sua_lop($data,$lop_id))
            {
                $this->session->set_userdata('mess','<div class="alert alert-warning">Lớp đã tồn tại hoặc không hợp lệ</div>');
                $this->index_chung();
            }
            else
            {
                $this->session->set_userdata('mess','<div class="alert alert-success">Cập nhật lớp thành công</div>');
                $this->index_chung();
            }
        }
        else if (isset($_POST['xoa_lop']))
        {
            $id_lop = $_POST['id'];
            if (!$this->m_admin->xoa_lop($id_lop))
            {
                echo 'Vui lòng xóa tất cả thông tin users liên quan đến lớp này';
            }
            else
            {
                echo 'ok';
            }
        }
    }
    public function quan_tri_chuyen_nganh()
    {
        //Thêm lớp
        if (isset($_POST['them_cn']))
        {
            $tencn = $_POST['tencn'];
            $data = array(
                'TenCN'    =>  $tencn
            );
            if (!$this->m_admin->them_chuyennganh($data))
            {
                $this->session->set_userdata('mess','<div class="alert alert-warning">Chuyên ngành đã tồn tại hoặc không hợp lệ</div>');
                $this->index_chung();
            }
            else
            {
                $this->session->set_userdata('mess','<div class="alert alert-success">Thêm chuyên ngành mới thành công</div>');
                $this->index_chung();
            }
        }
        else if (isset($_POST['sua_cn']))
        {
            $id_cn = $_POST['id_chuyennganh'];
            $ten_cn = $_POST['tencn'];
            $data = array ('TenCN'      =>  $ten_cn);
            if (!$this->m_admin->sua_cn($data,$id_cn))
            {
                $this->session->set_userdata('mess','<div class="alert alert-warning">Chuyên ngành đã tồn tại hoặc không hợp lệ</div>');
                $this->index_chung();
            }
            else
            {
                $this->session->set_userdata('mess','<div class="alert alert-success">Cập nhật chuyên ngành thành công</div>');
                $this->index_chung();
            }
        }
        else if (isset($_POST['xoa_cn']))
        {
            $id_cn = $_POST['id'];
            if (!$this->m_admin->xoa_cn($id_cn))
            {
                echo 'Vui lòng xóa tất cả thông tin users liên quan đến chuyên ngành này';
            }
            else
            {
                echo 'ok';
            }
        }
    }
    # Quản trị đề tài
    public function quan_tri_de_tai()
    {
        $this->_data['heading']="Quản trị đề tài";
        $this->_data['path']=array('backend/quanly_detai/index_detai');
        $this->_data['arr_luuvet'] = array(
        "Home"     => site_url('user/admin'),
        "Quản trị đề tài" => site_url('user/quan-ly-de-tai')
        );
        $this->_data['cur_page'] = 'quan_tri_de_tai';
        $this->_data['ds_cauhinh'] = $this->m_home->get_danh_sach_loai_de_tai();
        $this->_data['ds_giangvien'] = $this->m_admin->get_giangvien();
        $this->load->view('layout/backend-layout',$this->_data);
    }
    public function detai_giangvien_admin()
    {
        $cauhinh_id = $this->uri->segment(4);
        $giangvien_id = $this->uri->segment(3);
        $this->_data['ds_cauhinh'] = $this->m_home->get_danh_sach_loai_de_tai();
        $this->_data['ds_giangvien'] = $this->m_admin->get_giangvien();
        $this->_data['select_ch'] = $cauhinh_id;
        $this->_data['select_gv'] = $giangvien_id;
        $ten_cauhinh = $this->m_home->get_ten_loai_de_tai($cauhinh_id);
        $this->_data['control'] = true; 
        $detai_giangvien = $this->m_dangdetai_gv->get_detai_giangvien($giangvien_id,$cauhinh_id);
        $arr_thanhvien_detai = ('');
        foreach ($detai_giangvien as $rows)
        {
            $arr_thanhvien_detai[$rows->id] = $this->m_home->count_thanh_vien($rows->id);
        }
        $this->_data['arr_thanhvien_detai']=$arr_thanhvien_detai;
        $this->_data['heading']=$ten_cauhinh->tenloai.' 20'.$ten_cauhinh->TenNK;
        $this->_data['query_ds_de_tai'] = $detai_giangvien;
        $this->_data['path']=array('backend/quanly_detai/index_detai','backend/quanly_detai/detai_ajax');
        $this->_data['arr_luuvet'] = array(
        "Home"     => site_url('user/admin'),
        "Quản trị đề tài" => site_url('user/quan-ly-de-tai'),
        $ten_cauhinh->tenloai.' 20'.$ten_cauhinh->TenNK => ''
        );
        $this->_data['giangvien_id'] = $giangvien_id;
        $this->_data['cur_page'] = 'quan_tri_de_tai';
        $this->load->view('layout/backend-layout',$this->_data);
    }
    public function detai_giangvien_ajax()
    {
        if (isset($_POST['them_dt']))
        {
            $this->_data['ds_cauhinh'] = $this->m_home->get_danh_sach_loai_de_tai();
            $this->_data['ds_giangvien'] = $this->m_admin->get_giangvien();
            echo $this->load->view('backend/quanly_detai/view_themdetai',$this->_data);
        }
        else if (isset($_POST['submit_themdt']))
        {
            $khac_cn =  $_POST['khac_cn'];
            $cauhinh_id = $_POST['cauhinh_id'];
            $info_cauhinh = $this->m_dangdetai_gv->get_thongtin_cauhinh($cauhinh_id);
            $loai_detai = $info_cauhinh->loaidetai_id;
            $user_id = $_POST['giangvien_id'];
            $detai_id = date('Ymd').time();
            $data = array(
            'tendetai'          =>$_POST['ten_detai'],
            'muctieu'           =>$_POST['muc_tieu'],
            'soluongSVtoida'    =>$_POST['so_luong_sv'],
            'soluongSVtoithieu' =>'1',
            'yeucau'            =>$_POST['yeu_cau'],
            'chuthich'          =>$_POST['chuthich'],
            'chuyennganh'       =>$_POST['chuyen_nganh'],
            'trangthai'         =>$_POST['trang_thai'],
            'loaidetai'         =>$loai_detai,
            'id'                =>$detai_id,
            'sanpham'           =>$_POST['san_pham'],
            'cauhinh_id'        =>$cauhinh_id,
            'duocdkkhaccn'      =>$khac_cn,
            );
            if ($data['soluongSVtoida'] > $info_cauhinh->soluongSVtoida)
            {
                echo 'Số lượng sinh viên tối đa không được lớn hơn : '.$info_cauhinh->soluongSVtoida;
            }
            else
            {
                $this->m_dangdetai_gv->them_detai_moi($data,$user_id,$detai_id);
                echo 'ok';
            }
        }
        else if (isset($_POST['submit_them_list_dt'])){
            $list_dt = $_FILES['ds_detai']['tmp_name'];
            $cauhinh_id = $_POST['cbo_list_dt'];
            $info_cauhinh = $this->m_dangdetai_gv->get_thongtin_cauhinh($cauhinh_id);
            $loai_detai = $info_cauhinh->loaidetai_id;
            if ($loai_detai == 1){
                $khac_cn = 1;
            }else{
                $khac_cn = 0;
            }
            $this->load->library('excel');
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($list_dt);
            //$objPHPExcel->setActiveSheetIndexByName('CNPM');
            $count = 0;
            for ($sheet = 0; $sheet < 3; $sheet++){
                if ($sheet == 0){
                    $chuyennganh_id = 3 ; //Mang may tinh
                }else if($sheet == 1){
                    $chuyennganh_id = 2 ; //HTTT
                }else if($sheet == 2){
                    $chuyennganh_id = 1 ; //CNPM
                } 
                $objPHPExcel->setActiveSheetIndex($sheet);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                foreach ($sheetData as $rows){
                    if (is_numeric($rows['A']) && !empty($rows['B'])){
                        $detai_id = date('Ymd').(time() + 1);
                        $user_id = $this->m_user->get_info_user($rows['G'])->id;
                        $data = array(
                            'tendetai'          =>  $rows['B'],
                            'muctieu'           =>  $muctieu = (empty($rows['C'])) ? '' : $rows['C'] ,
                            'soluongSVtoida'    =>  $rows['F'],
                            'soluongSVtoithieu' =>  '1',
                            'yeucau'            =>  $rows['E'],
                            'chuyennganh'       =>  $chuyennganh_id,
                            'trangthai'         =>  '1',//dc tao ra
                            'loaidetai'         =>  $loai_detai,
                            'id'                =>  $detai_id,
                            'yeucau'            =>  '',
                            'sanpham'           =>  $sanpham = (empty($rows['D'])) ? '' : $rows['D'],
                            'cauhinh_id'        =>  $cauhinh_id,
                            'duocdkkhaccn'      =>  $khac_cn,
                        );
                        sleep(1);
                        $this->m_dangdetai_gv->them_detai_moi($data,$user_id,$detai_id);
                        $count++;
                    }
                }// end foreach;
            }// endfor;
            //echo $count;
            $this->session->set_userdata('mess','<div class="alert alert-success">Thêm thành công ' . $count . ' đề tài</div>');
            $this->quan_tri_de_tai();
        }
        else if(isset($_POST['xoa_dt']))
        {
            $detai_id = $_POST['detai_id'];
            $giangvien_id = $_POST['giangvien_id'];
            $this->m_dangdetai_gv->xoa_detai_giangvien($giangvien_id,$detai_id);
            echo 'ok';
        }
        else if (isset($_POST['submit_del_list_detai'])){
            $cauhinh_id = $_POST['cbo_list_del_dt'];
            $list_detai = $this->m_dangdetai_gv->get_detai_cauhinh($cauhinh_id);
            $i = 0;
            if (!empty($list_detai)){
                foreach ($list_detai as $rows){
                    $this->m_dangdetai_gv->xoa_detai_giangvien($rows->user_id,$rows->id);
                    $i++;
                    //echo $i;
                }
                $this->session->set_userdata('mess','<div class="alert alert-success">Xóa thành công ' . $i . ' đề tài</div>');
                $this->quan_tri_de_tai();
            }else{
                $this->session->set_userdata('mess','<div class="alert alert-warning">Không có đề tài để xóa</div>');
                $this->quan_tri_de_tai();
            }
        }
        else if(isset($_POST['form_suadt']))
        {
            $detai_id = $_POST['id_detai'];
            $this->_data['ds_chuyennganh'] = $this->m_user->get_chuyen_nganh();
            $this->_data['ds_cauhinh'] = $this->m_home->get_danh_sach_loai_de_tai();
            $this->_data['ds_giangvien'] = $this->m_admin->get_giangvien();
            $this->_data['detai_id'] = $detai_id;
            $ct_detai = $this->m_home->get_chi_tiet_de_tai($detai_id);
            $this->_data['chitiet_detai'] = $ct_detai;
            $arr_giangvien_huongdan = $this->m_home->get_ten_giang_vien($detai_id);
            $this->_data['arr_GVHD'] = $arr_giangvien_huongdan;
            $this->_data['soluong_sv_dadk']=$this->m_home->count_thanh_vien($detai_id);
            echo $this->load->view('backend/quanly_detai/view_suadetai',$this->_data);
        }
        else if(isset($_POST['submit_suadt']))
        {
            $khac_cn =  $_POST['khac_cn'];
            $detai_id = $_POST['id_detai'];
            $data = array(
            'tendetai'          =>$_POST['ten_detai'],
            'muctieu'           =>$_POST['muc_tieu'],
            'soluongSVtoida'    =>$_POST['so_luong_sv'],
            'yeucau'            =>$_POST['yeu_cau'],
            'chuthich'          =>$_POST['chuthich'],
            'chuyennganh'       =>$_POST['chuyen_nganh'],
            'sanpham'           =>$_POST['san_pham'],
            'trangthai'         =>$_POST['trang_thai'],
            'duocdkkhaccn'      =>$khac_cn
            );
            $this->m_dangdetai_gv->sua_detai($detai_id,$data);
            if (!empty($_POST['mssv_nt']))
            {
                $cauhinh_id = $_POST['cauhinh_id'];
                $mssv_nhomtruong = $_POST['mssv_nt'];
                $id_nhomtruong = $this->m_user->get_info_user($mssv_nhomtruong)->id;
                if ($this->m_dangkydetai->da_dang_ky_de_tai($id_nhomtruong,$cauhinh_id))
                {
                    echo 'Trưởng nhóm này đã đăng ký đề tài trước đó';
                }
                else if (!$this->m_dangkydetai->kt_cauhinh_sinhvien($cauhinh_id,$id_nhomtruong))
                {
                    echo 'Trưởng nhóm này không có trong danh sách đăng ký đề tài';
                }
                else
                {
                    $this->m_dangkydetai->dk_nhom_truong($id_nhomtruong,$detai_id,$cauhinh_id);
                    echo 'ok';
                }
                if (!empty($_POST['mssv_tv']))
                {
                    
                    $mssv_thanhvien = $_POST['mssv_tv'];
                    $id_thanhvien = $this->m_user->get_info_user($mssv_thanhvien)->id;
                    if ($this->m_dangkydetai->da_dang_ky_de_tai($id_thanhvien,$cauhinh_id))
                    {
                        echo 'Thành viên viên đã đăng ký đề tài trước đó';
                    }
                    else if (!$this->m_dangkydetai->kt_cauhinh_sinhvien($cauhinh_id,$id_thanhvien))
                    {
                        echo 'Thành viên này không có trong danh sách đăng ký đề tài';
                    }
                    else
                    {
                         $this->m_dangkydetai->them_sinhvien_detai($id_thanhvien,$detai_id,$cauhinh_id);
                         echo 'ok';
                    }
                }
            }
            else
            {
                echo 'ok';
            }
            //print_r($data);
        }
        else if(isset($_POST['btn_xoa_sv_dt']))
        {
            $detai_id = $_POST['id_xoa_sv_detai'];
            $this->m_dangdetai_gv->xoa_2sinhvien_detai($detai_id);
            echo 'ok';
        }
    }
    /*===================== Quản trị log ============================*/
}
?>