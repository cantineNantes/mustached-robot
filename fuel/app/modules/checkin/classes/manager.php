<?php

namespace Checkin;

class Manager
{

	/**
	 * Return a list the public checkins
	 * 
	 * @param  string $order 	Order of the result (asc or desc)
	 * @return Array Array of checkins associative arrays
	 */

	public function get_public_checkins($order = 'desc')
	{
		return \DB::select()
					->from('checkins')
					->where('count', '=', 1)
					->where('public', '=', '1')
					->order_by('created_at', $order)
					->execute()
					->as_array();
	}

	/**
	 * Return a list of checkins between two dates
	 *
	 * @param  string  $start Start of the date range (format yyyy-mm-dd)
	 * @param  string  $end   End of the date range   (format yyyy-mm-dd)
	 * @return Array   	 	  Array of checkins associative arrays
	 */

	public function get_checkins($start, $end)
	{
		return \DB::select()
					->from('checkins')
					->where('created_at', '>=', $start)
					->where('created_at', '<=', $end)
					->execute()
					->as_array();
	}

	/**
	 * Return a single checkin
	 * 
	 * @param  int $id 	Id of the checkin
	 * @return array 	Associative array for the checkin
	 */
	public function get_checkin($id)
	{
		return \DB::select()
					->from('checkins')
					->where('id', '=', $id)
					->execute()
					->as_array();
	}

	/**
	 * Return a list of a user's checkins
	 * 
	 * @param int $user_id 		Id of the user
	 * @param string $order  	Order of the result (asc or desc). (optional, default = 'asc')
	 * @return Array 			Array of checkins associative arrays
	 */
	public function get_user_checkins($user_id, $order = 'asc')
	{
		return \DB::select('checkins.*')
					->from('checkins')
					->where('checkins.user_id', '=', $user_id)
					->join('users', 'right')
					->on('users.id', '=', 'checkins.user_id')
					->order_by('checkins.created_at', $order)
					->execute()->as_array();
	}

}
