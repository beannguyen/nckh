<div class="text-center">
        <p class="badge red">Tổng số mẩu tin : <?php echo @$count ?></p>
</div>

<table class="table demo footable-loaded footable phone breakpoint" data-page-size="5">
	<thead>
		<tr>
            <th style="width: 30px!important;">STT</th>
			<th data="true">Tên đề tài</th>
            <th data-hide="phone,tablet" style="width: 80px;">Chi tiết</th>
            <th style="width: 100px;">Trạng thái</th>
		</tr>
	</thead>
	<tbody>
        <?php
            if (!empty($query_ds_de_tai))
            {
                $i=1;
                foreach ($query_ds_de_tai as $rows)
                {
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $i ?></td>
                            <td><?php echo $rows->tendetai ?></td>
                            <?php $ten_detai_kodau = $this->my_lib->khong_dau($rows->tendetai) ?>
                            <td><?php echo anchor('chi-tiet-de-tai/'.$ten_detai_kodau.'-'.$rows->id,'Chi tiết','class="btn btn-info btn-xs"') ?></td>
                            <td style="width:70px!important">
                            <?php 
                                if (empty($rows->truongnhom))
                                {
                                    ?>
                                        <a href="javascript:void(0)" id="<?php echo $rows->id ?>" class="btn btn-success btn-xs link_dk" rel="Bạn vừa chọn đề tài: <?php echo $rows->tendetai ?>">Đăng ký</a>
                                    <?php
                                }
                                else if ($array_sothanhvien[$rows->id]==$rows->soluongSVtoida)
                                {
                                    echo '<span class="btn btn-danger btn-xs center">Đủ thành viên</span>';
                                }
                                else
                                {
                                    ?>
                                    <div class="btn-group">
                                        <a id="<?php echo $rows->id ?>" title="Xin vào nhóm" class="btn btn-primary btn-xs btn-xvn" href="javascript:void();">XVN</a>
                                        <a rel="<?php echo $rows->id ?>" title="Liên hệ qua email" class="btn btn-danger btn-xs email_btn" href="javascript:void();">Email</a>
                                    </div>
                                    <?php
                                }
                            ?>
                            </td>
                        </tr>
                    <?php
                    $i++;
                }
            }
            else
            {
                ?>
                    <td colspan="7" style="text-align: center;">Không tìm thấy đề tài</td>
                <?php
            }
        ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="7">
				<div class="pagination pagination-centered"><?php echo @$pagination ?></div>
			</td>
		</tr>
	</tfoot>
</table>
<script>
$(document).ready(function(){
    $(".link_dk").click(function(){
        var detai_id = $(this).attr('id');
        var diengiai = $(this).attr('rel');
        if (!confirm(diengiai))
        {
            //alert("No");
            return false;
        }
        else
        {
            //alert("Yes");
            //alert(diengiai);
            //Ajax here
            var form_data_dangky = {
                detai_id: detai_id,
            };
            $.ajax({
                url:'<?php echo base_url('user/dang-ky/') ?>',
                type:'POST',
                cache:true,
                data:form_data_dangky,
                success:function(mess_dangky){
                    //alert(mess_dangky);
                    if (mess_dangky != "success")
                    {
                        alert(mess_dangky);
                    }
                    else
                    {
                        alert("Đăng ký nhóm thành công");
                        window.location.href = "<?php echo site_url('user/quan-ly-nhom') ?>";
                    }
                    //$("#show_detai_dk").html(msg_form_gv_dk);
                }
            });
            return false;
        }
    })
})
</script>
<script>
//Email
$(document).ready(function(){
    //email
    $(".email_btn").click(function(e){
        e.preventDefault();
        //alert("ok");
        if (confirm('Việc gửi mail sẽ tốn một khoảng thời gian xử lý.\nBạn có chắc không ? '))
        {
            var detai_id_var = $(this).attr('rel');
            var nguoigui_var = '<?php echo $this->session->userdata('id_user') ?>';
            var form_email = {
                detai_id : detai_id_var,
                nguoigui_email : nguoigui_var,
            };
            $("#loading").show();
            $.ajax({
                    url:'<?php echo site_url('user/gui-email-nhom-truong') ?>',
                    type:'POST',
                    async:true,
                    data:form_email,
                    success:function(mess_email){
                        $("#loading").hide();
                        alert(mess_email);
            }
            });
        }
    });
    //XVN
    $(".btn-xvn").click(function(){
        if (confirm('Việc gửi thông tin Xin và nhóm sẽ tốn một khoảng thời gian xử lý.\nBạn có chắc không ? '))
        {
            $("#loading").show();
            var id_dt_xvn = $(this).attr('id');
            $.ajax({
                url     :   '<?php echo site_url('user/xin-vao-nhom') ?>',
                type    :   'POST',
                data    :   {id_detai:id_dt_xvn,xvn:'yes'},
                success:function(msg_xvn){
                    $("#loading").hide();
                    alert(msg_xvn);
                }
            })
        }
    });
})
</script>