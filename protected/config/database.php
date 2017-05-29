<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	'connectionString' => 'mysql:host=localhost;dbname=rpsaec_sms',
	'emulatePrepare' => true,
	'username' => 'rpsaec_admin',
	'password' => 'p@ssw0rd',
	'charset' => 'utf8',
	
);