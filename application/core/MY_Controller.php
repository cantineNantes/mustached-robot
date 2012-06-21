<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
    
    protected $data = array();

    public function __construct() {
        parent::__construct();
        
        $this->lang->load('mustached');
        $this->load->library('Twig');
		$this->load->spark('assets/1.5.0');

		//assets_css();
        $this->twig->add_function('assets_css');
        $this->twig->add_function('assets_js');
        $this->twig->add_function('lang');

        if ( ENVIRONMENT == 'development' ){
            $this->output->enable_profiler(true);
        }

        if($this->session->flashdata('msg'))
        {
            $this->data['msg_type'] = $this->session->flashdata('msg_type');
            $this->data['msg'] = $this->session->flashdata('msg');
        }
        
        // add the modules to the model autoloader search path
        Datamapper::add_model_path( array(  APPPATH.'modules/welcome' ) );
    }

    // Utility function called to output a template
	public function _render($template, $data = array())
	{		
		$data_merge = array_merge($data, $this->data);
		$view = $this->twig->display($template.'.html.twig', $data_merge);				
	}

    // Utility function called to return the page as a string
	public function getTemplate($template, $data = array())
	{		
		$data_merge = array_merge($data, $this->data);
		return $this->twig->render($template.'html.twig', $data_merge);
	}


}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */