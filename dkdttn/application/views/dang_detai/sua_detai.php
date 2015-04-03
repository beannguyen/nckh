<?php
$mess = $this->session->userdata('mess');
if (!empty($mess))
{
    echo '<div class="alert alert-success">'.$this->session->userdata('mess').'</div>';
    $this->session->unset_userdata('mess');
}
?>
<?php
if(!empty($info_detai))
{
    ?>
        <form id="frm_suadetai" class="form-horizontal" method="post" action="<?php echo site_url('user/xu-ly-sua-de-tai') ?>">
            <div class="form-group">
                <input type="hidden" name="detai_id" value="<?php echo end($this->uri->segments) ?>" />
                <label class="col-sm-2 control-label">Chuyên ngành</label>
                <div class="col-sm-4">
                    <select class="form-control" name="chuyen_nganh">
                        <?php $chuyen_nganh = $info_detai->chuyennganh ?> 
                        <option value="1" <?php if ($chuyen_nganh == '1') echo 'selected' ?>>Công nghệ phần mềm</option>
                        <option value="3" <?php if ($chuyen_nganh == '3') echo 'selected' ?>>Mạng máy tính</option>
                        <option value="2" <?php if ($chuyen_nganh == '2') echo 'selected' ?>>Hệ thống thông tin</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên đề tài </label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="ten_detai" name="ten_detai"><?php echo $info_detai->tendetai ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Yêu cầu</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="yeucau" name="yeu_cau"><?php echo $info_detai->yeucau ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Sản phẩm</label>
                <div class="col-sm-10">
                     <textarea class="form-control" rows="3" id="sanpham" name="san_pham"><?php echo $info_detai->sanpham ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Mục tiêu</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="muc_tieu"><?php echo $info_detai->muctieu ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Số lượng SV</label>
                <div class="col-sm-2">
                    <select class="form-control text-center" name="so_luong_sv">
                        <?php
                            for ($i=1;$i<=$info_cauhinh->soluongSVtoida;$i++)
                            {
                                ?>
                                    <option <?php if ($i==$info_detai->soluongSVtoida) echo "selected" ?> ><?php echo $i ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Trạng thái</label>
                <div class="col-sm-4">
                    <select class="form-control text-center" name="trang_thai">
                        <option value="1" <?php if ($info_detai->trangthai == 1) echo 'selected' ?>>Được tạo ra</option>
                        <option value="2" <?php if ($info_detai->trangthai == 2) echo 'selected' ?>>Được bảo vệ</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Chú thích</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="chu_thich"><?php echo $info_detai->chuthich ?></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-2"></div>
                <p class="col-sm-5 text-danger" style="text-align: left!important;"><input type="checkbox" name="khac_cn" <?php if ($info_detai->duocdkkhaccn == 1) echo "checked" ?> /> Được phép đăng ký khác chuyên ngành</p>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-default" value="Save Change"/>
                  <input type="reset" class="btn btn-default" value="Nhập lại"/>
                </div>
            </div>
        </form>
    <?php
}
?>
<script>
    $(document).ready(function(){
        $("#frm_suadetai").submit(function(e){
            if ($("#ten_detai").val()=='') {alert("Tên đề tài chưa nhập");$("#ten_detai").focus();return false;}
            else if ($("#yeucau").val()=='') {alert("Yêu cầu đề tài chưa nhập");$("#yeucau").focus();return false;}
            else if ($("#sanpham").val()=='') {alert("Sản phẩm đề tài chưa nhập");$("#sanpham").focus();return false;}
            else return true;
    });
    });
</script>