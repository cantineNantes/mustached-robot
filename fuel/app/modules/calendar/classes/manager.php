<?php

namespace Calendar;

class Manager {

	private $gcal;
	
	public function __construct()
	{
		if(!class_exists('GCalendar'))
		{
			require_once 'vendor/gcalendar/gcalendar.php';
		}
		$this->gcal = new \GCalendar(array('email' => \Config::get('google_calendar_email'), 'password' => \Config::get('google_calendar_password')));
	}
	
	public static function load()
	{
		\Lang::load('calendar.yml', 'calendar');
		\Config::load('calendar.php');
	}

	/**
	 * Set a new calendar (overrides constructor calendar)
	 * 
	 * @param \GCalendar $gcal
	 */
	public function setCalendar(\GCalendar $gcal)
	{
		$this->gcal = $gcal;
	}

	/**
	 * Get the next events
	 * 
	 * @param int $number Number of events to retrieve
	 * @return bool|array Returns false on failure or an array containing the events informations on success
	 */
	public function get_next_events($number = 20)
	{
		if (!$this->gcal->authenticate())
		{
			return false;
		}
		else
		{
			$evts = $this->gcal->getEvents(\Config::get('google_calendar_id'), $number, date('Y-m-d'));
		}
		return $evts->data->items;
	}

}
