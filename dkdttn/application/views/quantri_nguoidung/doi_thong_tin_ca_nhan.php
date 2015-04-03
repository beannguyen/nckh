<div id="form">
<form method="post" action="<?php echo base_url('user/xu-ly-doi-thong-tin-ca-nhan.html') ?>">
    <?php
        $thongbao=$this->session->userdata('ses_thongbao');
        if (!empty($thongbao))
        {
            ?>
                <div class="alert alert-success">
            <?php
            echo $this->session->userdata('ses_thongbao')."<br>";
            $this->session->unset_userdata('ses_thongbao');
            ?>
                </div>
            <?php
        }
    ?>
    
    <div class="form-group">
        <label for="inputEmail1" class="control-label">Email</label>
        <input type="email" required="required" name="email" class="form-control" id="inputEmail1" value="<?php if (!empty($query_info)) echo $query_info->email ?>" placeholder="Email"/>
    </div>
    <div class="form-group">
        <label for="inputSDT" class="control-label">Số điện thoại</label>
        <div>
          <input required="required" name="phone" class="form-control" id="inputSDT" value="<?php  if (!empty($query_info)) echo $query_info->phone ?>"  placeholder="Số điện thoại"/>
        </div>
    </div>
    <div class="text-center">
        <input class="btn btn-primary" type="submit" name="luuthongtin" value="Lưu thông tin" />
        <input class="btn btn-primary"  type="reset" name="reset" value="Nhập lại" />
    </div>
</form>
</div>