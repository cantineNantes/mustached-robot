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

}
