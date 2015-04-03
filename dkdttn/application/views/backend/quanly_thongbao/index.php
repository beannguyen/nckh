<?php
    echo $this->session->userdata('mess');
    $this->session->unset_userdata('mess');
?>
<a href="<?php echo site_url('user/them-thong-bao') ?>" class="btn btn-default pull-right">Thêm thông báo</a>
<br />
<hr />
<h3 class="text-center">Danh sách thông báo</h3>
<table class="table demo table-responsive" data-page-size="5">
    <thead>
        <tr>
            <th>STT</th>
            <th>Thông báo</th>
            <th data-hide="tablet,phone">Last Update</th>
            <th data-hide="phone">Tin mới</th>
            <th data-hide="phone">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($ds_thongbao))
            {
                $i=1;
                foreach ($ds_thongbao as $rows): ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td>
                        <?php echo $rows->tenthongbao ?>
                        <?php if ($rows->cotinmoi == '1') echo '<img src="'.base_url('public/images/new1.gif').'">'; ?>
                    </td>
                    <td><span class="badge red"><?php echo date("H:i:s d/m/Y",strtotime($rows->ngaycapnhat)) ?></span></td>
                    <td>
                        <div class="btn-group">
                          <a onclick="return confirm('Bật tin mới cho thông báo có STT là <?php echo $i ?> ?');" href="<?php echo site_url('user/cap-nhat-tin-moi/'.$rows->id.'/1') ?>" title="Bật tin mới" type="button" class="btn_on btn btn-default btn-sm <?php if ($rows->cotinmoi==1) echo 'disabled' ?>">On</a>
                          <a onclick="return confirm('Tắt tin mới cho thông báo có STT là <?php echo $i ?> ?');" href="<?php echo site_url('user/cap-nhat-tin-moi/'.$rows->id.'/0') ?>" title="Tắt tin mới" type="button" class="btn_off btn btn-default btn-sm  <?php if ($rows->cotinmoi==0) echo 'disabled' ?>">Off</a>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                          <a href="<?php echo site_url('user/xoa-thong-bao/'.$rows->id) ?>" title="Xóa dòng này" type="button" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có muốn xóa thông báo có STT là : <?php echo $i ?> không ?');">Xóa</a>
                          <a href="<?php echo site_url('user/sua-thong-bao/'.$rows->id) ?>" title="Sửa dòng này" type="button" class="btn btn-primary btn-xs">Sửa</a>
                        </div>
                    </td>
                    <?php $i++; ?>
                </tr>
                <?php endforeach;
            }
            else
            echo 'Hiện chưa có thông báo nào';
        ?>
    </tbody>
</table>
