<?php

namespace User;
use Mustached\Message;

class Controller_Profile extends \Controller_Front
{

	public function before()
	{
		parent::before();
	}

	public function action_view($id)
	{
		$this->data['user'] = Model_User::find($id);
		return $this->_render('profile');
	}

}