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

	/**
	 * buildMenu return the menu items of a menu
	 * 
	 * @param  String $type Type of menu ("public" or "admin")
	 * @return Array 		Array of menu items
	 */
	public function buildMenu($type)
	{
		$menuItems = array();
		foreach($this->plugins as $plugin)
		{
			\Module::load($plugin);
			$object_name = "\\".ucfirst($plugin)."\Config";

			$object = new $object_name;
			if(method_exists($object, 'publicMenu'))
			{
				try 
				{
					$menuItems[] = $object->publicMenu();	
				}
				catch(Exception $e)
				{

					// Log the error and the plugin associated with it
				}
			}
		}
		return $menuItems;
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

	public function buildSettings()
	{
		foreach($this->plugins as $plugin)
		{
			\Module::load($plugin);
			\Lang::load($plugin.'::'.$plugin.'.yml', $plugin);

		}

	}

	/**
	 * Return installed plugins
	 * @return Array Array of the plugins name
	 */
	public function get_plugins()
	{
		return $this->plugins;
	}

	public function plugin_exists($plugin)
	{
		return (in_array($plugin, $this->plugins)) ? true : false;
	}


}