<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends Public_Controller {


	public function index()
	{
		Datamapper::add_model_path( array( APPPATH.'modules/user') );
		$u = new User();

		if($this->input->post())
		{			
			$u->where('email', $this->input->post('email'))->get();
			
			if($u->exists()) {
				$l = new Log();
				$l->from_array($this->input->post(), '', true);
				$l->save($u);
				$this->data['msg'] = user_message('success', lang('user.login.success'));
			}
			else 
			{
				$this->session->set_flashdata('msg', array('type' => 'error', 'content' => lang('user.login.userDoesntExist')));
				redirect('user/register');
			}			
		}
		$this->_render('login');		
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */