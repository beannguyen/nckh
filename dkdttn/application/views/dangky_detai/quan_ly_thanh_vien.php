<table class="table">
    <thead>
    <tr>
        <th>Tên đề tài</th>
        <th style="width: 140px;">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $ten_detai ?></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="icon-cogs"></i> &nbsp;Thao tác
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                    <?php $ten_detai_kodau = $this->my_lib->khong_dau($ten_detai) ?>
                      <li><a href="<?php echo site_url('chi-tiet-de-tai/'.$ten_detai_kodau.'-'.$id_detai) ?>"><i class="icon-info-sign"></i> &nbsp;Xem chi tiết</a></li>
                      <li class="divider"></li>
                      <li><a id="delete" href="<?php echo site_url('user/roi-nhom') ?>"><i class="icon-ban-circle"></i> &nbsp;Rời nhóm</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<script>
$(document).ready(function(){
  $("#delete").click(function(){
    if (!confirm("Bạn có chắc không ?")){
      return false;
    }
  });
});
</script>