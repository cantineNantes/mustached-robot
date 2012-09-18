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

    	$less_files = array
	    (
	      DOCROOT.'assets/less/reset',
	      DOCROOT.'assets/less/variables',
	      DOCROOT.'assets/less/mixins',
	      DOCROOT.'assets/less/scaffolding',
	      DOCROOT.'assets/less/grid',
	      DOCROOT.'assets/less/layouts',
	      DOCROOT.'assets/less/type',
	      DOCROOT.'assets/less/code',
	      DOCROOT.'assets/less/forms',
	      DOCROOT.'assets/less/tables',
	      DOCROOT.'assets/less/sprites',
	      DOCROOT.'assets/less/dropdowns',
	      DOCROOT.'assets/less/wells',
	      DOCROOT.'assets/less/component-animations',
	      DOCROOT.'assets/less/close',
	      DOCROOT.'assets/less/buttons',
	      DOCROOT.'assets/less/button-groups',
	      DOCROOT.'assets/less/alerts',
	      DOCROOT.'assets/less/navs',
	      DOCROOT.'assets/less/navbar',
	      DOCROOT.'assets/less/breadcrumbs',
	      DOCROOT.'assets/less/pagination',
	      DOCROOT.'assets/less/pager',
	      DOCROOT.'assets/less/utilities',
	      DOCROOT.'assets/less/mustached',
	      //DOCROOT.'assets/less/responsive',
	      DOCROOT.'assets/less/responsive-utilities',
	      DOCROOT.'assets/less/responsive-767px-max',
	      DOCROOT.'assets/less/responsive-768px-979px',
	      DOCROOT.'assets/less/responsive-1200px-min',
	      DOCROOT.'assets/less/responsive-navbar',
	      DOCROOT.'assets/less/mustached',
	      DOCROOT.'assets/less/mustached',
	      DOCROOT.'assets/less/mustached',

	    );

    	$this->data['stylesheet'] = \Less::compile($less_files);

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
