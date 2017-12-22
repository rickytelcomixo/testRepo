<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/BaseController.php");

class Menu extends BaseController {

	public function __construct() {
		parent::__construct ();
		$this->isRestricted();
		$this->load->model('menu_model');
	}

	public function index($option="add",$id=""){

		$data = array();

		if($option == "add" || $option == "edit" || $option == "delete"){
			if($this->input->post()){
				$menuData = array(
					"TITLE" => $this->input->post("menu-title"),
					"METHOD" => $this->input->post("menu-method"),
					"PARAMS" => $this->input->post("menu-params"),
					"ICON" => $this->input->post("menu-icon"),
					"POSITION" => $this->input->post("menu-pos")
				);
				if($option == "add"){
					$this->db->insert ( 'menu', $menuData );
					flash('success','Menu data has been saved','Success');
				} else if($option == "edit"){
					$this->db->update( 'menu', $menuData, "ID = ".$this->input->post("menu-id") );
					flash('success','Menu data has been updated','Success');
					$option = "add";
				}

			}

			if($option == "edit"){
				$data['menuEdit'] =$this->menu_model->get_menu($id);
			}

			if($option == "delete"){
				$this->db->delete('menu', array('ID' => $id)); 
				flash('success','Menu data has been deleted','Success');
				$option = "add";
			}
		} 

		$data['title'] = "Menu - ".$this->config->item('app_name');
		$data['contentHeader'] = "Menu";
		$data['content'] = 'admin/menu';

		$data['menu'] = $this->menu_model->get_menu();

		$data['option'] = $option;
		$data['formHeader'] = ucfirst($option)." Menu";
		$this->load->view('template/main', $data);
	}

}