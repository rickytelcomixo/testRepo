<!-- Content Header (Page header) -->
    <section class="content-header">
      <?php 
      //set flash session and remmove after displayed
      echo $this->session->userdata('flash');
      $this->session->unset_userdata('flash');
      ?>
      <h1>
        <?php echo $contentHeader; ?>
        <!-- <small>Optional description</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->load->view($content); ?>
    </section>
 <!-- /.content -->