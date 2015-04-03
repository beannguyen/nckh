<ul class="list-unstyled" >
<?php
    foreach ($ds_thongbao as $rows)
    {
        $tieude = $this->my_lib->khong_dau($rows->tenthongbao);
        ?>

            <a href="<?php echo site_url('tin-tu-giao-vu/'.$tieude.'-'.$rows->id) ?>">
                <li class="article-area">
                    <p>
                    <span class="btn btn-primary btn-sm"><?php echo date('d/m/Y - H:i',strtotime($rows->ngaycapnhat)); ?></span>
                    <?php echo $rows->tenthongbao ?>
                    <?php
                        if ($rows->cotinmoi == '1')
                        {
                            ?>
                            <img src="<?php echo base_url('public/images/new1.gif') ?>"/>
                            <?php
                        }
                    ?>
                    </p>
                </li>
            </a>
            
            
        <?php
    }
?>
</ul>
