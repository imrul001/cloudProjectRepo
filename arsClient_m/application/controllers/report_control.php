<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report_control
 *
 * @author g7
 */
class Report_Control extends CI_Controller{
    function __construct()
   {
      parent::__construct();
      $this->load->model('model_employees');
   }
   function salarybytitle(){
        $data['salarybytitle'] = $this->model_employees->salarybytitle();        
        $this->load->view('salarybytitle_view', $data);
   }
   function totalempbyyear(){
        $data['totalempbyyear'] = $this->model_employees->totalempbyyear();        
        $this->load->view('totalempbyyear_view', $data); 
   }
   function totalempbydept(){
        $data['totalempbydept'] = $this->model_employees->totalempbydept();        
        $this->load->view('totalempbydept_view', $data); 
   }
   function totalempbyyeardept(){
        $data['totalempbyyeardept'] = $this->model_employees->totalempbyyeardept();        
        $this->load->view('totalempbyyeardept_view', $data);
   }
   function listmanagerbydept(){
        $data['listmanagerbydept'] = $this->model_employees->listmanagerbydept();        
        $this->load->view('listmanagerbydept_view', $data);   
   }
   function totalsalaryexpensebydept(){
        $data['totalsalaryexpensebydept'] = $this->model_employees->totalsalaryexpensebydept();        
        $this->load->view('totalsalaryexpensebydept_view', $data); 
   }
    //put your code here
}
