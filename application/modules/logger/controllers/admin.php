<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {


	public function index()
	{
		Datamapper::add_model_path( array( APPPATH.'modules/user') );
		$l = new Log();
		$u = new User();
		$r = new Reason();

		//$l->include_related('user', array('firstname', 'lastname', 'id'), true)->get()->all_to_array();
		$l->include_related('user', array('firstname', 'lastname', 'id', 'email'), true);
		$l->include_related('reason', array('sentence'), true);
		$l->order_by('created', 'desc');
		$l->get()->all_to_array();

		//get()->all_to_array();
		
		foreach($l as $log)
		{
			$date = substr($log->created, 0, 10);
			$data['logs'][$date][] = array(
				'id'     => $log->id,
				'email'  => $log->user_email,
				'reason' => $log->reason_sentence,
				'start'  => $log->created,
				'end'    => $log->ended,
				'killed' => $log->killed,
				'user'   => array(
					'name'   => $log->user_firstname.' '.$log->user_lastname,
					'id'     => $log->user_id,	
				),
			);
		};

		//print_r($data['logs']);

		$this->_render('admin', $data);		
		
	}

	public function kill($id)
	{
		$l = new Log();
		try {
			$l->get_by_id($id);
			if($l->exists())
			{
				$l->killed = true;
				$l->save();	
				flash_message('success', lang('logger.kill.success'));
			}
			else 
			{
				flash_message('error', lang('error'));
			}				
		}
		catch(Exception $e)
		{
			flash_message('error', lang('error'));
			redirect('admin');
		}
		
		redirect('admin');

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */