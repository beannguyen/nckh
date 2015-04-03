<?php
if (!empty($ds_giangvien))
{
    //print_r($ds_giangvien);
    echo '<select class="form-control text-center" id="lst_gv_dk">';
    echo '<option class="text-left" value="all"> Tất cả giảng viên </option>';
    $i=1;
    foreach ($ds_giangvien as $rows)
    {
        echo '<option class="text-left" value='.$rows->id.'>'.$i.'/&nbsp;&nbsp;&nbsp;'.$rows->name.'</option>';
        $i++;
    }
    echo '</select>';
}
?>
<br />
<div id="show_detai_dk">
<div class="text-center">
<p class="badge red">Tổng số đề tài : <?php echo @$total_record ?></p>
</div>
<table class="table demo" data-page-size="5">
	<thead>
		<tr>
            <th data="true">STT</th>
			<th data="true">Tên đề tài</th>
			<th>GVHD</th>
            <th data-hide="phone,tablet">Chuyên ngành </th>
			<th data-hide="phone,tablet">Số lượng SV </th>
            <th data-hide="phone,tablet">More info</th>
            <th style="width: 100px;">Trạng thái</th>
		</tr>
	</thead>
	<tbody>
        <?php
             $last = end($this->uri->segments);  
             if (is_numeric($last))
             {
                $page = $last;
                $i = ($page-1)*12 +1;
                
             }
             else
             {
                $page = 1;
                $i = $page;
             }
        ?>
        <?php
            if (!empty($query_ds_de_tai))
            {
                foreach ($query_ds_de_tai as $rows)
                {
                    ?>
                        <tr>
                            <td><?php echo '<span class="text-danger">'.$i.'</span>' ?></td>
                            <td><?php echo $rows->tendetai ?></td>
                            <td><?php echo $rows->name ?></td>
                            <td><?php echo $rows->TenCN ?></td>
                            <td><?php echo '<span class="badge green">'.$array_sothanhvien[$rows->id].'</span> / <span class="badge red">'.$rows->soluongSVtoida.'</span>' ?></td>
                            <?php $ten_detai_kodau = $this->my_lib->khong_dau($rows->tendetai) ?>
                            <td><?php echo anchor('chi-tiet-de-tai/'.$ten_detai_kodau.'-'.$rows->id,'Chi tiết','class="btn btn-info btn-xs"') ?></td>
                            <td style="width:70px!important">
                            <?php 
                                if (empty($rows->truongnhom))
                                {
                                    //echo anchor('user/dang-ky/'.$this->session->userdata('id_user').'-'.$rows->id,'Đăng ký','class="label label-success center"');
                                    ?>
                                        <!--
                                        <a class="label label-success" href="<?php echo base_url('user/dang-ky/'.$rows->id.'.html') ?>"  onclick="return confirm('Bạn vừa chọn đề tài :\n<?php echo $rows->tendetai.'\nGVHD : '.$rows->name ?>')">Đăng ký</a>
                                        -->
                                        <a href="javascript:void(0)" id="<?php echo $rows->id ?>" class="btn btn-success btn-xs link_dk" rel="Bạn vừa chọn đề tài: <?php echo $rows->tendetai.' || GVHD : '.$rows->name ?>">Đăng ký</a>
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
                                        <!--
                                        <a title="Xin vào nhóm" class="btn btn-primary btn-xs btn-xvn" href="<?php echo site_url('user/xin-vao-nhom/'.$rows->id) ?>">XVN</a>
                                        -->
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
</div>
<script>
$(document).ready(function(){
    $("#lst_gv_dk").change(function(){
        var id_gv = $(this).val();
        if (id_gv == 'all')
        {
            //return false;
            location.reload();
        }
        else
        {
            var cauhinh_id = '<?php echo @$cauhinh_id ?>';
            var cn_id = '<?php echo @$chuyennganh_id ?>'
            //alert(cn_id);
            var form_data_gv_dk = {
                gv_id: id_gv,
                cauhinh_id: cauhinh_id,
                cn_id : cn_id,
                delay: 3
            };
            $.ajax({
                url:'<?php echo site_url('user/de-tai-giang-vien')  ?>',
                type:'POST',
                timeout:5000,
                async:false,
                data: form_data_gv_dk,
                error: function(request, status, err) {
                if(status == "timeout") {
                    //do something
                    alert('Thời gian chờ quá lâu, vui lòng đăng nhập lại');
                    window.location.href = '<?php echo site_url('user/dang-xuat') ?>'; 
                }
                },
                success:function(msg_form_gv_dk){
                    //alert(msg_form_gv_dk);
                    $("#show_detai_dk").html(msg_form_gv_dk);
                }
                });
                return false;
        }
    });  
});
</script>
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
            $("#loading").fadeIn(300);
            $("#container").addClass("overlay");
            $.ajax({
                url:'<?php echo base_url('user/dang-ky/') ?>',
                type:'POST',
                cache:true,
                data:form_data_dangky,
                success:function(mess_dangky){
                    //alert(mess_dangky);
                    if (mess_dangky != "success")
                    {
                        //$("#loading").hide();
                        $('#loading').fadeOut(300);
                        $("#container").removeClass("overlay");
                        alert(mess_dangky);
                        window.location.reload();
                    }
                    else
                    {
                        //$("#loading").hide();
                        $('#loading').fadeOut(300);
                        $("#container").removeClass("overlay");
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

$(document).ready(function(){
    //Email
    $(".email_btn").click(function(e){
        e.preventDefault();
        //alert("ok");
        if (confirm('Việc gửi mail sẽ tốn một khoảng thời gian xử lý.\nBạn có chắc không ? '))
        {
            $(this).addClass('disabled');
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
            $(this).addClass('disabled');
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
