<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VerifyLogin
 *
 * @author g7
 */
class VerifyLogin extends CI_Controller{
    //put your code here
   function __construct()
   {
      parent::__construct();
      $this->load->model('user','',TRUE);
   }

   function index()
   {
      //This method will have the credentials validation
      $this->load->library('form_validation');

      $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

      if($this->form_validation->run() == FALSE)
      {
        //Field validation failed.  User redirected to login page
        $this->load->view('login_view');
      }
      else
      {
        //Go to private area
        redirect('home', 'refresh');
      }

   }

   function check_database($password)
   {
      //Field validation succeeded.  Validate against database
      $username = $this->input->post('username');
      //query to the remote database
      $result = $this->user->login($username, $password);
      if($result)
      {
        $sess_array = array();
        $sess_array = array(
          'password' => $result->password, 
          'username' => $result->username
        );
        $this->session->set_userdata('logged_in', $sess_array);
        return TRUE;
      }
      else
      {
        $this->form_validation->set_message('check_database', 'Invalid username or password');
        return false;
      }
   }
}
