<div id="form" class="form-group">
    <form method="post" action="<?php echo base_url('user/xu-ly-them-thanh-vien.html') ?>">
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
        <label>Nhập MSSV</label>
        <input type="text" required="required" name="mssv_thanhvien" class="form-control" value="<?php echo set_value('mssv_thanhvien', @$this->uri->segment(3)); ?>" />
        <?php echo form_error('mssv_thanhvien', '<div class="text-danger">', '</div>'); ?>
        <label>Xác nhận MSSV</label>
        <input type="text" required="required" name="cf_mssv_thanhvien" value="<?php echo @$this->uri->segment(3) ?>" class="form-control"/>
        <?php echo form_error('cf_mssv_thanhvien', '<div class="text-danger">', '</div>'); ?>
        <br />
        <div class="text-center">
            <input class="btn btn-primary" type="submit" value="Thêm" name="them"/>
            <input class="btn btn-primary" type="reset" value="Nhập lại" name="reset"/>
        </div>
    </form>
</div>