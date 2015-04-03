<?php
    $time_query=$this->benchmark->elapsed_time('total_execution_time_start','total_execution_time_end');
?>
<div class="panel panel-default" id="thongke_right">
    <div class="panel-heading">
        <h4 id="mobile_thongke">Thống kê</h4>   
    </div>
    <a class="list-group-item">Timing : <span class="badge"><?php echo @$time_query ?></span></a>
    <a class="list-group-item">Memory :  <span class="badge"><?php echo @$this->benchmark->memory_usage();?></span></a>
    <a class="list-group-item">Lượt truy cập : <span class="badge"><?php echo @$hit_counter ?></span></a>    
    <a style="text-decoration: underline;" data-toggle="modal" data-target="#who_online" title="Who is online ?" href="javascript:void();" class="list-group-item">Đang trực tuyến:  <span class="badge"><?php echo @$online_user ?></span></a>    
</div>