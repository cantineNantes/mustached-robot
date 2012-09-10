<?php

namespace Calendar;
use Mustached\Message;

class Controller_Tv extends \Controller_Tv
{

	public function before()
	{
		parent::before();
		Manager::load();
	}

	public function action_index()
	{		
		return $this->_render('tv');
	}

}
