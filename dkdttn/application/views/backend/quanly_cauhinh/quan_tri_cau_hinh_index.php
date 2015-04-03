<a href="<?php echo site_url('user/them-cau-hinh') ?>" class="btn btn-default pull-right">Thêm cấu hình mới</a>
<br />
<hr />
<?php if (!empty($ds_cauhinh)): ?>
<table class="table table-responsive">
    <thead>
        <tr class="danger">
            <th class="text-center">ID</th>
            <th>Tên CH</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ds_cauhinh as $rows): ?>
            <tr>
                <td style="text-align: center;"><span class="badge red"><?php echo $rows->id ?></span></td>
                <td><?php echo $rows->tenloai.' Khóa 20'.$rows->TenNK ?></td>
                <td>
                    <div class="btn-group pull-right">
                      <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                        Thao tác <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo site_url('user/chi-tiet-cau-hinh/'.$rows->id) ?>">Xem chi tiết</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('user/sua-cau-hinh/'.$rows->id) ?>">Sửa cấu hình</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Xóa cấu hình</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('user/quan-ly-sinh-vien-cau-hinh/'.$rows->id) ?>">Sinh viên - cấu hình</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('user/export-de-tai/'.$rows->id) ?>">Export danh sách đề tài</a></li>
                      </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php endif ?>