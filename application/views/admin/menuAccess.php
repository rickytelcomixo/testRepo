
<?php if(isEntitle('add') || isEntitle('edit') || isEntitle('view') || isEntitle('delete')){ ?>
<div class="panel panel-success">
  <div class="panel-heading">
      <h3 class="panel-title"><?php echo $formHeader; ?></h3>
    </div>
  <div class="panel-body">
    <form id="usersForm" class="form-horizontal" action="<?php echo base_url().'menuAccess/index/'.$option?>" method="post">
        <div class="form-group required">
          <label class="control-label col-lg-2" for="user-id">User</label>
          <div class="col-lg-8">
            <select class="form-control select2" name="user-id" id="access-user" required>
              <option value="">Select User</option>
            <?php
            if(count($users)>0){
              foreach($users as $val){
                echo '<option value="'.$val['id'].'" '.($userId==$val['id']?'selected':'').'>'.$val['fullname'].'</option>';
              }
            }
            ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">Menu</label>
          <div class="col-sm-10">
            <select multiple="multiple" id="role_entitle" name="role_entitle[]" class="multiselect">
            <?php 
            if(count($menu)>0){
              foreach($menu as $arr){
                echo '
                <optgroup label="'.$arr['LABEL'].'">
                  <option value="'.$arr['ID'].'" '.$arr['SELECTED'].'>'.$arr['TITLE'].'</option>
                </optgroup>';
              }
            }
            ?>
            </select>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-lg-offset-2 col-lg-8">
            <input type="hidden" name="menu-id" value="<?php echo isset($menuEdit[0]['ID'])?$menuEdit[0]['ID']:"" ?>">
            <?php if(isEntitle('add') || isEntitle('edit')){ ?>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
            <?php } ?>
          </div>
        </div>
    </form><br>
  </div>
  <!-- <div class="panel-footer">
    Panel footer
  </div> -->
</div>
<?php } ?>


<script type="text/javascript">

$(document).ready(function(){

  $('#role_entitle').multiSelect({
    cssClass: 'custom_multiselect_container',
      selectableHeader: "<div class='custom-header'>Selectable items</div>",
      selectionHeader: "<div class='custom-header'>Selection items</div>",
  });

  $('#access-user').change(function(){
    window.location = getBaseUrl()+'/menuAccess/index/update/'+$(this).val();
  });

});

</script>
