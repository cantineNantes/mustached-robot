<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mustache_User {
	
	private $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('encrypt');
	}

	

	public function login($email, $password)
	{
		$u = new User();
		$u->get_by_email($email);

		if($u->password == $this->_prep_password($password)) {
			$user = array(
				'user_id'      => $u->id,
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
			'user_id'      => '',
			'firstname'    => '',
			'is_admin'     => '',
		);
		$this->CI->session->unset_userdata($user);
		return true;
	}

	/*
	 * Create or update a user from form data
	 * @param array $post 
	 * @param boolean 
	 * @param integer $user_id : user_id of the user (if none provided, a new user will be created)
	 * @return boolean 
	 */
	public function saveFromArray($post, $savePassword, $user_id = null)
	{
		$u = new User();

		if($user_id) 
		{
			$u->get_by_id($user_id);	
		}
		
		// Save the user from the POST values 
		$u->from_array($post, array('firstname', 'lastname', 'email', 'twitter'), false);
				
		// Search for the company		
		$c = new Company();
		$c->where('name', $post['company'])->get();

		// If the company doesn't exist, create it
		if(!$c->exists()) {
			$c->name = $post['company'];
			$c->save();
		}

		if($savePassword)
		{
			$u->password = $this->_prep_password($post['password']);
		}

		$u->save($c);

		return $u;
	}

	private function _prep_password($password)
	{
		return $this->CI->encrypt->sha1($password.$this->CI->config->item('encryption_key'));
	}



}