<div id="form">
<form method="post" action="<?php echo base_url('user/xu-ly-doi-mat-khau.html') ?>">
    <?php
        $thongbao=$this->session->userdata('ses_thongbao');
        if (!empty($thongbao))
        {
            ?>
                <div class="error alert alert-<?php echo @$alert_type ?>">
            <?php
            echo $this->session->userdata('ses_thongbao')."<br>";
            $this->session->unset_userdata('ses_thongbao');
            ?>
                </div>
            <?php
        }
    ?>
    <label>Mật khẩu cũ</label>
    <input type="password" required="required" name="old_password" class="form-control"  />
    <?php echo form_error('old_password', '<p class="text-warning">', '</p>'); ?>
    
    <label>Mật khẩu mới</label>
    <input type="password" required="required" name="new_password" class="form-control" />
    <?php echo form_error('new_password', '<p class="text-warning">', '</p>'); ?>
    
    <label>Xác nhận mật khẩu mới</label>
    <input type="password" required="required" name="cf_new_password" class="form-control"  />
    <?php echo form_error('cf_new_password', '<p class="text-warning">', '</p>'); ?>
    <br />
    <div class="text-center">
        <input class="btn btn-primary" type="submit" name="luuthongtin" value="Lưu thông tin" />
        <input class="btn btn-primary" type="reset" name="reset" value="Nhập lại" />
    </div>
</form>
</div>