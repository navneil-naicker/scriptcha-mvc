<?php

class Auth{
    //Create user in the database table with the $params
    static function create( $table, $params ){
        global $db;
        return $db->insert($table, $params);
    }
    
    //Hash the supplied password
    static function password( $password ){
        return password_hash( $password, PASSWORD_DEFAULT);
    }

    //Check if email address exists in the table
    static function email_exists( $table, $params ){
        global $db;
        if( count($params) ){
            foreach( $params as $k => $v ){
                $db->where($k, $v);
            }
        }
        return $db->getOne( $table );
    }

    //Get the details of the specified user
    static function read( $table, $params ){
        global $db;
        if( count($params) ){
            foreach( $params as $k => $v ){
                $db->where($k, $v);
            }
        }
        return $db->getOne( $table );
    }

    //Match the plain text and hash password
    static function verify_password( $plain, $hash ){
        return password_verify($plain, $hash);
    }

    //Save the user data in the session
    static function set_session( $params ){
        if( !headers_sent()){
            if( session_status() == PHP_SESSION_NONE ){
                session_start();
                $_SESSION['session_user'] = $params;
            } else {
                $_SESSION['session_user'] = $params;
            }
        }
    }

    //Get the user data from session
    static function get_session(){
        if( isset($_SESSION['session_user']) ){
            return $_SESSION['session_user'];
        }
    }

    //Check if the user is logged in
    static function logged_in(){
        if( count(self::get_session()) == 1 ){
            return true;
        }
    }

    //Check if the user has logged out
    static function logout(){
        if( count(self::get_session()) == 1 ){
            $_SESSION['session_user'] = array();
            return self::logged_in();
        }
    }

}