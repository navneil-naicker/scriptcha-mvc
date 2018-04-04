<?php

class SystemController extends Controller{
    
    public function error404(){
        Controller::$title = 'Error 404!';
        view('system/error404');
    }

}