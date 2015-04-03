<div id="desktop-menu">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 id="mobile_home">Danh Mục</h4>   
        </div>
        <?php
            if (empty($cur_page)) $cur_page = NULL;
        ?>
        <a href="<?php echo base_url('trang-chu.chn') ?>" class="list-group-item <?php if (@$cur_page == 'home') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Trang Chủ</a>
        <a href="<?php echo base_url('danh-sach-loai-de-tai.html') ?>" class="list-group-item <?php if (@$cur_page == 'dsdt') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Danh sách đề tài</a>
        <a href="<?php echo site_url('danh-sach-giang-vien/page/1') ?>" class="list-group-item <?php if (@$cur_page == 'dsgv') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Thông tin giảng viên</a>
        <a href="<?php echo site_url('danh-sach-sinh-vien/page/1') ?>" class="list-group-item <?php if (@$cur_page == 'dssv') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Thông tin sinh viên</a>
        <a href="<?php echo base_url('huong-dan-dang-ky.html') ?>" class="list-group-item <?php if (@$cur_page == 'huongdan') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Hướng dẫn đăng ký</a>    
        <a href="<?php echo base_url('thong-ke.html') ?>" class="list-group-item <?php if (@$cur_page == 'thongke') echo 'active' ?>"><span class="pull-right"><i class="icon-chevron-right"></i></span>Thống kê</a>    
        <a data-toggle="modal" href="#seach_box" class="list-group-item"><span class="pull-right"><i class="icon-chevron-right"></i></span>Tìm kiếm</a>
    </div><!-- /panel-default -->

<?php
    if ($this->session->userdata('da_dang_nhap')===true)
    {
        if ($this->session->userdata('usertype') === 'sinhvien')
        {
            ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 id="mobile_sinhvien">Sinh viên</h4>     
                    </div>
                    <?php $this->load->view('includes/menu_quantri_sinhvien') ?>
                </div><!-- /panel-default -->
            <?php
        }
        else if ($this->session->userdata('usertype') === 'giangvien')
        {
            ?>
                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 id="mobile_giangvien">Giảng viên</h4></li>     
                    </div>
                    <?php $this->load->view('includes/menu_quantri_giangvien') ?>
                </div><!-- /panel-default -->
            <?php
        }
    }
?>
<!--============================Bench==================-->
<?php
    $time_query=$this->benchmark->elapsed_time('total_execution_time_start','total_execution_time_end');
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 id="mobile_thongke">Thống kê</h4>   
        </div>
        <a class="list-group-item">Timing : <span class="badge"><?php echo @$time_query ?></span></a>
        <a class="list-group-item">Memory :  <span class="badge"><?php echo @$this->benchmark->memory_usage();?></span></a>
        <a class="list-group-item">Lượt truy cập : <span class="badge"><?php echo @$hit_counter ?></span></a>    
        <a style="text-decoration: underline;" data-toggle="modal" data-target="#who_online" title="Who is online ?" href="javascript:void();" class="list-group-item">Đang trực tuyến: <span class="badge"><?php echo @$online_user ?></span></a>    
    </div>
</div>

<!-- Modal Who online -->
<div class="modal fade" id="who_online" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Online Users</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>STT</td>
                    <td>Tên SV</td>
                </tr>
            </thead>
            <?php
                if(!empty($online_user_list))
                {
                    $i=1; 
                    foreach ($online_user_list as $list)
                    {
                        $udata = unserialize($list->user_data);
                        if ($udata['usertype'] == 'sinhvien')
                        {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $udata['name'] ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                }
            ?>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- ########################### Form ###########################-->
<?php $this->load->view('timkiem/tim_kiem_form') ?>
<!-- ===================================Ajax========================= -->
<script>
$(document).ready(function(){
    $("#cpa-form").submit(function(e){
    if ($("#parameter1").val() == '')
    {
        $('#err_tk').html('<div class="alert alert-danger">Vui lòng nhập từ khoá tìm kiếm</div>');
        $("#parameter1").focus();
        return false;
    }
});
})
</script>

