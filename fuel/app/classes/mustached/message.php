<?php

namespace Mustached;

/**
 * The Message Class handles the notification system on the application
 */

class Message {

	public static function success($message){
		return self::generic('success', $message);
	}

	public static function error($message) {
		return self::generic('error', $message);
	}

	public static function flash_success($message)
	{
		\Session::set_flash('msg', self::generic('success', $message));
	}

	public static function flash_error($message) {
		\Session::set_flash('msg', self::generic('error', $message));
	}

	/**
	 * This function return a correctly formated array to display a message to the end user
	 * 
	 * @param  String $type    error or success
	 * @param  String $message Message to display to the end-user OR language key 
	 * @return Array           Array containing the message type and message
	 */
	public static function generic($type, $message)
	{
		$message = \Lang::get($message) ?: $message;
		return array('type' => $type, 'content' => $message);
	}

}
