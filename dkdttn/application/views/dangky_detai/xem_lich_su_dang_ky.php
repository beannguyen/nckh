<table class="table demo" data-page-size="5">
<?php
if(!empty($lichsu_list))
{
    ?>
    <thead>
		<tr>
			<th data="true" style="width: 10px;">STT</th>
            <th date="true">Mã đề tài</th>
			<th data-hide="phone,tablet">Tên đề tài</th>
            <th>Hoạt động</th>
            <th>Thời gian</th>
		</tr>
	</thead>
    <?php
    $i=1;
    foreach ($lichsu_list as $rows)
    {
       echo '<tr>'; 
       echo '<td>'.$i.'</td>';
       echo '<td>'.$rows->id.'</td>';
       echo '<td>'.$rows->tendetai.'</td>';
       echo '<td>'.$rows->tenhoatdong.'</td>';
       echo '<td>'.date('H:i A d/m/Y',strtotime($rows->thoigian)).'</td>';
       echo '</tr>'; 
       $i++;
    }
}
else
{
    echo '<tr><td>Không có thông tin nào !</td></tr>';
}
?>
</table>
