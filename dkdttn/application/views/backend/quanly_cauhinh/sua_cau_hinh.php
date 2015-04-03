<p class="">Cập nhật lần cuối lúc : <span class="badge red"><?php echo date("H:i:s d/m/Y",strtotime($info_cauhinh->dateupdate)) ?></span></p>
<hr />
<form class="form-horizontal" method="post" action="<?php echo site_url('user/sua-cau-hinh') ?>">
    <input type="hidden" value="<?php echo $info_cauhinh->id ?>" name="cauhinh_id" />
    <div class="form-group">
        <label class="col-sm-4 control-label">Loại đề tài</label>
        <div class="col-sm-4">
            <select class="form-control" name="loai_detai">
                <option value="2" <?php if ($info_cauhinh->loaidetai_id == '2') echo 'selected' ?>>Tiểu luận chuyên ngành</option>
                <option value="1" <?php if ($info_cauhinh->loaidetai_id == '1') echo 'selected' ?>>Đề tài tốt nghiệp</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Niên khóa</label>
        <div class="col-sm-4">
            <select name="nienkhoa" class="form-control">
                <?php foreach ($arr_nienkhoa as $nk): ?>
                    <option <?php if ($nk->id == $info_cauhinh->nienkhoa) echo 'selected' ?> value="<?php echo $nk->id ?>"><?php echo $nk->NamBD ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Năm học</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="namhoc" required="required" value="<?php echo $info_cauhinh->namhoc ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Số lượng SV tối đa</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="max_sv" required="required" value="<?php echo $info_cauhinh->soluongSVtoida ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Thời gian GV bắt đầu đăng ký</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="thoigianGVbatdaudk" value="<?php echo $info_cauhinh->thoigianGVbatdaudk ?>" />
            <script type="text/javascript">
        		$(function(){
        			$('*[name=thoigianGVbatdaudk]').appendDtpicker({
        			 //"dateFormat": "DD-MM-YYYY hh:mm"
        			});
        		});
        	</script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Thời gian GV kết thúc đăng ký</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="thoigianGVketthucdk" value="<?php echo $info_cauhinh->thoigianGVketthucdk ?>" />
            <script type="text/javascript">
        		$(function(){
        			$('*[name=thoigianGVketthucdk]').appendDtpicker({
        			 //"dateFormat": "DD-MM-YYYY hh:mm"
        			});
        		});
        	</script>
        </div>
    </div>
        <div class="form-group">
        <label class="col-sm-4 control-label">Thời gian SV bắt đầu đăng ký</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="thoigianSVbatdaudk" value="<?php echo $info_cauhinh->thoigianSVbatdaudk ?>"/>
            <script type="text/javascript">
        		$(function(){
        			$('*[name=thoigianSVbatdaudk]').appendDtpicker({
        			 
        			});
        		});
        	</script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Thời gian SV kết thúc đăng ký</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="thoigianSVketthucdk" value="<?php echo $info_cauhinh->thoigianSVketthucdk ?>" />
            <script type="text/javascript">
        		$(function(){
        			$('*[name=thoigianSVketthucdk]').appendDtpicker({
        			 //"dateFormat": "DD-MM-YYYY hh:mm"
        			});
        		});
        	</script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Quy định điểm</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="diemgioi" value="<?php echo $info_cauhinh->diemGIOI ?>"  />
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="diemkha" value="<?php echo $info_cauhinh->diemKHA ?>" />
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="diemtb" value="<?php echo $info_cauhinh->diemTB ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input name="btn_sua_ch" type="submit" class="btn btn-default" value="Cập nhật"/>
          <input type="reset" class="btn btn-default" value="Nhập lại"/>
        </div>
    </div>
</form>