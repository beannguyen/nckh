<?php
class C_error extends CI_Controller{
    
    public function err()
    {
        $this->_data['heading'] = "Thông báo";
        $this->_data['thongbao'] = "Bạn không được phép vào trang này !";
        $this->_data['alert_type'] = "danger";
        $this->_data['path'] =array('thongbao/thong_bao_chung');
        $this->_data['arr_luuvet'] = array(
            "Home"     => base_url(),
            "Error page"  => ''
            );
        $this->load->view('layout/layout', $this->_data);
    }
    public function err_php()
    {
        $this->_data['heading'] = "Thông báo";
        $this->_data['thongbao'] = "Có lỗi xảy ra trong quá trình thực thi";
        $this->_data['alert_type'] = "warning";
        $this->_data['path'] =array('thongbao/thong_bao_chung');
        $this->_data['arr_luuvet'] = array(
            "Home"     => base_url(),
            "Error page"  => ''
            );
        $this->load->view('layout/layout', $this->_data);
    }
}  
?>