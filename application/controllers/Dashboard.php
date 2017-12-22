<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/BaseController.php");

class Dashboard extends BaseController {

	public function __construct() {
		parent::__construct ();
		$this->isRestricted();

	}

	public function index(){

		$data = array();

		$startDate = isset($_REQUEST['start-date'])? $_REQUEST['start-date']:date('Y-m-01');
		$endDate = isset($_REQUEST['end-date'])? $_REQUEST['end-date']:date('Y-m-t');
		$data['startDate'] = $startDate;
		$data['endDate'] = $endDate;

		$data['title'] = "Dashboard - ".$this->config->item('app_name');
		$data['contentHeader'] = "Dashboard";
		$data['content'] = 'admin/dashboard';
		$this->load->view('template/main', $data);
	}

}