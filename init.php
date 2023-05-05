<?php		

//if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

	$DB = null;
	//if( defined( 'DBHOST' ) && defined( 'DBUSER' ) && defined( 'DBPASS' ) && defined( 'DBNAME' ) ) {
		//$DB = new mysqli( DBHOST, DBUSER, DBPASS, DBNAME ); 
		$DB= new mysqli('localhost','root','r@@t','db_cpsuinventory');
	//}