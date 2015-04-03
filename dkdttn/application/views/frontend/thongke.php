<script type="text/javascript" src="<?php echo base_url('public/js/Chart.js') ?>"></script>
<ul class="nav nav-tabs nav-justified" id="myTab">
  <li class="active"><a href="#home" data-toggle="tab">Đề tài</a></li>
  <li><a href="#profile" data-toggle="tab">Sinh Viên</a></li>
  <li><a href="#messages" data-toggle="tab">Giảng viên</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="home"><?php $this->load->view('thongke/thongke_detai') ?></div>
  <div class="tab-pane" id="profile"><?php $this->load->view('thongke/thongke_sinhvien') ?></div>
  <div class="tab-pane" id="messages"><?php $this->load->view('thongke/thongke_giangvien') ?></div>
</div>
