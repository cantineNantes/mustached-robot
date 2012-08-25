<?php

namespace Mustached;

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
		\Session::set_flashp('msg', self::generic('error', $message));
	}

	public static function generic($type, $message)
	{
		$message = \Lang::get($message) ?: $message;
		return array('type' => $type, 'content' => $message);
	}

}
