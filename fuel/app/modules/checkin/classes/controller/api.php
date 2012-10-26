<?php

namespace Checkin;

class Controller_Api extends \Controller_Api
{

	protected $return = array('id', 'user_id', 'reason_id', 'created_at', 'updated_at', 'public', 'killed');
	protected $m;

	public function before()
	{
		parent::before();
		$this->m = new Manager;
	}

	/* Return the public checkins */
	public function get_checkins($order = 'asc')
	{
		$c = $this->m->get_public_checkins($order);
		return $this->response($this->filter_array($c, $this->return));
	}

	public function get_checkin($id) {

		$c = \DB::select_array($this->return)->from('checkins')->where('id', '=', $id)->execute()->as_array();
		$this->response($c);
	}

	public function get_reasons()
	{
		$reasons = array('id', 'name', 'sentence');
		$r = \DB::select_array($reasons)->from('reasons')->order_by('order', 'asc')->execute()->as_array();
		$this->response($r);
	}

	public function get_user($user_id, $order = 'asc')
	{
		return $this->response($this->filter_array($this->m->get_user_checkins($user_id, $order), $this->return));
	}

	public function get_user_checkins($user_id, $order = 'asc')
	{
		return $this->response($this->filter_array($this->m->get_user_checkins($user_id), $this->return));
	}





}
