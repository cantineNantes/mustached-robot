<?php

/**
 * The production database settings.
 */


// Get the database data from environment variable. See http://support.cloudfoundry.com/entries/20386327-php-support-in-cloud-foundry

/* APP FOG CONFIGURATION */

/*
$services = getenv("VCAP_SERVICES");
$services_json = json_decode($services,true);

$mysql_config = $services_json["mysql-5.1"][0]["credentials"];

print_r($mysql_config);

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host='.$mysql_config["hostname"].';dbname='.$mysql_config["name"],
			'username'   => $mysql_config["user"],
			'password'   => $mysql_config["password"],
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

