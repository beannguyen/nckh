<?php
class C_dangdetai_gv extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('m_dangdetai_gv');
        $this->load->model('m_home');
        $this->load->helper("text");
    }
    public function danh_sach_loai_de_tai()
    {
        $this->_data['heading']="Danh sách loại đề tài";
        $this->_data['query_ds_loai_de_tai']= $this->m_home->get_danh_sach_loai_de_tai();
        //$this->_data['query_count_ds_loai_de_tai']= $this->m_home->count_all_ds_loai_de_tai();
        $this->_data['path']=array('dang_detai/quan_tri_loai_de_tai.php');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Danh sách loại đề tài"  => ''
        );
        $this->_data['cur_page'] = 'quantri_dt_gv';
        $this->load->view('layout/layout',$this->_data);
    }
    public function danh_sach_de_tai()
    {
        $cauhinh_id = $this->uri->segment(3);
        $ten_cauhinh = $this->m_home->get_ten_loai_de_tai($cauhinh_id);
        $cauhinh_giangvien = $this->get_cauhinh_gv();
        if (!empty($cauhinh_giangvien))
        {
            if ($cauhinh_id == $cauhinh_giangvien)
            {
                $this->_data['control'] = true; 
            }
        }
        $giangvien_id = $this->session->userdata('id_user');
        $detai_giangvien = $this->m_dangdetai_gv->get_detai_giangvien($giangvien_id,$cauhinh_id);
        $arr_thanhvien_detai = ('');
        foreach ($detai_giangvien as $rows)
        {
            $arr_thanhvien_detai[$rows->id] = $this->m_home->count_thanh_vien($rows->id);
        }
        $this->_data['arr_thanhvien_detai']=$arr_thanhvien_detai;
        $this->_data['heading']=$ten_cauhinh->tenloai.' 20'.$ten_cauhinh->TenNK;
        $this->_data['query_ds_de_tai'] = $detai_giangvien;
        $this->_data['path']=array('dang_detai/danh_sach_de_tai_giang_vien.php');
        $this->_data['arr_luuvet'] = array(
        "Home"              => base_url(),
        "Loại đề tài"       => site_url('user/chon-loai-de-tai'),
        $ten_cauhinh->tenloai.' 20'.$ten_cauhinh->TenNK => ''
        );
        $this->_data['cur_page'] = 'quantri_dt_gv';
        $this->load->view('layout/layout',$this->_data);
    }
    public function them_detai()
    {
        $this->_data['heading']="Thêm đề tài";
        $cauhinh_giangvien = $this->get_cauhinh_gv();
        $ten_cauhinh_luuvet = $this->m_home->get_ten_loai_de_tai($cauhinh_giangvien);
        $info_cauhinh = $this->m_dangdetai_gv->get_thongtin_cauhinh($cauhinh_giangvien);
        $this->_data['info_cauhinh'] = $info_cauhinh;
        $this->_data['path']=array('dang_detai/them_detai');
        $this->_data['arr_luuvet'] = array(
        "Home"              => base_url(),
        "Loại đề tài"       => site_url('user/chon-loai-de-tai'),
        $ten_cauhinh_luuvet->tenloai.' 20'.$ten_cauhinh_luuvet->TenNK => site_url('user/danh-sach-de-tai-gv/'.$cauhinh_giangvien),
        "Thêm đề tài mới"   => ''
        );
        $this->_data['cur_page'] = 'dang_dt';
        $this->load->view('layout/layout',$this->_data);
    }
    public function xu_ly_them_detai()
    {
        if (!isset($_POST['loai_detai']))
        {
            $this->my_lib->display_thongbao('warning','Thêm đề tài thất bại');
        }
        else
        {
            if (isset($_POST['khac_cn'])) $khac_cn = 1; 
            else $khac_cn = 0;
            $cauhinh_id = $this->get_cauhinh_gv();
            $user_id = $this->session->userdata('id_user');
            $detai_id = date('Ymd').time();
            $data = array(
            'tendetai'          =>$_POST['ten_detai'],
            'muctieu'           =>$_POST['muc_tieu'],
            'soluongSVtoida'    =>$_POST['so_luong_sv'],
            'soluongSVtoithieu' =>'1',
            'yeucau'            =>$_POST['yeu_cau'],
            'chuthich'          =>$_POST['chu_thich'],
            'chuyennganh'       =>$_POST['chuyen_nganh'],
            'trangthai'         =>$_POST['trang_thai'],
            'loaidetai'         =>$_POST['loai_detai'],
            'id'                =>$detai_id,
            'sanpham'           =>$_POST['san_pham'],
            'cauhinh_id'        =>$cauhinh_id,
            'duocdkkhaccn'      =>$khac_cn
            );
            $this->m_dangdetai_gv->them_detai_moi($data,$user_id,$detai_id);
            $this->session->set_userdata('mess','Thêm thành công');
            $this->them_detai($cauhinh_id);
        }
    }
    public function xoa_detai()
    {
        $detai_id = $this->uri->segment(3);
        $cauhinh_id = $this->uri->segment(4);
        $user_id = $this->session->userdata('id_user');
        if ($this->m_dangdetai_gv->kt_xoa_detai_giangvien($user_id,$detai_id) == 1)
        {
            $this->m_dangdetai_gv->xoa_detai_giangvien($user_id,$detai_id);
            redirect(site_url('user/danh-sach-de-tai-gv/'.$cauhinh_id));
        }
        else
        {
            $this->my_lib->display_thongbao('danger','Bạn không được xoá đề tài này !');
        }
    }
    public function sua_detai()
    {
        $detai_id = $this->uri->segment(3);
        $cauhinh_giangvien = $this->get_cauhinh_gv();
        $ten_cauhinh_luuvet = $this->m_home->get_ten_loai_de_tai($cauhinh_giangvien);
        $info_cauhinh = $this->m_dangdetai_gv->get_thongtin_cauhinh($cauhinh_giangvien);
        $this->_data['info_cauhinh'] = $info_cauhinh;
        $info_detai = $this->m_home->get_chi_tiet_de_tai($detai_id);
        $this->_data['info_detai'] = $info_detai;
        $this->_data['heading']="Sửa đề tài";
        $this->_data['path']=array('dang_detai/sua_detai');
        $this->_data['arr_luuvet'] = array(
        "Home"              => base_url(),
        "Loại đề tài"       => site_url('user/chon-loai-de-tai'),
        $ten_cauhinh_luuvet->tenloai.' 20'.$ten_cauhinh_luuvet->TenNK => site_url('user/danh-sach-de-tai-gv/'.$cauhinh_giangvien),
        "Sửa đề tài"   => ''
        );
        $this->_data['cur_page'] = 'dang_dt';
        $this->load->view('layout/layout',$this->_data);
    }
    public function xu_ly_sua_detai()
    {
        if (isset($_POST['khac_cn'])) $khac_cn = 1; 
        else $khac_cn = 0;
        $detai_id = $_POST['detai_id'];
        $data = array(
        'tendetai'          =>$_POST['ten_detai'],
        'muctieu'           =>$_POST['muc_tieu'],
        'soluongSVtoida'    =>$_POST['so_luong_sv'],
        'yeucau'            =>$_POST['yeu_cau'],
        'chuthich'          =>$_POST['chu_thich'],
        'chuyennganh'       =>$_POST['chuyen_nganh'],
        'sanpham'           =>$_POST['san_pham'],
        'trangthai'         =>$_POST['trang_thai'],
        'duocdkkhaccn'      =>$khac_cn
        );
        $this->m_dangdetai_gv->sua_detai($detai_id,$data);
        $this->session->set_userdata('mess','Cập nhật thành công');
        //$this->sua_detai();
        redirect(site_url('user/sua-de-tai/'.$detai_id));
    }
    public function xu_ly_them_nhom_truong()
    {
        $this->load->model('m_user');
        if (isset($_POST['mssv_nhomtruong']))
        {
            $mssv_nhomtruong = $_POST['mssv_nhomtruong'];
            $id_nhomtruong = $this->m_user->get_info_user($mssv_nhomtruong);
            if (!empty($id_nhomtruong))
            {
                $id_nhomtruong = $id_nhomtruong->id;
                $id_detai = $_POST['detai_id'];
                if (isset($_POST['cauhinh_id'])){
                    $cauhinh_id = $_POST['cauhinh_id'];
                }else {
                    $cauhinh_id = $this->get_cauhinh_gv();
                }
                
                if (!$this->m_dangkydetai->kt_cauhinh_sinhvien($cauhinh_id,$id_nhomtruong))
                {
                    echo 'Sinh viên này không có trong danh sách đăng ký đề tài';
                    //$this->my_lib->display_thongbao('warning','Sinh viên này không có trong danh sách đăng ký đề tài');
                }
                else
                {
                    $path_err = $path_success = site_url('user/danh-sach-de-tai-gv/'.$cauhinh_id);
                    $this->dk_nhom_truong($cauhinh_id,$id_detai,$id_nhomtruong,$path_success,$path_err);
                }
            }
            else
            {
                //$this->my_lib->display_thongbao('warning','Sinh viên không tồn tại trong hệ thống');
                echo 'Sinh viên không tồn tại trong hệ thống';
            }
        }
        else
        {
             $this->my_lib->display_thongbao('warning','Bạn chưa nhập thông tin nhóm trưởng');
        }
    }
    public function xu_ly_them_thanh_vien()
    {
        $this->load->model('m_user');
        if (isset($_POST['mssv_thanhvien']))
        {
            $mssv_thanhvien = $_POST['mssv_thanhvien'];
            $id_thanhvien = $this->m_user->get_info_user($mssv_thanhvien);
            if (!empty($id_thanhvien))
            {
                $id_thanhvien = $id_thanhvien->id;
                $id_detai = $_POST['detai_id'];
                if (isset($_POST['cauhinh_id'])){
                    $cauhinh_id = $_POST['cauhinh_id'];
                }else {
                    $cauhinh_id = $this->get_cauhinh_gv();
                }
                if (!$this->m_dangkydetai->kt_cauhinh_sinhvien($cauhinh_id,$id_thanhvien))
                {
                    $this->my_lib->display_thongbao('warning','Sinh viên này không có trong danh sách đăng ký đề tài');
                }
                else
                {
                    //$this->dk_nhom_truong($cauhinh_id,$id_detai,$id_nhomtruong,$path_success,$path_err);
                    $this->dk_thanhvien($id_thanhvien,$cauhinh_id,$id_detai);
                }
            }
            else
            {
                //$this->my_lib->display_thongbao('warning','Sinh viên không tồn tại trong hệ thống');
                echo 'Sinh viên không tồn tại trong hệ thống';
            }
        }
        else
        {
            $this->my_lib->display_thongbao('warning','Thêm thành viên không thành công');
        }
    }
}
?>