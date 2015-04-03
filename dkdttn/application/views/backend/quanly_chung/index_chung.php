<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">Niên khóa</a></li>
  <li><a href="#profile" data-toggle="tab">Lớp</a></li>
  <li><a href="#messages" data-toggle="tab">Chuyên ngành</a></li>
  <li><a href="#settings" data-toggle="tab">Logs</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home"><?php $this->load->view('backend/quanly_chung/nienkhoa_index') ?></div>
  <div class="tab-pane" id="profile"><?php $this->load->view('backend/quanly_chung/lop_index') ?></div>
  <div class="tab-pane" id="messages"><?php $this->load->view('backend/quanly_chung/chuyennganh_index') ?></div>
  <div class="tab-pane" id="settings"><?php $this->load->view('backend/quanly_chung/log_index') ?></div>
</div>
<br />
