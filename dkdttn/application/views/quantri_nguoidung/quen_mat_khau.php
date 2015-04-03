<div id="form">
<form method="post" action="<?php echo base_url('xu-ly-quen-mat-khau.html') ?>">
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
    <label>Địa chỉ Email </label>
    <input required="required" type="text" name="email" class="form-control" />
    <?php echo form_error('email', '<br><p class="text-warning">', '</p>'); ?>
    <br />
    <div class="text-center">
        <input class="btn btn-primary" type="submit" name="tieptuc" value="Tiếp tục" />
        <input class="btn btn-primary"  type="reset" name="reset" value="Nhập lại" />
    </div>
</form>
</div>