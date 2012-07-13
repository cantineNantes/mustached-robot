<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('mustache_user');
	}
	
	
	/*
	 * Create a new user
	 */
	public function create()
	{
		
		// Initialize reason dropdown menu
		Datamapper::add_model_path( array( APPPATH.'modules/logger') );		
		$r = new Reason();
		$reasons = $r->order_by('order asc')->get()->all_to_array(array('id', 'name'));
		$data['reasons'] = set_dropdown_array($reasons, 'id', 'name');

		// Set default value to the form if the user is redirected from the login page
		$data['email'] = urldecode($this->input->get('email'));
		$data['reason_id'] = urldecode($this->input->get('reason_id'));
		$data['public'] = urldecode($this->input->get('public'));

		// If form has been POSTed
		if($this->input->post())
		{			
			// Save the user datas
			$user = $this->mustache_user->saveFromArray($this->input->post(), true);

			if($user->valid)
			{
				// Log the user (using the logger module)
				Datamapper::add_model_path( array( APPPATH.'modules/logger') );
				modules::run('logger/front/index');

				// Display a confirmation message to the user
				$this->session->set_flashdata('msg', array('type' => 'info', 'content' => lang('user.form.saved')));

				redirect('logger/front');	
			}	
			else {
				$this->data['msg'] = msg_error($user->error->all);
				foreach($this->input->post() as $key => $value)
				{
					$this->data[$key] = $value; 
				}
			}
		}
		
		$this->_render('register', $data);	
		
	}

	/*
	 * Edit a user's properties
	 * @param int $id (optional) : if specified, the page will change the properties of the user with id = $id, otherwise it will change the password of the current user
	 */

	public function edit($id = null)
	{		
		if(!$id) {
			$id = $this->data["current_user"]["id"];
		}
		else {
			$this->_protect_and_allow_admin_edit();	
		}
		

		if($this->input->post())
		{
			// save user
			$user = $this->mustache_user->saveFromArray($this->input->post(), false, $id);
			if($user->valid) 
			{
				$this->data['msg'] = user_message('success', lang('updateSuccessful'));
			}
			else 
			{
				$this->data['msg'] = msg_error($user->error->all);
				foreach($this->input->post() as $key => $value)
				{
					$this->data[$key] = $value; 
				}	
			}
		}
		else {
			$user = new User();			
			$user->get_by_id($id);
		}

		foreach($user->to_array() as $key => $value)
		{
			$this->data[$key] = $value; 
		}

		$this->data["company"] = $user->company->get()->name;	
		
		
		$this->_render('edit', $this->data);
	}

	/*
	 * Edit a user's password
	 * @param int $id (optional) : if specified, the page will change the password of the user with id = $id, otherwise it will change the password of the current user
	 */
	public function edit_password($id = null)
	{
		// If an admin is editing another user
		$this->data['adminEditingAnotherUser'] = false;
		$this->data['action'] = current_url();

		if($id) {
			$this->_protect_and_allow_admin_edit();				
		}
		else {
			$id = $this->data["current_user"]["id"];
		}

		if($this->input->post())
		{
			// If an admin is editing another user, allow him to set a new password without entering the current one
			if($this->data['adminEditingAnotherUser'])
			{
				$user = $this->mustache_user->force_change_password($id, $this->input->post('newPassword'));
			}
			else 
			{
				$user = $this->mustache_user->change_password($id, $this->input->post('currentPassword'), $this->input->post('newPassword')); 
			}

			if($user->valid)
			{
				$this->data['msg'] = user_message('success', 'Mot de passe mis à jour !');
			}	
			else {
				//$this->data['msg'] = user_message('error', 'Le mot de passe actuel n\'est pas le bon !');
				$this->data['msg'] = msg_error($user->error->all);
				foreach($this->input->post() as $key => $value)
				{
					$this->data[$key] = $value; 
				}
			}	
		}

		$this->_render('edit_password');
	}


	public function delete()
	{
		if($this->input->post())
		{
			$u = new User;
			$this->mustache_user->delete($this->session->userdata('user_id'));
		}
		$this->_render('delete');
	}


	public function listing()
	{
		$u = new User();
		print_r($u->get());
	}

	private function _protect_and_allow_admin_edit()
	{
		if(!$this->session->userdata('is_admin'))
		{
			flash_message('error', lang('admin.accessRestricted'));
			redirect('user/auth/login');
		}
		else 
		{
			$this->data['adminEditingAnotherUser'] = true;
		}
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */