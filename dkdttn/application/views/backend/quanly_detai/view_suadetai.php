<h3>ID: <?php echo $detai_id ?></h3>
<hr />
<form class="form-horizontal" role="form">
  <input type="hidden" id="detai_id" value="<?php echo $detai_id ?>" /> 
  <div class="form-group">
    <label class="col-sm-2 control-label">Loại đề tài</label>
    <div class="col-sm-6">
      <select class="form-control" name="cauhinh_id" id="cauhinh_id">
        <?php if (!empty($ds_cauhinh)): ?>
            <?php foreach ($ds_cauhinh as $ds_ch): ?>
                <option value="<?php echo $ds_ch->id ?>"><?php echo $ds_ch->tenloai.' Khóa 20'.$ds_ch->TenNK ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Giảng viên</label>
    <div class="col-sm-6">
      <select class="form-control" name="giangvien_id" id="giangvien_id">
        <?php if (!empty($ds_giangvien)): ?>
            <?php foreach ($ds_giangvien as $ds_gv): ?>
                <option <?php if ($arr_GVHD->id == $ds_gv->id) echo 'selected'; ?> value="<?php echo $ds_gv->id ?>"><?php echo $ds_gv->name; ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Chuyên ngành</label>
    <div class="col-sm-4">
        <select class="form-control" name="chuyen_nganh" id="chuyen_nganh">
            <?php foreach($ds_chuyennganh as $ds_cn): ?>
                <option <?php if($chitiet_detai->chuyennganh == $ds_cn->id) echo 'selected'; ?> value="<?php echo $ds_cn->id ?>"><?php echo $ds_cn->TenCN ?></option>
            <?php endforeach; ?>
        </select>
    </div>
  </div>
  <div class="form-group">
        <label class="col-sm-2 control-label">Tên đề tài (*)</label>
        <div class="col-sm-10">
            <textarea required="required" class="form-control" rows="3" name="ten_detai" id="ten_detai"><?php echo $chitiet_detai->tendetai ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Yêu cầu (*)</label>
        <div class="col-sm-10">
            <textarea required="required" class="form-control" rows="3" name="yeu_cau" id="yeu_cau"><?php echo $chitiet_detai->yeucau ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Sản phẩm (*)</label>
        <div class="col-sm-10">
             <textarea required="required" class="form-control" rows="3" name="san_pham" id="san_pham"><?php echo $chitiet_detai->sanpham ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Mục tiêu</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" name="muc_tieu" id="muc_tieu"><?php echo $chitiet_detai->muctieu ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Số lượng SV</label>
        <div class="col-sm-2">
            <select class="form-control text-center" name="so_luong_sv" id="so_luong_sv">
                <?php
                    for ($i=1;$i<=5;$i++)
                    {
                        ?>
                            <option <?php if ($chitiet_detai->soluongSVtoida == $i) echo 'selected'; ?> ><?php echo $i ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="mssv_nt" placeholder="Nhóm trưởng" />
        </div>
        <?php
        if($chitiet_detai->soluongSVtoida > 1)
        {
            ?>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="mssv_tv" placeholder="Thành viên" />
            </div>
            <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Trạng thái</label>
        <div class="col-sm-4">
            <select class="form-control text-center" name="trang_thai" id="trang_thai">
                <option <?php if($chitiet_detai->trangthai == 1) echo 'selected' ?> value="1">Được tạo ra</option>
                <option <?php if($chitiet_detai->trangthai == 2) echo 'selected' ?> value="2">Được bảo vệ</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Chú thích</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" name="chu_thich" id="chuthich"><?php echo $chitiet_detai->chuthich ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <p class="col-sm-5 text-danger" style="text-align: left!important;"><input <?php if($chitiet_detai->duocdkkhaccn == 1) echo 'checked' ?> type="checkbox" name="khac_cn" id="khac_cn" /> Được phép đăng ký khác chuyên ngành</p>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="button" id="btn-mod" class="btn btn-default" value="Sửa đề tài"/>
          <input type="reset" class="btn btn-default" value="Nhập lại"/>
        </div>
    </div>
</form>
<script>
$(document).ready(function(){
    $("#btn-mod").click(function(){
        if($("#ten_detai").val() == '') {alert("Vui lòng nhập Tên đề tài");$("#ten_detai").focus();return false;}
        else if($("#yeu_cau").val() == '') {alert("Vui lòng nhập Yêu cầu");$("#yeu_cau").focus();return false;}
        else if($("#san_pham").val() == '') {alert("Vui lòng nhập Sản phẩm");$("#san_pham").focus();return false;}
        else
        {
            $("#loading").show();
            var form_data_mod = {
                submit_suadt:  'yes',
                id_detai    :   $("#detai_id").val(),
                ten_detai   :   $("#ten_detai").val(),
                yeu_cau     :   $("#yeu_cau").val(),
                san_pham    :   $("#san_pham").val(),
                muc_tieu    :   $("#muc_tieu").val(),
                so_luong_sv :   $("#so_luong_sv").val(),
                trang_thai  :   $("#trang_thai").val(),
                chuthich    :   $("#chuthich").val(),
                khac_cn     :   $("#khac_cn").prop("checked") ? 1 : 0,
                cauhinh_id  :   $("#cauhinh_id").val(),
                giangvien_id:   $("#giangvien_id").val(),
                chuyen_nganh:   $("#chuyen_nganh").val(),
                mssv_nt     :   $("#mssv_nt").val(),
                mssv_tv     :   $("#mssv_tv").val(),
            };
            $.ajax({
                url     :   "<?php echo site_url('user/cau-hinh-giang-vien-ajax') ?>",
                type    :   "post",
                data    :   form_data_mod,
                success:function(msg_mod){
                    $("#loading").hide();
                    if(msg_mod == 'ok'){
                        window.location.reload();
                    }else {
                        alert(msg_mod);
                    }
                }
            })
        }
    })
})
</script>

