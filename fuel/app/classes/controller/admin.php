<?php

use Mustached\Message;

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
