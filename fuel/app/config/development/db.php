<?php
/**
 * The development database settings.
 */

/*
return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host=localhost;dbname=mustached',
			'username'   => 'root',
			'password'   => 'root',
		),
	),
);

 */
/* PHPFOG Configuration */
return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host='.getenv('MYSQL_DB_HOST').';dbname='.getenv('MYSQL_DB_NAME'),
			'username'   => getenv('MYSQL_USERNAME'),
			'password'   => getenv('MYSQL_PASSWORD'),
		),
	),
);