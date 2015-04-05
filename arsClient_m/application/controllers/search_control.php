<?php
/**
 * Description of report_control
 *
 * @author g7
 */
class Search_Control extends CI_Controller{
    function __construct()
   {
      parent::__construct();
      $this->load->model('model_employees');
   }
   function getEmployeeById(){

        $id = $this->input->post('methodValue');
        $limit =$this->input->post('rowCount');
        $data['empSearchObject'] = $this->model_employees->getEmployeeById($id, $limit);        
        $this->load->view('search_result_view', $data);
   }

   function getEmployeesByDept(){

        $dept_no = $this->input->post('methodValue');
        $limit =$this->input->post('rowCount');
        $data['empSearchObject'] = $this->model_employees->getEmployeesByDepartment($dept_no, $limit);        
        $this->load->view('search_result_view', $data);
   }
   function getEmployeesByGender(){
        $gender = $this->input->post('methodValue');
        $limit =$this->input->post('rowCount');
        $data['empSearchObject'] = $this->model_employees->getEmployeesByGender($gender, $limit);        
        $this->load->view('search_result_view', $data);
   }

   function getEmployeeByTitle(){
        $title = $this->input->post('methodValue');
        $limit =$this->input->post('rowCount');
        $data['empSearchObject'] = $this->model_employees->getEmployeeByTitle($title, $limit);        
        $this->load->view('search_result_view', $data);
   }

   function getEmployeeByFn(){
        $pattern = $this->input->post('methodValue');
        $limit =$this->input->post('rowCount');
        $data['empSearchObject'] = $this->model_employees->getEmployeeByFn($pattern, $limit);        
        $this->load->view('search_result_view', $data);
   }
   function getEmployeeByLn(){
        $pattern = $this->input->post('methodValue');
        $limit =$this->input->post('rowCount');
        $data['empSearchObject'] = $this->model_employees->getEmployeeByLn($pattern, $limit);        
        $this->load->view('search_result_view', $data);
   }
}
