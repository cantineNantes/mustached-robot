<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$u = new User();		
		if($this->input->post())
		{
			if($u->from_array($this->input->post(), '', true))
			{
				// flash message
				$this->session->set_flashdata('msg', array('type' => 'info', 'content' => 'Utilisateur enregistré'));
				redirect('user/register');
			}		
			else {
				// print_r($u->error->all);
				$this->data['msg'] = msg_error($u->error->all);
			}
		}
		else 
		{
			//$this->data['user'] = $u->to_array(array('id', 'name', 'email'));
		}
			
		$this->_render('register');

		
		
	}

	public function create2()
	{
		$u = new User();

		$u->firtsname = "Jey";
		$u->lastname  = "Pottier";
		$u->email     = "jeremie.pottier+tst@gmail.com";

		$u->save();
		
	}

	

	public function listing()
	{
		$u = new User();
		print_r($u->get());
	}

	

	
	


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */