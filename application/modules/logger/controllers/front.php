<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends Public_Controller {


	public function index()
	{
		Datamapper::add_model_path( array( APPPATH.'modules/user') );
		$u = new User();
		$r = new Reason();

		$reasons = $r->order_by('order asc')->get()->all_to_array(array('id', 'name'));
		$data['reasons'] = set_dropdown_array($reasons, 'id', 'name');

		if($this->input->post())
		{			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'lang:user.fields.email', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$errors = $this->form_validation->error_array();
				$this->data['msg'] = msg_error($errors);
			}
			else 
			{
				$u->where('email', $this->input->post('email'))->get();		

				$r->get_by_id($this->input->post('reason_id'))->to_array();

				if($u->exists()) {
					$l = new Log();

					$l->from_array($this->input->post(), '', true);
					$l->save(array($u, $r));

					$this->data['msg'] = user_message('success', lang('user.login.success'));
				}
				else 
				{
					$this->session->set_flashdata('msg', array('type' => 'error', 'content' => lang('user.login.userDoesntExist')));
					redirect('user/register?email='.urlencode($this->input->post('email')).'&reason_id='.urlencode($this->input->post('reason_id')).'&public='.urlencode($this->input->post('public')));
				}			
			}
			
		}


		$this->_render('login', $data);		
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */