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
   function login($username, $password)
    {
        $this -> db -> select('userid, username, password');
        $this -> db -> from('users');
        $this -> db -> where('username', $username);
        $this -> db -> where('password', $password);
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
        {
          return $query->result();
        }
        else
        {
          return false;
        }
    }
}

