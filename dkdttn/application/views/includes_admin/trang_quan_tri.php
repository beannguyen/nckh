<div class="alert alert-info">
            Chào mừng  
            <span>
                <?php
                $usertype = $this->session->userdata('usertype');
                if ($usertype=='admin') echo 'admin';
                ?>
            </span>
            <strong class="text-danger"><?php echo $this->session->userdata('name') ?></strong>
            <br /> 
            đến với hệ thống Đăng Ký Đề Tài Khoa Công Nghệ Thông Tin
            <br />
        <div class="clearfix"></div>
</div>
<hr />
<h3 class="text-danger">Quản trị tài khoản : </h3>
<hr />
<li><a href="<?php echo base_url('user/doi-thong-tin-ca-nhan.html') ?>">Đổi thông tin cá nhân</a></li><hr />
<li><a href="<?php echo base_url('user/doi-mat-khau.html') ?>">Đổi mật khẩu</a></li><hr />