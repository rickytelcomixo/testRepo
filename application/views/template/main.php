<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/ionicons.min.css">
  
   <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

  <!-- multi-select.css -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/multi-select.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/select2/select2.min.css">
  <!-- DataTable -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/datatables.min.css">
  
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/pace/pace.min.css">

  <!-- Editor style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" >

  <!-- Editor summernote -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/summernote/summernote.css" >

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/skins/skin-blue-light.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/custom.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 2.2.0 -->
  <script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url()?>assets/dist/js/app.min.js"></script>
  <!-- PACE -->
  <script src="<?php echo base_url()?>assets/plugins/pace/pace.min.js"></script>

  <script src="<?php echo base_url()?>assets/dist/js/jquery.multi-select.js"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url()?>assets/plugins/select2/select2.full.min.js"></script>
  <!-- Moment -->
  <script src="<?php echo base_url()?>assets/dist/js/moment.min.js"></script>

  <!-- Chart -->
  <script src="<?php echo base_url()?>assets/plugins/chartjs/Chart.min.js"></script>
  
  <!-- Data Table -->
  <script src="<?php echo base_url()?>assets/plugins/datatables/datatables.min.js"></script>

  <!-- Date Picker -->
  <script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker.js"></script>

  <!-- Editor-->
  <script src="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

  <!-- Editor summernote -->
 <script src="<?php echo base_url()?>assets/plugins/summernote/summernote.min.js"></script>

  <!-- CK Editor -->
  <script src="<?php echo base_url()?>assets/plugins/ckeditor/ckeditor.js"></script>
  
  <!-- ChartJS -->
  <script src="<?php echo base_url()?>assets/plugins/chartjs/Chart.js"></script>

  <script src="<?php echo base_url()?>assets/dist/js/custom.js"></script>

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
       Both of these plugins are recommended to enhance the
       user experience. Slimscroll is required when using the
       fixed layout. -->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <?php $this->load->view('template/header'); ?>
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('template/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php $this->load->view('template/content'); ?> 
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php $this->load->view('template/footer'); ?>

  <!-- Control Sidebar -->
  <?php $this->load->view('template/control-sidebar'); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

</body>
</html>
