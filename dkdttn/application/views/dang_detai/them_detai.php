<?php
$mess = $this->session->userdata('mess');
if (!empty($mess))
{
    echo '<div class="alert alert-success">'.$this->session->userdata('mess').'</div>';
    $this->session->unset_userdata('mess');
}
?>
<?php
if(!empty($info_cauhinh))
{
    ?>
        <form id="frm_themdetai" class="form-horizontal" method="post" action="<?php echo base_url('user/xu-ly-them-de-tai') ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <label class="text-danger"><?php echo $info_cauhinh->tenloai.' '.'Khoá 20'.$info_cauhinh->TenNK ?></label>
                    <input type="hidden" name="loai_detai" value="<?php echo $info_cauhinh->loaidetai_id ?>" />
                    <input type="hidden" name="nien_khoa" value="<?php echo $info_cauhinh->nienkhoa ?>" />
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Chuyên ngành</label>
                <div class="col-sm-4">
                    <select class="form-control" name="chuyen_nganh">
                        <?php $chuyen_nganh = $this->session->userdata('id_chuyennganh') ?> 
                        <option value="1" <?php if ($chuyen_nganh == '1') echo 'selected' ?>>Công nghệ phần mềm</option>
                        <option value="3" <?php if ($chuyen_nganh == '3') echo 'selected' ?>>Mạng máy tính</option>
                        <option value="2" <?php if ($chuyen_nganh == '2') echo 'selected' ?>>Hệ thống thông tin</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên đề tài (*)</label>
                <div class="col-sm-10">
                    <textarea required="required" class="form-control" rows="3" name="ten_detai" id="ten_detai"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Yêu cầu (*)</label>
                <div class="col-sm-10">
                    <textarea required="required" class="form-control" rows="3" name="yeu_cau" id="yeucau"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Sản phẩm (*)</label>
                <div class="col-sm-10">
                     <textarea required="required" class="form-control" rows="3" name="san_pham" id="sanpham"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Mục tiêu</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="muc_tieu" id="muc_tieu"></textarea>
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
                                    <option <?php if ($i==2) echo "selected" ?> ><?php echo $i ?></option>
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
                        <option value="1">Được tạo ra</option>
                        <option value="2">Được bảo vệ</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Chú thích</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="chu_thich" id="chuthich"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2"></div>
                <p class="col-sm-5 text-danger" style="text-align: left!important;"><input type="checkbox" <?php if ($info_cauhinh->loaidetai_id == 1) echo "checked" ?> name="khac_cn" /> Được phép đăng ký khác chuyên ngành</p>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-default" value="Thêm đề tài"/>
                  <input type="reset" class="btn btn-default" value="Nhập lại"/>
                </div>
            </div>
        </form>
    <?php
}
?>
<script>
    $(document).ready(function(){
        $("#frm_themdetai").submit(function(e){
            if ($("#ten_detai").val()=='') {alert("Tên đề tài chưa nhập");$("#ten_detai").focus();return false;}
            else if ($("#yeucau").val()=='') {alert("Yêu cầu đề tài chưa nhập");$("#yeucau").focus();return false;}
            else if ($("#sanpham").val()=='') {alert("Sản phẩm đề tài chưa nhập");$("#sanpham").focus();return false;}
            else return true;
    });
    });
</script>
