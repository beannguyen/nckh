<?php
    echo $this->session->userdata('mess');
    $this->session->unset_userdata('mess');
?>
<div class="row">
    <div class="col-md-5 col-xs-4">
        <form>
            <select class="form-control" id="cbo_loaidt">
                <option value="0">Chọn loại đề tài</option>
                <?php if (!empty($ds_cauhinh)): ?>
                    <?php foreach ($ds_cauhinh as $ds_ch): ?>
                        <option <?php if (@$select_ch == $ds_ch->id) echo 'selected' ?> value="<?php echo $ds_ch->id ?>"><?php echo $ds_ch->tenloai.' Khóa 20'.$ds_ch->TenNK ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </form>
    </div>
    <div class="col-md-4 col-xs-4">
        <form>
            <select class="form-control" id="cbo_giangvien">
                <option value="gv_0">Chọn giảng viên</option>
                <?php if (!empty($ds_giangvien)): ?>
                    <?php foreach ($ds_giangvien as $ds_gv): ?>
                        <option <?php if (@$select_gv == $ds_gv->id) echo 'selected' ?> value="<?php echo $ds_gv->id ?>"><?php echo $ds_gv->name; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </form>
    </div>
    <div class="col-md-3 col-xs-4">
        <button class="btn btn-primary" id="btn-themdt">Thêm đề tài mới</button>
    </div>
</div>
<br />
<!-- Button trigger modal -->
<div class="btn-group">
    <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Thêm danh sách đề tài</button>
    <button class="btn btn-danger" data-toggle="modal" data-target="#myModal1">Xóa danh sách đề tài</button>
</div>
<br />

<div id="list_detai"></div>
<div id="them_detai"></div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('user/cau-hinh-giang-vien-ajax') ?>">
            <div class="form-group">
            <label class="col-sm-3">Loại đề tài</label>
            <div class="col-sm-9">
                <select class="form-control" name="cbo_list_dt">
                    <?php if (!empty($ds_cauhinh)): ?>
                        <?php foreach ($ds_cauhinh as $ds_ch): ?>
                            <option <?php if (@$select_ch == $ds_ch->id) echo 'selected' ?> value="<?php echo $ds_ch->id ?>"><?php echo $ds_ch->tenloai.' Khóa 20'.$ds_ch->TenNK ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Chọn file excel </label>
                <div class="col-sm-9">
                    <input type="file" name="ds_detai" class="form-control" required="required" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit_them_list_dt" class="btn btn-primary">Save changes</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('user/cau-hinh-giang-vien-ajax') ?>">
            <div class="form-group">
            <label class="col-sm-3">Loại đề tài</label>
            <div class="col-sm-9">
                <select class="form-control" name="cbo_list_del_dt">
                    <?php if (!empty($ds_cauhinh)): ?>
                        <?php foreach ($ds_cauhinh as $ds_ch): ?>
                            <option <?php if (@$select_ch == $ds_ch->id) echo 'selected' ?> value="<?php echo $ds_ch->id ?>"><?php echo $ds_ch->tenloai.' Khóa 20'.$ds_ch->TenNK ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit_del_list_detai" class="btn btn-danger">Delete All</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    
    $("#cbo_loaidt").change(function(){
        $("#cbo_giangvien").prop('selectedIndex',0);
    });
    $("#cbo_giangvien").change(function(){
        var uri = '<?php echo base_url('user/danh-sach-de-tai-admin/') ?>';
        var id_gv = $(this).val();
        var id_ch = $("#cbo_loaidt").val();
        var url = uri.concat("/",id_gv,"/",id_ch);
        if (id_ch == 0)
        {
            alert('Vui lòng chọn loại đề tài trước');
            $(this).prop('selectedIndex',0);
        }
        else
        {
            window.location.href = url;
        }
    });
    //load view them de tai
    $("#btn-themdt").click(function(){
        $("#loading").show();
        $.ajax({
            url     :   '<?php echo site_url('user/cau-hinh-giang-vien-ajax') ?>',
            type    :   'post',
            data    :   {'them_dt' : 'yes'},
            success:function(msg_load_themdt){
                $("#loading").hide();
                $("#them_detai").html(msg_load_themdt);
            }
        })
    });
})
</script>