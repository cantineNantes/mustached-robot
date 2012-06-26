<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Help display a message error for the form */
if ( ! function_exists('msg_error'))
{
	function msg_error($errors = array())
	{
		$CI =& get_instance();
		$content = '<ul>';
		foreach($errors as $error)
		{
			$content .= '<li>'.$error.'</li>'; 
		}
		$content .= '</ul>';
		return array('type' => 'error', 'content' => $content);
	}
}

/* Help set flash message */
if ( ! function_exists('msg_error'))
{
	function set_flashmessage($message)
	{
		$CI =& get_instance();
		$content = '<ul>';
		foreach($errors as $error)
		{
			$content .= '<li>'.$error.'</li>'; 
		}
		$content .= '</ul>';
		$CI->data['msg'] = array('type' => 'error', 'content' => $content);
		return array('type' => 'error', 'content' => $content);
	}
}