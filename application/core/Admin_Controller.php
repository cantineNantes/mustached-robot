<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_controller extends MY_Controller {
	
	function __construct()
	{
		// Load the parent constructor
		parent::__construct();
		
		// Load necessary libraries
		// $this->load->library();
		
		// Load necessary models
		// $this->load->model();
		
		// We need to check here whether the page is currently offline or not

		/*
		if ( ( $this->preference->item('site.offline') == 1 ) && ( $this->acl->has_perm('admin') == FALSE ) )
		{
			show_error('The page is currently under maintenance, please come back soon.');
		}
		*/
		
		// We need to check here for the correct rights first
		/*
		if ( FALSE OR ! $this->acl->has_perm('public') )
		{
			show_error(
						'You don\'t have enough rights to view this page. This is odd. Maybe you will notify an administrator '
						. mailto($this->preference->item('mail.contact'), html_entities($this->preference->item('mail.contact')))
					);
		}
		*/
	}	
}

/* End of file Public_controller.php */
/* Location: ./application/core/Public_controller.php */