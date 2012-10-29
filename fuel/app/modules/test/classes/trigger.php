<?php

namespace Test;

class Trigger
{

	/**
	 * This action is triggered after a user checks in. 
	 * If the user has checked the checkbox "publish on twitter" on the checkin form, a tweet is sent on behalf of the coworking space twitter account
	 * 
	 * @param  Array $options Options 
	 */
	public function postCheckin($options = null)
	{
		if($options)
		{
			return $options['return'];			
		}
		else 
		{
			return true;
		}
	}
}