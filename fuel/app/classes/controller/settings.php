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
		\Module::load($plugin);
		\Lang::load($plugin.'::'.$plugin.'.yml', $plugin);
		\Config::load($plugin.'::'.$plugin, $plugin);

		$p = new Plugin();

		if(!$p->plugin_exists($plugin))
		{
			throw new HttpNotFoundException;
		}
		
		$fieldset = $p->buildSettingsForm($plugin);

		if ( ! is_dir($p->get_path($plugin).'/config') or ! is_writable($p->get_path($plugin).'/config'))
		{
			$this->data['msg'] = Message::error(__('mustached.settings.directoryNotWritable', array('dir' => $p->get_path($plugin).'/config')));
		}

		if (\Input::method() == 'POST')
		{
			$res = $p->saveSettingsFromForm($plugin, $fieldset);
			$fieldset->repopulate();
			$this->data['msg'] = Message::success(__('mustached.settings.saved'));
		}

		$this->data['form'] = $fieldset->form()->build();
		$this->data['plugin'] = $plugin;


		return $this->_render('settings/plugin');
	}

}