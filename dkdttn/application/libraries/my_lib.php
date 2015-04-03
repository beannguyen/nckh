<?php
class My_lib
{
    var $ci;
    public function __construct(){
        $this->ci=&get_instance();
    }
    public function Create_salt($password)
    {
        $salt='';
        for ($i=0; $i<=32; $i++) 
        {
            $d=rand(1,30)%2;
            $salt .= $d ? chr(rand(65,90)) : chr(rand(48,57));
        }
        $hashed = md5($password . $salt);
        $encrypted = $hashed . ':' . $salt;
        return $encrypted;
    }
    public function send_email($nguoi_goi,$nguoi_nhan,$message,$subject)
    {
        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => 'dangkydetaicntt@gmail.com', // email trung gian, nhan email tu nguoi dung va gui den nguoi nhan
          'smtp_pass' => '10110063',
          'mailtype' => 'html',
          'charset' => 'utf-8',
          'wordwrap' => TRUE
          );
        //$message = "Chào bạn, mật khẩu của bạn đã được reset như sau : "." .Mong bạn giữ gìn cẩn thận .";
        $this->ci->load->library('email', $config);
        $this->ci->email->set_newline("\r\n");
        $this->ci->email->from($nguoi_goi,'Đăng ký đề tài khoa CNTT - SPKTHCM'); // change it to yours
        $this->ci->email->to($nguoi_nhan);// change it to yours
        $this->ci->email->subject($subject);
        $this->ci->email->message($message);
        if($this->ci->email->send())
             {
              //echo 'Email sent.';
              return true;
             }
        else
            {
                //show_error($this->ci->email->print_debugger());
                //echo 'Gửi không thành công';
                return false;
            }
    }
    public function pre_config_pagination($param,$per_pg,$total)
    {
        $this->ci->load->library('pagination');
        $config['uri_segment']=$param;
        $config['total_rows']=$total;
        $config['per_page']=$per_pg;
        $config['use_page_numbers']=true;
        $confif['url_suffix']='.html';
        $config['suffix'] = '.html';
        $config['first_url']='1';
        
        $config['full_tag_open']='<ul class="pagination">';
        $config['full_tag_close']='</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['num_links'] = "2";
        $config['prev_link'] = FALSE;
        $config['next_link'] = FALSE;
        
        
        $this->ci->pagination->initialize($config);
    }
    public function display_thongbao($type,$message)
    {
        //Get info user cho thong bao
        $this->ci->load->model('m_home');
        $this->ci->load->model('m_user');
        $info_user = $this->ci->m_user->get_info_user($this->ci->session->userdata('username'));
        $this->ci->_data['info_user'] = $info_user;
        //var_dump($info_user);
        $lop = $this->ci->m_user->get_lop_sinhvien($this->ci->session->userdata('username'));
        $this->ci->_data['info_lop'] = $lop;
        $this->ci->_data['query_ds_loai_de_tai'] = $this->ci->m_home->get_danh_sach_loai_de_tai();
        $this->ci->_data['heading'] = "Thông báo";
        $this->ci->_data['alert_type']=$type;
        $this->ci->_data['thongbao'] = $message;
        $this->ci->_data['path']=array('thongbao/thong_bao_chung');
        $this->ci->_data['arr_luuvet'] = array(
        "Home"     => base_url(),
        "Thông báo"  => ''
        );
        $this->ci->load->view('layout/layout',$this->ci->_data);
    }
    public function count_online()
    {
        $this->ci->load->model('m_countonline');
        $this->ci->m_countonline->delete_exp_sess();
        $session_id = $this->ci->session->userdata('session_id');
        $last_activity = $this->ci->session->userdata('last_activity');
        $ip = $this->ci->session->userdata('ip_address');
        $data = array (
        'session_id' =>  $session_id,
        'guest'      => '1',
        'time'       => $last_activity,
        'data'       => $ip  
        );
        if ($this->ci->m_countonline->kt_tontai_sess($session_id) == 0)
        {
            $this->ci->m_countonline->them_moi_session($data);
            //tăng biến counter lên 1
            $this->hit_counter();
            $hit_counter = file_get_contents('./counter_visit');
            $this->ci->_data['hit_counter'] = $hit_counter;
        }
        else
        {
            //kt nguoi dung nay co hoat dong trong 10 phut
            $this->ci->m_countonline->update_sess_guest($session_id,time());
            $hit_counter = file_get_contents('./counter_visit');
            $this->ci->_data['hit_counter'] = $hit_counter;
        }
        //In ra so nguoi online
        return $this->ci->m_countonline->count_all_sess();
    }
    public function count_online_ci()
    {
        $this->ci->load->model('m_countonline');
        return $this->ci->m_countonline->count_all_sess_id_ci();
    }
    public function hit_counter()
    {
        $counter = file_get_contents('./counter_visit') + 1;
        file_put_contents('./counter_visit', $counter);
    }
    public function khong_dau($str)
    {
        return mb_strtolower(url_title(removesign($str))); 
    }
    public function get_first_letter($str)
    {
        $words = explode(" ",$str);
        $result = "";
        foreach ($words as $ft)
            $result .= $ft[0];
        return $result;
    }
	public function write_excel_data_dk_chuyennganh()
	{
		
		$this->ci->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $ten_cauhinh = ('DANH SÁCH  ');
            // Chon sheet 0
        $active_sheet = 0;
        $objPHPExcel->setActiveSheetIndex($active_sheet);
            // Mergecell
        $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('C3:F3');
            
            //height
            $objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(50);
            $objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);
            
            // Set column width
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            
             //Modify cell's style
             $title = array(
                'font' => array(
                    'name'         => 'Times New Roman',
                    'bold'         => true,
                    'italic'    => false,
                    'size'        => 12
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
                'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_NONE
                  )
                )
             );
             $heading = array(
                'font' => array(
                    'name'         => 'Times New Roman',
                    'bold'         => true,
                    'italic'    => false,
                    'size'        => 12
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
                'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
                )
             );
             $normal = array(
                'font' => array(
                    'name'         => 'Times New Roman',
                    'bold'         => false,
                    'italic'    => false,
                    'size'        => 12
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
                'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
                )
             );
             $normal_center= array(
                'font' => array(
                    'name'         => 'Times New Roman',
                    'bold'         => false,
                    'italic'    => false,
                    'size'        => 12
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
                'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
                )
             );
            //$objPHPExcel->getActiveSheet()->getStyle('G5:L5')->applyFromArray($normal);
            $objPHPExcel->getActiveSheet()->getStyle('C3:F3')->applyFromArray($title);
            $objPHPExcel->getActiveSheet()->getStyle('A4:L5')->applyFromArray($heading);
            
            // Add some data
            $objPHPExcel->setActiveSheetIndex($active_sheet);
            $objPHPExcel->getActiveSheet()->SetCellValue('A4', "MSSV");
            $objPHPExcel->getActiveSheet()->SetCellValue('B4', "Họ tên");
            $objPHPExcel->getActiveSheet()->SetCellValue('C4', "Nguyện vọng 1");
            $objPHPExcel->getActiveSheet()->SetCellValue('D4', "Nguyện vọng 2");
            
			$ds_detai = $this->ci->m_dangkychuyennganh->get_ds_sinhvien();
			if (!empty($ds_detai)){
                $stt = $i_stt = 1;
                for ($i_count=0;$i_count < count($ds_detai); $i_count=$i_count+1)
                {
                    $detai = $ds_detai[$i_count];
					
                    $row = $stt + 5;
                    $row1 = $row+1;
                    
                    $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
                    $objPHPExcel->getActiveSheet()->getRowDimension($row1)->setRowHeight(20);
                    //Fill data
                    $objPHPExcel->getActiveSheet()->SetCellValue("A$row", $detai['username']);
                    $objPHPExcel->getActiveSheet()->SetCellValue("B$row", $detai['name']);
					if($detai['nguyenvong'] == 1)	{
						$detai2 = $ds_detai[$i_count+1];
						$i_count+=1;
						$objPHPExcel->getActiveSheet()->SetCellValue("C$row", $detai['TenCN']);
						$objPHPExcel->getActiveSheet()->SetCellValue("D$row", $detai2['TenCN']);
					}
					
						
                    //NORMAL 
                    $objPHPExcel->getActiveSheet()->getStyle("A$row:L$row")->applyFromArray($normal);
                    $objPHPExcel->getActiveSheet()->getStyle("A$row1:L$row1")->applyFromArray($normal);
                     // center alignment
                    $objPHPExcel->getActiveSheet()->getStyle("A$row:A$row1")->applyFromArray($normal_center);
                    $objPHPExcel->getActiveSheet()->getStyle("F$row:F$row1")->applyFromArray($normal_center);
                    $objPHPExcel->getActiveSheet()->getStyle("G$row:G$row1")->applyFromArray($normal_center);
                    $objPHPExcel->getActiveSheet()->getStyle("I$row:I$row1")->applyFromArray($normal_center);
                    $objPHPExcel->getActiveSheet()->getStyle("K$row:K$row1")->applyFromArray($normal_center);
                    $objPHPExcel->getActiveSheet()->getStyle("L$row:L$row1")->applyFromArray($normal_center);
                    
                    $stt += 1;
                    $i_stt++;
                }
            }
            
         //End for
        
        //Rename sheet
        $objPHPExcel->getSheet(0)->setTitle('DKCN');
        // Save Excel5 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save(str_replace('.php', '.xls', __FILE__));
        
        ob_end_clean(); // cuc ky quan trong
        
        $name_file = 'DKCN';
        // We'll be outputting an excel file
        header('Content-type: application/force-download');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$name_file.'.xls');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        
    
	}
    public function write_excel_data($id_cauhinh)
    {
        $this->ci->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $cauhinh_id = $id_cauhinh;
        for ($cn = 1; $cn <=3; $cn++)
        {
            $chuyennganh_id = $cn;//cnpm
            //set title
            //$objPHPExcel->getActiveSheet()->setTitle("$chuyennganh_id");
            $tencn = '';
            if ($cn == 1){
                $tencn = 'CNPM';
            }else if($cn == 2){
                $tencn = 'HTTT';
            }else if ($cn == 3){
                $tencn = 'MMT';
            }
            $query_heading = $this->ci->m_home->get_ten_loai_de_tai($cauhinh_id);
            $ten_cauhinh = ('DANH SÁCH ĐỀ TÀI ' . mb_strtoupper($query_heading->tenloai,"UTF-8") .' HỌC KỲ '.$query_heading->hocky.'-'.$query_heading->namhoc."\n".' K20'. $query_heading->TenNK . ' - ' . 'BỘ MÔN : '. $tencn);
            // Chon sheet 0
            $active_sheet = $cn-1;
            $objPHPExcel->setActiveSheetIndex($active_sheet);
            // Mergecell
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('C3:F3');
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('G4:H4');
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('I4:J4');
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('K4:L4');
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('A4:A5');
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('A4:A5');
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('B4:B5');
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('C4:C5');
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('D4:D5');
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('E4:E5');
            $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells('F4:F5');
            
            //height
            $objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(50);
            $objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);
            
            // Set column width
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
            
             //Modify cell's style
             $title = array(
                'font' => array(
                    'name'         => 'Times New Roman',
                    'bold'         => true,
                    'italic'    => false,
                    'size'        => 12
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
                'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_NONE
                  )
                )
             );
             $heading = array(
                'font' => array(
                    'name'         => 'Times New Roman',
                    'bold'         => true,
                    'italic'    => false,
                    'size'        => 12
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
                'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
                )
             );
             $normal = array(
                'font' => array(
                    'name'         => 'Times New Roman',
                    'bold'         => false,
                    'italic'    => false,
                    'size'        => 12
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
                'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
                )
             );
             $normal_center= array(
                'font' => array(
                    'name'         => 'Times New Roman',
                    'bold'         => false,
                    'italic'    => false,
                    'size'        => 12
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'       => true
                ),
                'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
                )
             );
            //$objPHPExcel->getActiveSheet()->getStyle('G5:L5')->applyFromArray($normal);
            $objPHPExcel->getActiveSheet()->getStyle('C3:F3')->applyFromArray($title);
            $objPHPExcel->getActiveSheet()->getStyle('A4:L5')->applyFromArray($heading);
            
            // Add some data
            echo date('H:i:s') . " Add some data\n";
            $objPHPExcel->setActiveSheetIndex($active_sheet);
            $objPHPExcel->getActiveSheet()->SetCellValue('C3', "$ten_cauhinh");
            $objPHPExcel->getActiveSheet()->SetCellValue('A4', "STT");
            $objPHPExcel->getActiveSheet()->SetCellValue('B4', "Tên đề tài");
            $objPHPExcel->getActiveSheet()->SetCellValue('C4', "Mục tiêu");
            $objPHPExcel->getActiveSheet()->SetCellValue('D4', "Sản phẩm dự kiến");
            $objPHPExcel->getActiveSheet()->SetCellValue('E4', "Yêu cầu về kiến thức");
            $objPHPExcel->getActiveSheet()->SetCellValue('F4', "Số lượng SV");
            $objPHPExcel->getActiveSheet()->SetCellValue('G4', "GVHD");
            $objPHPExcel->getActiveSheet()->SetCellValue('G5', "Mã GV");
            $objPHPExcel->getActiveSheet()->SetCellValue('H5', "Họ và tên GV");
            
            $objPHPExcel->getActiveSheet()->SetCellValue('I4', "GVPB");
            $objPHPExcel->getActiveSheet()->SetCellValue('I5', "Mã GV");
            $objPHPExcel->getActiveSheet()->SetCellValue('J5', "Họ và tên GV");
            
            $objPHPExcel->getActiveSheet()->SetCellValue('K4', "SVTH");
            $objPHPExcel->getActiveSheet()->SetCellValue('K5', "MSSV");
            $objPHPExcel->getActiveSheet()->SetCellValue('L5', "Họ và tên SV");
            
            
            $ds_detai = $this->ci->m_home->get_detai_cauhinh($cauhinh_id , $chuyennganh_id);
            if (!empty($ds_detai)){
                $stt = $i_stt = 1;
                foreach ($ds_detai as $detai)
                {
                    $info_detai = $this->ci->m_home->get_chi_tiet_de_tai($detai->id);
                    //tendetai,muctieu,sanpham,yeucau
                    //echo $info_detai->yeucau.'<br>';
                    $arr_nhomtruong = $this->ci->m_home->get_ten_truong_nhom($info_detai->truongnhom);
                    if (!empty($info_detai->truongnhom))
                    {
                        $arr_thanhvien = $this->ci->m_home->get_ten_thanh_vien($detai->id,$info_detai->truongnhom);
                    }
                    else
                    {
                        $arr_thanhvien = "";
                    }
                    $arr_giangvien_huongdan = $this->ci->m_home->get_ten_giang_vien($detai->id);
                    $arr_giangvien_phanbien = $this->ci->m_home->get_ten_giang_vien_phan_bien($detai->id);
                   
                    $row = $stt + 5;
                    $row1 = $row+1;
                    
                    $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
                    $objPHPExcel->getActiveSheet()->getRowDimension($row1)->setRowHeight(20);
                    // Mergecell
                    $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells("A$row:A$row1");
                    $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells("B$row:B$row1");
                    $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells("C$row:C$row1");
                    $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells("D$row:D$row1");
                    $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells("E$row:E$row1");
                    $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells("F$row:F$row1");
                    $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells("G$row:G$row1");
                    $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells("H$row:H$row1");
                    $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells("I$row:I$row1");
                    $objPHPExcel->setActiveSheetIndex($active_sheet)->mergeCells("J$row:J$row1");
                    
                    // replace <br>
                    $info_detai->muctieu = str_replace('<br />','',$info_detai->muctieu);
                    $info_detai->tendetai = str_replace('<br />','',$info_detai->tendetai);
                    $info_detai->sanpham = str_replace('<br />','',$info_detai->sanpham);
                    $info_detai->yeucau = str_replace('<br />','',$info_detai->yeucau);
                    
                    //Fill data
                    $objPHPExcel->getActiveSheet()->SetCellValue("A$row", "$i_stt");
                    $objPHPExcel->getActiveSheet()->SetCellValue("B$row", "$info_detai->tendetai");
                    $objPHPExcel->getActiveSheet()->SetCellValue("C$row", "$info_detai->muctieu");
                    $objPHPExcel->getActiveSheet()->SetCellValue("D$row", "$info_detai->sanpham");
                    $objPHPExcel->getActiveSheet()->SetCellValue("E$row", "$info_detai->yeucau");
                    $objPHPExcel->getActiveSheet()->SetCellValue("F$row", "$info_detai->soluongSVtoida");
                    if (!empty($arr_giangvien_huongdan)){
                        $objPHPExcel->getActiveSheet()->setCellValueExplicit("G$row", $arr_giangvien_huongdan->username, PHPExcel_Cell_DataType::TYPE_STRING);
                        $objPHPExcel->getActiveSheet()->SetCellValue("H$row", $arr_giangvien_huongdan->name);
                    }
                    if (!empty($arr_giangvien_phanbien)){
                        $objPHPExcel->getActiveSheet()->setCellValueExplicit("I$row", $arr_giangvien_phanbien->username, PHPExcel_Cell_DataType::TYPE_STRING);
                        $objPHPExcel->getActiveSheet()->SetCellValue("J$row", $arr_giangvien_phanbien->name);
                    }
                    
                    if (!empty($arr_nhomtruong)){
                        $objPHPExcel->getActiveSheet()->setCellValueExplicit("K$row", $arr_nhomtruong->username, PHPExcel_Cell_DataType::TYPE_STRING);
                        $objPHPExcel->getActiveSheet()->SetCellValue("L$row", $arr_nhomtruong->name);
                    }
                    
                    
                    if (!empty($arr_thanhvien)){
                        $objPHPExcel->getActiveSheet()->setCellValueExplicit("K$row1", $arr_thanhvien[0]->username, PHPExcel_Cell_DataType::TYPE_STRING);
                        $objPHPExcel->getActiveSheet()->SetCellValue("L$row1", $arr_thanhvien[0]->name);
                    }
                    
                    //NORMAL 
                    $objPHPExcel->getActiveSheet()->getStyle("A$row:L$row")->applyFromArray($normal);
                    $objPHPExcel->getActiveSheet()->getStyle("A$row1:L$row1")->applyFromArray($normal);
                     // center alignment
                    $objPHPExcel->getActiveSheet()->getStyle("A$row:A$row1")->applyFromArray($normal_center);
                    $objPHPExcel->getActiveSheet()->getStyle("F$row:F$row1")->applyFromArray($normal_center);
                    $objPHPExcel->getActiveSheet()->getStyle("G$row:G$row1")->applyFromArray($normal_center);
                    $objPHPExcel->getActiveSheet()->getStyle("I$row:I$row1")->applyFromArray($normal_center);
                    $objPHPExcel->getActiveSheet()->getStyle("K$row:K$row1")->applyFromArray($normal_center);
                    $objPHPExcel->getActiveSheet()->getStyle("L$row:L$row1")->applyFromArray($normal_center);
                    
                    $stt += 2;
                    $i_stt++;
                }
            }
            //create new sheet
            if ($cn<3){
                $objWorkSheet = $objPHPExcel->createSheet($cn);
            }
        } //End for
        
        //Rename sheet
        $objPHPExcel->getSheet(0)->setTitle('CNPM');
        $objPHPExcel->getSheet(1)->setTitle('HTTT');
        $objPHPExcel->getSheet(2)->setTitle('MMT');
        // Save Excel5 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save(str_replace('.php', '.xls', __FILE__));
        
        ob_end_clean(); // cuc ky quan trong
        $tenloai = strtoupper($this->get_first_letter($query_heading->tenloai));
        $name_file = 'DSDT_'.$tenloai.'_K'.$query_heading->TenNK;
        // We'll be outputting an excel file
        header('Content-type: application/force-download');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$name_file.'.xls');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        
    }
}
?>