<form class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-3 control-label">Chọn loại đề tài</label>
        <div class="col-sm-4">
            <select class="form-control" id="loai_detai">
                <option value="2">Tiểu luận chuyên ngành</option>
                <option value="1">Đề tài tốt nghiệp</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Niên khóa</label>
        <div class="col-sm-4">
            <select id="nienkhoa" class="form-control">
                <?php foreach ($arr_nienkhoa as $nk): ?>
                    <option value="<?php echo $nk->id ?>"><?php echo $nk->NamBD ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Năm học</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="namhoc1" required="required" placeholder="Năm học 1" />
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="namhoc2" required="required" placeholder="Năm học 2" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Số lượng SV tối đa</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="max_sv" required="required" value="2" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Thời gian GV bắt đầu đăng ký</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="thoigianGVbatdaudk" name="thoigianGVbatdaudk" />
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
            <input type="text" class="form-control" id="thoigianGVketthucdk" name="thoigianGVketthucdk" />
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
            <input type="text" class="form-control" id="thoigianSVbatdaudk" name="thoigianSVbatdaudk" />
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
            <input type="text" class="form-control" id="thoigianSVketthucdk" name="thoigianSVketthucdk" />
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
            <input type="text" class="form-control" id="diemgioi" placeholder="gioi"  />
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="diemkha" placeholder="kha"  />
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="diemtb" placeholder="tb"  />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input id="btn_them_ch" name="btn_them_ch" type="button" class="btn btn-default" value="Thêm cấu hình"/>
          <input type="reset" class="btn btn-default" value="Nhập lại"/>
        </div>
    </div>
</form>
<script>
$(document).ready(function(){
    $("#btn_them_ch").click(function(e){
        e.preventDefault();
        if ($("#max_sv").val()=='' || $("#nienkhoa").val() == '' || $("#namhoc1").val()=='' || $("#namhoc2").val()=='' || $("#loai_detai").val()=='' || $("#diemgioi").val()=='' || $("#diemkha").val()=='' || $("#diemtb").val()=='')
        {
            alert('Vui lòng nhập đủ thông tin');
        }
        else
        {
            var form_data= {
                btn_them_ch         : 'yes',
                max_sv              : $("#max_sv").val(),
                nienkhoa            : $("#nienkhoa").val(),
                namhoc1             : $("#namhoc1").val(),
                namhoc2             : $("#namhoc2").val(),
                loai_detai          : $("#loai_detai").val(),
                diemgioi            : $("#diemgioi").val(),
                diemkha             : $("#diemkha").val(),
                diemtb              : $("#diemtb").val(),
                thoigianSVbatdaudk  : $("#thoigianSVbatdaudk").val(),
                thoigianSVketthucdk : $("#thoigianSVketthucdk").val(),
                thoigianGVbatdaudk  : $("#thoigianGVbatdaudk").val(),
                thoigianGVketthucdk : $("#thoigianGVketthucdk").val(),  
            };
            $.ajax({
                url:'<?php echo site_url('user/them-cau-hinh') ?>',
                type:'POST',
                async:true,
                data: form_data,
                success:function(msg){
                    if (msg == "ok")
                    {
                        window.location.href = "<?php echo site_url('user/manager-config') ?>";
                    }
                    else 
                    {
                        alert(msg);
                    }
                }
            })
        }
    })
})
</script>