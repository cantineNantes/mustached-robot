<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('mustache_user');
	}

	public function index()
	{

	}

	public function login()
	{
		// display login form
		$u =  new User();
		$data = array();
			
		if($this->input->post()) {
			if($this->mustache_user->login($this->input->post('email'), $this->input->post('password')))
			{
				flash_message('success', lang('user.login.success'));
				redirect('user/account/edit');	
			}
			else {
				$this->data['msg'] = user_message('error', lang('user.login.error'));
			}	
		}

		$this->_render('login_form', $data);
		
	}

	public function logout()
	{
		$this->mustache_user->logout();
		flash_message('success', 'Vous êtes déconnecté');
		redirect('user/auth/login');
	}
}