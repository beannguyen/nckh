<div id="search">
    <select id="search_cn" class="form-control text-center">
        <?php
            if ($selected==-1)
            {
                ?>
                    <option value="<?php echo site_url('danh-sach-de-tai/'.$cauhinh_id.'page/1') ?>" selected>Tất cả chuyên ngành</option>
                <?php
                foreach ($ds_chuyen_nganh as $rows)
                {
                    $ten_chuyen_nganh_khong_dau = $this->my_lib->khong_dau($rows->TenCN);
                    ?>
                        <option value="<?php echo site_url('de-tai-chuyen-nganh/'.$cauhinh_id.'/'.$rows->id.'/page/1') ?>"><?php echo $rows->TenCN ?></option>
                    <?php
                }
            }
            else
            {
                ?>
                    <option value="<?php echo site_url('danh-sach-de-tai/'.$cauhinh_id.'/page/1') ?>">Tất cả chuyên ngành</option>
                <?php
                foreach ($ds_chuyen_nganh as $rows)
                {
                    $ten_chuyen_nganh_khong_dau = $this->my_lib->khong_dau($rows->TenCN);
                    ?>
                        <option <?php if ($selected==$rows->id) echo "selected" ?> value="<?php echo site_url('de-tai-chuyen-nganh/'.$cauhinh_id.'/'.$rows->id.'/page/1') ?>"><?php echo $rows->TenCN ?></option>
                    <?php
                }
            }
        ?>
    </select>
</div>
<br />
<?php
if (!empty($ds_giangvien))
{
    //print_r($ds_giangvien);
    echo '<select class="form-control text-center" id="lst_gv">';
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
<div id="show_detai">
    <div class="text-center">
        <p class="badge red">Tổng số đề tài : <?php echo @$total_record ?></p>
    </div>
    <table class="table" data-page-size="5">
    	<thead>
    		<tr>
                <th data="true">STT</th>
    			<th data="true">Tên đề tài</th>
    			<th data="true" style="width: 140px!important;">GVHD</th>
                <th data-hide="phone,tablet">Chuyên ngành </th>
    			<th data-hide="phone,tablet">Tình trạng </th>
    			<th data-hide="phone,tablet">Số lượng</th>
                <th data-hide="phone">Chi tiết</th>
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
                                <td><?php echo '<span class="text-info">'.$i.'</span>' ?></td>
                                <td><?php echo $rows->tendetai ?></td>
                                <td><?php echo $rows->name ?></td>
                                <td><?php echo $rows->TenCN ?></td>
                                <td><?php
                                        if (!empty($rows->truongnhom))
                                        {
                                            echo "Đã có người đăng ký";
                                        }
                                        else
                                        {
                                            echo "Chưa có sinh viên đăng ký";
                                        }
                                    ?>
                                </td>
                                <td><?php echo '<a class="badge red">'.$array_sothanhvien[$rows->id].'</a> / <a class="badge green">' .$rows->soluongSVtoida.'</a>' ?></td>
                                <?php
                                    $ten_detai_khongdau = $this->my_lib->khong_dau($rows->tendetai);;
                                    if (!empty($rows->truongnhom)){
                                        ?>
                                        <td><a target="_blank" href="<?php echo site_url('chi-tiet-de-tai/'.$ten_detai_khongdau.'-'.$rows->id) ?>" class="btn btn-success btn-xs">Chi tiết</a></td>
                                        <?php
                                    } else {
                                        ?>
                                        <td><a target="_blank" href="<?php echo site_url('chi-tiet-de-tai/'.$ten_detai_khongdau.'-'.$rows->id) ?>" class="btn btn-danger btn-xs">Chi tiết</a></td>
                                        <?php
                                    }
                                ?>
                            </tr>
                        <?php
                        $i++;
                    }
                }
                else
                {
                    ?>
                        <td colspan="6" style="text-align: center;">Không tìm thấy đề tài</td>
                    <?php
                }
            ?>
    	</tbody>
    	<tfoot>
    		<tr>
    			<td colspan="6">
    				<div class="pagination pagination-centered"><?php echo @$pagination ?></div>
    			</td>
    		</tr>
    	</tfoot>
    </table>
</div>
<script>
$(document).ready(function(){
    $("#hinh_thuc").change(function(){
        //document.location.href = $(this).val();
        alert($(this).val());
    });
});
</script>
<script>
$(document).ready(function(){
    $("#lst_gv").change(function(){
        var id_gv = $(this).val();
        if (id_gv == 'all')
        {
            //return false;
            location.reload();
        }
        else
        {
            var cauhinh_id = '<?php echo $cauhinh_id ?>';
            var cn_id = '<?php echo $this->uri->segment(3); ?>'
            //alert(cn_id);
            var form_data_gv = {
                gv_id: id_gv,
                cauhinh_id: cauhinh_id,
                cn_id : cn_id
            };
            $.ajax({
                url:'<?php echo site_url('giang-vien-de-tai')  ?>',
                type:'POST',
                cache:true,
                data: form_data_gv,
                success:function(msg_form_gv){
                    $("#show_detai").html(msg_form_gv);
                }
                });
                return false;
        }
    });  
});
 $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
        $("#loading").hide();
    });
</script>

