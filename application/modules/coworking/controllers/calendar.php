<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('coworking');

	}

	public function index()
	{
		$data['events'] = $this->coworking->getNextEvents();
		$this->_render('calendar', $data);
	}

}