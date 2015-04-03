<div id="form">
<form id="frm_conf_pass" method="post" action="<?php echo base_url('xu-ly-xac-nhan-quen-mat-khau.html') ?>">
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
    <input type="text" name="ten_dang_nhap" class="form-control" id="user_name" />
    <?php echo form_error('ten_dang_nhap', '<div class="error">', '</div>'); ?>
    
    <label>Mã xác nhận</label>
    <input type="text" name="code_verify" class="form-control" id="code_conf" />
    <?php echo form_error('code_verify', '<div class="error">', '</div>'); ?>
    <br />
    <div id="button_area">
        <input class="btn btn-primary" type="submit" name="tieptuc" value="Tiếp tục" />
        <input class="btn btn-primary"  type="reset" name="reset" value="Nhập lại" />
    </div>
</form>
</div>
<script>
    $(document).ready(function(){
        $("#frm_conf_pass").submit(function(e){
            if ($("#user_name").val()=='') {alert("Username chưa nhập");$("#user_name").focus();return false;}
            else if ($("#code_conf").val()=='') {alert("Mã xác nhận chưa nhập");$("#code_conf").focus();return false;}
            else return true;
    });
    });
</script>