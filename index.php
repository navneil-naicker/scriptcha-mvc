<?php
//Include the required files for bootstrapping
require_once( __DIR__ . '/config.php' );
require_once( __DIR__ . '/app/Autoload.php' );
require_once( __DIR__ . '/pattern/routes.php' );

//Initialize the controller class
new Controller;

//Make the current controller into global variable
$controller = controller();

//Make the current method into global variable
$method = method();

//Make the current params into global variable
$params = params();

//Connect to the database and make the db variable global
$db = Controller::database();

//Inject the current controller
require_once( controller_path() . '/' . $controller . '.php' );

//Initialize the current controller
$execute = new $controller;

//Pass the params into the controller method
$execute->$method( (object) $params );