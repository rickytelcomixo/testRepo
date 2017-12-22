<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/BaseController.php");

class Profile extends BaseController {

	public function __construct() {
		parent::__construct ();
		$this->isRestricted();
		$this->load->model('users');
	}

	public function index($option='profileDetails')
	{
		$loggedInUser = $this->session->userdata('loggedIn');
		if($option == 'profileDetails' && isset($_REQUEST['submit'])){
			//$params['id'] = $loggedInUser['id'];
			$params['username'] = $loggedInUser['username'];
			$params['fullname'] = $_REQUEST['name'];
			$params['password'] = $loggedInUser['password'];
			$params['email'] = $_REQUEST['email'];
			$params['phone'] = $_REQUEST['phone'];
			$params['address'] = $_REQUEST['address'];
			
			if($this->db->update('users',$params,"id=".$loggedInUser['id'])){
				$user = $this->users->getUser($loggedInUser['id']);
				$this->session->set_userdata('loggedIn',$user[0]);
				flash('success','Profile has been updated','Success');
			} else {
				flash('danger','Saved failed. Please try again.','Failed');
			}
			
		}

		if($option == 'changePassword' && isset($_REQUEST['submit'])){
			$params['id'] = $loggedInUser['id'];
			$params['username'] = $loggedInUser['username'];
			$params['fullname'] = $loggedInUser['fullname'];
			$params['password'] = $_REQUEST['password'];
			$params['cpassword'] = $_REQUEST['cpassword'];

			if($loggedInUser['password'] != $_REQUEST['oldpassword']){
				flash('danger','Incorrect password. Please try again.','Failed');
			} else {
				if($params['password'] != $params['cpassword']){
					flash('danger','Password did not match. Please try again.','Failed');
				} else {
					if($this->users->insertUpdateUser($params)){
						$user = $this->users->getUser($loggedInUser['id']);
						$this->session->set_userdata('loggedIn',$user[0]);
						flash('success','Password has been updated','Success');
					} else {
						flash('danger','Saved failed. Please try again.','Failed');
					}
				}
			}
		}

		$data['option'] = $option;
		$data['title'] = "Profile - Klinik Hewan Zero";
		$data['contentHeader'] = 'Profile';
		$data['content'] = 'pages/profile';
		$data['loggedIn'] = $this->session->userdata('loggedIn');
		$this->load->view('template/main', $data);
	}

}
