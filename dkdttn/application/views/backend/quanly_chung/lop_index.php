<?php
    echo $this->session->userdata('mess');
    $this->session->unset_userdata('mess');
?>
<h3>Danh sách lớp</h3>
<p style="text-align: right;"><button class="btn btn-danger" data-toggle="modal" data-target="#frm_themlop">Thêm lớp mới</button></p>

<table class="table demo" data-page-size="5">
    <thead>
		<tr>
            <th data="true" style="width: 50px!important;">ID</th>
            <th data="true">Tên Lớp</th>
			<th data="truw">Tên NK</th>
            <th data="true">Thao tác</th>
		</tr>
	</thead>
    <tbody>
        <?php if (!empty($ds_lop)):   ?>
            <?php foreach ($ds_lop as $ds_lop): ?>
                <tr>
                    <td><?php echo $ds_lop->id ?></td>
                    <td><?php echo $ds_lop->TenLop ?></td>
                    <td><?php echo $ds_lop->TenNK ?></td>

                    <td>
                        <div class="btn-group">
                            <a rel="<?php echo $ds_lop->id ?>" href="javascript:void();" class="btn btn-danger btn-xs btn_xoa_lop">Xóa</a>
                            <button data-toggle="modal" data-target="#frm_sualop_<?php echo $ds_lop->id ?>" class="btn btn-warning btn-xs">Sửa</button>
                        </div>
                    </td>
                </tr>
                <!-- Sửa form -->
                <!-- Modal -->
                <div class="modal fade" id="frm_sualop_<?php echo $ds_lop->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Cập nhật lớp</h4>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" method="post" action="<?php echo site_url('user/quan-ly-lop') ?>">
                            <input type="hidden" name="lop_id" value="<?php echo $ds_lop->id ?>" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-6">
                                    <select name="nienkhoa_id" class="form-control">
                                        <?php foreach ($ds_nienkhoa as $ds_nk): ?>
                                            <option <?php if ($ds_lop->nienkhoa == $ds_nk->id) echo 'selected'; ?> value="<?php echo $ds_nk->id ?>"><?php echo $ds_nk->TenNK ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <p class="clearfix"></p>
                                <label class="col-sm-3 control-label">Tên Lớp</label>
                                <div class="col-sm-8">
                                    <input value="<?php echo $ds_lop->TenLop ?>" required="required" type="text" class="form-control" name="tenlop" pattern="\d*" />
                                </div>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="sua_lop">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                        </form>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<!-- Thêm form -->
<!-- Modal -->
<div class="modal fade" id="frm_themlop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Thêm lớp mới</h4>
      </div>
      <div class="modal-body">
        <form id="them_lop" class="form-horizontal" method="post" action="<?php echo site_url('user/quan-ly-lop') ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-6">
                    <select id="chon_nk" name="nienkhoa_id" class="form-control">
                        <option value="0">Chọn niên khóa</option>
                        <?php foreach ($ds_nienkhoa as $ds_nk): ?>
                            <option value="<?php echo $ds_nk->id ?>"><?php echo $ds_nk->TenNK ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <p class="clearfix"></p>
                <label class="col-sm-2 control-label">Tên Lớp</label>
                <div class="col-sm-8">
                    <input required="required" type="text" class="form-control" name="tenlop" pattern="\d*" />
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="them_lop">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $("#them_lop").submit(function(e){
            var id = $("#chon_nk").val();
            if (id == 0)
            {
                alert('Vui lòng chọn niên khóa');
                return false;
            }
        })
    })
</script>
<script>
    $(document).ready(function(){
        $(".btn_xoa_lop").click(function(){
            var id = $(this).attr('rel');
            if (confirm("Bạn có muốn xóa lớp id: " + id + " không ?"))
            {
                $.ajax({
                    type : "post",
                    url  : '<?php echo site_url('user/quan-ly-lop') ?>',
                    data : {'id' : id,'xoa_lop' : 'yes'},
                    success:function(msg_xoa_lop){
                        if (msg_xoa_lop == 'ok')
                        {
                            alert('Xóa thành công');
                            window.location.href = "<?php echo site_url('user/quan-ly-chung') ?>"
                        }
                        else 
                        {
                            alert(msg_xoa_lop);
                        }
                    }
                })
            }
            return false;
        })
    })
</script>
