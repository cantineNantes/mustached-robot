<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Get the gravatar of the user */
if ( ! function_exists('get_user_avatar'))
{
	function get_user_avatar($user_email, $size = '80')
	{	 
		return 'http://www.gravatar.com/avatar/'.md5($user_email).'?s='.$size;    
	}
}