<?php if (!empty($query_ct_tin)): ?>
    <h4 style="color: #bb240d!important;"><?php echo $query_ct_tin->tenthongbao ?></h4>
    <span style="font-size: 0.9em;color: rgb(204, 0, 0);">
        (<?php echo date('d/m/Y - H:i',strtotime($query_ct_tin->ngaycapnhat)); ?>)
    </span>
    <hr /> 
    <div class="chitiet_thongbao">
        <?php 
            echo ($query_ct_tin->noidung);   
        ?>
    </div>
<?php endif; ?>

<hr />
<h3 class="text-danger">&nbsp;&nbsp;Tin liên quan</h3>
<hr />
<ul>
    <?php
        foreach ($tin_lien_quan as $rows)
        {
            $tieude = mb_strtolower(url_title(removesign($rows->tenthongbao))); 
            ?>
                <a href="<?php echo site_url('tin-tu-giao-vu/'.$tieude.'-'.$rows->id) ?>">
                    <li><p>
                        <span class="badge green"><?php echo date('d/m/Y - H:i',strtotime($rows->ngaycapnhat)); ?></span>
                        <?php echo $rows->tenthongbao ?>
                        <?php
                        if ($rows->cotinmoi == '1')
                        {
                            ?>
                            <img src="<?php echo base_url('public/images/new1.gif') ?>"/>
                            <?php
                        }
                        ?>
                    </p></li>
                </a>
            <?php
        }
    ?>
</ul>
