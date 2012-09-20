<?php

namespace Fuel\Tasks;

/**
 * Custom database tasks
 */

class Db
{

	public function setup_test()
	{
		\Fuel::$env = \Fuel::TEST;		
		\DB::query(file_get_contents(APPPATH.'database_test.sql'))->execute();
	}

}