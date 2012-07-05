<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$u = new User();

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
			// Save the user from the POST values 
			$u->from_array($this->input->post(), array('firstname', 'lastname', 'email', 'twitter'), false);
					
			// Search for the company		
			$c = new Company();
			$c->where('name', $this->input->post('company'))->get();

			// If the company doesn't exist, create it
			if(!$c->exists()) {
				$c->name = $this->input->post('company');
				$c->save();
			}

			$this->load->library('encrypt');
			$u->password = $this->encrypt->encode($this->input->post('password'));

			// Save the user with encrypted password and relationships
			if($u->save($c)) {
				// Log the user (using logger module function)
				Datamapper::add_model_path( array( APPPATH.'modules/logger') );
				modules::run('logger/front/index');

				// Display a confirmation message to the user
				$this->session->set_flashdata('msg', array('type' => 'info', 'content' => lang('user.form.saved')));

				redirect('logger/front');
			}		
			else {
				$this->data['msg'] = msg_error($u->error->all);
				foreach($this->input->post() as $key => $value)
				{
					$this->data[$key] = $value; 
				}
			}
		}
		
		$this->_render('register', $data);	
		
	}


	public function listing()
	{
		$u = new User();
		print_r($u->get());
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */