<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="icon" href="<?php echo base_url('public/images/it_spkt.png') ?>" type="image/x-icon" />
  <link rel="shortcut icon" href="<?php echo base_url('public/images/it_spkt.png') ?>"/>
  <title>::. <?php echo $heading ?> .::</title>
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url('public/css/style.css') ?>" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url('public/css/footable.core.css') ?>" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url('public/css/footable.standalone.css') ?>" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url('public/font-awesome/css/font-awesome.min.css') ?>"/>
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url('public/datepicker/jquery.simple-dtpicker.css') ?>" />
  
  <script type="text/javascript" src="<?php echo base_url('public/js/jquery-1.10.2.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('public/js/footable.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('public/js/my_script.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('public/datepicker/jquery.simple-dtpicker.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('public/ckeditor/ckeditor.js') ?>"></script>
  <!-- IE8 -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Font Awesom core -->
  <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo base_url('public/font-awesome/css/font-awesome-ie7.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/font-awesome/css/bootstrap-ie7.css') ?>">
  <![endif]-->
  <!-- Force IE7
    <meta http-equiv="X-UA-Compatible" content="IE=7"/>
  -->
</head>
<body>
<div id="menu">
    <?php $this->load->view('includes/left-sidebar-mobile') ?>
</div>        
<div id="container">
    <div id="mobile-bar">
        <?php $this->load->view('includes/mobile-bar') ?>
    </div>
    <div id="navigation">
        <?php $this->load->view('includes/main_nav') ?>
    </div>
    <div id="wrapper">
        <div class="container">
            <div class="row">
                <div id="left-content">
                    <div class="col-md-3">
                        <!-- Menu desktop -->
                        <?php $this->load->view('includes_admin/left-sidebar') ?>
                    </div>
                </div>
                <div class="col-md-9">
                    <?php
                        $this->load->view('includes/breadcrum');
                        $this->load->view('includes/time_bar')
                    ?>
                    <div class="panel panel-default">
                        <div  style="color: rgb(7, 132, 163);" class="panel-heading">
                            <h4 style="font-family: verdana;color:rgb(87,87,87);"><?php echo @$heading ?></h4>
                        </div>
                        <div class="panel-body">
                            <?php
                                foreach ($path as $view)
                                {
                                    $this->load->view($view);
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                        $this->load->view('includes/breadcrum')
                    ?>
                    <?php $this->load->view('includes/right_thongke') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="footer">
        <hr />
            <h5 class="text-center text-danger">Khoa Công nghệ Thông tin - Đại học Sư phạm Kỹ thuật TP. Hồ Chí Minh</h5>
            <h5 class="text-center text-danger">Số 1, Võ Văn Ngân, Thủ Đức, TP. Hồ Chí Minh</h5>
        </div>
    </div>
</div><!-- End #container -->
<div id="loading">
    <span>Đang tải ...</span>
</div>
<script type="text/javascript" src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>

