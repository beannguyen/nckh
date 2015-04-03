<script type="text/javascript" src="<?php echo base_url('public/js/active_script.js') ?>"></script>
<div class="text-center">
<p class="badge red">Tổng số mẩu tin : <?php echo @$total_record ?></p>
</div>
<table class="table demo" data-page-size="5">
	<thead>
		<tr>
			<th data="true">Tên đề tài</th>
			<th>GVHD</th>
            <th data-hide="phone,tablet">Chuyên ngành </th>
			<th data-hide="phone,tablet">Tình trạng </th>
			<th data-hide="phone">Số lượng SV </th>
            <th data-hide="phone,tablet">More info</th>
		</tr>
	</thead>
	<tbody>
        <?php
            if (!empty($query_ds_de_tai))
            {
                foreach ($query_ds_de_tai as $rows)
                {
                    ?>
                        <tr>
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
                            <td><?php echo '<span class="badge green">'.$array_sothanhvien[$rows->id].'</span> / <span class="badge red"> '.$rows->soluongSVtoida.'</span>' ?></td>
                            <?php $ten_detai_khongdau = $this->my_lib->khong_dau($rows->tendetai) ?>
                            <td><?php echo anchor('chi-tiet-de-tai/'.$ten_detai_khongdau.'-'.$rows->id,'Chi tiết','class="btn btn-info btn-sm"') ?></td>
                        </tr>
                    <?php
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