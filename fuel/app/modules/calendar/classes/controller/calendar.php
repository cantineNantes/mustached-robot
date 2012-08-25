<?php

namespace Calendar;
use Mustached\Message;

class Controller_Calendar extends \Controller_Front
{

	public function before()
	{
		parent::before();
		Manager::load();
	}

	public function action_index()
	{
		include('../vendor/gcalendar/gcalendar.php');
		$m = new Manager(new \GCalendar(array('email' => \Config::get('google_calendar_email'), 'password' => \Config::get('google_calendar_password'))));

		if( ! ($this->data['events'] = $m->get_next_events()))
		{
			$this->data['msg'] = Message::error('calendar.authentication_error');
		}

		return $this->_render('public');
	}



}
