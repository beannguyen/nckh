<?php
Class C_dangkydetai extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('m_dangkydetai');
        $this->load->model('m_home');
        $this->load->helper("text");
    }
    public function index()
    {
		//echo "test";
		//exit(0);
        $id_user=$this->session->userdata('id_user');
        $cauhinh_id = $this->get_cauhinh_sv();
        if (empty($cauhinh_id))
        {
            $this->my_lib->display_thongbao('warning','Chưa đến thời hạn đăng ký đề tài');
        }
        else
        {
            if ($this->m_dangkydetai->da_dang_ky_de_tai($id_user,$cauhinh_id))
            {
                $this->my_lib->display_thongbao('warning',"Bạn đã đăng ký đề tài. Vào <a class='label label-warning' href='".base_url('user/quan-ly-nhom.html')."'>ĐÂY</a> để quản lý nhóm !");
            }
            else
            {
                $this->hien_thi_danh_sach_de_tai_dang_ky($cauhinh_id);   
            }
        }
    }
	public function dang_ky_chuyen_nganh()
	{
		echo "test";
		exit(0);
	}
    public function hien_thi_danh_sach_de_tai_dang_ky($cauhinh_id)
    {
        //get cau hinh hien tai
        $id_chuyennganh=$this->session->userdata('id_chuyennganh');
        $cauhinh_id = $cauhinh_id;
        $ds_giangvien = $this->m_home->get_giangvien_chuyennganh_co_detai($id_chuyennganh,$cauhinh_id);
        $this->_data['ds_giangvien'] = $ds_giangvien;
        $param=5;
        $per_pg=12;
        $total=$this->m_home->count_danh_sach_de_tai_loai_de_tai_theo_chuyen_nganh($cauhinh_id,$id_chuyennganh);
        $page=$this->uri->segment($param);
        if ($page==true) $page=(int)$page; else $page=1;
        $offset=($page-1)*$per_pg;
        //Load cấu hình phân trang        
        $this->my_lib->pre_config_pagination($param,$per_pg,$total);
        $config['base_url']=base_url('user/dang-ky-de-tai/'.$cauhinh_id.'/page');
        $this->pagination->initialize($config);
        $query_heading=$this->m_home->get_ten_loai_de_tai($cauhinh_id);
        //đếm số thành viên
        $array_sothanhvien=array();
        $query_temp = $this->m_home->get_danh_sach_de_tai_loai_de_tai_chuyen_nganh($cauhinh_id,$id_chuyennganh,$per_pg,$offset);
        $i=0;
        foreach ($query_temp as $rows)
        {
            $array_sothanhvien[$rows->id] = $this->m_home->count_so_luong_sinhvien_detai($rows->id);
        }
        $this->_data['pagination']=$this->pagination->create_links();
        $this->_data['query_ds_de_tai']=$this->m_home->get_danh_sach_de_tai_loai_de_tai_chuyen_nganh($cauhinh_id,$id_chuyennganh,$per_pg,$offset);
        $this->_data['cauhinh_id']=$cauhinh_id;
        $this->_data['chuyennganh_id'] = $id_chuyennganh;
        $this->_data['array_sothanhvien']=$array_sothanhvien;     
        $this->_data['total_record'] = $total;   
        $this->_data['path']=array('dangky_detai/danh_sach_de_tai_dang_ky');
        $this->_data['heading'] = "Danh sách đề tài";
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Đăng ký đề tài"  => ''
        );
        $this->_data['cur_page'] = 'dangky_dt';
        $this->load->view('layout/layout',$this->_data);
    }
    public function giangvien_detai()
    {
        $giangvien_id = $_POST['gv_id'];
        $cauhinh_id = $_POST['cauhinh_id'];
        $chuyennganh_id = $_POST['cn_id'];
        $query_tmp = $this->m_home->get_detai_giangvien_chuyennganh($giangvien_id,$cauhinh_id,$chuyennganh_id);
        $query_ds_de_tai = $query_tmp['result'];
        $count = $query_tmp['row_count'];
        $array_sothanhvien=array();
        foreach ($query_ds_de_tai as $rows)
        {
            $array_sothanhvien[$rows->id] = $this->m_home->count_so_luong_sinhvien_detai($rows->id);
        }
        $this->_data['query_ds_de_tai'] = $query_ds_de_tai;
        $this->_data['count'] = $count;
        $this->_data['array_sothanhvien'] = $array_sothanhvien;
        echo $this->load->view('dangky_detai/detai_giangvien_ajax_page',$this->_data);
    }
    public function dang_ky_nhom_truong()
    {
        if (isset($_POST['detai_id']))
        {
            $cauhinh_id = $this->get_cauhinh_sv();
            //$id_detai = $this->uri->segment(3);
            $id_detai = $_POST['detai_id'];
            $id_user = $this->session->userdata('id_user');
            $this->dk_nhom_truong($cauhinh_id,$id_detai,$id_user);
        }
        else
        {
            redirect('404-page');
        }
    }
    public function quan_ly_nhom()
    {
        $cauhinh_id = $this->get_cauhinh_sv();
        $id_user = $this->session->userdata('id_user');
        if (!$this->m_dangkydetai->da_dang_ky_de_tai($id_user,$cauhinh_id))
        {
            $this->my_lib->display_thongbao('warning',"Bạn chưa đăng ký đề tài nào. Vào <a class='label label-warning' href='".base_url('user/dang-ky-de-tai.html')."'><u>ĐÂY</u></a> để đăng ký đề tài !");
        }
        else
        {
            //$this->load->model('m_user');
            //update 8/1/2014
            
            $detai_id = $this->m_dangkydetai->get_id_detai($id_user)->detai_id;
            
            //end update
            $this->_data['id_detai']= $detai_id;
            $this->_data['ten_detai']=$this->m_dangkydetai->get_info_detai($detai_id)->tendetai;
            if ($this->m_dangkydetai->is_truong_nhom($id_user,$cauhinh_id)===true)
            {
                $this->_data['so_thu'] = $this->m_dangkydetai->count_thu_vao_nhom($cauhinh_id,$detai_id,$id_user);
                $array_thu=$this->m_dangkydetai->get_thu_vao_nhom($cauhinh_id,$detai_id,$id_user);
                $i=0;
                $my_array = '';
                foreach ($array_thu as $rows)
                {
                    $my_array['info'][$i] = $this->m_user->get_info_user($rows->id_nguoigui);
                    $my_array['time'][$i] = $rows->time;
                    $i++;
                }
                $this->_data['array_thu'] =  @$my_array;
                $this->_data['so_phantu'] = count($array_thu);
                $this->_data['heading'] = "Quản lý nhóm";
                $this->_data['path']=array('dangky_detai/quan_ly_nhom_truong');
                $this->_data['arr_luuvet'] = array(
                "Home"     => base_url(),
                "Quản lý nhóm trưởng"  => ''
                );
                $this->_data['cur_page'] = 'quanly_nhom';
                $this->load->view('layout/layout',$this->_data);
            }
            else
            {
                $this->_data['heading'] = "Thông tin nhóm";
                $this->_data['cur_page'] = 'quanly_nhom';
                $this->_data['path']=array('dangky_detai/quan_ly_thanh_vien');
                $this->_data['arr_luuvet'] = array(
                "Home"     => base_url(),
                "Quản lý nhóm thành viên"  => ''
                );
                
                $this->load->view('layout/layout',$this->_data);
            }
        }   
    }
    public function xu_ly_them_thanh_vien()
    {                
        $this->load->model('m_user');
        if (isset($_POST['mssv_thanhvien']))
        {
            $mssv_thanhvien = $_POST['mssv_thanhvien'];
        }
        else
        {
            $mssv_thanhvien = $this->uri->segment(3);
        }
        $id_thanhvien = $this->m_user->get_info_user($mssv_thanhvien);
        {
            if (!empty($id_thanhvien))
            {
                $id_thanhvien=$id_thanhvien->id;
                $id_detai=$this->m_dangkydetai->get_id_detai($this->session->userdata('id_user'))->detai_id;
                $arr_detail = $this->m_home->get_chi_tiet_de_tai($id_detai);
                $soluong_thanhvien_dadangky=$this->m_home->count_thanh_vien($id_detai);
                if ($arr_detail->soluongSVtoida == $soluong_thanhvien_dadangky)
                {
                    $this->my_lib->display_thongbao('warning','Nhóm đã đủ thành viên, không thể thêm mới');
                    $this->output->set_header('refresh:2;url='.site_url('user/quan-ly-nhom')); 
                }
                else
                {
                    $cauhinh_id = $this->get_cauhinh_sv();
                    $path_err = $path_success = site_url('user/quan-ly-nhom');
                    $this->dk_thanhvien($id_thanhvien,$cauhinh_id,$id_detai,$path_success,$path_err);
                }
            }
            else
            {
                $this->my_lib->display_thongbao('warning','Sinh viên không tồn tại trong hệ thống');
            }
        }
    }
    public function xoa_sv_xin_vaonhom()
    {
        $mssv_nguoigui = $this->uri->segment(3);
        $this->load->model('m_user');
        $id_nguoigui = $this->m_user->get_info_user($mssv_nguoigui);
        if (!empty($id_nguoigui))
        {
            $id_nguoigui = $id_nguoigui->id;
            $cauhinh_id = $this->get_cauhinh_sv();
            $detai_id = $this->m_dangkydetai->get_id_detai($this->session->userdata('id_user'))->detai_id;
            $data = array(
            'id_nguoigui'   =>$id_nguoigui,
            'detai_id'      =>$detai_id,
            'cauhinh_id'    =>$cauhinh_id
            );
            $this->m_dangkydetai->xoa_thu_vao_nhom($data);
            $this->my_lib->display_thongbao('success','Xóa thành công');
            $this->output->set_header('refresh:1;url='.base_url('user/quan-ly-nhom.html'));  
        }
        else
        {
            $this->my_lib->display_thongbao('danger','Xóa thất bại');
            $this->output->set_header('refresh:1;url='.base_url('user/quan-ly-nhom.html'));  
        }
    }
    public function kt_tontai_sinhvien($id_user)
    {
        if ($this->m_dangkydetai->kt_tontai_sinhvien($id_user)==0)
        {
            $this->form_validation->set_message('kt_tontai_sinhvien', 'Sinh viên không tồn tại trong hệ thống');
            return false;
        }
        else
        {
            return true;
        }
    }
    //Nhóm trưởng rời nhóm
    public function huy_nhom()
    {
        $id_nhomtruong = $this->session->userdata('id_user');
        $id_detai=$this->m_dangkydetai->get_id_detai($id_nhomtruong);
        if (!empty($id_detai))
        {
            $cauhinh_id = $this->get_cauhinh_sv();
            $id_detai=$this->m_dangkydetai->get_id_detai($id_nhomtruong)->detai_id;
            $query_thanhvien = $this->m_home->get_ten_thanh_vien($id_detai,$id_nhomtruong);
            if (!empty($query_thanhvien))
            {
                $id_thanhvien = $query_thanhvien[0]->id;
            }
            else
            {
                $id_thanhvien = NULL;
            }
            $this->m_dangkydetai->huy_nhom_truong($id_detai,$id_nhomtruong,$id_thanhvien,$cauhinh_id);
            $this->my_lib->display_thongbao('success','Hủy nhóm thành công');
            $this->output->set_header('refresh:1;url='.base_url('user/dang-ky-de-tai.html'));
        }
        else
        {
            $this->my_lib->display_thongbao('warning','Bạn chưa đăng ký đề tài');
            $this->output->set_header('refresh:1;url='.base_url('user/dang-ky-de-tai.html'));
        }
        
    }
    //Thành viên rời nhóm
    public function roi_nhom()
    {
        $id_detai=$this->m_dangkydetai->get_id_detai($this->session->userdata('id_user'));
        if (!empty($id_detai))
        {
            $cauhinh_id = $this->get_cauhinh_sv();
            $id_detai=$this->m_dangkydetai->get_id_detai($this->session->userdata('id_user'))->detai_id;
            $this->m_dangkydetai->huy_detai_sinhvien($id_detai,$this->session->userdata('id_user'),$cauhinh_id);
            $this->my_lib->display_thongbao('success','Rời nhóm thành công');
            $this->output->set_header('refresh:1;url='.base_url('user/dang-ky-de-tai.html'));
        }
        else
        {
            $this->my_lib->display_thongbao('warning','Bạn chưa đăng ký đề tài');
            $this->output->set_header('refresh:1;url='.base_url('user/dang-ky-de-tai.html'));
        }
    }
    //xin vào nhóm
    public function xin_vao_nhom()
    {
        /*
        $cauhinh_id = $this->get_cauhinh_sv();
        $id_detai= $this->uri->segment(3);
        if (!$this->m_dangkydetai->kt_detai_cauhinh_hople($id_detai,$cauhinh_id))
        {
            //de tai khong hop le
            $this->my_lib->display_thongbao('warning','Đề tài không có trong danh sách đăng ký');
            $this->output->set_header('refresh:2; url='.site_url('user/dang-ky-de-tai'));
        }
        else
        {
            $id_nguoigui = $this->session->userdata('id_user');
            $detai_id = $id_detai;
            if ($this->m_dangkydetai->them_thu_vao_nhom($id_nguoigui,$detai_id,$cauhinh_id) === false)
            {
                $this->my_lib->display_thongbao('warning','Gửi thất bại, yêu cầu của bạn đã được gửi tới trước đó');
                $this->output->set_header('refresh:2;url='.site_url('user/dang-ky-de-tai'));
            }
            else
            {
                $this->my_lib->display_thongbao('success','Gửi thành công. Đợi trưởng nhóm đề tài thêm vào nhóm nhé bạn');
                $this->output->set_header('refresh:2;url='.site_url('user/dang-ky-de-tai'));  
            }
        }
        */
        if(isset($_POST['xvn']))
        {
            $cauhinh_id = $this->get_cauhinh_sv();
            $id_detai = $_POST['id_detai'];
            if (!$this->m_dangkydetai->kt_detai_cauhinh_hople($id_detai,$cauhinh_id))
            {
                //de tai khong hop le
                echo 'Đề tài không có trong danh sách đăng ký';
            }
            else
            {
                $id_nguoigui = $this->session->userdata('id_user');
                $detai_id = $id_detai;
                if ($this->m_dangkydetai->them_thu_vao_nhom($id_nguoigui,$detai_id,$cauhinh_id) === false)
                {
                    echo 'Gửi thất bại, yêu cầu của bạn đã được gửi tới trước đó';
                }
                else
                {
                    echo 'Gửi thành công. Đợi trưởng nhóm đề tài thêm vào nhóm nhé bạn';
                }
            }
        }
    }
    //gửi mail liên lạc nhóm trưởng
    public function gui_email_nhomtruong()
    {
        if (isset($_POST['nguoigui_email']))
        {
            $id_nguoigui = $_POST['nguoigui_email'];
            $detai_id = $_POST['detai_id'];
            $id_nguoinhan = $this->m_dangkydetai->get_id_truong_nhom($detai_id)->truongnhom;
            $info_nguoigui = $this->m_user->get_info_user($id_nguoigui);
            $info_nguoinhan = $this->m_user->get_info_user($id_nguoinhan);
            $email_nguoigui = $info_nguoigui->email;
            $email_nguoinhan = $info_nguoinhan->email;
            $ten_detai = $this->m_dangkydetai->get_info_detai($detai_id)->tendetai;
            $mess = 'Chào bạn, tôi là '.$info_nguoigui->name.' - MSSV : '.$info_nguoigui->username.' .Tôi muốn làm chung đề tài : '.$ten_detai.' này cùng bạn. Hãy thêm tôi vào nhóm nhé.';
            $subj = 'THÔNG BÁO - Yêu cầu xin vào nhóm - Đăng ký đề tài Khoa Công Nghệ Thông Tin';
            //echo $mess;
            if (!$this->my_lib->send_email($email_nguoigui,$email_nguoinhan,$mess,$subj))
            {
                echo 'Gửi email liên lạc không thành công';
            }
            else
            {
                echo 'Gửi Email thành công đến '.$email_nguoinhan;
            }
        }
    }
    //xem lich su
    public function xem_lichsu_nguoidung()
    {
        $user_id = $this->session->userdata('id_user');
        $this->_data['lichsu_list'] = $this->m_dangkydetai->get_lichsu($user_id);
        $this->_data['heading']="Lịch sử đăng ký";
        $this->_data['path']=array('dangky_detai/xem_lich_su_dang_ky');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Lịch sử người dùng"  => ''
        );
        $this->_data['cur_page'] = 'lich_su';
        $this->load->view('layout/layout',$this->_data);
    }
}
?>