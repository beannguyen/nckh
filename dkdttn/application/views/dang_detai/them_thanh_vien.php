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
<form class="form-horizontal" method="post" action="<?php echo site_url('user/xu-ly-them-sinh-vien-de-tai') ?>">
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <h3 class="text-danger "><?php echo @$info_detai->tendetai ?></h3>
        </div>
    </div>
    <?php
        if (!empty($info_detai))
        {
            if ($info_detai->soluongSVtoida == '1')
            {
                ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nhóm trưởng </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nhom_truong" />
                        </div>
                    </div>
                <?php
            }
            else
            {
                ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">MSSV Nhóm trưởng </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nhom_truong" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Thành viên </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="thanh_vien" />
                        </div>
                    </div>
                
                <?php
            }
        }
    ?>
    <input type="hidden" name="detai_id" value="<?php echo end($this->uri->segments) ?>" />
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <input type="submit" class="btn btn-info" value="Save Changes" />
            <input type="reset" class="btn btn-default" value="Nhập lại" />
        </div>
    </div>
</form>