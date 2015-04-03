<div id="search">
    <select id="search_cn" class="form-control text-center">
        <?php
            if ($selected==-1)
            {
                ?>
                    <option value="<?php echo site_url('danh-sach-giang-vien/page/1') ?>" selected>Tất cả chuyên ngành</option>
                <?php
                foreach ($ds_chuyen_nganh as $rows)
                {
                    $ten_chuyen_nganh_khong_dau = mb_strtolower(url_title(removesign($rows->TenCN))); 
                    ?>
                        <option value="<?php echo site_url('giang-vien-chuyen-nganh/'.$ten_chuyen_nganh_khong_dau.'-'.$rows->id) ?>"><?php echo $rows->TenCN ?></option>
                    <?php
                }
            }
            else
            {
                ?>
                    <option value="<?php echo site_url('danh-sach-giang-vien/page/1') ?>">Tất cả chuyên ngành</option>
                <?php
                foreach ($ds_chuyen_nganh as $rows)
                {
                    $ten_chuyen_nganh_khong_dau = mb_strtolower(url_title(removesign($rows->TenCN))); 
                    ?>
                        <option <?php if ($selected==$rows->id) echo "selected" ?> value="<?php echo site_url('giang-vien-chuyen-nganh/'.$ten_chuyen_nganh_khong_dau.'-'.$rows->id) ?>"><?php echo $rows->TenCN ?></option>
                    <?php
                }
            }
        ?>
    </select>
</div>
<br />
<div class="text-center">
<p class="badge red">Tổng số Giảng viên : <?php echo @$total_record ?></p>
</div>
<?php
     $last = end($this->uri->segments);  
     if (is_numeric($last))
     {
        $page = $last;
        $i = ($page-1)*10 +1;
        
     }
     else
     {
        $page = 1;
        $i = $page;
     }
?>
<table class="table demo" data-page-size="5">
	<thead>
		<tr>
            <th data="true" style="width: 50px!important;">STT</th>
            <th data-hide="phone"></th>
			<th data="true">Họ tên</th>
			<th data-hide="phone">Email</th>
            <th data-hide="phone">SĐT</th>
            <th>CNgành</th>
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
                            <td><?php echo $i ?></td>
                            <?php
                            if (!empty($rows->avatar))
                            {
                                ?>
                                <td><img style="width: 50px;height:50px;" class="img-thumbnail img-responsive" src="<?php echo base_url('public/images/upload-image/'.$rows->avatar) ?>" /></td>
                                <?php
                            }
                            else
                            {
                                ?>
                                <td><img style="width: 50px;height:50px;" class="img-thumbnail img-responsive" src="<?php echo base_url('public/images/upload-image/noavatar92.png') ?>" /></td>
                                <?php
                            }
                            ?>
                            
                            <td><?php echo $rows->name ?></td>
                            <td><?php echo $rows->email ?></td>
                            <td><?php echo $rows->phone ?></td>
                            <td><?php echo $this->my_lib->get_first_letter($rows->TenCN)  ?></td>
                        </tr>
                    <?php
                    $i++;
                }
            }
            else
            {
                ?>
                    <tr>
                        <td colspan="4" class="center">Không tìm thấy thông tin giảng viên này</td>
                    </tr>
                <?php
            }
        ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5">
				<div class="pagination pagination-centered"><?php echo @$pagination ?></div>
			</td>
		</tr>
	</tfoot>
</table>
