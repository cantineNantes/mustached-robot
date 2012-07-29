<?php

use Mustached\Message;

class Controller_Admin extends Controller_Base
{

	public function before()
	{
		parent::before();
		$this->data['section'] = 'admin';

		if (!$this->current_user['is_admin'])
		{
			\Session::set_flash('redirect', \Uri::main());

			Message::flash_error('mustached.admin.accessRestricted');
			\Response::redirect('user/auth/login');
		}
	}
}
