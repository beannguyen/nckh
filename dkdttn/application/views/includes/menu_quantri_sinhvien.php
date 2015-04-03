<?php
    if ($this->session->userdata('da_dang_nhap')==true)
    {
        if (empty($cur_page)) $cur_page = NULL;
        ?>
        <a href="<?php echo site_url('user/quan-tri') ?>" class="list-group-item <?php if (@$cur_page == 'quantri') echo 'active' ?> "><span class="pull-right"><i class="icon-chevron-right"></i></span>Quản trị tài khoản</a>
        <a href="<?php echo site_url('user/dang-ky-de-tai') ?>" class="list-group-item <?php if (@$cur_page == 'dangky_dt') echo 'active' ?> "><span class="pull-right"><i class="icon-chevron-right"></i></span>Đăng ký đề tài</a>
        <a href="<?php echo site_url('user/quan-ly-nhom') ?>" class="list-group-item <?php if (@$cur_page == 'quanly_nhom') echo 'active' ?> "><span class="pull-right"><i class="icon-chevron-right"></i></span>Quản lý nhóm</a>
		<a href="<?php echo site_url('user/dang-ky-chuyen-nganh') ?>" class="list-group-item <?php if (@$cur_page == 'dangkychuyenngganh') echo 'active' ?> "><span class="pull-right"><i class="icon-chevron-right"></i></span>Đăng ký chuyên ngành</a>
        <a href="<?php echo site_url('user/lich-su-nguoi-dung') ?>" <?php echo base_url('user/lich-su-nguoi-dung') ?> class="list-group-item <?php if (@$cur_page == 'lich_su') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Lịch sử đăng ký</a>
        <a href="<?php echo site_url('user/dang-xuat') ?>" class="list-group-item"><span class="pull-right"><i class="icon-chevron-right"></i></span>Đăng xuất</a>
        <?php
    }
?>
<div class="modal fade" id="change_info">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Đổi thông tin cá nhân</h4>
      </div>
      <form>
          <div class="modal-body">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="<?php if (!empty($query_info)) echo $query_info->email ?>"  />
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="<?php  if (!empty($query_info)) echo $query_info->phone ?>" />
            <br />
            <div id="err"></div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"  id="login_btn">Đăng nhập</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
