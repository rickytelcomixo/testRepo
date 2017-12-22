<div class="panel panel-success">
  <div class="panel-heading">
      <h3 class="panel-title"><?php echo $formHeader; ?></h3>
    </div>
  <div class="panel-body">
    <form id="usersForm" class="form-horizontal" action="<?php echo base_url().'menu/index/'.$option?>" method="post">
        <div class="form-group required">
          <label class="control-label col-lg-3" for="menu-title">Title</label>
          <div class="col-lg-8">
            <input type="text" name="menu-title" value="<?php echo isset($menuEdit[0]['TITLE'])?$menuEdit[0]['TITLE']:"" ?>" class="form-control" required="" />
          </div>
        </div>
        <div class="form-group required">
          <label class="control-label col-lg-3" for="menu-method">Method</label>
          <div class="col-lg-8">
            <input type="text" name="menu-method" value="<?php echo isset($menuEdit[0]['METHOD'])?$menuEdit[0]['METHOD']:"" ?>" class="form-control" required="" />
          </div>
        </div>
        <div class="form-group ">
          <label class="control-label col-lg-3" for="menu-params">Parameters</label>
          <div class="col-lg-8">
            <input type="text" name="menu-params" value="<?php echo isset($menuEdit[0]['PARAMS'])?$menuEdit[0]['PARAMS']:"" ?>" class="form-control" />
          </div>
        </div>
        <div class="form-group ">
          <label class="control-label col-lg-3" for="menu-icon">Icon</label>
          <div class="col-lg-8">
            <input type="text" name="menu-icon" value="<?php echo isset($menuEdit[0]['ICON'])?$menuEdit[0]['ICON']:"" ?>" class="form-control" />
          </div>
        </div>
        <div class="form-group ">
          <label class="control-label col-lg-3" for="menu-pos">Position</label>
          <div class="col-lg-8">
            <input type="text" name="menu-pos" value="<?php echo isset($menuEdit[0]['POSITION'])?$menuEdit[0]['POSITION']:"" ?>" class="form-control" />
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-lg-offset-3 col-lg-8">
            <input type="hidden" name="menu-id" value="<?php echo isset($menuEdit[0]['ID'])?$menuEdit[0]['ID']:"" ?>">
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
            <a href="<?php echo base_url().'menu/index/add'; ?>" class="btn btn-warning btn-sm" >Cancel</a>
          </div>
        </div>
    </form><br>
  </div>
  <!-- <div class="panel-footer">
    Panel footer
  </div> -->
</div>


<div class="panel panel-success">
	<div class="panel-heading">
    	<h3 class="panel-title">Menu List</h3>
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
              <th>TITLE</th>
              <th>METHOD/PARAMS</th>
              <th>ICON</th>
              <th>POSITION</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
        <?php
        if($menu){
        	foreach($menu as $val){
        		echo '
        			<tr>
                <td>'.$val['TITLE'].'</td>
                <td>'.$val['METHOD'].$val['PARAMS'].'</td>
                <td>'.$val['ICON'].'</td>
                <td>'.$val['POSITION'].'</td>
                <td>
                  <a role="button" class="btn btn-primary btn-xs" href="'.base_url().'menu/index/edit/'.$val['ID'].'" ><i class="fa fa-pencil" title="Edit"></i> Edit</a>
                  <a href="'.base_url().'menu/index/delete/'.$val['ID'].'" class="btn btn-danger btn-xs" onclick="return confirm(\'Confirm delete. Are you sure?\')" title="Delete" onclick="return confirm(\'Confirm delete. Are you sure?\')"><i class="fa fa-trash"></i> Delete</a>
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
	<!-- <div class="panel-footer">
		Panel footer
	</div> -->
</div>
