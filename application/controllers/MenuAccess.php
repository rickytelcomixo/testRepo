<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/BaseController.php");

class MenuAccess extends BaseController {

	public function __construct() {
		parent::__construct ();
		$this->isRestricted();
		$this->load->model('menu_model');
		$this->load->model('users');
	}

	public function index($option="update",$id=""){

		$data = array();

		if($option == "update"){
			if($this->input->post()){
				$this->db->delete('menu_access', array('USERID' => $this->input->post("user-id"))); 
				$menuList = $this->input->post("role_entitle");
				if(count($menuList)>0){
					$menuData = array();
					$tmpMenuList = array();
					foreach($menuList as $menu){
						$ent = explode("-", $menu);
						$tmpMenuList[$this->input->post("user-id")][$ent[0]][] = $ent[1];
					}

					foreach($tmpMenuList as $userId => $arr){
						$entList = "";
						foreach($arr as $menuId=>$arr2){
							$entList = implode(",", $arr2);
							$menuData[] = array(
								"USERID" => $userId,
								"MENUID" => $menuId,
								"ENTITLEMENT" => $entList
							);
						}
					}

					$this->db->insert_batch('menu_access', $menuData);
					flash('success','Menu access data has been updated','Success');
				} else {
					flash('success','No changes has been made','Success');
				}

			}
		} 

		$data['title'] = "Menu Access - ".$this->config->item('app_name');
		$data['contentHeader'] = "Menu Access";
		$data['content'] = 'admin/menuAccess';

		$menu = $this->menu_model->get_menu();
		$menuAccess = $this->menu_model->get_menu_access($id);
		$newMenu = array();
		$ent = array('add','edit','view','delete');
		foreach($menu as $key => $arr){
			foreach($ent as $val){
				$selected = '';
				if($menuAccess && $id!=''){
					foreach($menuAccess as $arr3){
						$entList = explode(",", $arr3['ENTITLEMENT']);
						if($arr['TITLE'] == $arr3['TITLE'] && in_array($val, $entList)){
							$selected = 'selected';
							break;
						}
					}
				}
				$newMenu[] = array(
					'ID'=>$arr['ID'].'-'.$val,
					'TITLE'=>ucfirst($val).' '.$arr['TITLE'],
					'SELECTED'=>$selected,
					'LABEL' => $arr['TITLE']
				);
			}
		}
		$data['menu'] = $newMenu;
		$data['users'] = $this->users->getUser();
		$data['userId'] = $id;

		$data['option'] = $option;
		$data['formHeader'] = ucfirst($option)." Menu Access";
		$this->load->view('template/main', $data);
	}

}