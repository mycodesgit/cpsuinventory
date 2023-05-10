<?php	
	if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

	/* 
	NOTE:
	ONLY SET THESE IF YOU WANT TO ALLOW AUTHENTICATION 
	IF NOT THEN JUST COMMENT THEM OUT 
	*/

	// table columns found in your 'users' table
	define( 'AUTH_ID', 'id' );
	define( 'AUTH_NAME', 'username' );
	define( 'AUTH_TYPE', 'usertype' );
	define( 'AUTH_TOKEN', 'token' );

	// default page to login, name of the file found in /pages
	define( 'LOGIN_REDIRECT', 'login' ); 

	/*
		TO USE:
			To add restricted pages, just uncomment the variable $restricted_pages,
			each array elements are page names found in your pages folder.
			When added, these pages will not be accessible unless the SESSION AUTH_ID
			is assigned with a value.
	*/

	$restricted_pages[ 'Administrator' ]['access'] = [ "dashboard", "profile", "inventory", "add-inventory", "edit-inventory", "category", "edit-category", "logstatus", "classification", "edit-classification", "offices", "edit-office", "users", "edit-user", "pdf-form1", "pdf-form2", "pdf1", "pdf2", "returned"];
	$restricted_pages[ 'Administrator' ][ 'default_page' ] = "dashboard";

	$restricted_pages[ 'SupplyOfficer' ]['access'] = [ "dashboard", "profile", "inventory", "add-inventory", "edit-inventory", "category", "logstatus", "classification", "edit-classification", "offices", "edit-office", "pdf-form1", "pdf-form2", "pdf1", "pdf2", "returned"];
	$restricted_pages[ 'SupplyOfficer' ][ 'default_page' ] = "dashboard";

	$restricted_pages[ 'Staff' ]['access'] = [ "dashboard", "profile", "inventory", "add-inventory", "edit-inventory", "category", "logstatus", "classification", "edit-classification", "offices", "edit-office", "pdf-form1", "pdf-form2", "pdf1", "pdf2", "returned" ];
	$restricted_pages[ 'Staff' ][ 'default_page' ] = "dashboard";
	
	$restricted_pages[ 'default' ]['access'] = [ "login", "register" ];
	$restricted_pages[ 'default' ][ 'default_page' ] = "default"; 

	has_access( true );
