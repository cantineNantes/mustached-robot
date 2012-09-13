<?php

namespace User;
use Mustached\Message;

class Controller_Fullscreen extends \Controller_Admin
{

	public function action_enter()
	{
		\Session::set('fullscreen', true);
		\Response::redirect(\Input::referrer());
	}

	public function action_exit()
	{
		\Session::delete('fullscreen');
		\Response::redirect(\Input::referrer());
	}

}
