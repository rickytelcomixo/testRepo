<aside class="main-sidebar no-print">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->

      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->

	  <?php 
    $user = $this->session->userdata('loggedIn'); 
    $menuAccess = $this->session->userdata('menuAccess');
    ?>
	  
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
       
      <?php 
      if(count($menuAccess)>0){
        foreach($menuAccess as $arr){
          echo '
          <li class="'.($this->uri->segment(1) == $arr['METHOD']? 'active':'').'" >
           <a href="'.base_url().$arr['METHOD'].$arr['PARAMS'].'"><i class="'.$arr['ICON'].'"></i> <span>'.$arr['TITLE'].'</span></a>
          </li>';
        }
      }
      ?>
        <!-- <li class="<?php echo ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '')? 'active':''; ?>">
			   <a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li> -->

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>