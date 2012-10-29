<?php

namespace Mustached;

class Plugin {

	private $plugins = array(); // list of plugins installed on the app (in the modules folder)
	private $regular_modules = array('checkin', 'calendar', 'user', 'test', 'install'); // list of the core module of the app (aka "not the plugins")

	/**
	 * Instanciate the plugins array.
	 */
	public function __construct()
	{
		// Todo: store the plugin_path in cache
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
	 * Generic action for plugins : for each plugin, check if there is a $method() in the $class
	 * If so, execute the method.
	 * 
	 * @param  String $class  Class name
	 * @param  String $method Method name
	 * @param  Array  $params Array of params
	 * @return Array          Array of the return values of each plugin
	 */
	public function pluginAction($class, $method, $params = null)
	{
		$return = array();
		foreach($this->plugins as $plugin)
		{
			\Module::load($plugin);
			$object_name = "\\".ucfirst($plugin)."\\".ucfirst($class);

			$object = new $object_name;
			
			if(method_exists($object, $method))
			{
				try 
				{
					$return[$plugin] = $object->$method($params);						
				}
				catch(Exception $e)
				{
					$return[$plugin] = array('error' => $e->getMessage());
					// Log the error and the plugin associated with it
				}
			}
		}
		return $return;
	}

	/**
	 * For each plugin, add a form element to a form. 
	 *
	 * This method checks the Form class of each plugins and checks if there is a method called "addElementOn".FormName
	 * If the method exists, it is called and the form element is added on the given form.
	 * 
	 * @param  String $form_name Name of the form
	 * @param  \Fieldset 		Fieldset on which to add the new form element
	 * @return \Fieldset 		Fieldset
	 */
	public function addToForm($form_name, $fieldset)
	{		
		foreach($this->plugins as $plugin)
		{
			\Module::load($plugin);
			$object_name = "\\".ucfirst($plugin)."\Form";

			// Check if there is a addElementOnFormName
			$object = new $object_name;
			$method = 'addElementOn'.$form_name;

			if(method_exists($object, $method))
			{
				try 
				{
					$p = $object->$method();
					$method_add = 'add_'.$p['before_after'];
					$fieldset->$method_add($p['name'], $p['label'], $p['attributes'], $p['rules'], $p['fieldname']);                    
				}
				catch(Exception $e)
				{
					// Log the error and the plugin associated with it
				}
			}				
		}
		return $fieldset;
	}

	/**
	 * Build the settings form of a plugin
	 * @param  String $plugin Plugin name
	 * @return \Fieldset      Fieldset
	 */
	public function buildSettingsForm($plugin)
	{

		$config = \Config::get($plugin);
	
		$fieldset = \Fieldset::forge($plugin);

		foreach($config as $key => $value)
		{
			$fieldset->add($key, __($plugin.'.'.$value['label']), array('type' => $value['type'], 'value' => $value['value']));
		}

		$fieldset->add('submit',
		   '',
		   array('type' => 'submit', 'value' => __('mustached.settings.plugins.update'), 
		   'class' => 'btn btn-large btn-primary')
		);	

		return $fieldset;

	}


	/**
	 * Save the settings of a plugin in the plugin config file.
	 * @param  String    $plugin   Plugin name
	 * @param  \Fieldset $fieldset Fieldset
	 * @return Bool                True if the config was saved, false if an error occured
	 */
	public function saveSettingsFromForm($plugin, $fieldset)
	{

		$config = \Config::get($plugin);

		foreach ($config as $key => $value) {
			\Config::set($plugin.'.'.$key.'.value', $fieldset->input($key));		
		}

		return \Config::save($plugin.'::'.$plugin, $plugin);
		
	}


	/**
	 * Return installed plugins
	 * @return Array Array of the plugins name
	 */
	public function get_plugins()
	{
		return $this->plugins;
	}

	/**
	 * Set the installed plugins
	 * @param array $plugins Array of the installed plugins
	 */
	public function set_plugins($plugins = array())
	{
		$this->plugins = $plugins;
	}

	/**
	 * Checks wether a plugin exists or not
	 * @param  String $plugin Plugin name
	 * @return Bool 
	 */
	public function plugin_exists($plugin)
	{
		return (in_array($plugin, $this->plugins)) ? true : false;
	}

	/**
	 * Retirn the full path of a plugin
	 * @param  String $plugin
	 * @return String         
	 */
	public function get_path($plugin)
	{
		return APPPATH.'modules/'.$plugin;
	}


}