<div id="banner-desktop">
    <div class="container">
        <div id="banner">
            <div id="login-area">
                <?php
                    if ($this->session->userdata('da_dang_nhap')!==true)
                    { 
                        echo '<a data-toggle="modal" href="#dang_nhap">Đăng nhập</a>';
                    }
                    else
                    {
                        $name=$this->session->userdata('name');
                        $usertype = $this->session->userdata('usertype');
                        if ($usertype=='sinhvien') $usertype='SV ';
                        else if ($usertype=='giangvien') $usertype='GV ';
                        else if ($usertype=='admin') $usertype='Admin ';
                        else $usertype='User';
                        echo '<a data-toggle="modal" href="#thong_tin">'.'<i>'.$usertype.'</i>: '.$name.'</a>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- ############################ Đăng nhập ############################## -->
<div class="modal fade" id="dang_nhap">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Đăng nhập</h4>
      </div>
      <form method="post" action="<?php echo base_url('xu-ly-dang-nhap') ?>" id="frm-login">
          <div class="modal-body">
            <div id="err_login"></div>
            <div id="login_here">
                <label>Username : </label>
                <input type="text" class="form-control" name="username" id="username" />
                <label>Password : </label>
                <input type="password" class="form-control" name="password" id="password" />
            <br />
            <?php echo anchor('quen-mat-khau','Quên mật khẩu','class="text-danger"') ?>
            </div>
            <br />
            <div id="waiting" style="display: none;">
                <div class="progress progress-striped active">
                  <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
            </div>            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"  id="login_btn">Đăng nhập</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ===================================Thông tin người dùng=========================-->
<div class="modal fade" id="thong_tin">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Thông tin người dùng</h4>
      </div>
      <?php if (!empty($info_user)): ?>
        <form method="post" action="<?php echo base_url('xu-ly-dang-nhap') ?>" id="frm-login">
          <div class="modal-body">
            <div id="err_login"></div>
            <p>Tên người dùng : <span class="text-info"><?php echo @$info_user->name ?></span></p>
            <?php
                if ($info_user->usertype == 'sinhvien')
                {
                    ?>
                    <p>MSSV : <span class="text-info"><?php echo @$info_user->username ?></span></p>
                    <?php
                }
            ?>
            <p>Chuyên ngành : <span class="text-info"><?php echo @$info_user->TenCN ?></span></p>
            <?php
                if (!empty($info_lop))
                {
                    echo '<p>Lớp : <span class="text-info">'.$info_lop->TenLop.'</span></p>';
                }
            ?>
            <br />        
          </div>
          <div class="modal-footer">
            <a href="<?php echo site_url('user/dang-xuat') ?>" type="button" class="btn btn-default">Đăng xuất</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </form>
      <?php endif; ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ===================================Ajax Login=========================-->
<script>
$(document).ready(function(){
    $("#frm-login").submit(function(e){
    if ($("#username").val() == '')
    {
        $('#err_login').html('<div class="alert alert-danger">Username chưa nhập</div>');
        $("#username").focus();
        return false;
    }
    else if ($("#password").val() == '')
    {
        $('#err_login').html('<div class="alert alert-danger">Password chưa nhập</div>');
        $("#password").focus();
        return false;
    }
    else
    {
        var form_data_login = {
            username: $("#username").val(),
            password: $("#password").val()
        };
        $.ajax({
            url:'<?php echo base_url('xu-ly-dang-nhap') ?>',
            type:'POST',
            async:true,
            data: form_data_login,
            success:function(msg_login){
                //alert(msg);
                if (msg_login == 'false')
                {
                    $('#err_login').html('<div class="alert alert-danger">Tên hoặc mật khẩu không chính xác</div>');
                    $("#password").val("");
                    $("#password").focus();
                    return false;
                }
                else
                {
                    $("#login_here").hide();
                    $(".modal-footer").hide();
                    
                    $('#err_login').html('<div class="alert alert-success"><strong>Đăng nhập thành công</strong><span> Hệ thống tự chuyển sau vài giây ...</span></div>');
                    setTimeout(
                      function() 
                      {
                        window.location.href = ''+msg_login+'';
                      }, 2000);
                }
            }
            });
            return false;
    }
});
})
//Load wating bar
 $(document).ajaxStart(function () {
        $("#waiting").show();
    }).ajaxStop(function () {
        $("#waiting").hide();
    });
</script>

