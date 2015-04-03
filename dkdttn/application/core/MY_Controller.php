<?php
class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    public function get_cauhinh_sv()
    {
        $curr_date = date("Y-m-d H:i:s");
        $cauhinh_id=$this->m_dangkydetai->get_cauhinh_for_sinhvien($curr_date);
        if (!empty($cauhinh_id))
        {
            $cauhinh_id=$cauhinh_id->id;
        }
        else
        {
            $cauhinh_id=NULL;
        }
        return $cauhinh_id;
    }
    public function get_cauhinh_gv()
    {
        $curr_date = date("Y-m-d H:i:s");
        $cauhinh_id=$this->m_dangdetai_gv->get_cauhinh_for_giangvien($curr_date);
        if (!empty($cauhinh_id))
        {
            $cauhinh_id=$cauhinh_id->id;
        }
        else
        {
            $cauhinh_id=NULL;
        }
        return $cauhinh_id;
    }
    /*
    public function dk_nhom_truong($cauhinh_id,$id_detai,$id_user,$path_success,$path_err)
    {
         //kiem tra nguoi dung da dang ky de tai chua
        if ($this->m_dangkydetai->da_dang_ky_de_tai($id_user,$cauhinh_id))
        {
            $this->my_lib->display_thongbao('warning','Sinh viên đã đăng ký đề tài trước đó');
            $this->output->set_header('refresh:2; url='.$path_err);
        }
        else
        {
            // kiem tra de tai hop le
            if (!$this->m_dangkydetai->kt_detai_cauhinh_hople($id_detai,$cauhinh_id))
            {
                //de tai khong hop le
                $this->my_lib->display_thongbao('warning','Đề tài không có trong danh sách đăng ký');
                $this->output->set_header('refresh:2; url='.$path_err);
            }
            else
            {
                //de tai hop le, kiem tra de tai co ai dang ky truoc do chua
                if ($this->m_dangkydetai->kt_detai_dangky_roi($id_detai))
                {
                    $this->my_lib->display_thongbao('warning','Đề tài đã có người đăng ký trước đó ');
                    $this->output->set_header('refresh:2; url='.$path_err);
                }
                else
                {
                    //kiem tra de tai cho phep dang ky khac chuyen nganh khong
                    if (!$this->m_dangkydetai->kt_duocdkkhaccn($id_detai))
                    {
                        //Su pham
                        if ($this->m_user->get_info_user($id_user)->chuyennganh == '5')
                        {
                            $this->m_dangkydetai->dk_nhom_truong($id_user,$id_detai,$cauhinh_id);
                            $this->my_lib->display_thongbao('success','Đăng ký nhóm thành công');
                            $this->output->set_header('refresh:2;url='.$path_success);  
                        }
                        else
                        {
                            //ko phai sinh vien su pham
                            $detai_chuyennganh = $this->m_dangkydetai->get_info_detai($id_detai)->chuyennganh;
                            $sinhvien_chuyennganh = $this->m_user->get_info_user($id_user)->chuyennganh;
                            if ($detai_chuyennganh == $sinhvien_chuyennganh)
                            {
                                $this->m_dangkydetai->dk_nhom_truong($id_user,$id_detai,$cauhinh_id);
                                $this->my_lib->display_thongbao('success','Đăng ký nhóm thành công');
                                $this->output->set_header('refresh:2;url='.$path_success);  
                            }
                            else
                            {
                                $this->my_lib->display_thongbao('warning','Đề tài không cho phép sinh viên đăng ký khác chuyên ngành');
                                $this->output->set_header('refresh:2; url='.$path_err);
                            }
                        }
                    }
                    else
                    {
                        $this->m_dangkydetai->dk_nhom_truong($id_user,$id_detai,$cauhinh_id);
                        $this->my_lib->display_thongbao('success','Đăng ký nhóm thành công');
                        $this->output->set_header('refresh:2;url='.$path_success);  
                    }
                }# End kt_detai_dangky_roi 
            } # End kt_detai_cauhinh 
        } # End da_dang_ky_de_tai 
    */
    public function dk_nhom_truong($cauhinh_id,$id_detai,$id_user)
    {
         //kiem tra nguoi dung da dang ky de tai chua
        if ($this->m_dangkydetai->da_dang_ky_de_tai($id_user,$cauhinh_id))
        {
            # $this->my_lib->display_thongbao('warning','Sinh viên đã đăng ký đề tài trước đó');
            # $this->output->set_header('refresh:2; url='.$path_err);
            echo 'Sinh viên đã đăng ký đề tài trước đó';
        }
        else
        {
            // kiem tra de tai hop le
            if (!$this->m_dangkydetai->kt_detai_cauhinh_hople($id_detai,$cauhinh_id))
            {
                //de tai khong hop le
                # $this->my_lib->display_thongbao('warning','Đề tài không có trong danh sách đăng ký');
                # $this->output->set_header('refresh:2; url='.$path_err);
                echo 'Đề tài không có trong danh sách đăng ký';
            }
            else
            {
                //de tai hop le, kiem tra de tai co ai dang ky truoc do chua
                if ($this->m_dangkydetai->kt_detai_dangky_roi($id_detai))
                {
                    # $this->my_lib->display_thongbao('warning','Đề tài đã có người đăng ký trước đó ');
                    # $this->output->set_header('refresh:2; url='.$path_err);
                    echo 'Đề tài đã có người đăng ký trước đó';
                }
                else
                {
                    //kiem tra de tai cho phep dang ky khac chuyen nganh khong
                    if (!$this->m_dangkydetai->kt_duocdkkhaccn($id_detai))
                    {
                        //Su pham
                        if ($this->m_user->get_info_user($id_user)->chuyennganh == '5')
                        {
                            $this->m_dangkydetai->dk_nhom_truong($id_user,$id_detai,$cauhinh_id);
                            //$this->my_lib->display_thongbao('success','Đăng ký nhóm thành công');
                            //$this->output->set_header('refresh:2;url='.$path_success);  
                            echo 'success';
                        }
                        else
                        {
                            //ko phai sinh vien su pham
                            $detai_chuyennganh = $this->m_dangkydetai->get_info_detai($id_detai)->chuyennganh;
                            $sinhvien_chuyennganh = $this->m_user->get_info_user($id_user)->chuyennganh;
                            if ($detai_chuyennganh == $sinhvien_chuyennganh)
                            {
                                $this->m_dangkydetai->dk_nhom_truong($id_user,$id_detai,$cauhinh_id);
                                //$this->my_lib->display_thongbao('success','Đăng ký nhóm thành công');
                                //$this->output->set_header('refresh:2;url='.$path_success);  
                                echo 'success';
                            }
                            else
                            {
                                //$this->my_lib->display_thongbao('warning','Đề tài không cho phép sinh viên đăng ký khác chuyên ngành');
                                //$this->output->set_header('refresh:2; url='.$path_err);
                                echo 'Đề tài không cho phép sinh viên đăng ký khác chuyên ngành';
                            }
                        }
                    }
                    else
                    {
                        $this->m_dangkydetai->dk_nhom_truong($id_user,$id_detai,$cauhinh_id);
                        //$this->my_lib->display_thongbao('success','Đăng ký nhóm thành công');
                        //$this->output->set_header('refresh:2;url='.$path_success);  
                        echo 'success';
                    }
                }/* End kt_detai_dangky_roi */
            } /* End kt_detai_cauhinh */
        }/* End da_dang_ky_de_tai */
    }
    public function dk_thanhvien($id_thanhvien,$cauhinh_id,$id_detai,$path_success,$path_err)
    {
        $this->load->model('m_user');
        if (!$this->m_dangkydetai->kt_cauhinh_sinhvien($cauhinh_id,$id_thanhvien))
        {
            $this->my_lib->display_thongbao('warning','Sinh viên này không có trong danh sách đăng ký đề tài');
            $this->output->set_header('refresh:2;url='.$path_err);  
        }
        else
        {
            if ($this->m_dangkydetai->da_dang_ky_de_tai($id_thanhvien,$cauhinh_id))
            {   
                $this->my_lib->display_thongbao('warning','Sinh viên này đã có nhóm');
                $this->output->set_header('refresh:2;url='.$path_err);  
            }
            else
            {
                //Kiem tra duoc dk khac chuyen nganh truoc khi them
                if (!$this->m_dangkydetai->kt_duocdkkhaccn($id_detai))
                {
                    //Su pham
                    if ($this->m_user->get_info_user($id_thanhvien)->chuyennganh == '5')
                    {
                        $this->m_dangkydetai->them_sinhvien_detai($id_thanhvien,$id_detai,$cauhinh_id);
                        $this->my_lib->display_thongbao('success','Thêm thành công');
                        $this->output->set_header('refresh:2;url='.$path_success);  
                    }
                    else
                    {
                        //ko phai sinh vien su pham
                        $detai_chuyennganh = $this->m_dangkydetai->get_info_detai($id_detai)->chuyennganh;
                        $sinhvien_chuyennganh = $this->m_user->get_info_user($id_thanhvien)->chuyennganh;
                        if ($detai_chuyennganh == $sinhvien_chuyennganh)
                        {
                            $this->m_dangkydetai->them_sinhvien_detai($id_thanhvien,$id_detai,$cauhinh_id);
                            $this->my_lib->display_thongbao('success','Thêm thành công');
                            $this->output->set_header('refresh:2;url='.$path_success);  
                        }
                        else
                        {
                            $this->my_lib->display_thongbao('warning','Đề tài không cho phép thêm sinh viên khác chuyên ngành');
                            $this->output->set_header('refresh:2;url='.$path_err); 
                        }
                    }
                }
                else
                {
                    $this->m_dangkydetai->them_sinhvien_detai($id_thanhvien,$id_detai,$cauhinh_id);
                    $this->my_lib->display_thongbao('success','Thêm thành công');
                    $this->output->set_header('refresh:2;url='.$path_success);    
                }     
            }
        }
    }
}
?>