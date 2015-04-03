<?php
class C_user extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('m_user');
        $this->load->helper("text");
        $this->load->library('form_validation');
    }
    public function dang_nhap_form()
    {
        $this->my_lib->display_thongbao('warning','Vui lòng <a class="label label-warning" href="#dang_nhap" data-toggle="modal">ĐĂNG NHẬP</a> vào hệ thống');
    }
    public function xu_ly_dang_nhap()
    {
        sleep(1);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Tên người dùng','required');
        $this->form_validation->set_rules('password','Mật khẩu','required');
        $this->form_validation->set_message('required','(*) %s chưa nhập');
        if ($this->form_validation->run()==false)
        {
            $this->dang_nhap_form();
        }
        else
        {
            $user = trim($this->input->post('username'));
            $pass_nhapvao = trim($this->input->post('password'));
            if ($this->m_user->kt_dangnhap($user,$pass_nhapvao) == 0) 
            {
                echo "false";
            } 
            else
            {
                $query_get_info_user = $this->m_user->get_info_user($user);
                $user_type = $query_get_info_user->usertype;
                $this->session->set_userdata('da_dang_nhap', true);
                $this->session->set_userdata('name', $query_get_info_user->name);
                $this->session->set_userdata('id_user', $query_get_info_user->id);
                $this->session->set_userdata('username', $query_get_info_user->username);
                $this->session->set_userdata('usertype',$user_type);
                $this->session->set_userdata('id_chuyennganh',$query_get_info_user->chuyennganh);
                switch ($user_type)
                {
                    case 'giangvien' : 
                    {
                        echo base_url('user/quan-tri.html');
                    }
                    break;
                    case 'sinhvien' :
                    {
                        echo base_url('user/quan-tri.html');
                    }
                    break;
                    case 'admin' :
                    {
                        echo site_url('');
                    }
                }
            }
        }
    }
    //Log out
    public function dang_xuat()
    {
        $cur_sess = $this->session->userdata('session_id');
        $this->load->model('m_countonline');
        $this->m_countonline->delete_cur_sess($cur_sess);
        $counter = file_get_contents('./counter_visit') - 1;
        file_put_contents('./counter_visit', $counter);
        $this->session->sess_destroy();
        $this->output->set_header('refresh:0; url='.base_url()); 
    }
	public function quan_tri2()
	{
		echo "test 2";
		exit(0);
    
	}
	
    /*---------------------------Quản trị tài khoản -------------------------------------*/
    public function quan_tri()
    {
		//echo "test";
		//exit(0);
        $this->_data['heading']="Quản trị tài khoản";
        $this->_data['path']=array('quantri_nguoidung/trang_quan_tri');
        $this->_data['avatar'] = $this->m_user->get_info_user($this->session->userdata('username'))->avatar;
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Quản trị hệ thống"  => ''
        );
        $this->_data['cur_page'] = 'quantri';
        $this->load->view('layout/layout',$this->_data);
    }
    public function doi_mat_khau_form(){
        $this->_data['heading']="Đổi mật khẩu";
        $this->_data['path']=array('quantri_nguoidung/doi_mat_khau');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Quản trị hệ thống"     => site_url('user/quan-tri'),
        "Đổi mật khẩu"  => ''
        );
        $this->_data['cur_page'] = 'quantri';
        $this->load->view('layout/layout',$this->_data);
    }
    public function xu_ly_doi_mat_khau(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('old_password','Mật khẩu cũ','required');
        $this->form_validation->set_rules('new_password','Mật khẩu mới','required');
        $this->form_validation->set_rules('cf_new_password','Xác nhận mật khẩu mới','required|matches[new_password]');
        $this->form_validation->set_message('required','(*) %s chưa nhập');
        $this->form_validation->set_message('matches','Mật khẩu xác nhận không đúng');
        if ($this->form_validation->run()==false)
        {
            $this->doi_mat_khau_form();
        }
        else
        {
            $username=trim($this->session->userdata('username'));
            $old_pass=trim($this->input->post('old_password'));
            $new_pass=trim($this->input->post('new_password'));
            if ($old_pass==$new_pass)
            {
                $this->session->set_userdata('ses_thongbao','Mật khẩu mới không được trùng với mật khẩu cũ');
                $this->_data['alert_type'] = "warning";
                $this->doi_mat_khau_form();
            }
            else
            {
                $info=$this->m_user->get_info_user($username);
                $dbpassword = $info->password;
                $hashparts = explode (':' , $dbpassword);
                $userhash = md5("$old_pass".$hashparts[1]);
                
                if ($userhash === $hashparts[0])
                {
                    $this->load->library('my_lib');
                    $crypted_new_pass=$this->my_lib->Create_salt($new_pass);
                    $this->m_user->doimatkhau($username,$crypted_new_pass);
                    $this->_data['thongbao']="Đổi mật khẩu thành công";
                    $this->_data['alert_type'] = "success";
                    $this->_data['heading']="Đổi mật khẩu";
                    $this->_data['path']=array('thongbao/thong_bao_chung');
                    $this->_data['arr_luuvet'] = array(
                    "Home"     => base_url(),
                    "Đổi mật khẩu"  => ''
                    );
                    $this->load->view('layout/layout',$this->_data);
                }
                else
                {
                    $this->session->set_userdata('ses_thongbao','Mật khẩu cũ không đúng');
                    $this->_data['alert_type'] = "danger";
                    $this->doi_mat_khau_form();
                }
            }
        }
    }
    /*--------------------------- Đổi avatar -----------------------------*/
    public function doi_avatar()
    {
       if (isset($_FILES["hinh"]))
       {
            $hinh=$_FILES['hinh'];
            if (empty($hinh['name']))
             {
                echo $this->my_lib->display_thongbao('danger','Vui lòng chọn hình');
             }
            else
            {
                 $config['upload_path']='./public/images/upload-image/';
                 $config['allowed_types']='gif|jpg|png';
                 $config['max_size']='10000';
                 $config['max_width']='1024';
                 $config['max_height']='768';
                 $config['overwrite'] = TRUE;//Ghi đè nếu cùng tên
                 $this->load->library('upload',$config);
                 if (!$this->upload->do_upload("hinh"))
                 {
                    //echo $this->upload->display_errors();
                    echo $this->my_lib->display_thongbao('danger',$this->upload->display_errors());
                 }
                 else
                 {
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 92;
                    $config['height'] = 92;
                    $this->load->library('image_lib', $config); 
                    $this->image_lib->resize();
                    // Xóa hình cũ trong thư mục
                    $old_avatar = $this->m_user->get_info_user($this->session->userdata('username'))->avatar;
                    if (!empty($old_avatar) && $old_avatar != $hinh['name'])
                    {
                        //Xóa hình
                        unlink($this->upload->upload_path.$old_avatar);
                    }
                    $this->m_user->doi_avatar($this->session->userdata('username'),$hinh['name']);
                    $this->quan_tri();
                 }
            }
       }
       else
       {
            echo $this->my_lib->display_thongbao('danger','Vui lòng chọn hình');
       }
    }
    /*----------------------------Đổi thông tin cá nhân ------------------*/
    public function doi_thong_tin_ca_nhan()
    {
        $username=trim($this->session->userdata('username'));
        $this->_data['query_info'] = $this->m_user->get_info_user($username);
        $this->_data['heading']="Đổi thông tin cá nhân";
        $this->_data['path']=array('quantri_nguoidung/doi_thong_tin_ca_nhan');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Quản trị hệ thống"     => site_url('user/quan-tri'),
        "Đổi thông tin cá nhân"  => ''
        );
        $this->_data['cur_page'] = 'quantri';
        $this->load->view('layout/layout',$this->_data);
    }
    public function xu_ly_doi_thong_tin_ca_nhan(){
        $username=trim($this->session->userdata('username'));
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $data = array (
            'phone'     =>$phone,
            'email'     =>$email
        );
        $this->m_user->doi_thong_tin_ca_nhan($username,$data);
        $this->session->set_userdata('ses_thongbao','Đổi thông tin cá nhân thành công');
        $this->doi_thong_tin_ca_nhan();
    }
    /*--------------------------Quen mat khau -------------------------------*/
    public function quen_mat_khau()
    {
        $username=trim($this->session->userdata('username'));
        //$this->_data['query_info'] = $this->m_user->get_info_user($username);
        $this->_data['heading']="Quên mật khẩu";
        $this->_data['path']=array('quantri_nguoidung/quen_mat_khau');
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Quên mật khẩu"  => base_url('quen-mat-khau.html'),
        'Step 1'    =>''
        );
        $this->load->view('layout/layout',$this->_data);
    }
    public function xu_ly_quen_mat_khau()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_message('required','%s chưa nhập');
        $this->form_validation->set_message('valid_email','Vui lòng nhập Email có nghĩa');
        if (!$this->form_validation->run())
        {
            $this->quen_mat_khau();
        }
        else
        {
            $email = trim($_POST['email']);
            $info_user = $this->m_user->get_info_user($email);
            if (empty($info_user))
            {
                $this->session->set_userdata('ses_thongbao','Địa chỉ email không tồn tại');
                $this->_data['alert_type'] = "warning";
                $this->quen_mat_khau();
            }
            else
            {
                $db_password = $info_user->password;
                $hashpart = explode(":",$db_password);
                $nguoi_goi = "shinhwa2403@gmail.com";
                $nguoi_nhan = $email;
                $subject = "Phục hồi mật khẩu trang Đăng Ký Đề Tài Khoa CNTT - ĐHSPKT";
                $message = "Xin chào : <br>Mã xác nhận của bạn là: ".$hashpart[0]."<br>Vui lòng vào link này : ".anchor('xu-ly-xac-nhan-quen-mat-khau')." để xác nhận tài khoản.<br>Trân trọng !";
                $this->load->library('my_lib');
                if (!$this->my_lib->send_email($nguoi_goi,$nguoi_nhan,$message,$subject))
                {
                    echo "Gửi mail không thành công";
                }
                else
                {
                    $this->session->set_userdata('ses_thongbao','Mã xác nhận vừa được gửi vào trong Email của bạn, vui lòng kiểm tra và điền Code nhận được vào hộp bên dưới.');
                    $this->_data['heading']="Xác nhận quên mật khẩu";
                    $this->_data['alert_type'] = "info";
                    $this->_data['path']=array('quantri_nguoidung/xac_nhan_quen_mat_khau');
                    $this->_data['arr_luuvet'] = array(
                    "Home"     => base_url(),
                    "Đổi mật khẩu"  => base_url('quen-mat-khau.html'),
                    "Step 1"    => base_url('quen-mat-khau.html'),
                    "Step 2"    => '',
                    );
                    $this->load->view('layout/layout',$this->_data);
                }
            }
        }
    }
    public function xu_ly_xac_nhan_quen_mat_khau()
    {
        
        if (empty($_POST['ten_dang_nhap']) || empty($_POST['code_verify']))
        {
            $this->_data['heading']="Xác nhận quên mật khẩu";
            $this->_data['path']=array('quantri_nguoidung/xac_nhan_quen_mat_khau');
            $this->_data['arr_luuvet'] = array(
            "Home"     => base_url(),
            "Đổi mật khẩu"  => base_url('quen-mat-khau.html'),
            "Step 1"    => '',
            "Step 2"    => '',
            );
            $this->load->view('layout/layout',$this->_data);
        }
        else
        {
            $ten_dang_nhap = trim($_POST['ten_dang_nhap']);
            $ma_xac_nhan = trim($_POST['code_verify']);
            $info_user = $this->m_user->get_info_user($ten_dang_nhap);
            if (empty($info_user))
            {
                $this->session->set_userdata('ses_thongbao','Mã xác nhận không đúng hoặc tên người dùng không tồn tại');
                $this->_data['heading']="Xác nhận quên mật khẩu";
                $this->_data['alert_type'] = "danger";
                $this->_data['path']=array('quantri_nguoidung/xac_nhan_quen_mat_khau');
                $this->_data['arr_luuvet'] = array(
                "Home"     => base_url(),
                "Đổi mật khẩu"  => base_url('quen-mat-khau.html'),
                "Step 1"    => '',
                "Step 2"    => '',
                );
                $this->load->view('layout/layout',$this->_data);
            }
            else
            {
                $db_password = $info_user->password;
                $hashpart = explode(":",$db_password);
                if ($hashpart[0]!== $ma_xac_nhan)
                {
                    //sai ma xac nhan
                    $this->session->set_userdata('ses_thongbao','Mã xác nhận không đúng hoặc tên người dùng không tồn tại');
                    $this->_data['heading']="Xác nhận quên mật khẩu";
                    $this->_data['alert_type'] = "danger";
                    $this->_data['path']=array('quantri_nguoidung/xac_nhan_quen_mat_khau');
                    $this->_data['arr_luuvet'] = array(
                    "Home"     => base_url(),
                    "Đổi mật khẩu"  => base_url('quen-mat-khau.html'),
                    "Step 1"    => '',
                    "Step 2"    => '',
                    );
                    $this->load->view('layout/layout',$this->_data);
                }
                else
                {
                    //chuyen toi trang doi mat khau
                    $this->_data['username'] = $ten_dang_nhap;
                    $this->_data['heading']="Cập nhật mật khẩu mới";
                    $this->_data['alert_type'] = "info";
                    $this->session->set_userdata('ses_thongbao','Vui lòng đổi mật khẩu để hoàn tất quá trình');
                    $this->_data['path']=array('quantri_nguoidung/cap_nhat_mat_khau_quen_mat_khau');
                    $this->_data['arr_luuvet'] = array(
                    "Home"     => base_url(),
                    "Đổi mật khẩu"  => base_url('quen-mat-khau.html'),
                    "Step 1"    =>  base_url('quen-mat-khau.html'),
                    "Step 2"    => '',
                    );
                    $this->load->view('layout/layout',$this->_data);
                }
            }
        }
    }
    public function cap_nhat_mat_khau()
    {
        $username = trim($_POST['username']);
        $new_pass =trim ($_POST['new_password']);
        $cf_new_password =trim ($_POST['cf_new_password']);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('new_password','Mật khẩu ','required');
        $this->form_validation->set_rules('cf_new_password','Xác nhận mật khẩu','required|matches[new_password]');
        $this->form_validation->set_message('required','(*) %s chưa nhập');
        $this->form_validation->set_message('matches','Mật khẩu xác nhận không đúng');
        if (!$this->form_validation->run())
        {
            $this->_data['username'] = $username;
            $this->_data['heading']="Cập nhật mật khẩu mới";
            $this->_data['path']=array('quantri_nguoidung/cap_nhat_mat_khau_quen_mat_khau');
            $this->_data['arr_luuvet'] = array(
            "Home"     => base_url(),
            "Đổi mật khẩu"  => base_url('quen-mat-khau.html'),
            "Step 1"    =>  base_url('quen-mat-khau.html'),
            "Step 2"    => base_url('xu-ly-xac-nhan-quen-mat-khau.html'),
            "Step 3"    => '',
            );
            $this->load->view('layout/layout',$this->_data);
        }
        else
        {
            $this->load->library('my_lib');
            $crypted_new_pass=$this->my_lib->Create_salt($new_pass);
            $this->m_user->doimatkhau($username,$crypted_new_pass);
            $this->_data['alert_type'] = "success";
            $this->_data['thongbao']="Đổi mật khẩu thành công";
            $this->_data['heading']="Đổi mật khẩu";
            $this->_data['path']=array('thongbao/thong_bao_chung');
            $this->_data['arr_luuvet'] = array(
            "Home"     => base_url(),
            "Đổi mật khẩu"  => base_url('quen-mat-khau.html'),
            "Step 1"    =>  base_url('quen-mat-khau.html'),
            "Step 2"    => base_url('xu-ly-xac-nhan-quen-mat-khau.html'),
            "Step 3"    => '',
            );
            $this->load->view('layout/layout',$this->_data);
        }
    }
}
?>