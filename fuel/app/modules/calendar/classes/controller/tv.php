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
		$m = new Manager;

		if( ! ($this->data['events'] = $m->get_next_events()))
		{
			$this->data['msg'] = Message::error('calendar.authentication_error');
		}
		return $this->_render('tv');
	}

}
