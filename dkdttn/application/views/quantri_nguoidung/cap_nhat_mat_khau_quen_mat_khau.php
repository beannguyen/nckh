<div id="form">
<form method="post" action="<?php echo base_url('xu-ly-cap-nhat-mat-khau.html') ?>">
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
    <label>Mật khẩu </label>
    <input type="password" name="new_password" class="form-control" />
    <?php echo form_error('new_password', '<p class="text-danger">', '</p>'); ?>
    
    <label>Xác nhận mật khẩu </label>
    <input type="password" name="cf_new_password" class="form-control" />
    <input type="hidden" name="username" class="form-control" value="<?php echo $username ?>" />
    <?php echo form_error('cf_new_password', '<p class="text-danger">', '</p>'); ?>
    <br />
    <div id="button_area">
        <input class="btn btn-primary" type="submit" name="luuthongtin" value="Lưu thông tin" />
        <input class="btn btn-primary"  type="reset" name="reset" value="Nhập lại" />
    </div>
</form>
</div>