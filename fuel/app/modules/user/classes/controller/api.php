<?php

namespace User;

class Controller_Api extends \Controller_Api
{

	protected $return = array('id', 'checkins.public', 'firstname', 'lastname', 'biography', 'email', 'twitter', 'created_at', 'skills', 'company');

	protected $um;
	protected $cm;

	public function before()
	{
		\Module::load('checkin');
		$this->cm = new \Checkin\Manager;
		$this->um = new Manager;
	}

	public function get_users()
	{		
		$this->response($this->filter_array($this->um->get_users(), $this->return));
	}

	public function get_user($id) {

		if (\Input::get('expand'))
		{
			$this->response($this->filter_array($this->um->get_user_expand($id, \Input::get('expand')), $this->return));	
		}
		else 
		{
			$this->response($this->filter_array($this->um->get_user($id), $this->return));
		}
	}

	public function get_user_skills($id)
	{
		$this->response($this->um->get_user_skills($id));
	}

	public function get_companies()
	{
		$this->response($this->um->get_companies());
	}

	public function get_company($id)
	{
		$this->response($this->um->get_company($id));
	}

	public function get_skills()
	{

	}

	/*
	 * Return a list of the user currently in the coworking space (who have allowed their information to be publicly available)
	 *
	 */

	public function get_here($reason = null)
	{
		$u = $this->um->get_users_here($reason);
		if($u)
		{
			$this->response($this->filter_array($u, array_push($this->return, 'since')));
		}
		else
		{
			$this->response(array('info' => array('code' => 'no_one_here', 'message' => __('mustached.api.no_one_here'))));
		}
		
	}

	public function get_seats()
	{
		$total    = \Config::get('mustached.seats');
		$occupied = $this->um->get_occupied_seats_count();
		$response = array(
			'total_seats' => $total,
			'occupied'    => $occupied,
			'available'        => ($total - $occupied),
		);
		$this->response($response);

	}


}
