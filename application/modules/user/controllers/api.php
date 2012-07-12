<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends Rest_Controller {

	private $return = array('id', 'firstname', 'lastname', 'email', 'twitter', 'company_id', 'created', 'updated');

	/*
	public function __construct()
	{
		parent::__construct();
		$this->return = 
	}
	*/
	/*
	 *	Get the users
	 *  
	 */
	public function users_get()
	{
		$u = new User();
		$u->get();
		$this->response($u->all_to_array($this->return), 201);
	}

	public function user_get($id)
	{

		$u = new User();
		$u->get_by_id($id);
		if($u->exists())
		{
			$this->response($u->to_array($this->return), 201);
		}
		else 
		{
			$this->response(array('error' => 'Resource unavailable', 404));	
		}
	}

	public function here_get()
	{
		Datamapper::add_model_path( array( APPPATH.'modules/logger') );
		$l = new Log();

		//$logs->where('created >=', $start);

		$l->where('created >=', date('Y-m-d'));
		$l->where('killed = 0');
		$l->where('public = 1');

		$here = $l->get()->all_to_array($this->return);

		if($here) 
		{
			$this->response($here, 201);	
		}
		else 
		{
			$this->response(array('message' => 'Sorry, no one is here !'), 400);
		}

		

		//$this->response($l->user->get()->all_to_array(), 201);
		
	}

	public function logs_get($user_id, $param = 'created', $order = 'desc')
	{
		Datamapper::add_model_path( array( APPPATH.'modules/logger') );
		$l = new Log();
		$l->order_by($param, $order);
		$l->get_where(array('user_id' => $user_id));
		$this->response($l->all_to_array(), 201);
	}

}
