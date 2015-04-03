<?php if (!empty($info_nguoidung)): ?>
<form method="post" action="<?php echo site_url('user/detail-user') ?>">
<input type="hidden" name="username" value="<?php echo $info_nguoidung->username ?>" />
<table class="table demo">
    <tr>
        <td colspan="2" style="text-align: center;">
            <object style="width: 90px;height:100px;" class="img-thumbnail img-responsive text-center" data="<?php echo 'http://online.hcmute.edu.vn/HinhSV/'.$info_nguoidung->username.'.jpg' ?>">            
                <img style="width: 80px;height:90px;" class="img-responsive" src="http://localhost/ci_dkdt/public/images/upload-image/noavatar92.png"/>
            </object>
        </td>
    </tr>
    <tr>
        <td colspan="2"><h4 class="text-center text-danger"><?php echo $info_nguoidung->name.' - '.$info_nguoidung->username ?></h4></td>
    </tr>
    <tr>
        <th>ID</th>
        <td><span class="badge red"><?php echo $info_nguoidung->id ?></span></td>
    </tr>
    <tr>
        <th>Usertype</th>
        <td>
            <select name="usertype">
                <option <?php if($info_nguoidung->usertype == 'sinhvien') echo 'selected'  ?> value="sinhvien">Sinh viên</option>
                <option <?php if($info_nguoidung->usertype == 'giangvien') echo 'selected'  ?> value="giangvien">Giảng viên</option>
                <option <?php if($info_nguoidung->usertype == 'admin') echo 'selected'  ?> value="admin">Admin</option>
            </select>
            
        </td>
    </tr>
    <?php if (!empty($cn_list)): ?>
        <tr>
            <th>C.Ngành</th>
            <td>
                <select name="chuyennganh">
                    <?php foreach ($cn_list as $cn): ?>
                        <option <?php if ($info_nguoidung->chuyennganh === $cn->id) echo 'selected'; ?> value="<?php echo $cn->id ?>"><?php echo $cn->TenCN ?></option>
                    <?php endforeach ?>
                </select>
            </td>
        </tr>    
    <?php endif; ?>
    
    <tr>
        <th>Email</th>
        <td><input type="text" class="form-control" name="email" value="<?php echo $info_nguoidung->email ?>" /></td>
    </tr>
    <tr>
        <th>Phone</th>
        <td><input type="text" class="form-control" name="phone" value="<?php echo $info_nguoidung->phone ?>" /></td>
    </tr>
    <!--
    <?php if(($info_nguoidung->usertype)=='sinhvien'): ?>
        <tr>
            <th>Điểm TB</th>
            <td><input type="text" class="form-control" name="diem" value="<?php echo $info_nguoidung->diem ?>" /></td>
        </tr>
        <tr>
            <th>Tổng TC</th>
            <td><input type="text" class="form-control" name="tong_tc" value="<?php echo $info_nguoidung->TongTC ?>" /></td>
        </tr>
    <?php endif; ?>  
    -->
    <tr>
        <th>Register Date</th>
        <td><span class="badge green"><?php echo date("H:i:s d/m/Y",strtotime($info_nguoidung->registerDate))?></span></td>
    </tr>
    <tr>
        <th>Last Visit</th>
        <td><span class="badge green"><?php echo date("H:i:s d/m/Y",strtotime($info_nguoidung->lastvisitDate))?></span></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="submit" class="btn btn-primary" name="doi_thongtin" value="Lưu thông tin" />
            <button type="button" id="reset_btn" class="btn btn-danger">Reset mật khẩu</button>
        </td>
    </tr>    
</table>
</form>
<script>
$(document).ready(function(){
    $("#reset_btn").click(function(e){
        e.preventDefault();
        if (confirm('Mật khẩu sau khi reset sẽ là username; Bạn có chắc reset không ?'))
        {
             var form_data = {
            username : <?php echo $info_nguoidung->username  ?>,
            reset_mk : '1',
            };
            $.ajax({
                url:'<?php echo site_url('user/detail-user') ?>',
                type:'POST',
                async:true,
                data: form_data,
                success:function(msg){
                    alert(msg);
                }
            })
        }
    })
})
</script>
<?php endif; ?>
