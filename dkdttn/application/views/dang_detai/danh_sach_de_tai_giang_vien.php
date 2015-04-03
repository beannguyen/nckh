<?php
if (!empty($control) && $control==true)
{
    $last = end($this->uri->segments);
    ?>
        <a href="<?php echo site_url('user/them-de-tai/'.$last) ?>" class="btn btn-default pull-right">Thêm đề tài mới</a>
        <br />
        <hr />
    <?php
}
?>
<?php
if (!empty($query_ds_de_tai))
{
    ?>
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <td style="width: 30px!important;">STT</td>
                <td>Tên đề tài</td>
                <td style="width: 80px!important;">Số lượng SV</td>
                <td style="width: 140px;">Thao tác</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
            foreach ($query_ds_de_tai as $rows)
            {
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <?php
                        if (!empty($query_ds_de_tai->truongnhom))
                        {
                            echo '<td>'.$rows->tendetai.'</td>';
                        }
                        else
                        {
                            echo '<td>'.$rows->tendetai.'</p></td>';
                        }
                        ?>
                        <td><p class="text-center"><a class="badge red"><?php echo $arr_thanhvien_detai[$rows->id] ?> </a> / <a class="badge green"><?php echo $rows->soluongSVtoida ?></a></p></td>
                        <td>
                        <?php
                            if (!empty($control) && $control==true)
                            {
                                ?>
                                <?php //echo $detai_id = $rows->id ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                      <i class="icon-cogs"></i> Thao tác <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                    <?php $ten_detai_kodau = $this->my_lib->khong_dau($rows->tendetai) ?>
                                      <li><a href="<?php echo site_url('chi-tiet-de-tai/'.$ten_detai_kodau.'-'.$rows->id,$rows->tendetai) ?>"><i class="icon-file"></i> &nbsp;Xem chi tiết</a></li>
                                      <li class="divider"></li>
                                      <li><a href="<?php echo site_url('user/sua-de-tai/'.$rows->id) ?>"><i class="icon-edit"></i> &nbsp;Sửa đề tài</a></li>
                                      <li class="divider"></li>
                                      <li><a href="<?php echo site_url('user/xoa-de-tai/'.$rows->id.'/'.$rows->cauhinh_id) ?>" onclick="return confirm('Bạn có muốn xoá đề tài : \n<?php echo $rows->tendetai ?>')"><i class="icon-trash"></i> &nbsp;Xoá đề tài</a></li>
                                      <li class="divider"></li>
                                      <?php
                                        if ($arr_thanhvien_detai[$rows->id]== 0)
                                        {
                                            ?>
                                            <li><a data-toggle="modal" href="#them_nhomtruong_<?php echo $rows->id ?>"><i class="icon-user"></i> Thêm nhóm trưởng</a></li>
                                            <?php
                                        }
                                        else if ($arr_thanhvien_detai[$rows->id] < $rows->soluongSVtoida)
                                        {
                                            ?>
                                            <li><a data-toggle="modal" href="#them_thanhvien_<?php echo $rows->id ?>"><i class="icon-user"></i> Thêm thành viên</a></li>
                                            <?php
                                        }
                                      ?>
                                      </ul>
                                </div>
                                <!-- Them nhom truong -->
                                 <div class="modal fade" id="them_nhomtruong_<?php echo $rows->id ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h3 class="text-danger">Thêm nhóm trưởng</h3>
                                          <h5>Tên đề tài : <?php echo $rows->tendetai ?></h5>
                                        </div>
                                        <div class="modal-body">
                                        <div id="err_nt<?php echo $rows->id ?>"></div>
                                        <form id="form_them_nt<?php echo $rows->id ?>" method="post" action="<?php echo site_url('user/xu-ly-them-nhom-truong-gv') ?>">
                                            <label>MSSV nhóm trưởng : </label>
                                            <input type="text" id="mssv_nhomtruong<?php echo $rows->id ?>" class="form-control" name="mssv_nhomtruong" />
                                            <input id="detai_<?php echo $rows->id ?>" type="hidden" name="detai_id" value="<?php echo $rows->id ?>" />

                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-primary">Lưu</button>  
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  
                                <!-- Thêm thành viên -->
                                <div class="modal fade" id="them_thanhvien_<?php echo $rows->id ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h3 class="text-danger">Thêm thành viên</h3>
                                          <h5>Tên đề tài : <?php echo $rows->tendetai ?></h5>
                                        </div>
                                        <div class="modal-body">
                                        <div id="err_tv<?php echo $rows->id ?>"></div>
                                        <form id="form_them_tv<?php echo $rows->id ?>" method="post" action="<?php echo site_url('user/gv-thanh-vien') ?>">
                                            <label>MSSV thành viên : </label>
                                            <input type="text" id="mssv_thanhvien<?php echo $rows->id ?>" class="form-control" name="mssv_thanhvien" />
                                            <input type="hidden" name="detai_id" value="<?php echo $rows->id ?>" />
                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-primary">Lưu</button>  
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!--Script-->
                                  <script>
                                    $(document).ready(function(){
                                        $("#form_them_nt<?php echo $rows->id ?>").submit(function(e){
                                        if ($("#mssv_nhomtruong<?php echo $rows->id ?>").val() == '' || !$.isNumeric($("#mssv_nhomtruong<?php echo $rows->id ?>").val()))
                                        {
                                            $('#err_nt<?php echo $rows->id ?>').html('<div class="alert alert-danger">Thông tin nhập vào không hợp lệ</div>');
                                            $("#mssv_nhomtruong<?php echo $rows->id ?>").val('');
                                            $("#mssv_nhomtruong<?php echo $rows->id ?>").focus();
                                            return false;
                                        }
                                        else
                                        {
                                            var form_data_dangky_nhomtruong = {
                                                mssv_nhomtruong: $("#mssv_nhomtruong<?php echo $rows->id ?>").val(),
                                                detai_id:$("#detai_<?php echo $rows->id ?>").val(),
                                            };
                                            $.ajax({
                                                url:'<?php echo base_url('user/xu-ly-them-nhom-truong-gv') ?>',
                                                type:'POST',
                                                cache:true,
                                                data:form_data_dangky_nhomtruong,
                                                success:function(mess_dangky_nt){
                                                    //alert(mess_dangky);
                                                    if (mess_dangky_nt != "success")
                                                    {
                                                        $('#err_nt<?php echo $rows->id ?>').html('<div class="alert alert-warning">'+ mess_dangky_nt + '</div>');
                                                        $("#mssv_nhomtruong<?php echo $rows->id ?>").focus();
                                                    }
                                                    else
                                                    {
                                                        $('#err_nt<?php echo $rows->id ?>').html('<div class="alert alert-success">Thêm nhóm trưởng thành công</div>');
                                                        location.reload();
                                                    }
                                                }
                                            });
                                            return false;
                                        }
                                    });
                                    })
                                 </script>
                                <script>
                                    $(document).ready(function(){
                                        $("#form_them_tv<?php echo $rows->id ?>").submit(function(e){
                                        if ($("#mssv_thanhvien<?php echo $rows->id ?>").val() == '' || !$.isNumeric($("#mssv_thanhvien<?php echo $rows->id ?>").val()))
                                        {
                                            $('#err_tv<?php echo $rows->id ?>').html('<div class="alert alert-danger">Thông tin nhập vào không hợp lệ</div>');
                                            $("#mssv_thanhvien<?php echo $rows->id ?>").val('');
                                            $("#mssv_thanhvien<?php echo $rows->id ?>").focus();
                                            return false;
                                        }
                                    });
                                    })
                                 </script>
                                <?php
                            }
                            else
                            {
                                echo anchor('chi-tiet-de-tai/'.$rows->id,'Chi tiết','class="label label-info"');
                            }
                        ?>
                        </td>
                    </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <?php
}
else
{
    echo '<h5 class="text-warning">Hiện không có thông tin đề tài nào</h5>';
}
?>

