<?php

namespace Install;
use Mustached\Message;
use Mustached\Plugin;

class Controller_Public extends \Controller_Front
{

	public function action_test()
	{
		return $this->_render('database');
	}

}