<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends Rest_Controller {

	public function logs_get()
	{
		$l = new Log();
		$l->get();
		$this->response($l->all_to_array(), 201);
	}

	public function log_get($id)
	{
		$l = new Log();
		$l->get_by_id($id);
		if($l->exists())
		{
			$this->response($l->to_array(), 201);
		}
		else 
		{
			$this->response(array('error' => 'Resource unavailable', 404));	
		}
	}

	public function reasons_get()
	{
		$r = new Reason();
		$r->get();
		$this->response($r->all_to_array(), 201);
	}



}
