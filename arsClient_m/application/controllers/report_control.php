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
   function addemployee(){
       
        $emp_no = $this->input->post('emp_no');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $gender = $this->input->post('gender');
        $birth_date = $this->input->post('birth_date');
        
        $dept_no = $this->input->post('dept_no');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');        
        $salary = $this->input->post('salary');
        $title = $this->input->post('title');
  
        $data['emp_result'] = $this->model_employees->addemployee( $emp_no,$first_name,$last_name,$gender,$birth_date,$dept_no, $from_date,$to_date,$salary,$title);
        $this->load->view('addemployee_view', $data);       
    
   }
   
   function editEmployee(){
        $emp_no = $this->input->post('emp_no');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $gender = $this->input->post('gender');
        $birth_date = $this->input->post('birth_date');
        
        $dept_no = $this->input->post('dept_no');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');        
        $salary = $this->input->post('salary');
        $title = $this->input->post('title');
        
        $data['emp_result'] = $this->model_employees->editEmployee( $emp_no,$first_name,$last_name,$gender,$birth_date,$dept_no, $from_date,$to_date,$salary,$title);
        $this->load->view('editemployee_view', $data);

   }
   
   function deleteEmployee(){
        $emp_no = $this->input->post('emp_no');
        $data['emp_result'] = $this->model_employees->deleteEmployee($emp_no);
        $this->load->view('deleteEmployee_view', $data);

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
