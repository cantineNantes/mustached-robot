<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{		
	protected $data = array();
	public $culture;
	
	function __construct()
	{		
		parent::__construct();		
		
		//$this->output->enable_profiler(TRUE);
		
		// We need this to use the profiler
		//$this->load->database();
		
 		if($this->session->flashdata('msg'))
 		{
 			$this->data['msg_type'] = $this->session->flashdata('msg_type');
 			$this->data['msg'] = $this->session->flashdata('msg');
 		}

    }
    
    // Utility function called to output a template
	public function _render($template, $data = array())
	{		
		$data_merge = array_merge($data, $this->data);
		$view = $this->twig->display($template, $data_merge);				
	}
	
    // Utility function called to return the page as a string
	public function getTemplate($template, $data = array())
	{		
		$data_merge = array_merge($data, $this->data);
		return $this->twig->render($template, $data_merge);
	}
	
    
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */