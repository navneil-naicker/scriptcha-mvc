<?php

Class Controller{

    static $controller; //Current in use controller will be assigned to this static variable
    static $method; //Current in use method will be assigned to this static variable
    static $params; //Current in use params will be assigned to this static variable

    static $title; //Method can use this static variable to assign and get the title
    static $description; //Can be used by the method to assign and get description
    static $db; //Holds the database connection link for easiler access to database within the method or view
    
    public function __construct(){
        
        //Run the dispatch on Router to start crunching and get the current request match
        $dispatch = Router::dispatch();
        
        if( !empty($dispatch) ){
            $dispatch = explode('@', $dispatch); //We have a match now let's separate the controller and method
            self::$controller = $dispatch[0]; //Get the controller from the Router
            self::$method = $dispatch[1]; //Get the method from the Router
            self::$params = (object) Router::$params; //Get the params if passed to the method
            $controller = self::$controller; //Create local variable for controller
            $method = self::$method; //Create local variable for method
            $params = self::$params; //Create local variable for params
        } else {
            self::$controller = 'SystemController'; //Default controller 
            self::$method = 'error404'; //Default method
            $controller = self::$controller; //Create local variable for method
            $method = self::$method; //Create local variable for params
        }
    }

    //Creates connection to the database
    static function database(){
        if( USE_DATABASE ){
            return new MysqliDb(array( 'host' => DATABASE_HOST, 'username' => DATABSE_USERNAME, 'password' => DATABAS_PASSWORD, 'db'=> DATABASE_NAME, 'port' => DATABASE_PORT, 'prefix' => DATABASE_PREFIX, 'charset' => 'utf8'));
        }     
    }

}
