<div id="form" class="form-group">
<form method="post" action="<?php echo base_url('xu-ly-dang-nhap') ?>">
    <?php
        $thongbao=$this->session->userdata('ses_thongbao');
        if (!empty($thongbao))
        {
            ?>
                <div class="alert alert-<?php echo @$alert_type ?>">
                    <?php
                    echo $this->session->userdata('ses_thongbao')."<br>";
                    $this->session->unset_userdata('ses_thongbao');
                    ?>
                </div>
            <?php
        }
    ?>
    <label>Tên người dùng</label>
    <input required="required" type="text" class="form-control" name="username" value="<?php echo set_value('username', ' '); ?>" />
    <?php echo form_error('username', '<p class="text-warning">', '</p>'); ?>
    <label>Mật khẩu</label>
    <input  type="password" required="required" name="password" class="form-control" />
    <?php echo form_error('password', '<p class="text-warning">', '</p>'); ?>
    <br />
    <?php echo anchor('quen-mat-khau','Quên mật khẩu','class="text-danger"') ?>
    <br />
    <br />
    <div id="button_area">
        <input class="btn btn-primary" type="submit" name="dangnhap" value="Đăng nhập" />
        <input class="btn btn-primary"  type="reset" name="reset" value="Nhập lại" />
    </div>
</form>
</div>