
<div class="panel panel-success" id="taskList">
	<div class="panel-heading">
    	<h3 class="panel-title">Dashboard</h3>
  	</div>
	<div class="panel-body">
		<div class="box">
      <!--<div class="box-header">
        <h3 class="box-title">Data Table With Full Features</h3>
      </div>-->
      <!-- /.box-header -->
      <div class="box-body">
        Under development..
        <!-- <form id="taskListForm" class="form-inline" action="<?php echo base_url().'dashboard?#taskList'?>" method="post">
          <div class="form-group">
            <label>Date range :</label>
            <div class="input-group">
              <button id="daterange-taskListForm-btn" class="btn btn-default pull-right" type="button">
                <span></span>
                <i class="fa fa-caret-down"></i>
              </button>
            </div>
          </div>
          <input type="hidden" id="start-date" value="<?php echo $startDate; ?>" name="start-date">
          <input type="hidden" id="end-date" value="<?php echo $endDate; ?>" name="end-date">
      </form>
        <table id="list-table" class="table table-bordered table-striped table-responsive">
          <thead>
            <tr>
              <th>DATE</th>
              <th>PROJECT</th>
              <th>TITLE</th>
              <th>STATUS</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
        <?php
        if(isset($task)){
        	foreach($task as $val){
        		echo '
        			<tr>
                <td>'.date('D, d-M-Y',strtotime($val['TDATE'])).'</td>
                <td>'.$val['PROJECT'].'</td>
                <td>'.$val['TITLE'].'</td>
                <td>'.$taskStatus[$val['STATUS']].'</td>
                <td>
                  <a role="button" class="btn btn-success btn-xs" href="'.base_url().'task/index/view/'.$val['ID'].'" target="_blank"><i class="fa fa-eye" title="View Detail"></i> View</a>
                  <a role="button" class="btn btn-primary btn-xs" href="'.base_url().'task/index/edit/'.$val['ID'].'" ><i class="fa fa-pencil" title="Edit"></i> Edit</a>
                  <a href="'.base_url().'task/index/delete/'.$val['ID'].'" class="btn btn-danger btn-xs" onclick="return confirm(\'Confirm delete. Are you sure?\')" title="Delete" onclick="return confirm(\'Confirm delete. Are you sure?\')"><i class="fa fa-trash"></i> Delete</a>
                </td> 
              </tr>
        		';
        	}
        }
        ?>
        </tbody>
       </table> -->
    </div>
	</div>
	<!-- <div class="panel-footer">
		Panel footer
	</div> -->
</div>