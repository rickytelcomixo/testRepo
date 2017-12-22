<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/BaseController.php");

class User extends BaseController {

	public function __construct() {
		parent::__construct ();
		$this->isRestricted();
		$this->load->model('users');
	}

	

	public function index($option="add",$id="")
	{
		$data = array();
		if($option == "add" || $option == "edit" || $option == "delete"){
			if(isset($_REQUEST['submit'])){
				$params['id'] = $_REQUEST['user-id'];
				$params['username'] = $_REQUEST['username'];
				$params['fullname'] = $_REQUEST['fullname'];
				$params['password'] = $_REQUEST['password'];
				$params['userTypeId'] = $_REQUEST['usertype'];

				$user = $this->users->getUser('',$params['username']);
				if(count($user) > 0 && $_REQUEST['user-id'] == ''){
					flash('danger','Username already exists. Please enter different username.','Failed');
					redirect('user/newUser');
				}
				
				if($option == "add"){
					if($this->db->insert('users',$params)){
						flash('success','User data has been saved','Success');
					} else {
						flash('danger','Saved failed. Please try again.','Failed');
					}
				}

				if($option == "edit"){
					if($this->db->update('users',$params," id = ".$this->input->post("user-id"))){
						flash('success','User data has been saved','Success');
					} else {
						flash('danger','Update failed. Please try again.','Failed');
					}
					$option = "add";
				}				
			}

			if($option == "edit"){
				$data['userEdit'] = $this->users->getUser($id);
			}

			if($option == "delete"){
				$this->db->delete('user', array('d' => $id)); 
				flash('success','User data has been deleted','Success');
				$option = "add";
			}
		}

		$data['users'] = $this->users->getUser();
		$data['userType'] = $this->users->getUserType();
		$data['title'] = "New User - ".$this->config->item('app_name');
		$data['contentHeader'] = 'Pengguna';

		$data['option'] = $option;
		$data['formHeader'] = ucfirst($option).' Pengguna';
		$data['content'] = 'admin/user';
		$this->load->view('template/main', $data);
	}

	public function printUsers($users){

		$html = '
				<h4>USERS LIST</h4>
				<br>
				<table id="list-user" class="table table-bordered table-striped table-responsive">
                  <thead>
  	                <tr>
  	                  <th>Username</th>
  	                  <th>Full Name</th>
  	                  <th>Type</th>
                      <th>Group</th>
                      <th>Initial Balance</th>
  	                </tr>
                  </thead>
                  <tbody>';

                if(count($users) > 0){
                	foreach($users as $val){
                		$html .= '
                			<tr>
			                  <td style="padding:5px 10px;">'.$val['username'].'</td>
			                  <td style="padding:5px 10px;">'.$val['fullname'].'</td>
			                  <td style="padding:5px 10px;">'.$val['user_type'].'</td>
                              <td style="padding:5px 10px;">'.$val['user_group'].'</td>
                        	  <td style="padding:5px 10px;">'.number_format($val['initial_balance'],2).'</td>
			                </tr>
                		';
                	}
                }
            $html .= '
                </tbody>
               </table>';

		return $html;
	}
}
