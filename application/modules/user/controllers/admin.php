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

	public  function upgrade($id)
	{
		$u = new User();
		$u->get_by_id($id);
		$u->is_admin = true;
		$u->save();
		flash_message('success', lang('user.adminUpgrade.success'));
		redirect('admin/user');
	}
}