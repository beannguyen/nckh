<div class="text-center">
    <p class="badge red">Tổng số đề tài : <?php echo @$count ?></p>
</div>
<table class="table footable-loaded footable tablet breakpoint" data-page-size="5">
	<thead>
		<tr>
            <th>STT</th>
			<th data="true">Tên đề tài</th>
			<th data-hide="phone,tablet" style="width: 82px;">Số lượng</th>
            <th data="true" style="width: 80px;">Chi tiết</th>
		</tr>
	</thead>
    <tbody>
    <?php
        $i=1;
        foreach ($query as $rows)
        {
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rows->tendetai ?></td>
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
    ?>
    </tbody>
 </table>