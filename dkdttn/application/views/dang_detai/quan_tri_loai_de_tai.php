<table class="table demo" data-page-size="5">
	<thead>
		<tr>
			<th data="true">STT</th>
			<th>Loại đề tài</th>
		</tr>
	</thead>
	<tbody>
        <?php
            $i=1;
            foreach ($query_ds_loai_de_tai as $rows)
            {
                ?>
                
                    <tr>
                        <td><?php echo $i ?></td>
                        <td>
                        <?php 
                            $tenloai = mb_strtolower(url_title(removesign($rows->tenloai))); 
                        ?>
                        <?php
                            echo anchor('user/danh-sach-de-tai-gv/'.$rows->id,$rows->tenloai.' | K'.$rows->TenNK.' '.'('.$rows->NamBD.'-'.$rows->NamKT.')'.' | Học kỳ '.$rows->hocky.' ('.$rows->namhoc.')',"style='color: rgb(68,68,68)!important;'");
                        ?>
                        </td>
                    </tr>
                <?php
                $i++;
            }
        ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5"></td>
		</tr>
	</tfoot>
</table>