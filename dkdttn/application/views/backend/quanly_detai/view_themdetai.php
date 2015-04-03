<h3>Thêm đề tài mới</h3>
<hr />
<form method="post" action="<?php echo site_url('user/cau-hinh-giang-vien-ajax') ?>" class="form-horizontal" role="form">
  <input type="hidden" name="submit_themdt" />
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
                <option value="<?php echo $ds_gv->id ?>"><?php echo $ds_gv->name; ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Chuyên ngành</label>
    <div class="col-sm-4">
        <select class="form-control" name="chuyen_nganh" id="chuyen_nganh">
            <option value="1">Công nghệ phần mềm</option>
            <option value="3">Mạng máy tính</option>
            <option value="2">Hệ thống thông tin</option>
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
            <textarea required="required" class="form-control" rows="3" name="yeu_cau" id="yeu_cau"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Sản phẩm (*)</label>
        <div class="col-sm-10">
             <textarea required="required" class="form-control" rows="3" name="san_pham" id="san_pham"></textarea>
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
            <select class="form-control text-center" name="so_luong_sv" id="so_luong_sv">
                <?php
                    for ($i=1;$i<=5;$i++)
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
            <select class="form-control text-center" name="trang_thai" id="trang_thai">
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
        <p class="col-sm-5 text-danger" style="text-align: left!important;"><input type="checkbox" name="khac_cn" id="khac_cn" /> Được phép đăng ký khác chuyên ngành</p>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="button" id="btn-add" class="btn btn-default" value="Thêm đề tài"/>
          <input type="reset" class="btn btn-default" value="Nhập lại"/>
        </div>
    </div>
</form>
<script>
$(document).ready(function(){
    $("#btn-add").click(function(){
        if($("#ten_detai").val() == '') {alert("Vui lòng nhập Tên đề tài");$("#ten_detai").focus();return false;}
        else if($("#yeu_cau").val() == '') {alert("Vui lòng nhập Yêu cầu");$("#yeu_cau").focus();return false;}
        else if($("#san_pham").val() == '') {alert("Vui lòng nhập Sản phẩm");$("#san_pham").focus();return false;}
        else
        {
            $("#loading").show();
            var form_data_add = {
                submit_themdt:  'yes',
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
            };
            $.ajax({
                url     :   "<?php echo site_url('user/cau-hinh-giang-vien-ajax') ?>",
                type    :   "post",
                data    :   form_data_add,
                success:function(msg_add){
                    $("#loading").hide();
                    if (msg_add == 'ok'){
                        alert('Thêm thành công đề tài ' + $("#ten_detai").val());
                        $("#ten_detai").val('');
                        $("#yeu_cau").val('');
                        $("#san_pham").val('');
                        $("#muc_tieu").val(''),
                        $("chuthich").val(''),
                        $("#ten_detai").focus(); 
                    }else{
                         alert(msg_add);
                    }  
                }
            })
        }
    })
})
</script>
