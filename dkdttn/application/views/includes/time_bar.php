<?php
if (!empty($random_tin))
{
    ?>
    <div class="well-sm">
        <span>
            <span id="random_tin">
            <i class="icon-bullhorn"></i>&nbsp;
            <img src="<?php echo base_url('public/images/bullet-blue-icon.png') ?>" />
            <?php @$ten_kodau = $this->my_lib->khong_dau($random_tin->tenthongbao) ?>
            <small>
                <a href="<?php echo @site_url('tin-tu-giao-vu/'.$ten_kodau.'-'.$random_tin->id) ?>">
                <?php echo @$random_tin->tenthongbao ?> <small style="color: rgb(87,87,87);">(<?php echo date("H:i d/m/Y",strtotime(@$random_tin->ngaycapnhat)) ?>)</small>
                </a>
            </small>
            <img src="<?php echo base_url('public/images/new1.gif') ?>"/>
            </span>
            <span id="time_bar">
            <?php
                echo '<span id="time" class="label label-primary pull-right"><i class="icon-time"></i> '.date('H')." giờ ".date('i').' phút, ngày '.date('d').' tháng '.date('m').', '.date('Y').'</span><br>';
            ?>
            </span>
        </span>    
    </div>
    <?php
}
?>
