<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$u = new User();
		$data['users'] = $u->order_by('created', 'desc')->get()->all_to_array();
		$this->_render('admin', $data);
	}
}