<?php

namespace Twitter;

class Trigger
{

	/**
	 * This action is triggered after a user checks in. 
	 * If the user has checked the checkbox "publish on twitter" on the checkin form, a tweet is sent on behalf of the coworking space twitter account
	 * 
	 * @param  Array $options Options 
	 */
	public function postCheckin($options)
	{
		\Lang::load('twitter::twitter.yml', 'twitter');
		
		$fieldset = $options['fieldset'];
		
		if ($fieldset->validation()->run() == true)
        {
			$fields = $fieldset->validated();
			
			if($fields['twitter'])
			{
				include('vendor/twitter-php/library/twitter.class.php');

				$um = new \User\Manager;
				$user = $um->get_user_from_email($fields['email']);

				$c = new \Checkin\Manager;
				$reason = $c->get_reason($fields['reason']);

				$twitter_name = empty($user['twitter']) ? '' : '(@'.$user['twitter'].')';

				$config = \Config::load('twitter::twitter', 'twitter');

				try 
				{
					$twitter = new \Twitter(\Config::get('twitter.consumerKey.value'), \Config::get('twitter.consumerSecret.value'), \Config::get('twitter.accessToken.value'), \Config::get('twitter.accessTokenSecret.value'));
					$twitter->send(__('twitter.tweet', array('firstname' => $user['firstname'], 'lastname' => $user['lastname'], 'pseudo' => $twitter_name, 'reason' => $reason)));	
				}
				catch(Exception $e)
				{
									
				}

				return true;

			}
			else 
			{
				//echo 'No tweet';
			}
		}		
	}
}