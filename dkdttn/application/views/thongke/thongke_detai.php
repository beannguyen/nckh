<h3 class="text-center text-danger">Thống kê đề tài</h3>
<form class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-4 control-label">Loại đề tài</label>
        <div class="col-sm-4">
            <select class="form-control" id="loai_detai_dt">
                <option value="0">Chọn loại đề tài</option>
                <?php foreach ($ds_loaidt as $rows): ?>
                    <option value="<?php echo $rows->id ?>"><?php echo $rows->tenloai.' '.$rows->NamBD ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</form>
<div id="thongke_detai_area"></div>
<script>
$(document).ready(function(){
    $("#loai_detai_dt").change(function(){
        var id_dt = $(this).val();
        if (id_dt != '0')
        {
            //alert(id);
            var form_data = {
                thongke_detai : 1,
                cauhinh_id_dt : id_dt,
            };
            $("#loading").show();
            $.ajax({
                url:'<?php echo site_url('thong-ke-de-tai') ?>',
                type:'POST',
                async:true,
                data: form_data,
                success:function(msg_tk_dt){
                    //alert(msg_tk);
                    $("#loading").hide();
                    $("#thongke_detai_area").html(msg_tk_dt);   
                }
            })
        }
    })
})
</script>