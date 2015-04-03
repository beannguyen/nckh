<?php
    echo $this->session->userdata('mess');
    $this->session->unset_userdata('mess');
?>
<h3>Danh sách chuyên ngành</h3>
<p style="text-align: right;"><button class="btn btn-success" data-toggle="modal" data-target="#frm_themcn">Thêm chuyên ngành mới</button></p>

<table class="table demo" data-page-size="5">
    <thead>
		<tr>
            <th data="true" style="width: 50px!important;">ID</th>
            <th data="true">Tên CN</th>
            <th data="true">Thao tác</th>
		</tr>
	</thead>
    <tbody>
        <?php if (!empty($ds_chuyennganh)):   ?>
            <?php foreach ($ds_chuyennganh as $ds_cn): ?>
                <tr>
                    <td><?php echo $ds_cn->id ?></td>
                    <td><?php echo $ds_cn->TenCN ?></td>
                    <td>
                        <div class="btn-group">
                            <a rel="<?php echo $ds_cn->id ?>" href="javascript:void();" class="btn btn-danger btn-xs btn_xoa_cn">Xóa</a>
                            <button data-toggle="modal" data-target="#frm_suacn_<?php echo $ds_cn->id ?>" class="btn btn-warning btn-xs">Sửa</button>
                        </div>
                    </td>
                </tr>
                <!-- Sửa form -->
                <!-- Modal -->
                <div class="modal fade" id="frm_suacn_<?php echo $ds_cn->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Sửa chuyên ngành</h4>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" method="post" action="<?php echo site_url('user/quan-ly-chuyen-nganh') ?>">
                        <input type="hidden" name="id_chuyennganh" value="<?php echo $ds_cn->id ?>" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tên CN</label>
                                <div class="col-sm-8">
                                    <input value="<?php echo $ds_cn->TenCN ?>" required="required" type="text" class="form-control" name="tencn" />
                                </div>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="sua_cn">Save</button>
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
<div class="modal fade" id="frm_themcn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Thêm chuyên ngành mới</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="<?php echo site_url('user/quan-ly-chuyen-nganh') ?>">
            <div class="form-group">
                <p class="clearfix"></p>
                <label class="col-sm-2 control-label">Tên CN</label>
                <div class="col-sm-8">
                    <input required="required" type="text" class="form-control" name="tencn" />
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="them_cn">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $(".btn_xoa_cn").click(function(){
            var id = $(this).attr('rel');
            if (confirm("Bạn có muốn xóa chuyên ngành id: " + id + " không ?"))
            {
                $.ajax({
                    type : "post",
                    url  : '<?php echo site_url('user/quan-ly-chuyen-nganh') ?>',
                    data : {'id' : id,'xoa_cn' : 'yes'},
                    success:function(msg_xoa_cn){
                        if (msg_xoa_cn == 'ok')
                        {
                            alert('Xóa thành công');
                            window.location.href = "<?php echo site_url('user/quan-ly-chung') ?>"
                        }
                        else 
                        {
                            alert(msg_xoa_cn);
                        }
                    }
                })
            }
            return false;
        })
    })
</script>