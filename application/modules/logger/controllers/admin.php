<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {


	public function index()
	{
		Datamapper::add_model_path( array( APPPATH.'modules/user') );
		$l = new Log();
		$u = new User();
		$r = new Reason();

		//$l->include_related('user', array('firstname', 'lastname', 'id'), true)->get()->all_to_array();
		$l->include_related('user', array('firstname', 'lastname', 'id'), true);
		$l->include_related('reason', array('sentence'), true);
		$l->get()->all_to_array();

		//get()->all_to_array();
		
		foreach($l as $log)
		{
			$date = substr($log->created, 0, 10);
			$data['logs'][$date][] = array(
				'id'     => $log->id,
				'reason' => $log->reason_sentence,
				'start'  => $log->created,
				'user'   => array(
					'name'   => $log->user_firstname.' '.$log->user_lastname,
					'id'     => $log->user_id,	
				),
			);
		};

		//print_r($l);

		$this->_render('admin', $data);		
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */