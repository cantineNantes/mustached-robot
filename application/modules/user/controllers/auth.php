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
			
		$this->load->library('encrypt');

		if($this->input->post()) {
			$u->get_by_email($this->input->post('email'));

			if($u->password == $this->mustache_user->prep_password($this->input->post('password'))) {
				echo 'login yeah';
			}
			else 
			{
				echo 'login na !';
			}
		}

		

		$this->_render('login_form');
		
	}

	public function logout()
	{

	}
}