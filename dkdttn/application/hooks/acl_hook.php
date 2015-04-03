<?php
class Acl_hook extends CI_Hooks
{
    var $ci;
    public function start()
    {
        $this->ci=&get_instance();
        $this->ci->load->library('session');
        
        # Đăng ký session id cho Guest
        $this->ci->load->library('my_lib');
        //Đếm theo cách thường
        //$online = $this->ci->my_lib->count_online();
        //Đếm theo CI
        $array_online = $this->ci->my_lib->count_online_ci();
        $this->ci->_data['online_user'] = $array_online['count'];
        $this->ci->_data['online_user_list'] = $array_online['result'];
        
        //Đếm lượt truy cập
        $hit_counter = file_get_contents('./counter_visit');
        $this->ci->_data['hit_counter'] = $hit_counter;
        
        
        # Lấy url hiện hành
        $this->ci->load->helper('url');
        $this->general_load();
        $url=uri_string();
        if (strpos($url,'c_dangkydetai') !== FALSE || strpos($url,'c_dangdetai_gv') !== FALSE)
        {
            redirect('error-page');
        }
        else
        {
            if (strpos($url,'user') !== FALSE) //có chuổi user trên thanh url
            {
                if ($this->acl()===true)
                {
                    //Kiểm tra quyền hạn rồi mới cho vào
                    if (!$this->role_res())
                        {
                            //ko dc vào trang này
                            redirect('error-page');
                        }
                    else
                        {
                            //echo "ok";
                        }
                }
                else
                {
                    //echo $this->ci->session->userdata('username');
                    if (!strpos($url,'dang-nhap')) //kiểm tra để ko bị loop
                    {
                        redirect('user/dang-nhap');
                    }
                }
                //echo "No guest";
            }
            else
            {
                //echo "Guest ok";
            }
        }
    }
    public function acl()
    {
        //Kiểm tra đăng nhập
        if ($this->ci->session->userdata('username')!=NULL)
        {
            return true;
        }
        else {return false;}
    }
    public function role_res()
    {
		
        # Lấy thông tin người dùng
        $this->ci->load->model('m_dangkydetai');
        #Quyền han nguoi dung da dang nhap
        $role_res['member'] = array('doi-mat-khau','dang-ky-chuyen-nganh','quan-tri','xu-ly-doi-mat-khau','doi-thong-tin-ca-nhan','xu-ly-doi-thong-tin-ca-nhan','dang-xuat');
        
        #Quyền hạn sinh viên không được phép đăng ký đề tài
        $role_res['sinhvien'] = $role_res['member'];
        
        $role_res['sinhvien_khong_duocphep_dangky'] = array_merge($role_res['sinhvien'],array('lich-su-nguoi-dung'));
        # Quyền hạn sinh viên được phép đăng ký đề tài
        $role_res['sinhvien_duocphep_dangky']=array_merge($role_res['sinhvien'],array('dang-ky-de-tai','dang-ky','quan-ly-nhom','lich-su-nguoi-dung'));
        
        $role_res['sinhvien_chua_dangky_detai'] = array_merge($role_res['sinhvien_duocphep_dangky'],array('xin-vao-nhom','de-tai-giang-vien','gui-email-nhom-truong')) ;
        
        $role_res['sinhvien_da_dangky_detai'] =  $role_res['sinhvien_duocphep_dangky'];
        
        $role_res['thanh_vien'] = array_merge($role_res['sinhvien_da_dangky_detai'],array('roi-nhom'));
        
        $role_res['nhom_truong'] = array_merge($role_res['sinhvien_da_dangky_detai'],array('huy-nhom','xu-ly-them-thanh-vien','xoa-sinh-vien-xin-vao-nhom'));

        #Quyền hạn cho Giang viên
        $role_res['giangvien']=array_merge($role_res['member'],array('chon-loai-de-tai','danh-sach-de-tai-gv','doi-avatar'));
        
        $role_res['giangvien_duocphep_dangky'] = array_merge($role_res['giangvien'],array(
        'them-de-tai','xu-ly-them-de-tai','xoa-de-tai','sua-de-tai',
        'xu-ly-sua-de-tai','xu-ly-them-nhom-truong-gv','gv-thanh-vien'
        ));
        
        // Quyền hạn cho admin
        
        $role_res['admin'] = array_merge($role_res['member'],array('admin','manager-config','chi-tiet-cau-hinh',
        'them-cau-hinh','sua-cau-hinh','quan-ly-sinh-vien-cau-hinh','xoa-sinh-vien-cau-hinh','them-sinh-vien-cau-hinh','them-thong-bao',
        'xoa-thong-bao','cap-nhat-tin-moi','ckfinder','sua-thong-bao','xoa-tat-ca-sinh-vien-cau-hinh','detail-user',
        'quan-ly-nien-khoa','quan-ly-thong-bao','quan-ly-nguoi-dung','quan-ly-de-tai','quan-ly-chung','quan-ly-lop',
        'quan-ly-chuyen-nganh','cau-hinh-giang-vien-ajax','quan-ly-dang-ky-de-tai','xuat-ket-qua-dang-ky-cn',
        'xu-ly-them-nhom-truong-gv','gv-thanh-vien','danh-sach-de-tai-admin','export-de-tai'
        
        
        ));
        $url=uri_string();
        $role=$this->ci->session->userdata('usertype');
        $user_id = $this->ci->session->userdata('id_user');
        # Lấy cấu hình chung cho thời gian hiện tại
        $curr_date = date("Y-m-d H:i:s");
        $cauhinh_id=$this->ci->m_dangkydetai->get_start_cauhinh($curr_date);
		//print_r($cauhinh_id);
		//exit(0);
        if ($role==='sinhvien')
        {
            if (!empty($cauhinh_id))
            {
                $info_cauhinh = $this->ci->m_dangkydetai->get_info_cauhinh($cauhinh_id->id);
                $this->ci->_data['info_cauhinh'] = $info_cauhinh;
                //Lấy thông tin sinh viên : 
                $this->ci->load->model('m_dangkydetai');
                if (!$this->ci->m_dangkydetai->kt_cauhinh_sinhvien($cauhinh_id->id,$user_id))
                {
                    //$this->ci->_data['duoc_dk_detai'] = "Bạn không có tên trong danh sách đăng ký đề tài lần này";
                    $this->ci->_data['duoc_dk_detai'] = 1;
                    $role = 'sinhvien_khong_duocphep_dangky';
                }
                else
                {
                    //Kiem tra den thoi gian dang ky de tai chua
                    $cauhinh_id_sv=$this->ci->m_dangkydetai->get_cauhinh_for_sinhvien($curr_date);
                    {
                        if (empty($cauhinh_id_sv))
                        {
                            //$this->ci->_data['duoc_dk_detai'] = "Hiện tại chưa đến thời hạn đăng ký đề tài";
                            $this->ci->_data['duoc_dk_detai'] = 2;
                            $role = 'sinhvien_khong_duocphep_dangky';
                        }
                        else
                        {
                            //$this->ci->_data['duoc_dk_detai'] = "Bạn được phép đăng ký đề tài";
                            $this->ci->_data['duoc_dk_detai'] = 3;
                            $role = 'sinhvien_duocphep_dangky';
							//echo $role;
							//exit(0);
                            //Kiem tra dang ky de tai chua
                            if (!$this->ci->m_dangkydetai->da_dang_ky_de_tai($user_id,$cauhinh_id->id))
                            {
                                $this->ci->_data['duoc_dk_detai'] = 3;
                                $role = 'sinhvien_chua_dangky_detai';
                            }
                            else
                            {
                                //Kiem tra la nhom truong hay thanh vien
                                if ($this->ci->m_dangkydetai->is_truong_nhom($user_id,$cauhinh_id->id))
                                {
                                    $this->ci->_data['duoc_dk_detai'] = 3;
                                    $role = 'nhom_truong';
                                }
                                else
                                {
                                    $this->ci->_data['duoc_dk_detai'] = 3;
                                    $role = 'thanh_vien';
                                }
                            }
                        }   
                    }
                }
            }
            else
            {
                //$this->ci->_data['duoc_dk_detai'] = "Đã hết hạn đăng ký đề tài";
                $this->ci->_data['duoc_dk_detai'] = 4;
                $role = 'sinhvien_khong_duocphep_dangky';
            }
        }
        else if($role=='giangvien')
        {
            $this->ci->load->model('m_dangdetai_gv');
            //giang vien here
            if (!empty($cauhinh_id))
            {
                $info_cauhinh = $this->ci->m_dangkydetai->get_info_cauhinh($cauhinh_id->id);
                $this->ci->_data['info_cauhinh'] = $info_cauhinh;
                //get cau hinh giang vien
                $cauhinh_id_gv = $this->ci->m_dangdetai_gv->get_cauhinh_for_giangvien($curr_date);
                if (empty($cauhinh_id_gv))
                {
                    //$this->ci->_data['duoc_dk_detai'] = "Hết hạn đăng ký đề tài";
                    $this->ci->_data['duoc_dk_detai'] = 4;
                    $role = 'giangvien';
                }
                else
                {
                    //$this->ci->_data['duoc_dk_detai'] = "Bạn được phép đăng ký đề tài";
                    $this->ci->_data['duoc_dk_detai'] = 3;
                    $role = 'giangvien_duocphep_dangky';
                }   
            }
            else
            {
                //hien tai ko nam trong cau hinh nao ca
                $this->ci->_data['duoc_dk_detai'] = 2;
                $role = 'giangvien';
            } 
        }
        else if($role=='admin')
        {
            $role = 'admin';
        }
        $res=$role_res[$role];
        $kt=0;
        for($i=0;$i<count($res);$i++)
        {
            if (strpos($url,$res[$i])!==false)
            {
                $kt=1;
                break;
            }
        }
        return $kt;
    }
    public function general_load()
    {
        $this->ci->load->database();
        $this->ci->load->model('m_home');
        $this->ci->load->model('m_user');
        if ($this->ci->session->userdata("da_dang_nhap")==true)
        {
            $info_user = $this->ci->m_user->get_info_user($this->ci->session->userdata('username'));
            $this->ci->_data['info_user'] = $info_user;
        }
        else
        {
            $info_user = NULL;
            $this->ci->_data['info_user'] = $info_user;
        }
        $lop = $this->ci->m_user->get_lop_sinhvien($this->ci->session->userdata('username'));
        $this->ci->_data['info_lop'] = $lop;
        $this->ci->_data['ds_chuyen_nganh']=$this->ci->m_user->get_chuyen_nganh();
        $this->ci->_data['query_ds_loai_de_tai'] = $this->ci->m_home->get_danh_sach_loai_de_tai();
        $this->ci->_data['random_tin'] = $this->ci->m_home->get_random_tin();
        /*
        echo "<pre>";
        print_r($this->ci->session->userdata); 
        echo "</pre>";
        */
    }
}
?>