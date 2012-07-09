<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('mustache_user');
	}
	
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

	public function edit($id = null)
	{		
		if(!$id) {
			$id = $this->data["current_user"]["id"];
		}
		else {
			// check if the current_user is admin. If not, show error
		}

		if($this->input->post())
		{
			// save user
			$user = $this->mustache_user->saveFromArray($this->input->post(), false, $id);
			if($user->valid) 
			{
				$this->data['msg'] = user_message('success', 'Modifications enregistrées !');
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


	public function delete()
	{

	}


	public function listing()
	{
		$u = new User();
		print_r($u->get());
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */