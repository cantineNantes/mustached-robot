<?php

class Controller_Front extends Controller_Base
{

	public function before()
	{
		parent::before();
		\Lang::load('front.php');

		$this->data['section'] = 'front';

	}
}
