<div class="alert alert-info">
        <div id="avatar" style="float: left;margin-right:20px;">
            <?php
            if ($this->session->userdata('usertype') == 'giangvien')
            {
                if (!empty($avatar))
                {
                    ?>
                    <img style="width: 92px; height:92px;" class="thumbnail" src="<?php echo base_url('public/images/upload-image/'.$avatar) ?>" />
                    <?php
                }
                else
                {
                    ?>
                    <img style="width: 92px; height:92px;" class="thumbnail" src="<?php echo base_url('public/images/upload-image/noavatar92.png') ?>" />
                    <?php
                }
            }
            else if ($this->session->userdata('usertype') == 'sinhvien')
            {
                $url = 'http://online.hcmute.edu.vn/HinhSV/'.$this->session->userdata('username').'.jpg';
                ?>
                <object style="width: 92px;height:92px;" class="img-thumbnail img-responsive" data="<?php echo $url ?>">            
                    <img style="width: 82px;height:82px;" class="img-responsive" src="<?php echo base_url('public/images/upload-image/noavatar92.png') ?>" />
                </object>
                <?php
            }
            ?>
        </div>
            Chào mừng  
            <span>
                <?php
                $usertype = $this->session->userdata('usertype');
                if ($usertype == 'sinhvien') echo "sinh viên ";
                else if ($usertype=='giangvien') echo "giảng viên ";
                else if ($usertype=='admin') echo 'admin';
                ?>
            </span>
            <strong class="text-danger"><?php echo $this->session->userdata('name') ?></strong>
            <br /> 
            đến với hệ thống Đăng Ký Đề Tài Khoa Công Nghệ Thông Tin
            <br />
        <div class="clearfix"></div>
</div>

<!--
<h3 class="text-info">Thông tin cấu hình : </h3>
<hr />
<ul>
    <?php
        /*
        if (!empty($info_cauhinh))
        {
            echo '<li>Tên cấu hình : '.$info_cauhinh->tenloai.' '.$info_cauhinh->NamBD.'</li><hr>';
            if($this->session->userdata('usertype')=='giangvien')
            {
                echo '<li>Thời gian giảng viên bắt đầu đăng ký đề tài &nbsp;: '.date('H:i d-m-Y',strtotime($info_cauhinh->thoigianGVbatdaudk)).'</li><hr>';
                echo '<li>Thời gian giảng viên kết thúc đăng ký đề tài : '.date('H:i d-m-Y',strtotime($info_cauhinh->thoigianGVketthucdk)).'<hr></li>';
            }
            else if ($this->session->userdata('usertype')=='sinhvien')
            {
                echo '<li>Thời gian sinh viên bắt đầu đăng ký đề tài &nbsp;: '.date('H:i d-m-Y',strtotime($info_cauhinh->thoigianSVbatdaudk)).'</li><hr>';
                echo '<li>Thời gian sinh viên kết thúc đăng ký đề tài : '.date('H:i d-m-Y',strtotime($info_cauhinh->thoigianSVketthucdk)).'</li><hr>';
            }
        }
        else
        {
            echo '<li>Chưa cập nhật</li><hr>';
        }
        */
    ?>
-->
    <?php
        if (!empty($duoc_dk_detai))
        {
            if ($duoc_dk_detai == 1)
            {
                $duoc_dk_detai = 'Bạn không có tên trong danh sách đăng ký đề tài lần này';
                echo '<li class="text-warning"> Chú ý : '.$duoc_dk_detai.'</li>';
                //echo '<script>alert("Bạn không có tên trong danh sách đăng ký đề tài lần này")</script>';
            }
            else if ($duoc_dk_detai == 2)
            {
                $duoc_dk_detai = "Hiện tại chưa đến thời hạn đăng ký đề tài";
                echo '<li class="text-warning"> Chú ý : '.$duoc_dk_detai.'</li>';
                //echo '<script>alert("Hiện tại chưa đến thời hạn đăng ký đề tài")</script>';
            }
            else if ($duoc_dk_detai==3)
            {
                $duoc_dk_detai = "Bạn được phép đăng ký đề tài";
                echo '<li class="text-success"> Chú ý : '.$duoc_dk_detai.'</li>';
                //echo '<script>alert("Bạn được phép đăng ký đề tài")</script>';
            }
            else if ($duoc_dk_detai==4)
            {
                $duoc_dk_detai = "Chưa đến thời hạn đăng ký đề tài";
                echo '<li class="text-danger"> Chú ý : '.$duoc_dk_detai.'</li>';
                //echo '<script>alert("Chưa đến thời hạn đăng ký đề tài")</script>';
            }
        }
    ?>
<hr />
<h3 class="text-danger">Quản trị tài khoản : </h3>
<hr />
<style>
#img-cover img
{
    width:80px!important;
    height:80px!important;
}
</style>
<ul>
    <?php
        if ($this->session->userdata('usertype') == "giangvien")
        {
            ?>
                <!-- button type file -->
                <form method="post" action="<?php echo site_url('user/doi-avatar') ?>" enctype="multipart/form-data">
                    <li><a>Đổi ảnh đại diện</a></li>
                    <div id="img-cover" style="display:none;"></div>
                    <input type="file" name="hinh" id="uploadImage" accept="image/x-png, image/gif, image/jpeg" class="btn btn-default pull-left"/>&nbsp;
                    <input type="submit" id="upload" style="display: none;" class="btn btn-primary" value="Upload and Change" />
                </form>
                <hr />
                <!-- End button type file -->
            <?php
        }
    ?>
    <li><a href="<?php echo base_url('user/doi-thong-tin-ca-nhan.html') ?>">Đổi thông tin cá nhân</a></li><hr />
    <li><a href="<?php echo base_url('user/doi-mat-khau.html') ?>">Đổi mật khẩu</a></li><hr />
</ul>
<script>
$(document).ready(function(){
    $("input").change(function(e) {
    for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
        var file = e.originalEvent.srcElement.files[i];
        
        var img = document.createElement("img");
        var reader = new FileReader();
        reader.onloadend = function() {
             img.src = reader.result;
        }
        reader.readAsDataURL(file);
        $("#img-cover").show();
        $("#img-cover").html(img);
        $("#upload").show();
    }
});
    //upload ajax
    $("#upload").click(function(){
        //alert("ok");
        var imgVal = $('#uploadImage').val(); 
        if (imgVal == '')
        {
            alert("Bạn chưa chọn hình");
            return false;
        }
    })
})
</script>