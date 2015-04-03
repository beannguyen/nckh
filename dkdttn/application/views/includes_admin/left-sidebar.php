<div class="panel panel-default" id="trangchu">
    <div class="panel-heading">
        <h4 id="mobile_home">Quản trị hệ thống</h4>   
    </div>
    <a href="<?php echo site_url('user/quan-ly-thong-bao') ?>" class="list-group-item <?php if (@$cur_page == 'quan_tri_thongbao') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Quản trị thông báo</a>
    <a href="<?php echo site_url('user/manager-config') ?>" class="list-group-item <?php if (@$cur_page == 'quan_tri_cau_hinh') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Quản trị cấu hình</a>
    <a href="<?php echo site_url('user/quan-ly-nguoi-dung') ?>" class="list-group-item <?php if (@$cur_page == 'quan_tri_nguoi_dung') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Quản trị người dùng</a>
    <a href="<?php echo site_url('user/quan-ly-de-tai') ?>" class="list-group-item <?php if (@$cur_page == 'quan_tri_de_tai') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Quản trị đề tài</a>
	<a href="<?php echo site_url('user/quan-ly-dang-ky-de-tai') ?>" class="list-group-item <?php if (@$cur_page == 'quan_tri_dangkychuyennganh') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Quản trị đăng ký chuyên ngành</a>
    <a href="<?php echo site_url('user/quan-ly-chung') ?>" class="list-group-item <?php if (@$cur_page == 'quan_tri_chung') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Quản trị chung</a>
    
</div><!-- /panel-default -->
<!--============================Bench==================-->
<?php
    $time_query=$this->benchmark->elapsed_time('total_execution_time_start','total_execution_time_end');
?>
<div class="panel panel-default" id="thongke_left">
    <div class="panel-heading">
        <h4 id="mobile_thongke">Thống kê</h4>   
    </div>
    <a class="list-group-item">Timing : <span class="badge"><?php echo @$time_query ?></span></a>
    <a class="list-group-item">Memory :  <span class="badge"><?php echo @$this->benchmark->memory_usage();?></span></a>
    <a class="list-group-item">Lượt truy cập : <span class="badge"><?php echo @$hit_counter ?></span></a>    
    <a class="list-group-item">Đang trực tuyến :  <span class="badge"><?php echo @$online_user ?></span></a>    
    
</div>