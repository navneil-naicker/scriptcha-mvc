<?php
/*
 * MIT License
 * 
 * Copyright (c) 2017 Navneil Naicker
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * 
 */

class Router{

    public static $get = [];
    public static $post = [];
    public static $pattern = null;
    public static $params = array();
    
    //Get the current URI and clean it up
    public static function uri( $uri = '' ){
        if( empty($uri) ){
            if( !isset($_GET['uri']) ){
                $uri = '/';
            } else {
                $uri = $_GET['uri'];
            }
        }
        $uri = ( !empty(trim( $uri, '/')) )? trim( $uri, '/'):'/';
        return $uri;
    }

    //Make a string into an array using specified delimiter
    public static function make_array( $string,  $delimiter = '/' ){
        $string = explode( $delimiter, $string );
        return $string;
    }

    //Clean and count the array
    public static function count( $subject ){
        $subject = self::make_array( $subject );
        $subject = array_filter( $subject );
        return count( $subject );        
    }

    //Used by the router for the GET request method
    public static function get( $route, $pattern ){
        $route = self::uri( $route );
        $count = self::count( $route );
        self::$get[$count][$route] = $pattern;
    }

    //Used by the router for the POST request method
    public static function post( $route, $pattern ){
        $route = self::uri( $route );
        $count = self::count( $route );
        self::$post[$count][$route] = $pattern;
    }

    //Return the current request method in lowercase   
    public static function request(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    //Proxies the current route and URI to creates params out of it
    public function make_params( $uri, $wildcard ){
        $params = [];
        $wildcard = self::make_array( $wildcard );
        foreach( $wildcard as $wk => $wi ){
            if( $uri[$wk] == $wi ){
                unset( $uri[$wk] );
            } else {
                $wi = str_replace(['{', '}'], '', $wi);
                $params[$wi] = $uri[$wk];    
            }
        }
        self::$params = (object) $params;
    }

    //This is where all the magic happens. Bootup the router and start constructing the pattern and params
    public static function dispatch(){
        $binder = null;
        $request = self::request();
        $route = self::uri();
        $count = self::count( $route );
        $binder = self::$$request;
        if( !empty($binder[$count]) ){
            if( !empty($binder[$count]) ){
                $binder = $binder[$count];
                if( !empty($binder[$route]) ){
                    self::$pattern = $binder[$route];
                } else {
                    if( is_array($binder) ){
                        $uri = self::make_array( $route );
                        $probability = array();
                        $probability_uri = array();
                        foreach( $binder as $key => $item ){
                            $routes = self::make_array( $key );
                            foreach( $routes as $rk => $ri ){
                                if( $uri[$rk] == $ri ){
                                    $probability[$item] = (!empty($probability[$item])?$probability[$item]:0) + 1;
                                    $probability_uri[$item] = $key;
                                }
                            }
                        }
                        arsort( $probability );
                        self::$pattern = !empty(key($probability))?key($probability):null;
                        $key = (!empty($probability_uri[self::$pattern]))?$probability_uri[self::$pattern]:null;
                        self::make_params( $uri, $key );
                    }
                }
            } else {
                $binder = array();
            }
        } else {
            $binder = array();
        }
        return self::$pattern;  
    }

}