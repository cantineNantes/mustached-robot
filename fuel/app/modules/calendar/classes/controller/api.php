<?php

namespace Calendar;

class Controller_Api extends \Controller_Api
{

	public function before()
	{
		parent::before();
		Manager::load();
	}

	public function get_next_events()
	{
		$m = new Manager(new \GCalendar(array('email' => \Config::get('google_calendar_email'), 'password' => \Config::get('google_calendar_password'))));

		if( ! ($events = $m->get_next_events()))
		{
			$this->response(array('info' => array('error' => 'authentication_error', 'message' => __('calendar.authentication_error'))));
		}
		else {
			$this->response($events);
		}
	}

}
