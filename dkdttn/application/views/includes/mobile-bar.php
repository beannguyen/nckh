<span style="cursor: pointer;" class="pull-left" href="javascript:;" onclick="slideMenu(); return false;" id="slideicon"><i class="icon-reorder"></i></span>
<?php
if ($this->session->userdata('da_dang_nhap')!==true)
{ 
    ?>
        <span data-toggle="modal" href="#dang_nhap" class="pull-right btn btn-default btn-sm" id="#">Sign In</span>
        <p style="text-align: center;font-weight:bold;">Đăng ký đề tài</p>
    <?php
}
else
{
    $name=$this->session->userdata('name');
    $usertype = $this->session->userdata('usertype');
    if ($usertype=='sinhvien') $usertype='SV: ';
    else if ($usertype=='giangvien') $usertype='GV: ';
    else if ($usertype=='admin') $usertype='Admin: ';
    else $usertype='User';
    ?>
    <span data-toggle="modal" href="#thong_tin" class="pull-right btn btn-default btn-sm" id="#">Sign Out</span>
    <p style="text-align: center;font-weight:bold;"><?php echo $usertype.$name ?></p>
    <?php
}
?>