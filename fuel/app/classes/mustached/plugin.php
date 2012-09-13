<?php

namespace Mustached;

class Plugin {

	private $plugins = array(); // list of plugins installed on the app (in the modules folder)
	private $regular_modules = array('checkin', 'calendar', 'user', 'install'); // list of the core module of the app (aka "not the plugins")


	/**
	 * Instanciate the plugins array.
	 */
	public function __construct()
	{
		$plugin_path = APPPATH.'modules'.DS;

		$modules = array_keys(\File::read_dir($plugin_path, 1));
		$plugins = array();

		foreach($modules as $module)
		{
			$module = substr($module, 0, -1);
		
			if(!in_array($module, $this->regular_modules))
			{
				$this->plugins[] = $module;
			}

		}
	}


	/**
	 * For each plugin, check if there is a postCheckin() function. 
	 * If so, the action is called, wathever it is.
	 */

	public function postCheckin($params = array())
	{
		foreach($this->plugins as $plugin)
		{
			\Module::load($plugin);
			$object_name = "\\".ucfirst($plugin)."\Trigger";

			$object = new $object_name;
			if(method_exists($object, 'postCheckin'))
			{
				try 
				{
					$object->postCheckin($params);	
				}
				catch(Exception $e)
				{
					// Log the error and the plugin associated with it
				}
			}
		}

	}

}