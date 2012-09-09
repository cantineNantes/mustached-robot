<?php

namespace Twitter;

class Config
{

	public function publicMenu()
	{
		return array('href' => 'twitter/showPublic', 'label' => 'Twitter');
		//echo 'post checkin from twitter module';
	}

	public function adminMenu()
	{
		return array('href' => 'twitter/showAdmin', 'label' => 'Twitter');	
	}

}