<?php

/**
 * Here you can register your HTTP routes for Web or API. You can only register GET and POST routes
 * E.g for HTTP GET: Router::get('/get/something', 'MyController@Method');
 * E.g for HTTP Post: Router::post('/post/something', 'AnotherController@AnotherMethod');
 */

Router::get('/', 'WelcomeController@index');
Router::get('/contact', 'WelcomeController@contact');
Router::get('/about', 'WelcomeController@about');
