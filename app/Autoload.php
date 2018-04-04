<?php

//Inject the helper function
require_once( dirname(__FILE__) . '/Helpers.php' );

//Inject the router class
require_once( dirname(__FILE__) . '/Router.php' );

//Inject the providers scripts
require_once( app_path() . '/Providers.php' );
if( !empty($providers) ){ foreach( $providers as $provider ){ require_once( vendor_path() . '/' . $provider . '.php' ); } }

//Inject the bootloader controller
require_once( dirname(__FILE__) . '/Controller.php' );