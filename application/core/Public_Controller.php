<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_controller extends MY_Controller {
	
	function __construct()
	{
		// Load the parent constructor
		parent::__construct();

		// Where are we ? Information used to set up informations on the layout
		$this->data['section'] = 'public';

		// We need to check here whether the page is currently offline or not
		/*
		if ( ( $this->preference->item('site.offline') == 1 ) && ( $this->acl->has_perm('admin') == FALSE ) )
		{
			show_error('The page is currently under maintenance, please come back soon.');
		}
		*/
		
		
	}	
}

/* End of file Public_controller.php */
/* Location: ./application/core/Public_controller.php */