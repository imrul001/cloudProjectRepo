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
        $m = new MongoClient();
        $db = $m->TestMongoDB;
        $collection = $db->users;
        $queryParam = array('username' => $username, 'password' => $password);
        $user = $collection->find($queryParam);
        if($user != null){
            return $user;
        }else{
            return false;
        }   
    }
}

