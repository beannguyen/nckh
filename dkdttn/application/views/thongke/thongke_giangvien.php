<h3 class="text-center text-danger">Thống kê đề tài theo Giảng Viên</h3>
<form class="form-horizontal">
    <div class="form-group">
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <select class="form-control" id="giangvien_cb">
                <option value="0">Chọn giảng viên</option>
                <?php foreach ($ds_giangvien as $rows_gv): ?>
                    <option value="<?php echo $rows_gv->id ?>"><?php echo $rows_gv->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-xs-3"></div>
    </div>
</form>
<div id="thongke_area_giangvien"></div>
<script>
$(document).ready(function(){
    $("#giangvien_cb").change(function(){
        var form_data = {
                thongke_gv      : 1,
                id_gv           : $("#giangvien_cb").val(),
            };
            $("#loading").show();
            $.ajax({
                url:'<?php echo site_url('thong-ke-giang-vien') ?>',
                type:'POST',
                async:true,
                data: form_data,
                success:function(msg_tk_gv){
                    //alert(msg_tk);
                    $("#loading").hide();
                    $("#thongke_area_giangvien").html(msg_tk_gv);   
                }
            })
    });
})
</script>
