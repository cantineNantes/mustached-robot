<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{		
		$this->_render('register');
	}

	
	


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */