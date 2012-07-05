<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Companies extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$c = new Company();
		$companies = $c->like('name', $this->input->get('q'))->get()->all_to_array();
	
		foreach ($companies as $company) {
			$data[] = array(
				'name'  => $company['name'],
				'value' => $company['id'],				
			);
		}

		$this->output
			 ->enable_profiler(FALSE)
    		 ->set_content_type('application/json')
    		 ->set_output(json_encode($data));

	}

}