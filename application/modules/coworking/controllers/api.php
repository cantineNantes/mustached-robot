<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends Rest_Controller {

	/*
	 *	Get the coworking space seats informations
	 *  
	 */
	public function seats_get()
	{
		
		Datamapper::add_model_path( array( APPPATH.'modules/logger') );
		$l = new Log();

		$l->where('created >=', date('Y-m-d'));
		$l->where('killed = 0');
		$l->where('reason_id = 1');

		$occupied  = $l->count();
		$total     = $this->config->item('seats');
		$available = (($total - $occupied) < 0) ? 0 : $total;

		$seats = array(
			'total'     => $total,
			'occupied'  => $occupied,
			'available' => $available, 
		);

		$this->response($seats, 201);
	}


}
