<?php

namespace Checkin;

class Manager
{

	public function get_public_checkins($order = 'desc')
	{
		return \DB::select()->from('checkins')->where('count', '=', 1)->where('public', '=', '1')->order_by('created_at', $order)->execute()->as_array();
	}

	public function get_checkin($id)
	{
		return \DB::select()->from('checkins')->where('id', '=', $id)->execute()->as_array();
	}

	/**
	 * Return a list of a user's checkins
	 * @param int $user_id 		Id of the user
	 * @param string $order  	Order of the result (asc or desc). (optional, default = 'asc')
	 * @return Array 			Array of checkins associative array
	 */
	public function get_user_checkins($user_id, $order = 'asc')
	{
		return \DB::select('checkins.*')->from('checkins')->where('checkins.user_id', '=', $user_id)->join('users', 'right')->on('users.id', '=', 'checkins.user_id')->order_by('checkins.created_at', $order)->execute()->as_array();
	}

	public function get_checkins($start, $end)
	{
		return \DB::select()->from('checkins')->where('created_at', '>=', $start)->where('created_at', '<=', $end)->execute()->as_array();
	}

	public function get_checkins_and_users($start, $end)
	{
		return Model_Checkin::find('all', array(
				'related'  => array('user'),							
				'order_by' => array('created_at' => 'desc'),
				'where'    => array(
					array('created_at', '>=', $start),
					array('created_at', '<=', $end)
				),
		));
	}

	public function get_leaders($start, $end)
	{

		/*
		$checkin_count = \DB::select(\DB::expr('count(id)'))
							->from('checkins')
							->where('checkins.created_at', '>=', $start)
							->where('checkins.created_at', '<=', $end);


		$leaders = \DB::select('users.*', array($checkin_count, 'check'))
							->from('checkins')		
							->where('checkins.created_at', '>=', $start)
							->where('checkins.created_at', '<=', $end)
							->join('users', 'right')
							->on('users.id', '=', 'checkins.user_id')
							//->distinct(true)
							->execute()->as_array();
		 */
		
		$leaders = \DB::select('users.email', 'users.firstname', 'users.lastname', array(\DB::expr('count(users.id)'), 'checkin_number'))
							->from('users')
							->join('checkins')
							->on('users.id', '=', 'checkins.user_id')
							->where('checkins.created_at', '>=', $start)
							->where('checkins.created_at', '<=', $end)
							->group_by('users.email')
							->order_by('checkin_number', 'desc')
							->execute()->as_array();

		
		return $leaders;

		/*

		SELECT `users`.*, 
			(SELECT count(id) 
				FROM `checkins` 
				WHERE `checkins`.`created_at` >= null 
				AND `checkins`.`created_at` <= null
			) AS `check` 
		
		FROM `checkins` 
			RIGHT JOIN `users` ON (`users`.`id` = `checkins`.`user_id`) 
			WHERE `checkins`.`created_at` >= null AND `checkins`.`created_at` <= null

		 */

	}



}
