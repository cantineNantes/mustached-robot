<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Coworking	 {
	
	private $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function getNextEvents()
	{
		$params = array(
			'email'    => $this->CI->config->item('google_calendar_email'), 
			'password' => $this->CI->config->item('google_calendar_password'),
		);

		$this->CI->load->library('gcalendar', $params);

		if(!$this->CI->gcalendar->authenticate())
		{
			show_error(lang('calendar.authenticationError'));
		}

		$evts = $this->CI->gcalendar->getEvents($this->CI->config->item('google_calendar_handle'), 20, date('Y-m-d'));

		return $evts->data->items;
	}

	





}