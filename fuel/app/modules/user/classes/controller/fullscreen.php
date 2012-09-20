<?php

namespace User;
use Mustached\Message;

class Controller_Fullscreen extends \Controller_Front
{

	public function action_enter()
	{
		\Session::set('fullscreen', true);
		// \Response::redirect(\Input::referrer());
		return 'enter';
	}

	public function action_exit()
	{
		\Session::delete('fullscreen');
		// \Response::redirect(\Input::referrer());
		return 'exit';
	}

}
