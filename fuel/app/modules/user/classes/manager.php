<?php

namespace User;

class Manager
{

	public function get_users($order = 'asc')
	{
		return \DB::select('users.*')->from('users')->order_by('created_at', $order)->execute()->as_array();
		
		/*
		return \DB::select('users.*')
					->select('skills.name')
					->from('users')
					->join('skills_users', 'left')
					->on('skills_users.user_id', '=', 'users.id')
					->join('skills', 'left')
					->on('skills.id', '=', 'skills_users.skill_id')
					->order_by('created_at', $order)
					->execute()
					->as_array();
		 */
		 
		 
	}

	public function get_user($id)
	{
		return \DB::select()->from('users')->where('id', '=', $id)->execute()->as_array();
	}

	public function get_user_extend($id)
	{
		$u = $this->get_user($id);
		$s = \DB::select('skills.name')					
				->from('users')
				->where('users.id', '=', $id)
				->join('skills_users', 'left')
				->on('skills_users.user_id', '=', 'users.id')
				->join('skills', 'left')
				->on('skills.id', '=', 'skills_users.skill_id')
				->order_by('created_at', $order)
				->execute()
				->as_array();

		$u[0]['skills'] = $s;

		return $u;
	}

	public function get_user_skills($id)
	{
		return \DB::select('skills.name')					
				->from('users')
				->join('skills_users', 'left')
				->on('skills_users.user_id', '=', 'users.id')
				->join('skills', 'left')
				->on('skills.id', '=', 'skills_users.skill_id')
				->order_by('created_at', $order)
				->execute()
				->as_array();
	}

	public function get_skills_by_user()
	{

	}

	public function get_users_here($reason = null)
	{
		$qb = \DB::select('users.*', array('checkins.created_at', 'since'))->from('users')->join('checkins', 'right')->on('checkins.user_id', '=', 'users.id')->where('checkins.killed', '=', '0')->where('checkins.created_at', '>=', date('Y-m-d'))->where('checkins.public', '=', '1');
		if($reason) {
			$qb->where('reason_id', '=', $reason);
		}
		return $qb->execute()->as_array();
	}



	public function get_companies()
	{
		return \DB::select()->from('companies')->execute()->as_array();
	}

	public function get_company($id)
	{
		return \DB::select()->from('companies')->where('id', '=', $id)->execute()->as_array();
	}

	public function get_occupied_seats_count()
	{
		return \DB::select('users.id')->from('users')->join('checkins', 'right')->on('checkins.user_id', '=', 'users.id')->where('checkins.killed', '=', '0')->where('checkins.created_at', '>=', date('Y-m-d'))->where('checkins.reason_id', '=', 1)->execute()->count();
	}

}
