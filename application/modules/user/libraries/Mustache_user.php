<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mustache_User {
	
	private $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('encrypt');
	}

	public function prep_password($password)
	{
		return $this->CI->encrypt->sha1($password.$this->CI->config->item('encryption_key'));
	}
}