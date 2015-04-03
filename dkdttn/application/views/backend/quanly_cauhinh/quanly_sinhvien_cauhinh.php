<?php
$mess = $this->session->userdata('mess');
if (!empty($mess))
{
    echo $this->session->userdata('mess');
    $this->session->unset_userdata('mess');
}
?>
<a href="<?php echo site_url('user/xoa-tat-ca-sinh-vien-cau-hinh/'.$cauhinh_id) ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa danh sách này không ?');">Xóa danh sách</a>
<a data-toggle="modal" data-target="#myModal" class="btn btn-primary pull-right">Thêm sinh viên</a>
<br />
<hr />
<h4 class="text-primary text-center">Danh sách sinh viên được phép đăng ký <?php echo @$ten_cauhinh ?></h4>
<?php if (!empty($sinhvien_cauhinh)): ?>
<table class="table demo" data-page-size="5">
	<thead>
		<tr>
            <th style="width: 50px;">STT</th>
			<th data="true">MSSV</th>
			<th>Họ tên</th>
            <th data-hide="phone">C.Ngành</th>
            <th></th>
		</tr>
	</thead>
	<tbody>
        <?php $i=1; ?>
        <?php foreach ($sinhvien_cauhinh as $rows): ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rows->username ?></td>
                <td><?php echo $rows->name ?></td>
                <td><?php echo $this->my_lib->get_first_letter($this->m_admin->get_CN($rows->chuyennganh)->TenCN);$i++; ?></td>
                <td style="text-align: center;"><a class="btn btn-danger btn-xs" href="<?php echo site_url('user/xoa-sinh-vien-cau-hinh/'.$cauhinh_id.'/'.$rows->id) ?>" onClick="return confirm('Bạn sẽ xóa sinh viên <?php echo $rows->name.' - '.$rows->username ?> ra khỏi danh sách đăng ký ?');">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
	</tbody>
	<tfoot>
		
	</tfoot>
</table>
<?php endif ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Thêm sinh viên</h4>
      </div>
      <div class="modal-body">
            <form class="form-horizontal" method="post" action="<?php echo site_url('user/them-sinh-vien-cau-hinh') ?>">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nhập MSSV</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" required="required" name="mssv" />
                        <input type="hidden" name="cauhinh_id" value="<?php echo $cauhinh_id ?>" />
                    </div>
                    <div class="col-sm-3">
                        <input type="submit" name="submit_mssv" class="btn btn-primary" value="Thêm sinh viên" />
                    </div>
                </div>
            </form>
            <hr />
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('user/them-sinh-vien-cau-hinh') ?>">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Chọn file excel </label>
                    <div class="col-sm-6">
                        <input type="file" name="ds_sinhvien" class="form-control" required="required" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                        <input type="hidden" name="cauhinh_id" value="<?php echo $cauhinh_id ?>" />
                    </div>
                    <div class="col-sm-3">
                        <input type="submit" name="submit_ds_mssv"  class="btn btn-primary text-center btn-sm" value="Thêm danh sách" />
                    </div>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->