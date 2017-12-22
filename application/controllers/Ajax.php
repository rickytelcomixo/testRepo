<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/BaseController.php");

class Ajax extends BaseController {

	public function __construct() {
		parent::__construct ();
		$this->isLogin();
		$this->load->model('users');
    $this->load->model('material_model');
    $this->load->model('followUp_model');
    $this->load->model('meeting_model');
    $this->load->model('diary_model');
    $this->load->model('lejer_model');
    $this->load->model('member_model');
    $this->load->model('project_model');
	}

	public function getForm()
	{
		$form = $_REQUEST['form'];
		$id = $_REQUEST['id'];
		$param = $_REQUEST;
		
		switch ($form){
			
			case 'User' :
				$form = $this->getUserForm($id);
				break;

            case 'Material' :
                $form = $this->getMaterialForm($param);
                break;

            case 'Minit Mesyuarat' :
                $form = $this->getMeetingForm($param);
                break;

            case 'Diary Projek' :
                $form = $this->getDiaryForm($param);
                break;

            case 'Follow-Up' :
                $form = $this->getFollowUpForm($param);
                break;

            case 'Lejer Transaction' :
                $form = $this->getLejerTransactionForm($param);
                break;

            case 'Lejer Project Transaction' :
                $form = $this->getLejerProjectTransactionForm($param);
                break;

            case 'Attendance' :
                $form = $this->getAttendance($param);
                break;

            case 'Items' :
                $form = $this->getItems($param);
                break;
		}
		
		echo json_encode(array('status'=>'success','form'=>$form));
	}

	public function getTable()
	{
		$list = $_REQUEST['list'];
		$param = $_REQUEST;
		
		switch ($list){
			case 'Sale Details' :
				$form = $this->getSaleDetails($param);
				break;
				
		}
		
		echo json_encode(array('status'=>'success','form'=>$form));
	}
	
