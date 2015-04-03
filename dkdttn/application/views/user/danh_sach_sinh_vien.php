<link rel="stylesheet" href="<?php echo base_url('public/lightbox/css/lightbox.css') ?>"/>
<script type="text/javascript" src="<?php echo base_url('public/lightbox/js/lightbox-2.6.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/lightbox/js/modernizr.custom.js') ?>"></script>
<div id="search">
    <select id="search_cn" class="form-control text-center">
        <?php
            if ($selected==-1)
            {
                ?>
                    <option value="<?php echo site_url('danh-sach-sinh-vien/page/1') ?>" selected>Tất cả chuyên ngành</option>
                <?php
                foreach ($ds_chuyen_nganh as $rows)
                {
                    $ten_chuyen_nganh_khong_dau = mb_strtolower(url_title(removesign($rows->TenCN))); 
                    ?>
                        <option value="<?php echo site_url('sinh-vien-chuyen-nganh/'.$ten_chuyen_nganh_khong_dau.'-'.$rows->id.'/page/1') ?>"><?php echo $rows->TenCN ?></option>
                    <?php
                }
            }
            else
            {
                ?>
                    <option value="<?php echo site_url('danh-sach-sinh-vien/page/1') ?>">Tất cả chuyên ngành</option>
                <?php
                foreach ($ds_chuyen_nganh as $rows)
                {
                    $ten_chuyen_nganh_khong_dau = mb_strtolower(url_title(removesign($rows->TenCN))); 
                    ?>
                        <option <?php if ($selected==$rows->id) {echo "selected";} ?> value="<?php echo site_url('sinh-vien-chuyen-nganh/'.$ten_chuyen_nganh_khong_dau.'-'.$rows->id.'/page/1') ?>"><?php echo $rows->TenCN ?></option>
                    <?php
                }
            }
        ?>
    </select>
    <br />
    <select id="search_nienkhoa" class="form-control text-center">
        <?php
            if ($selected==-1)
            {
                if ($selected_nk==-1)
                {
                    //Tat ca chuyen nganh - tat ca nien khoa
                    ?>
                        <option value="<?php echo site_url('danh-sach-sinh-vien/page/1') ?>" selected>Tất cả niên khóa</option>
                        <?php
                            foreach ($ds_nien_khoa as $rows_nk)
                            {
                                ?>
                                    <option  value="<?php echo site_url('sinh-vien-nien-khoa/'.$selected.'/'.$rows_nk->TenNK.'/page/1') ?>">
                                    <?php echo $rows_nk->TenNK ?>
                                    </option>
                                <?php
                            }
                        ?>
                    <?php
                }
                else
                {
                    //Tat ca chuyen nganh - nhung co nien khoa rieng
                    ?>
                        <option value="<?php echo site_url('danh-sach-sinh-vien/page/1') ?>">Tất cả niên khóa</option>
                        <?php
                            foreach ($ds_nien_khoa as $rows_nk)
                            {
                                ?>
                                    <option value="<?php echo site_url('sinh-vien-nien-khoa/'.$selected.'/'.$rows_nk->TenNK.'/page/1') ?>" <?php if ($selected_nk==$rows_nk->TenNK) echo "selected"  ?>>
                                        <?php echo $rows_nk->TenNK ?>
                                    </option>
                                <?php
                            }
                        ?>
                    <?php
                }
            }
            else
            {
                ?>
                    <option value="<?php echo site_url('sinh-vien-chuyen-nganh/'.$selected.'/page/1') ?>">Tất cả niên khóa</option>
                    <?php
                        foreach ($ds_nien_khoa as $rows_nk)
                        {
                            ?>
                                <option <?php if ($selected_nk==$rows_nk->TenNK) echo "selected"; ?> value="<?php echo site_url('sinh-vien-nien-khoa/'.$selected.'/'.$rows_nk->TenNK.'/page/1') ?>" >
                                <?php echo $rows_nk->TenNK ?></option>
                            <?php
                        }
                    ?>
                <?php
            }
        ?>

    </select>
</div>
<br />
<div class="text-center">
<p class="badge red">Tổng số sinh viên : <?php echo $total_record ?></p>
</div>
<?php
     $last = end($this->uri->segments);  
     if (is_numeric($last))
     {
        $page = $last;
        $i = ($page-1)*20 +1;
        
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
			<th data="true">MSSV</th>
			<th>Họ tên</th>
			<th data-hide="phone,tablet">Email</th>
            <th data-hide="phone">SĐT</th>
            <th data-hide="phone">C.Ngành</th>
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
                            <td><?php echo $i ?></td>
                            <td style="text-align: center;">
                            <a href="<?php echo $url ?>" data-lightbox="example-2" title="<?php echo $rows->name ?>">
                                <object style="width: 60px;height:60px;" class="img-thumbnail img-responsive" data="<?php echo $url ?>">            
                                <img style="width: 50px;height:50px;" class="img-responsive" src="<?php echo base_url('public/images/upload-image/noavatar92.png') ?>" />
                                </object>
                            </a>
                            </td>
                            <td><?php echo $rows->username ?></td>
                            <td><?php echo $rows->name ?></td>
                            <td><?php echo $rows->email ?></td>
                            <td><?php echo $rows->phone ?></td>
                            <td><?php echo $this->my_lib->get_first_letter($rows->TenCN) ?></td>
                        </tr>
                    <?php
                    $i++;
                }
            }
            else
            {
                ?>
                    <tr>
                        <td colspan="5" class="center">Không tìm thấy thông tin nào</td>
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

