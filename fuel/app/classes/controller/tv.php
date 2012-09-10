<?php

use Mustached\Message;

class Controller_Tv extends \Controller_Base
{


	public function action_index()
	{
		$this->data['screens'] = array('', '')
		return $this->_render('tv');
	}


}
