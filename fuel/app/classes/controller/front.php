<?php

class Controller_Front extends Controller_Base
{

	public function before()
	{
		parent::before();
		$this->data['section'] = 'front';
	}
}
