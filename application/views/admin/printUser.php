<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Print Users List</h3>
  </div>
  <div class="panel-body">
    <div class="box">
      <div class="box-body">
        <div id="printable">
          <?php echo $reportContent; ?>
        </div>
        <br>
          <button type="button" id="actprint" class="btn btn-default btn-sm no-print">Click Here to Print</button>
          <a id="printTransactionBtn" href="<?php echo base_url().'user/listUser?account-type='.$accountType.'&account-group='.$accountGroup; ?>" type="button" class="btn btn-warning btn-sm no-print">Cancel</a>
          <br><br>
        </div>
      </div>
    </div>
  </div>
</div>
