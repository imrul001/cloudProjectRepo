<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author g7
 */
class User extends CI_Model {
    //put your code here
   function login($username, $password){

        $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/UserService?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $params = array (
            "UserName" => $username,
            "Password" => $password
        );
        $user = $AuthorService->__soapCall('userLogin', $params);
        //$user is a php StdClass
        if(property_exists($user, "username") && $user->username != null){
            return $user;
        }
        else{
            echo false;
        }
    }
}

