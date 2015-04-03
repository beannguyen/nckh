<?php
Class C_dangkychuyennganh extends My_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
		$this->load->model('m_dangkychuyennganh');
        $this->load->helper("text");
    }
	public function check_timeline()
	{
		$cauhinh = $this->m_dangkychuyennganh->get_cauhinh();
		$now = new DateTime();
		$now =  $now->getTimestamp();
		$start = strtotime($cauhinh[0]['date_start']);
		$end = strtotime($cauhinh[0]['date_end']);
		if ($start > $now || $end < $now)
		{
			return false;
		}
		
		return true;
	}
    public function index()
    {
		if($this->check_timeline() == false)	{
			redirect('/error-page');
		}
		$this->_data['heading']="Đăng ký chuyên ngành";
        $this->_data['path']=array('dangkychuyennganh/Dang_ky');
        
		$id_user = $this->session->userdata('id_user');
		$ketqua = $this->m_dangkychuyennganh->get_ketqua_dangky($id_user);
		$this->_data['ketqua']= $ketqua;
		//print_r($ketqua(1));
		//print_r(($ketqua[0]['chuyennganh']));
		//exit(0);
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Đăng ký chuyên ngành"  => ''
        );
        $this->_data['cur_page'] = 'dangkychuyenngganh';
        $this->load->view('layout/layout',$this->_data);
    }
	public function dang_ky_chuyen_nganh()
	{
		if($this->check_timeline() == false)	{
			redirect('/error-page');
		}
		
		$this->load->helper('form');  
		$this->load->helper('html'); 
		//print_r($this->input->post);
		
		//echo $chuyenngan_1;
		$nguyenvong1 = $_GET['chuyenngan_1'];
		$nguyenvong2 = $_GET['chuyenngan_2'];
		if($nguyenvong1==nguyenvong2)
		{
			redirect('/user/dang-ky-chuyen-nganh');
		}
		$id_user = $this->session->userdata('id_user');
		$ketqua = $this->m_dangkychuyennganh->set_ketqua_dangky($id_user,$nguyenvong1,$nguyenvong2);
		redirect('/user/dang-ky-chuyen-nganh');
		//print_r($nguyenvong1);
		//exit(0);
	}
	public function export_result()
	{
		print_r($this->my_lib->write_excel_data_dk_chuyennganh());
		exit(0);
	}
    public function qlydangky()
	{
		$this->_data['heading']="Quản lý đăng ký chuyên ngành";
        $this->_data['path']=array('dangkychuyennganh/quanly_dangky');
		
        $this->_data['arr_nienkhoa'] = $this->m_dangkychuyennganh->get_nienkhoa();
		$this->_data['cauhinh'] = $this->m_dangkychuyennganh->get_cauhinh()[0];
		$id_user = $this->session->userdata('id_user');
		
		//$ketqua = $this->m_dangkychuyennganh->get_ketqua_dangky($id_user);
		//$this->_data['ketqua']= $ketqua;
		//print_r($ketqua(1));
		//print_r(($ketqua[0]['chuyennganh']));
		//exit(0);
        $this->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Đăng ký chuyên ngành"  => ''
        );
        $this->_data['cur_page'] = 'dangkychuyenngganh';
        $this->load->view('layout/backend-layout',$this->_data);
	}
	public function them_dang_ky_chuyen_nganh()
	{
			$sv_start = strtotime($_POST['thoigianSVbatdaudk']);
            $sv_end   = strtotime($_POST['thoigianSVketthucdk']);
            if ($sv_start>$sv_end)
            {
                echo 'Thời gian sinh viên bắt đầu đăng ký phải nhỏ hơn thời gian sinh viên kết thúc đăng ký';
            }
            
            else
            {
                $data = array (
                    'date_start'    =>  $_POST['thoigianSVbatdaudk'],
                    'date_end'   =>  $_POST['thoigianSVketthucdk'],
                    'nienkhoa'              =>  $_POST['nienkhoa'],
					'delete' => 1
                );
                $this->m_dangkychuyennganh->them_cauhinh($data);
                echo 'ok';
            }
	}
}
?>