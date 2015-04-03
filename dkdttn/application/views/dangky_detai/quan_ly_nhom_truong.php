<table class="table">
<thead>
<tr>
    <th>Tên đề tài</th>
    <th style="width: 140px;">Thao tác</th>
</tr>
</thead>
<tbody>
<tr>
    <td><p style="font-size: 105%;"><?php echo $ten_detai ?></p></td>
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
              <li><a id="delete" href="<?php echo site_url('user/huy-nhom') ?>"><i class="icon-ban-circle"></i> &nbsp;Hủy nhóm</a></li>
              <li class="divider"></li>
              <li><a data-toggle="modal" href="#frm_themtv"><i class="icon-user"></i> &nbsp;Thêm thành viên</a></li>
            </ul>
        </div>
    </td>
</tr>
</tbody>
</table>
<?php echo anchor('','Danh sách sinh viên quan tâm đề tài'.'<span class="badge">'.@$so_thu.'</span>','class="list-group-item text-center" id="group-hopthu"') ?>
<?php
    if (!empty($array_thu))
    {
        
        ?>
            <div class="list-group" id="list-hopthu">
                <?php
                for ($i=0;$i<$so_phantu;$i++)
                {
                    ?>
                        <li class="list-group-item text-danger"><strong><?php echo ($i+1 .'/ ').$array_thu['info'][$i]->name ?></strong>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <ul>
                            <li><span class="text-info">MSSV : <?php echo $array_thu['info'][$i]->username ?></span></li>
                            <li><span class="text-info">Gửi lúc : <?php echo date("H:i a || d/m/Y",strtotime($array_thu['time'][$i])) ?></span></li>
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-pencil"></i>  &nbsp;Thêm / Xoá &nbsp;<span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a onclick="return confirm('Thêm sinh viên <?php echo $array_thu['info'][$i]->name ?> vào nhóm của bạn')" href="<?php echo site_url('user/xu-ly-them-thanh-vien'.'/'.$array_thu['info'][$i]->username) ?>"><i class="icon-plus"></i> &nbsp;Thêm vào nhóm</a></li>
                                      <li class="divider"></li>
                                      <li><a onclick="return confirm('Xóa sinh viên <?php echo $array_thu['info'][$i]->name ?> ra khỏi danh sách.')" href="<?php echo site_url('user/xoa-sinh-vien-xin-vao-nhom/'.$array_thu['info'][$i]->username) ?>"><i class="icon-remove"></i> &nbsp;Xóa khỏi danh sách</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        </li>    
                    <?php
                }
                ?>
            </div>
        <?php
    }
?>
<!-- Modal -->
<div class="modal fade" id="frm_themtv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Thêm thành viên</h3>
      </div>
      <form method="post" action="<?php echo site_url('user/xu-ly-them-thanh-vien') ?>">
          <div class="modal-body">
            <div id="err_tv"></div>
            <label>MSSV thành viên :</label>
            <input type="text" required="required" class="form-control" name="mssv_thanhvien" id="mssv_tv" />
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ========================================================= -->
<script>
$(document).ready(function(){
  $("#delete").click(function(){
    if (!confirm("Bạn có muốn huỷ đề tài này không ?")){
      return false;
    }
  });
  $("#group-hopthu").click(function(e){
    e.preventDefault();
    $("#list-hopthu").slideToggle();
  })
  $("#frm_themtv").submit(function(e){
    if ($("#mssv_tv").val()=="" || !$.isNumeric($("#mssv_tv").val()))
    {
        $('#err_tv').html('<div class="alert alert-danger">Thông tin nhập vào không hợp lệ</div>');
        $("#mssv_tv").val("");
        $("#mssv_tv").focus();
        return false;
    }
  })
});
</script>