<script type="text/javascript" src="<?php echo base_url('public/js/active_script.js') ?>"></script>
<div class="text-center">
<p class="badge red">Tổng số mẩu tin : <?php echo @$total_record ?></p>
</div>
<table class="table demo" data-page-size="5">
	<thead>
		<tr>
			<th data="true">Tên giảng viên</th>
			<th>Chuyên ngành</th>
			<th data-hide="phone">Email</th>
            <th data-hide="phone">Số điện thoại</th>
		</tr>
	</thead>
	<tbody>
        <?php
            if (!empty($query_danh_sach_giang_vien))
            {
                foreach ($query_danh_sach_giang_vien as $rows)
                {
                    ?>
                        <tr>
                            <td><?php echo $rows->name ?></td>
                            <td><?php echo $rows->TenCN ?></td>
                            <td><?php echo $rows->email ?></td>
                            <td><?php echo $rows->phone ?></td>
                        </tr>
                    <?php
                }
            }
            else
            {
                ?>
                    <tr>
                        <td colspan="2" class="center">Không tìm thấy thông tin giảng viên này</td>
                    </tr>
                <?php
            }
        ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5">
				<div class="pagination pagination-centered"><?php echo @$pagination ?></div>
                <?php
                    if (isset($back_btn) && $back_btn==="yes")
                    {
                        ?>
                            <div class="center">
                                <button id="back" type="button" class="btn btn-info">Quay về</button>
                            </div>
                        <?php
                    }
                ?>
			</td>
		</tr>
	</tfoot>
</table>
