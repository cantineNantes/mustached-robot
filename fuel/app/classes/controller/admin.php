<?php

use Mustached\Message;

/**
 * The Controller_Admin adds a security layer to the Controller_Base
 * 
 * Every admin specific controller of the application MUST extend this controller.
 */
class Controller_Admin extends Controller_Base
{

	public function before()
	{
		parent::before();
		$this->data['section'] = 'admin';

		$auth = Auth::instance();
		
		if (!Auth::has_access('administration.read'))
		{
			\Session::set_flash('redirect', \Uri::main());
			Message::flash_error('mustached.admin.accessRestricted');
			\Response::redirect('user/auth/login');
		}	
		
	}
}
