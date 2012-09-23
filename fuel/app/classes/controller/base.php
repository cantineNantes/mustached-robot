<?php

use Mustached\Message;

/**
 * The Base Controller_Base instantiate all the basic elements needed in the whole application
 *
 * All the other Base Controllers (Controller_Front, Controller_API, Controller_TV and Controller_Admin) 
 * inherit from this controller. 
 * 
 * By extension, every controller of the application will inherit this controller.
 */
class Controller_Base extends Controller
{

	public $data = array();
	public $current_user;

	


	public function before()
	{

	
		\Lang::load('front.php');
		
		\Casset::css('mustached.css');

		\Casset::js('jquery-1.7.2.min.js');
		\Casset::js('jquery.autocomplete-min.js');
		\Casset::js('jquery-ui-1.8.23.custom.min.js');
		\Casset::js('jquery.timeago.js');
		\Casset::js('jquery.fullscreen.js');
		\Casset::js('bootstrap.js');
		\Casset::js('raphael-min.js');
		\Casset::js('raphael_linechart.js');
		\Casset::js('jquery.pnotify.min.js');
		\Casset::js('common.js');

    	if($msg = \Session::get_flash('msg'))
        {
            $this->data['msg'] = Message::generic($msg['type'], $msg['content']);
        }

        $this->current_user = \Session::get('current_user') ? \Session::get('current_user') : false;
        $this->data['fullscreen'] = \Session::get('fullscreen') ? \Session::get('fullscreen') : false;

        $this->data['current_user'] = $this->current_user;


	}

	/**
	 * Utility function to shorten the call on a template, automatically add a twig extension, and inject
	 * commonly used datas in the template
	 * 
	 * @param  $template String Template name
	 */
	protected function _render($template)
	{
		return \Response::forge(\View::forge($template.'.twig', $this->data, false));
	}
}
