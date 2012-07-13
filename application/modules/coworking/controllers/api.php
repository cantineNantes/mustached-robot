<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends Rest_Controller {

	/*
	 *	Get the next events in the coworking space (starting from today)
	 *  
	 */
	public function next_events_get()
	{
		$this->load->library('coworking');
		$this->response($this->coworking->getNextEvents(), 201);
	}



}