	public function getUserForm($id){
		$user = $this->users->getUser($id);
		$userType = $this->getUserType();//From baseController
        $userGroup = $this->getUserGroup();//From baseController
        $commissionPlan = $this->getCommissionPlan();
		$form = '
		<form class="form-horizontal" action="'.base_url().'user/newUser" method="post">
            <div class="form-group required">
                <label class="col-lg-3 control-label" for="username">Username</label>
                <div class="col-lg-9">
                	<input id="username" name="username" value="'.$user[0]['username'].'" class="form-control" autocomplete="off" type="text" placeholder="Username" required>
                </div>
            </div>
			<div class="form-group required">
                <label class="col-lg-3 control-label" for="username">Full Name</label>
                <div class="col-lg-9">
                	<input id="fullname" name="fullname" value="'.$user[0]['fullname'].'" class="form-control" autocomplete="off" type="text" placeholder="Full Name" required>
                </div>
            </div>
			<div class="form-group required">
                <label class="col-lg-3 control-label" for="user-type">User Type</label>
                <div class="col-lg-9">
                    <select id="user-type" name="user-type" class="form-control select2" placeholder="Select User Type" style="width: 100%;" required>
                        <option value="">Select User Type</option>';
                    foreach($userType as $type){
                        $form .= '<option value="'.$type.'" '.($user[0]['user_type'] == $type?'Selected':'').'>'.$type.'</option>';
                    }
        $form .= '
                    </select>
                </div>
            </div>
            <div class="form-group" '.($user[0]['user_type']=='Introducer'||$user[0]['user_type']=='Agent'?'':'style="display: none;"').' >
                <label class="col-lg-3 control-label" for="introducer-commission-plan">Introducer Commission Plan</label>
                <div class="col-lg-9">
                    <select id="introducer-commission-plan" name="introducer-commission-plan" class="form-control select2" style="width: 100%;">';

                    foreach($commissionPlan as $val){
                        $form .= '<option value="'.$val['id'].'" '.($user[0]['commission_plan']==$val['id']?'selected':'').' >'.$val['text'].'</option>';
                    }
                $form .= '
                    </select>
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-3 control-label" for="user-group">User Goup</label>
                <div class="col-lg-9">
                    <select id="user-group" name="user-group" class="form-control select2" placeholder="Select User Group" style="width: 100%;" >
                        <option value="">Select User Group</option>';
                    foreach($userGroup as $group){
                        $form .= '<option value="'.$group.'" '.($user[0]['user_group'] == $group?'Selected':'').'>'.$group.'</option>';
                    }
        $form .= '
                    </select>
                </div>
            </div>
			<div class="form-group required">
                <label class="col-lg-3 control-label" for="password">Password</label>
                <div class="col-lg-9">
                	<input id="password" name="password" value="'.$user[0]['password'].'" class="form-control" autocomplete="off" type="password" placeholder="Username" required>
                </div>
            </div>
			<div class="form-group required">
                <label class="col-lg-3 control-label" for="cpassword">Confirm Password</label>
                <div class="col-lg-9">
                	<input id="cpassword" name="cpassword" value="'.$user[0]['password'].'" class="form-control" autocomplete="off" type="password" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-3 control-label" for="balance">Initial Balance</label>
                <div class="col-lg-9">
                	<input id="balance" name="balance" value="'.$user[0]['initial_balance'].'" class="form-control" autocomplete="off" type="text" placeholder="Initial Balance" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-9 checkbox">
                    <label>
                      <input type="checkbox" value="1" name="profit_expense" '.($user[0]['profit_expense']?'checked':'').'> Profit Expense
                    </label>
                </div>
            </div><br>

			<input id="user-id" name="user-id" value="'.$user[0]['id'].'" type="hidden">
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-9">
                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
        <script>
        $(document).ready(function(){
            $(".select2").select2();

            $("#user-type").change(function(){
                if($(this).val() == "Introducer" || $(this).val() == "Agent"){
                    $("#introducer-commission-plan").parent().parent().show(400);
                    if($(this).val() == "Agent"){
                        $("#introducer-commission-plan option[value=\'2\']").wrap(\'<span/>\');
                    } else {
                        if($("#introducer-commission-plan option[value=\'2\']").parent().is( "span" )){
                            $("#introducer-commission-plan option[value=\'2\']").unwrap();
                        }
                    }
                } else {
                    $("#introducer-commission-plan").parent().parent().hide(400);
                }
            }); ';


        if($user[0]['user_type']=='Agent'){
            $form .= '$("#introducer-commission-plan option[value=\'2\']").wrap(\'<span/>\');';
        }

        $form .= '
        });
        </script>
		';
		
		return $form;
	}
	
	function getDropdownList(){
		$id = $_REQUEST['id'];
		$userProduct = $this->users->getUserProduct($id);
		
		$html = '<option></option>';
		if(count($userProduct)>0){
			foreach($userProduct as $val){
				$html .= '<option value="'.$val['product_id'].'">'.$val['product_name'].'</option>';
			}
		}
		echo json_encode(array('status'=>'success','html'=>$html));
	}

    function getMaterialForm($param){
        $option = $param['option'];
        $id = $param['id'];
        $id2 = $param['subid'];
        if($option == 'Edit'){
            $materialPrice = $this->material_model->get_material_price($id2);
        }

        $form = '
            <form id="lejerViewForm" class="form-horizontal" action="'.base_url().'material/price/'.$option.'" method="post">
              <div class="form-group required">
                <label class="control-label col-lg-3" for="seller">Seller</label>
                <div class="col-lg-8">
                  <input name="seller" value="'.(isset($materialPrice)?$materialPrice[0]['SELLER']:'').'" class="form-control" autocomplete="off" type="text" required>
                </div>
              </div>
              <div class="form-group required">
                <label class="control-label col-lg-3" for="price">Harga</label>
                <div class="col-lg-8">
                  <input type="text" name="price" value="'.(isset($materialPrice)?$materialPrice[0]['PRICE']:'').'" class="form-control" required="" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-3 col-lg-8">
                  <input type="hidden" name="material-id" value="'.$id.'">
                  <input type="hidden" name="material-price-id" value="'.$id2.'">
                  <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </form>
        ';

        return $form;
    }

    function getMeetingForm($param){
        $option = $param['option'];
        $id = $param['id'];
        $members = $this->member_model->get_member();
        $project = $this->project_model->get_project($id);
        $meetingList = $this->meeting_model->get_meeting("",$id);
        $bil = $project[0]['FILENAME'].'('.($meetingList?count($meetingList)+1:1).')';
        $attendanceList = array();

        if($option == 'Edit'){
            $meeting = $this->meeting_model->get_meeting($id);
            //$attendance = $this->meeting_model->get_attendance("",$id);
            $item = $this->meeting_model->get_item("",$id);
            $attendanceList = explode(",", $meeting[0]["ATTENDANCE"]);
        }

        $form = '
            <form id="meetingForm" class="form-horizontal" action="'.base_url().'project/meeting/'.$option.'" method="post">
              <div class="form-group required">
                <label class="control-label col-lg-3" for="title">Tajuk</label>
                <div class="col-lg-8">
                  <input name="title" value="'.(isset($meeting)?$meeting[0]['TITLE']:$project[0]['FILENAME']).'" class="form-control" autocomplete="off" type="text" required>
                </div>
              </div>
              <div class="form-group required">
                <label class="control-label col-lg-3" for="price">Bil</label>
                <div class="col-lg-8">
                  <input type="bil" name="bil" value="'.(isset($meeting)?$meeting[0]['BIL']:$bil).'" class="form-control" required="" />
                </div>
              </div>
              <div class="form-group required">
                <label class="control-label col-lg-3" for="meeting-date">Tarikh / Masa</label>
                <div class="col-lg-8">
                  <input type="text" id="meeting-date" name="meeting-date" value="'.(isset($meeting)?date('d-m-Y H:i A',strtotime($meeting[0]['MDATE'])):'').'" class="form-control" required="" />
                </div>
              </div>
              <div class="form-group required">
                <label class="control-label col-lg-3" for="venue">Tempat</label>
                <div class="col-lg-8">
                  <input type="venue" name="venue" value="'.(isset($meeting)?$meeting[0]['VENUE']:'').'" class="form-control" required="" />
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="">Kehadiran</label>
                <div class="col-lg-8">
                  <select id="attendance[]" name="attendance[]" class="form-control select2" style="width: 100%;" multiple>';
                  if($members){
                    foreach($members as $key => $val){
                      $form .= '<option value="'.$val['ID'].'" '.(in_array($val["ID"], $attendanceList)?'selected':'').'>'.$val['NAME'].' - '.$val['POSITION'].' - '.$val['ORGANIZATION'].'</option>';
                    }
                  }
              $form .= '    
                  </select>    
                </div>
              </div>

              <div class="form-group required">
                <label class="control-label col-lg-3" for="">Perkara</label>
                  <div class="col-lg-7">
                    <div class="input-group">
                      <span class="input-group-btn">
                      <input class="form-control" name="item[]" type="text" placeholder="Perkara" />
                      <input class="form-control" name="action[]" type="text" placeholder="Tindakan" />
                        <button class="btn btn-success additemButton" type="button">
                          <span class="glyphicon glyphicon-plus"></span>
                        </button>
                      </span>
                    </div>
                </div>
              </div>
              <div class="form-group hide" id="itemTemplate">
                  <div class="col-xs-offset-3 col-xs-7">
                      <div class="input-group">
                      <span class="input-group-btn">
                      <input class="form-control" name="item[]" type="text" placeholder="Perkara" />
                      <input class="form-control" name="action[]" type="text" placeholder="Tindakan" />
                        <button class="btn btn-success removeitemButton" type="button">
                          <span class="glyphicon glyphicon-minus"></span>
                        </button>
                      </span>
                    </div>
                  </div>
              </div>';

              if(isset($item) && $item){
                foreach($item as $key => $val){
                  $inputId = 'item'.$val['ID'];
                  $form .= '
                  <div class="form-group " >
                      <div class="col-xs-offset-3 col-xs-7">
                          <div class="input-group">
                          <span class="input-group-btn">
                          <input class="form-control" value="'.$val['DESC'].'" name="item-edit[]" type="text" placeholder="Perkara" />
                          <input class="form-control" value="'.$val['ACTION'].'" name="action-edit[]" type="text" placeholder="Tindakan" />
                          <input class="form-control" value="'.$val['ID'].'" name="item-id[]" type="hidden" />
                            <button id='.$inputId.'" class="btn btn-warning " type="button" onclick="return confirm(\'This data will be deleted from database. Continue?\')?doEditForm(\'Items\',\''.$val['ID'].'\',\'Delete\',\''.$meeting[0]["ID"].'\'):false">
                              <span class="glyphicon glyphicon-minus"></span>
                            </button>
                          </span>
                        </div>
                      </div>
                  </div>
                  ';  
                }
              }

        $form .= '
              <div class="form-group required">
                <label class="control-label col-lg-3" for="closing">Penutup</label>
                <div class="col-lg-8">
                  <input type="closing" name="closing" value="'.(isset($meeting)?$meeting[0]['CLOSING']:'').'" class="form-control" required="" />
                </div>
              </div>
              <div class="form-group required">
                <label class="control-label col-lg-3" for="prepared_by">DiSediakan Oleh</label>
                <div class="col-lg-8">
                  <input type="prepared_by" name="prepared_by" value="'.(isset($meeting)?$meeting[0]['PREPARED_BY']:'').'" class="form-control" required="" />
                </div>
              </div>
              <div class="form-group required">
                <label class="control-label col-lg-3" for="approved_by">DiSahkan Oleh</label>
                <div class="col-lg-8">
                  <input type="approved_by" name="approved_by" value="'.(isset($meeting)?$meeting[0]['APPROVED_BY']:'').'" class="form-control" required="" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-3 col-lg-8">
                  <input type="hidden" name="meeting-id" value="'.$id.'">
                  <input type="hidden" name="project-id" value="'.(isset($meeting)?$meeting[0]['PROJECTID']:$id).'">
                  <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </form>

            <script>
            $(document).ready(function(){
      
              $("#meeting-date").daterangepicker({
                singleDatePicker: true,
                format: "DD-MM-YYYY h:mm A",
                timePicker: true,
                timePickerIncrement: 5
              });
              setDynamicInput("meetingForm","item");

              $(".select2").select2();

            });
            </script>
        ';

        return $form;
    }

    function getDiaryForm($param){
        $option = $param['option'];
        $id = $param['id'];
        $subid = $param['subid'];

        if($option == 'Edit'){
            $diary = $this->diary_model->get_diary($subid);
        }
        //$form = "Under Development";
        $form = '
            <form id="diaryViewForm" class="form-horizontal" action="'.base_url().'project/diary/'.$option.'" method="post" enctype="multipart/form-data">
              <div class="form-group required">
                <label class="control-label col-lg-3" for="diary-date">Tarikh</label>
                <div class="col-lg-8">
                  <input name="diary-date" id="diary-date" value="'.(isset($diary)?date('d-m-Y',strtotime($diary[0]['DDATE'])):date('d-m-Y')).'" class="form-control" autocomplete="off" type="text" required>
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="diary-activity">Aktiviti Kerja</label>
                <div class="col-lg-8">
                  <input type="text" name="diary-activity" value="'.(isset($diary)?$diary[0]['ACTIVITY']:'').'" class="form-control" />
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="diary-manpower">Man Power</label>
                <div class="col-lg-8">
                  <input type="text" name="diary-manpower" value="'.(isset($diary)?$diary[0]['MANPOWER']:'').'" class="form-control" />
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="diary-machine">Mesin Dan Peralatan</label>
                <div class="col-lg-8">
                  <input type="text" name="diary-machine" value="'.(isset($diary)?$diary[0]['MACHINE']:'').'" class="form-control" />
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="diary-salary">Kewangan (Gaji)</label>
                <div class="col-lg-8">
                  <input type="text" name="diary-salary" value="'.(isset($diary)?$diary[0]['SALARY']:'').'" class="form-control" />
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="diary-beyondcontrol">Cuaca Dan Lain-lain Beyond Control</label>
                <div class="col-lg-8">
                  <input type="text" name="diary-beyondcontrol" value="'.(isset($diary)?$diary[0]['BEYONDCONTROL']:'').'" class="form-control" />
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="diary-rawmaterial">Bahan Mentah</label>
                <div class="col-lg-8">
                  <input type="text" name="diary-rawmaterial" value="'.(isset($diary)?$diary[0]['RAWMATERIAL']:'').'" class="form-control" />
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="diary-financial">Kewangan</label>
                <div class="col-lg-8">
                  <input type="text" name="diary-financial" value="'.(isset($diary)?$diary[0]['FINANCIAL']:'').'" class="form-control" />
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="upload-file">Upload File</label>
                <div class="col-lg-8">
                  <input type="file" name="upload-file" value="" />
                  <p class="help-block">Pilih fail untuk di upload</p>
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-offset-3 col-lg-8">
                  <input type="hidden" name="diary-id" value="'.$subid.'">
                  <input type="hidden" name="project-id" value="'.$id.'">
                  <input type="hidden" name="filename" value="'.(isset($diary)?$diary[0]['UPLOADFILE']:'').'">
                  <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </form>

            <script>
            $(document).ready(function(){
              $("#diary-date").daterangepicker({
                singleDatePicker: true,
                format: "DD-MM-YYYY"
              });
            });
            </script>
        ';

        return $form;
    }

    function getFollowUpForm($param){
        $option = $param['option'];
        $id = $param['id'];

        if($option == 'Edit'){
            $followUp = $this->followUp_model->get_followUp($id);
        }
        //$form = "Under Development";
        $form = '
            <form id="follow-upViewForm" class="form-horizontal" action="'.base_url().'project/followUp/'.$option.'" method="post" enctype="multipart/form-data">
              <div class="form-group required">
                <label class="control-label col-lg-3" for="title">Tajuk Isu</label>
                <div class="col-lg-8">
                  <input name="title" value="'.(isset($followUp)?$followUp[0]['TITLE']:'').'" class="form-control" autocomplete="off" type="text" required>
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="remarks">Remarks Isu</label>
                <div class="col-lg-8">
                  <input type="text" name="remarks" value="'.(isset($followUp)?$followUp[0]['REMARKS']:'').'" class="form-control" />
                </div>
              </div>
              <div class="form-group ">
                <label class="control-label col-lg-3" for="upload-file">Upload File</label>
                <div class="col-lg-8">
                  <input type="file" name="upload-file" value="" />
                  <p class="help-block">Pilih fail untuk di upload</p>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-3 col-lg-8">
                  <input type="hidden" name="project-id" value="'.(isset($followUp)?$followUp[0]['PROJECTID']:$id).'">
                  <input type="hidden" name="followup-id" value="'.(isset($followUp)?$followUp[0]['ID']:'').'">
                  <input type="hidden" name="filename" value="'.(isset($followUp)?$followUp[0]['UPLOADFILE']:'').'">
                  <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </form>
        ';

        return $form;
    }

    function getAttendance($param){
        $option = $param['option'];
        $id = $param['id'];
        $subid = $param['subid'];
        $this->db->delete('meeting_attendance', array('ID' => $id));
        

        return '
          <p>Attendance has been removed</p>
          <p><button type="button" class="btn btn-default" data-dismiss="modal">Ok</button></p>

          <script>
            $(document).ready(function(){
              var script   = document.createElement("script");
              script.type  = "text/javascript";
              script.text  = "$(\'#'.$subid.'\').parents(\'.form-group\').remove();";
              $("#formModal").append(script);
            });
          </script>
        ';
    }

    function getItems($param){
        $option = $param['option'];
        $id = $param['id'];
        $subid = $param['subid'];
        $this->db->delete('meeting_item', array('ID' => $id));
        

        return '
          <p>Meeting item has been removed</p>
          <p><button type="button" class="btn btn-default" data-dismiss="modal">Ok</button></p>
        ';
    }

    function getLejerTransactionForm($param){
        $option = $param['option'];
        $id = $param['id'];
        $subid = $param['subid'];

        if($option == "Edit"){
          $lejer_edit = $this->lejer_model->get_lejer_transaction($subid,"","","","","A.TDATE ASC, A.ID ASC","","");
        }

        $form = '
          <form id="lejerViewForm" class="form-horizontal" action="'.base_url().'financial/lejer/view/'.$id.'/'.$option.'/'.$subid.'" method="post">
            <div class="form-group required">
              <label class="col-lg-3 control-label" for="transaction-date">Date</label>
              <div class="col-lg-4">
                <input id="transaction-date" name="transaction-date" value="'.(isset($lejer_edit)?date('d-m-Y',strtotime($lejer_edit[0]['TDATE'])):'').'" class="form-control" autocomplete="off" type="text" placeholder="dd-mm-yyyy" required >
              </div>
            </div>
            <div class="form-group required">
              <label class="col-lg-3 control-label" for="transaction-type">Transaction Type</label>
              <div class="col-lg-4">
                <select id="transaction-type" name="transaction-type" class="form-control select2" placeholder="Select Transaction Type" required style="width:100%;">
                  <option value="1">Baki b/b</option>
                </select>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-lg-3 control-label" for="transaction-amount">Amount</label>
              <div class="col-lg-4">
                <input type="text" value="'.(isset($lejer_edit)?$lejer_edit[0]['BALANCE']:'').'" class="form-control" name="transaction-amount">
              </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-8">
                  <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </div>
          </form>

          <script>
            $(document).ready(function(){
              $(\'#transaction-date\').daterangepicker({
                  startDate: moment(),
                  singleDatePicker: true,
                  showDropdowns: true,
                  format: \'DD-MM-YYYY\'
              });
              $(".select2").select2();
            });
          </script>
        ';

        return $form;
    }

    function getLejerProjectTransactionForm($param){
        $option = $param['option'];
        $id = $param['id'];
        $subid = $param['subid'];
        $lejer_type = $this->lejer_model->get_lejer_type();

        if($option == "Edit"){
          $lejer_edit = $this->lejer_model->get_lejer_transaction($subid,"","","","","A.TDATE ASC, A.ID ASC","","");
        }

        $form = '
          <form id="lejerViewForm" class="form-horizontal" action="'.base_url().'financial/lejer/view/'.$id.'/'.$option.'LejerProject/'.$subid.'" method="post">
            <div class="form-group required">
              <label class="col-lg-3 control-label" for="transaction-date">Date</label>
              <div class="col-lg-4">
                <input id="transaction-date" name="transaction-date" value="'.(isset($lejer_edit)?date('d-m-Y',strtotime($lejer_edit[0]['TDATE'])):'').'" class="form-control" autocomplete="off" type="text" placeholder="dd-mm-yyyy" required disabled>
              </div>
            </div>
            <div class="form-group required">
              <label class="control-label col-lg-3" for="lejer-type">Lejer Type</label>
              <div class="col-lg-8">
                <select id="lejer-type" name="lejer-type" class="form-control select2" placeholder="Select Lejer Type" style="width: 100%;" required disabled>
                  <option value="">Select Lejer Type</option>';

                  foreach($lejer_type as $val){
                    $form .= '<option value="'.$val['ID'].'" '.($val['ID']==$lejer_edit[0]['LEJERTYPE']?'Selected':'').'>'.$val['DESC'].'</option>';
                  }
                  
            $form .= '
                </select>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-lg-3 control-label" for="transaction-amount">Baki Lejer</label>
              <div class="col-lg-4">
                <input type="text" value="'.(isset($lejer_edit)?$lejer_edit[0]['BALANCE']:'').'" class="form-control" name="transaction-amount">
              </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-8">
                  <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </div>
          </form>

          <script>
            $(document).ready(function(){
              $(\'#transaction-date\').daterangepicker({
                  startDate: moment(),
                  singleDatePicker: true,
                  showDropdowns: true,
                  format: \'DD-MM-YYYY\'
              });
              $(".select2").select2();
            });
          </script>
        ';

        return $form;
    }

    function getBakiCashBankStatus(){
      $startDate = $_REQUEST['date'];
      $status =  $this->checkBakiCashBank($startDate);
      echo json_encode(array('status'=>$status));
    }
}
