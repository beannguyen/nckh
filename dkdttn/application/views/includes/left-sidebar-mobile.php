<?php
    echo '<li class="list-group-item" id="time" style="font-size:11px;background-color:#3b5998;font-weight:bold;color:rgb(250,250,250);">'.date('H')." giờ ".date('i').' phút, ngày '.date('d').' tháng '.date('m').', '.date('Y').'</li>';
?>
<li class="list-group-item" style="text-align: right;font-weight:bold;font-family:verdana;background-color:#efefef;">Danh Mục</li>
<?php
    if (empty($cur_page)) $cur_page = 'NULL';
?>
<a href="<?php echo base_url('trang-chu.chn') ?>" class="list-group-item <?php if (@$cur_page == 'home') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Trang Chủ</a>
<a href="<?php echo base_url('danh-sach-loai-de-tai.html') ?>" class="list-group-item <?php if (@$cur_page == 'dsdt') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Danh sách đề tài</a>
<a href="<?php echo site_url('danh-sach-giang-vien/page/1') ?>" class="list-group-item <?php if (@$cur_page == 'dsgv') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Thông tin giảng viên</a>
<a href="<?php echo site_url('danh-sach-sinh-vien/page/1') ?>" class="list-group-item <?php if (@$cur_page == 'dssv') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Thông tin sinh viên</a>
<a href="<?php echo base_url('huong-dan-dang-ky.html') ?>" class="list-group-item <?php if (@$cur_page == 'huongdan') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Hướng dẫn đăng ký</a>    
<a href="<?php echo base_url('thong-ke.html') ?>" class="list-group-item <?php if (@$cur_page == 'thongke') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Thống kê</a>    
<a data-toggle="modal" href="#seach_box" class="list-group-item"><span class="pull-right"><i class="icon-chevron-right"></i></span>Tìm kiếm</a>
<hr />
<?php
    if ($this->session->userdata('da_dang_nhap')===true)
    {
        if ($this->session->userdata('usertype') === 'sinhvien')
        {
            ?>
                <li class="list-group-item" style="text-align: right;font-weight:bold;font-family:verdana;background-color:#efefef;">Sinh Viên</li>     
                <?php $this->load->view('includes/menu_quantri_sinhvien') ?>
            <?php
        }
        else if ($this->session->userdata('usertype') === 'giangvien')
        {
            ?>
                <li class="list-group-item" style="text-align: right;font-weight:bold;font-family:verdana;background-color:#efefef;">Giảng viên</li>
                <?php $this->load->view('includes/menu_quantri_giangvien') ?>
            <?php
        }
    }
?>


