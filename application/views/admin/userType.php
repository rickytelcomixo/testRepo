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
		<form class="form-horizontal" action="<?php echo base_url().'userType/index/'.$option ?>" method="post">
      <div class="form-group required">
        <label class="col-lg-3 control-label" for="usertype">Jenis Pengguna</label>
        <div class="col-lg-9">
        	<input id="usertype" value="<?php echo isset($userTypeEdit)?$userTypeEdit[0]['TITLE']:''?>" name="usertype" class="form-control" autocomplete="off" type="text" placeholder="Jenis Pengguna" required>
        </div>
      </div>
			<div class="form-group required">
        <label class="col-lg-3 control-label" for="rank">Level Pengguna</label>
        <div class="col-lg-9">
        	<input id="rank" value="<?php echo isset($userTypeEdit)?$userTypeEdit[0]['RANK']:''?>" name="rank" class="form-control" autocomplete="off" type="text" placeholder="Level Pengguna" required>
        </div>
      </div>
			<input id="usertype-id" name="usertype-id" value="<?php echo isset($userTypeEdit)?$userTypeEdit[0]['ID']:''?>" type="hidden">
      <div class="form-group">
        <div class="col-lg-offset-3 col-lg-9">
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
            <a href="<?php echo base_url().'userType/index/add'; ?>" class="btn btn-warning btn-sm" >Cancel</a>
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
      <h3 class="panel-title">Senarai Jenis Pengguna</h3>
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
            <th>JENIS PENGGUNA</th>
            <th>LEVEL</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
      <?php
      if($userType){
          foreach($userType as $val){
              echo '
                  <tr>
              <td>'.$val['TITLE'].'</td>
              <td>'.$val['RANK'].'</td>
              <td>';
              if(isEntitle('edit')){
                echo '
                <a role="button" class="btn btn-primary btn-xs" href="'.base_url().'userType/index/edit/'.$val['ID'].'" ><i class="fa fa-pencil" title="Edit"></i> Edit</a>';
              }

              if(isEntitle('delete')){
                echo '
                <a href="'.base_url().'userType/index/delete/'.$val['ID'].'" class="btn btn-danger btn-xs" onclick="return confirm(\'Confirm delete. Are you sure?\')" title="Delete" ><i class="fa fa-trash"></i> Delete</a>';
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

<script type="text/javascript">
    
$(document).ready(function(){

});
</script>