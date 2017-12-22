<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/BaseController.php");

class UserType extends BaseController {

	public function __construct() {
		parent::__construct ();
		$this->isRestricted();
		$this->load->model('users');
	}

	public function index($option="add",$id="")
	{
		$data = array();
		if($option == "add" || $option == "edit" || $option == "delete"){
			if($this->input->post()){
				$postData = array(
					"TITLE" => $this->input->post("usertype"),
					"RANK" => $this->input->post("rank")
				);
				if($option == "add"){
					$this->db->insert ( 'user_type', $postData );
					flash('success','User type data has been saved','Success');
				} else if($option == "edit"){
					$this->db->update( 'user_type', $postData, "ID = ".$this->input->post("usertype-id") );
					flash('success','Menu data has been updated','Success');
					$option = "add";
				}

			}

			if($option == "edit"){
				$data['userTypeEdit'] = $this->users->getUserType($id);
			}

			if($option == "delete"){
				$this->db->delete('user_type', array('ID' => $id)); 
				flash('success','User type data has been deleted','Success');
				$option = "add";
			}
		} 

		$data['userType'] = $this->users->getUserType();
		$data['title'] = "User Type - ".$this->config->item('app_name');
		$data['contentHeader'] = 'Jenis Pengguna';
		$data['content'] = 'admin/userType';

		$data['option'] = $option;
		$data['formHeader'] = ucfirst($option)." Jenis Pengguna";
		$this->load->view('template/main', $data);
	}
}
