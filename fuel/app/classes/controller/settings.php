<?php

use Mustached\Message;
use Mustached\Plugin;

class Controller_Settings extends \Controller_Admin
{

	public function action_index()
	{
		$p = new Plugin();
		$this->data['plugins'] = $p->get_plugins();
		return $this->_render('settings/settings');
	}

	/**
	 * Display a form able to update the settings of a given plugin
	 * @param  String $plugin Name of the plugin
	 */
	public function action_plugin($plugin)
	{
		$p = new Plugin();
	
		if(!$p->plugin_exists($plugin))
		{
			throw new HttpNotFoundException;
		}
		
		\Module::load($plugin);
		\Lang::load($plugin.'::'.$plugin.'.yml', $plugin);

		$config = \Config::load($plugin.'::'.$plugin, $plugin);
	
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

		if (\Input::method() == 'POST')
		{
			foreach ($config as $key => $value) {
				\Config::set($plugin.'.'.$key.'.value', $fieldset->input($key));	
			}

			\Config::save($plugin.'::'.$plugin, $plugin);

			$fieldset->repopulate();

		}

		$this->data['form'] = $fieldset->form()->build();

		return $this->_render('settings/plugin');
	}

}