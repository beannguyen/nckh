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
                                          <li><a target="_blank" href="<?php echo site_url('chi-tiet-de-tai/'.$ten_detai_kodau.'-'.$rows->id,$rows->tendetai) ?>"><i class="icon-file"></i> &nbsp;Xem chi tiết</a></li>
                                          <li class="divider"></li>
                                          <li><a class="btn-sua-dt" id="<?php echo $rows->id ?>" href="javascript:void();"><i class="icon-edit"></i> &nbsp;Sửa đề tài</a></li>
                                          <li class="divider"></li>
                                          <li>
                                              <a style="cursor: pointer;" id="<?php echo $rows->cauhinh_id ?>" rel="<?php echo $rows->id ?>" class="btn-xoa-detai"><i class="icon-trash"></i> &nbsp;Xoá đề tài</a>
                                          </li>
                                          <li class="divider"></li>
                                          <li>
                                              <a style="cursor: pointer;" id="<?php echo $rows->id ?>" class="btn-xoa-sv-dt"><i class="icon-trash"></i> &nbsp;Xoá sinh viên đề tài</a>
                                          </li>
                                    </ul>
                                </div>
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
<div id="frm_suadetai"></div>
<script>
    $(document).ready(function(){
        $(".btn-xoa-detai").click(function(){
            if (confirm("Bạn có chắc không ? "))
            {
                var detai_id = $(this).attr('rel');
                var cauhinh_id = $(this).attr('id');
                var giangvien_id = '<?php echo $giangvien_id; ?>';
                var form_data_xoadt = {
                    'detai_id'      :   detai_id,
                    'cauhinh_id'    :   cauhinh_id,
                    'giangvien_id'  :   giangvien_id,
                    'xoa_dt'        :   'yes',
                };
                $("#loading").show();
                $.ajax({
                    url     :   '<?php echo site_url('user/cau-hinh-giang-vien-ajax') ?>',
                    type    :   'post',
                    data    :   form_data_xoadt,
                    success:function(msg_xoa_dt){
                        $("#loading").hide();
                        if(msg_xoa_dt == 'ok')
                        {
                            alert('Xóa thành công');
                            window.location.reload();
                        }
                        else
                        {
                            alert ('Lỗi rồi');
                        }
                    }
                })
            }
            else 
            {
                return false;
            }
        })
    })
</script>
<script>
    $(document).ready(function(){
        //load view sua de tai
        $(".btn-sua-dt").click(function(){
        var id_detai = $(this).attr('id');
        var data_show_form_suadt = {
            form_suadt  :   'yes',
            id_detai    :   id_detai,
        };
        $("#loading").show();
        $.ajax({
            url     :   '<?php echo site_url('user/cau-hinh-giang-vien-ajax') ?>',
            type    :   'post',
            data    :   data_show_form_suadt,
            success:function(msg_load_suadt){
                $("#loading").hide();
                $("#frm_suadetai").html(msg_load_suadt);
            }
        })
    });
})
</script>
<script>
    $(document).ready(function(){
        //load view sua de tai
        $(".btn-xoa-sv-dt").click(function(){
        var id_xoa_sv_detai = $(this).attr('id');
        var data_xoa_sv_dt = {
            btn_xoa_sv_dt   :   'yes',
            id_xoa_sv_detai :   id_xoa_sv_detai,
        };
        $("#loading").show();
        $.ajax({
            url     :   '<?php echo site_url('user/cau-hinh-giang-vien-ajax') ?>',
            type    :   'post',
            data    :   data_xoa_sv_dt,
            success:function(msg_xoa_sv_dt){
                $("#loading").hide();
                //$("#frm_suadetai").html(msg_xoa_sv_dt);
                if (msg_xoa_sv_dt == 'ok')
                {
                    window.location.reload();
                }
            }
        })
    });
})
</script>
