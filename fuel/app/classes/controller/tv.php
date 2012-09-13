<?php

use Mustached\Message;

class Controller_Tv extends \Controller_Base
{


	public function action_index()
	{
		$this->data['screens'] = array('calendar/tv', 'admin/checkin/tv');
		$this->data['section'] = 'admin';
		return $this->_render('tv');
	}


}
