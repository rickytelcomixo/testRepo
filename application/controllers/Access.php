<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->model('users');
		$this->load->model('menu_model');
		$this->load->helper('captcha');
		$this->load->helper('string');
		$this->load->helper('language');
		$this->lang->load('global', 'english');
	}

	public function login()
	{

		if(isset($_REQUEST['submit'])){
			$username  = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			$user = $this->users->getUser('', $username, $password);
			//print_r($user);
			//exit();
			//check captcha
			/*$captcha = $this->session->userdata('captcha');
			if($captcha['word'] != $_REQUEST['captcha']){
				flash('error','Incorrect captcha. Please try again.','Error');
				redirect('access/login');
			}*/

			if($user && $username != '' && $password != ''){
				
				if(!$user[0]['locked']){
					
					$this->session->set_userdata('loggedIn',$user[0]);
					$this->session->set_userdata('menuAccess',$this->menu_model->get_menu_access($user[0]['id']));
					redirect('Dashboard');
				} else {
					flash('error','Your account has been locked after 5 times incorrect login attempt. Please contact Administrator.','Error');
					$data['captcha'] = $this->doGetCaptcha();
					$this->load->view('pages/login', $data);
				}
			} else {
				$user = $this->users->getUser('', $username);
				
				if($user){
					if($this->session->userdata('login_attempt')){
						$attempt = $this->session->userdata('login_attempt');
						$attempt++;
					} else {
						$attempt = 1;
					}

					$this->session->set_userdata('login_attempt',$attempt);

					if($attempt > 5){
						$data = array('locked' => 1);
						$this->db->update('users', $data, array('id' => $user[0]['id']));
						flash('error','Your account has been locked after 5 times incorrect attempt. Please contact Administrator.','Error');
					} else {
						flash('error',"Your account or password is incorrect. If you don't remember your password, contact Administrator",'Error');
					}
				} else {
					flash('error',"Your account or password is incorrect. If you don't remember your password, contact Administrator",'Error');
				}
				$data['captcha'] = $this->doGetCaptcha();
				$this->load->view('pages/login', $data);
			}
			
		} else {
			$data['captcha'] = $this->doGetCaptcha();
			$this->load->view('pages/login',$data);
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('loggedIn');
		$this->session->unset_userdata('menu');
		$data['captcha'] = $this->doGetCaptcha();
		$this->load->view('pages/login',$data);
	}

	function doGetCaptcha(){
		//Remove existing captcha image
		$captcha = $this->session->userdata('captcha');
		if(isset($captcha['time']) && file_exists((FCPATH.'assets/captcha/image/'.$captcha['time'].'.jpg'))){
			unlink(FCPATH.'assets/captcha/image/'.$captcha['time'].'.jpg');
		}

		//captcha start
		$vals = array(
            'word' => random_string('numeric', 4),
			'img_path' => './assets/captcha/image/',
			'img_url' => base_url('/assets/captcha/image').'/',
			'font_path' => './assets/captcha/font/times_new_yorker.ttf',
			'img_width' => '150',
			'img_height' => 34,
			'expiration' => 7200
			);
		$cap = create_captcha($vals);
		$this->session->set_userdata('captcha',$cap);

		/*$result = array(
			'captcha_time' => $cap['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $cap['word']
			);*/

		//$captcha = $cap['image'];
		return $cap;
		//captcha end
	}
}
