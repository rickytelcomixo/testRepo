<?php if(isEntitle('add') || isEntitle('edit')){ ?>
<div class="panel panel-success">
	<div class="panel-heading">
    	<h3 class="panel-title">
            <?php echo $formHeader; ?> 
            <!-- <div class="ibox-tools">
                <a href="<?php echo base_url()?>user/listUser" class="btn btn-block btn-success btn-xs">List Users</a>
            </div> -->
        </h3>             
  	</div>
	<div class="panel-body">
		<form class="form-horizontal" action="<?php echo base_url().'user/index/'.$option ?>" method="post">
      <div class="form-group required">
          <label class="col-lg-3 control-label" for="username">Username</label>
          <div class="col-lg-9">
          	<input id="username" value="<?php echo isset($userEdit)?$userEdit[0]['username']:''?>" name="username" class="form-control" autocomplete="off" type="text" placeholder="Username" required>
          </div>
      </div>
			<div class="form-group required">
          <label class="col-lg-3 control-label" for="username">Full Name</label>
          <div class="col-lg-9">
          	<input id="fullname" value="<?php echo isset($userEdit)?$userEdit[0]['fullname']:''?>" name="fullname" class="form-control" autocomplete="off" type="text" placeholder="Full Name" required>
          </div>
      </div>

      <div class="form-group required">
        <label class="control-label col-sm-3" for="usertype">User Type</label>
        <div class="col-sm-9">
          <select class="select2 form-control" id="usertype" name="usertype" required>
          <?php 
          $loggedInUser = $this->session->userdata('loggedIn');
          if(count($userType)>0){
            foreach($userType as $arr){
              if($loggedInUser['RANK'] <= $arr['RANK']){
                echo '<option value="'.$arr['ID'].'" '.(isset($userEdit)&&$userEdit[0]['userTypeId']==$arr['ID']?'selected':'').'>'.$arr['TITLE'].'</option>';
              }
            }
          }
          ?>
          </select>
        </div>
      </div>

			<div class="form-group required">
          <label class="col-lg-3 control-label" for="password">Password</label>
          <div class="col-lg-9">
          	<input id="password" value="<?php echo isset($userEdit)?$userEdit[0]['password']:''?>" name="password" class="form-control" autocomplete="off" placeholder="Password" required>
          </div>
      </div>

			<input id="user-id" name="user-id" value="<?php echo isset($userEdit)?$userEdit[0]['id']:''?>" type="hidden">
      <div class="form-group">
          <div class="col-lg-offset-3 col-lg-9">
              <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
              <a href="<?php echo base_url().'user/index/add'; ?>" class="btn btn-warning btn-sm" >Cancel</a>
          </div>
      </div>
    </form>
	</div>
	<!-- <div class="panel-footer">
		Panel footer
	</div> -->
</div>
<?php } ?>

<?php if(isEntitle('view')){ ?>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Senarai Pengguna</h3>
  </div>
    <div class="panel-body">
        <div class="box">
      <!--<div class="box-header">
        <h3 class="box-title">Data Table With Full Features</h3>
      </div>-->
      <!-- /.box-header -->
      <div class="box-body">
        <table id="list-table" class="table table-bordered table-striped table-responsive">
          <thead>
            <tr>
              <th>NAMA</th>
              <th>USERNAME</th>
              <th>USER TYPE</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
        <?php
        if($users){
            foreach($users as $val){
                echo '
                    <tr>
                <td>'.$val['fullname'].'</td>
                <td>'.$val['username'].'</td>
                <td>'.$val['userType'].'</td>
                <td>';

                if(isEntitle('edit')){
                echo '
                  <a role="button" class="btn btn-primary btn-xs" href="'.base_url().'user/index/edit/'.$val['id'].'" ><i class="fa fa-pencil" title="Edit"></i> Edit</a>';
                }

                if(isEntitle('delete')){
                echo '
                  <a href="'.base_url().'user/index/delete/'.$val['id'].'" class="btn btn-danger btn-xs" onclick="return confirm(\'Confirm delete. Are you sure?\')" title="Delete" ><i class="fa fa-trash"></i> Delete</a>';
                }

                echo '
                </td> 
              </tr>
                ';
            }
        }
        ?>
        </tbody>
       </table>
    </div>
</div>
<?php } ?>
