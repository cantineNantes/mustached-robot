<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$u = new User();
		// If form has been POSTed
		if($this->input->post())
		{			
			// Save the user from the POST values 
			if($u->from_array($this->input->post(), array('firstname', 'lastname', 'email'), true))
			{		
				// Search for the company		
				$c = new Company();
				$c->where('name', $this->input->post('company'))->get();

				// If the company doesn't exist, create it
				if(!$c->exists()) {
					$c->name = $this->input->post('company');
					$c->save();
				}

				// Save the relationship between the user and the company
				$u->save($c);

				// Display a confirmation message to the user
				$this->session->set_flashdata('msg', array('type' => 'info', 'content' => lang('user.form.saved')));
				redirect('user/register');
			}		
			else {
				$this->data['msg'] = msg_error($u->error->all);
			}
		}
		$this->_render('register');
	}


	public function listing()
	{
		$u = new User();
		print_r($u->get());
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */