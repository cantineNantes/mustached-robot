<?php

use Mustached\Message;

class Controller_Settings extends \Controller_Admin
{

	public function action_plugins()
	{
		\Module::load('twitter');

		$config = \Config::load('twitter::twitter', 'twitter');

		$fieldset = \Fieldset::forge('twitter');

		foreach($config as $key => $value)
		{
			$fieldset->add($key, $key, array('type' => $value['type']));
		}

		

		$this->data['config'] = $config;

		return $this->_render('plugins');
	}

}