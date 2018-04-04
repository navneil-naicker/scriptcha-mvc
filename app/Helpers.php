<?php

//Remove unwanted slashes and sanitizes the URI
function sanitize_path( $path ){
    $path = explode('/', $path);
    $path = array_filter( $path );
    $path = implode('/', $path);
    return htmlentities(filter_var($path, FILTER_SANITIZE_URL));
}

//Current page URI
function site_uri(){
    return (!empty($_GET['uri']))? trim($_GET['uri'], '/'):'/';
}

//Current website path defined in config.php
function base_path(){
    return BASE_PATH;
}

//Current website URL defined in config.php
function base_url(){
    return BASE_URL;
}

//Defines the path of the public directory
function public_path(){ 
    $path = base_path() . '/public'; 
    if( defined('PUBLIC_PATH') ){ $path = PUBLIC_PATH; }
    return $path;
}

//Defines the URL of the public directory
function public_url( $file = '' ){
    $url = base_url();
    $url = $url . '/public';
    if( defined('PUBLIC_URL') ){ $url = PUBLIC_URL; }
    if( $file ){ $url = $url . '/' . $file; }
    return $url;
}

//Defines the path of the controllers directory
function controller_path(){
    $path = base_path() . '/pattern/controllers';
    if( defined('CONTROLLER_PATH') ){ $path = CONTROLLER_PATH; }
    return $path;
}

//Defines the path of the models directory
function model_path(){
    $path = base_path() . '/pattern/requests';
    if( defined('MODEL_PATH') ){ $path = MODEL_PATH; }
    return $path;
}

//Defines the path of the views directory
function view_path(){
    $path = base_path() . '/pattern/views'; 
    if( defined('VIEW_PATH') ){ $path = VIEW_PATH; }
    return $path;
}

//Defines the path of the app directory
function app_path(){
    $path = base_path() . '/app';
    if( defined('APP_PATH') ){ $path = APP_PATH; }
    return $path;
}

//Defines the path of the vendor directory
function vendor_path(){
    $path = base_path() . '/vendor';
    if( defined('VENDOR_PATH') ){ $path = VENDOR_PATH; }
    return $path;
}

//Helper function to inject the HTML into the view
function view( $view, $data = array() ){
    include( view_path() . '/' . $view . '.php' );
}

//Helper function to inject the model into the controller
function model( $model, $data = array() ){ 
    include( model_path() . '/' . $model . '.php' );
}

//Get the current controller that is in use
function controller(){ 
    return Controller::$controller;
}

//Get the current method that is in use
function method(){
    return Controller::$method;
}

//Get the params that was passed to the method
function params(){
    return Controller::$params;
}

//Get the title that was assigned by method to the controller static variable
function get_the_title(){
    return Controller::$title;
}

//Current URL that's displayed in the browser address bar
function current_permalink(){
    $q = site_uri();
    $q = sanitize_path( $q );
    $url = rtrim(base_url(), '/');
    return $url . '/' . $q;
}

//Convert path to links so that it can be used in internal pages
function make_permalink( $path ){
    $path = sanitize_path( $path );
    $url = rtrim(base_url(), '/');
    return $url . '/' . $path;
}