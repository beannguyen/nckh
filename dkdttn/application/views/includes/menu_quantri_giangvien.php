<?php
    if ($this->session->userdata('da_dang_nhap')==true)
    {
        if (empty($cur_page)) $cur_page = NULL;
        ?>
        <a href="<?php echo site_url('user/quan-tri') ?>" class="list-group-item <?php if (@$cur_page == 'quantri') echo 'active' ?> "><span class="pull-right"><i class="icon-chevron-right"></i></span>Quản trị tài khoản</a>
        <a href="<?php echo site_url('user/chon-loai-de-tai') ?>" class="list-group-item <?php if (@$cur_page == 'quantri_dt_gv') echo 'active' ?> "><span class="pull-right"><i class="icon-chevron-right"></i></span>Quản trị đề tài</a>
        <a href="<?php echo site_url('user/dang-xuat') ?>" class="list-group-item"><span class="pull-right"><i class="icon-chevron-right"></i></span>Đăng xuất</a>
        <?php
    }
?>