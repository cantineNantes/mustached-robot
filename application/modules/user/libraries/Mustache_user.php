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

	public function login($email, $password)
	{
		$u = new User();
		$u->get_by_email($email);

		if($u->password == $this->prep_password($password)) {
			$user = array(
				'current_user' => $u->id,
				'firstname'    => $u->firstname,
				'is_admin'     => $u->is_admin,
			);
			$this->CI->session->set_userdata($user);
			return true;
		}
		else 
		{
			return false;
		}

	}

	public function logout()
	{
		$user = array(
			'current_user' => '',
			'firstname'    => '',
			'is_admin'     => '',
		);
		$this->CI->session->unset_userdata($user);
		return true;
	}


}