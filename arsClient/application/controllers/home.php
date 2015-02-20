<?php
session_start();
/**
 * Description of Home
 *
 * @author g7
 */
class Home extends CI_Controller{
    //put your code here
   function __construct()
   {
      parent::__construct();
   }

   function index()
   {
      if($this->session->userdata('logged_in'))
      {
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('home_view', $data);
      }
      else
      {
        //If no session, redirect to login page
        redirect('login', 'refresh');
      }
   }

   function logout()
   {
      $this->session->unset_userdata('logged_in');
      session_destroy();
      redirect('home', 'refresh');
   }
}
