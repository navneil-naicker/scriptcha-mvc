<?php

class WelcomeController extends Controller{
    
    public function index(){
        Controller::$title = 'Welcome Human!';
        view('welcome');
    }

}