<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_controller extends MY_Controller {
	
	function __construct()
	{
		// Load the parent constructor
		parent::__construct();

		// Where are we ? Information used to set up informations on the layout
		$this->data['section'] = 'admin';

		// Todo : save the current url in session to redirect the user to this url after his login
		if(!$this->session->userdata('is_admin')) {
			flash_message('error', lang('admin.accessRestricted'));
			redirect('user/auth/login');
		}

	}	
}

/* End of file Admin_controller.php */
/* Location: ./application/core/Admin_controller.php */