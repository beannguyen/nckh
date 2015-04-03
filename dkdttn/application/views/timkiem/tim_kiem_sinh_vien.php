<script type="text/javascript" src="<?php echo base_url('public/js/active_script.js') ?>"></script>
<div class="text-center">
<p class="badge red">Tổng số mẩu tin : <?php echo @$total_record ?></p>
</div>
<table class="table demo" data-page-size="5">
	<thead>
		<tr>
            <th data-hide="phone"></th>
            <th data="true">MSSV</th>
			<th>Họ tên sinh viên</th>
			<th data-hide="phone">Chuyên ngành</th>
			<th data-hide="phone,tablet">Email</th>
            <th data-hide="phone">Số điện thoại</th>
		</tr>
	</thead>
	<tbody>
    
        <?php
            if (!empty($query_danh_sach_sinh_vien))
            {
                foreach ($query_danh_sach_sinh_vien as $rows)
                {
                    $url = 'http://online.hcmute.edu.vn/HinhSV/'.$rows->username.'.jpg';
                    ?>
                        <tr>
                            
                            <td style="text-align: center;">
                            <a href="<?php echo $url ?>" data-lightbox="example-2" title="<?php echo $rows->name ?>">
                                <object style="width: 60px;height:60px;" class="img-thumbnail img-responsive" data="<?php echo $url ?>">            
                                <img style="width: 50px;height:50px;" class="img-responsive" src="<?php echo base_url('public/images/upload-image/noavatar92.png') ?>" />
                                </object>
                            </a>
                            </td>
                            <td><?php echo $rows->username ?></td>
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
                        <td colspan="5" style="text-align: center;">Không tìm thấy thông tin sinh viên này</td>
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