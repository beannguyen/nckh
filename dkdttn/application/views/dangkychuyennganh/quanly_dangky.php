<form class="form-horizontal">
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
        <div class="col-sm-offset-2 col-sm-10">
          <input id="btn_them_ch" name="btn_them_ch" type="button" class="btn btn-default" value="Xác nhận"/>
          <input type="reset" class="btn btn-default" value="Nhập lại"/>
        </div>
    </div>
</form>
<a href='<?php echo site_url('user/xuat-ket-qua-dang-ky-cn') ?>'>Xuất kết quả đăng ký</a>
<script>

$(document).ready(function(){
	$("#nienkhoa").val('<?php echo $cauhinh['nienkhoa']; ?>');
	$("#thoigianSVbatdaudk").val('<?php echo $cauhinh['date_start']; ?>');
	$("#thoigianSVketthucdk").val('<?php echo $cauhinh['date_end']; ?>');
    $("#btn_them_ch").click(function(e){
        e.preventDefault();
        
            var form_data= {
                btn_them_ch         : 'yes',
                nienkhoa            : $("#nienkhoa").val(),
                thoigianSVbatdaudk  : $("#thoigianSVbatdaudk").val(),
                thoigianSVketthucdk : $("#thoigianSVketthucdk").val()
                  
            };
            $.ajax({
                url:'<?php echo site_url('user/them-cau-hinh-dangky-cn') ?>',
                type:'POST',
                async:true,
                data: form_data,
                success:function(msg){
                    if (msg == "ok")
                    {
                        alert("Thêm đợt đăng ký thành công");
                    }
                    else 
                    {
                        alert(msg);
                    }
                }
            })
        
    })
})
</script>
