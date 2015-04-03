<?php
    echo $this->session->userdata('mess');
    $this->session->unset_userdata('mess');
?>
<h3>Danh sách niên khóa</h3>
<p style="text-align: right;"><button class="btn btn-primary" data-toggle="modal" data-target="#frm_themnk">Thêm niên khóa</button></p>

<table class="table demo" data-page-size="5">
    <thead>
		<tr>
            <th data="true" style="width: 50px!important;">ID</th>
            <th data="true">Tên NK</th>
			<th data-hide="phone">Năm BĐ</th>
			<th data-hide="phone">Năm KT</th>
            <th data="true">Thao tác</th>
		</tr>
	</thead>
    <tbody>
        <?php if (!empty($ds_nienkhoa)):   ?>
            <?php foreach ($ds_nienkhoa as $ds_nk): ?>
                <tr id="<?php echo $ds_nk->id ?>">
                    <td><?php echo $ds_nk->id ?></td>
                    <td><?php echo $ds_nk->TenNK ?></td>
                    <td><?php echo $ds_nk->NamBD ?></td>
                    <td><?php echo $ds_nk->NamKT ?></td>
                    <td>
                        <div class="btn-group">
                            <a rel="<?php echo $ds_nk->id ?>" href="javascript:void();" class="btn btn-danger btn-xs btn_xoa">Xóa</a>
                            <button data-toggle="modal" data-target="#frm_suank_<?php echo $ds_nk->TenNK ?>" class="btn btn-warning btn-xs">Sửa</button>
                        </div>
                    </td>
                </tr>
                <!-- Sửa form -->
                <!-- Modal -->
                <div class="modal fade" id="frm_suank_<?php echo $ds_nk->TenNK ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Sửa niên khóa</h4>
                      </div>
                      <form method="post" action="<?php echo site_url('user/quan-ly-nien-khoa') ?>">       
                          <div class="modal-body">
                            <input type="hidden" name="id_nk" value="<?php echo $ds_nk->id ?>" />
                            <label>Tên NK</label>
                            <input value="<?php echo $ds_nk->TenNK ?>" required="required" type="text" class="form-control" name="tennk" pattern="\d*" />
                            <br />
                            <label>Năm BĐ</label>
                            <input value="<?php echo $ds_nk->NamBD ?>" required="required" type="text" class="form-control" name="nambd" pattern="\d*" />
                            <br />
                            <label>Năm KT</label>
                            <input value="<?php echo $ds_nk->NamKT ?>" required="required" type="text" class="form-control" name="namkt" pattern="\d*" />
                            <br />
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="sua_nk">Save</button>
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
<div class="modal fade" id="frm_themnk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Thêm niên khóa mới</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="<?php echo site_url('user/quan-ly-nien-khoa') ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên NK</label>
                <div class="col-sm-8">
                    <input required="required" type="text" class="form-control" name="tennk" pattern="\d*" />
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="them_nk">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $(".btn_xoa").click(function(){
            var id = $(this).attr('rel');
            if (confirm("Bạn có muốn xóa niên khóa id: " + id + " không ?"))
            {
                $.ajax({
                    type : "post",
                    url  : '<?php echo site_url('user/quan-ly-nien-khoa') ?>',
                    data : {'id' : id,'xoa_nk' : 'yes'},
                    success:function(msg_xoank){
                        if (msg_xoank == 'ok')
                        {
                            alert('Xóa thành công');
                            window.location.href = "<?php echo site_url('user/quan-ly-chung') ?>"
                        }
                        else 
                        {
                            alert(msg_xoank);
                        }
                    }
                })
            }
            return false;
        })
    })
</script>