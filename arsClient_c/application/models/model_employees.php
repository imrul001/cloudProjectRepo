<?php

/** File Name:employees.php
 *  Created on: 20th February 2015
 *  Author: Hasan 
 *  Purpose: Its a test query.
 **/

class Model_employees extends CI_Model{
    function addemployee($emp_no,$first_name,$last_name,$gender,$birth_date,$dept_no,$from_date,$to_date,$salary,$title){   
        $str = str_replace("-", " ", $title);
        $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/HRService?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $params = array (
            "emp_no" => $emp_no,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "birth_date" => date('Y-m-d', strtotime($birth_date)),
            "gender" => $gender,
            "from_date" => date('Y-m-d', strtotime($from_date)),
            "to_date" => date('Y-m-d', strtotime($to_date)),
            "title" => $str,
            "dept_no" => $dept_no,
            "salary" => $salary
         );
        $check = $AuthorService->__soapCall('addNewEmployee', $params);
        if($check){
          return "1";
        }else{
          return "0";
        }
    }

    function editEmployee($emp_no,$first_name,$last_name,$gender,$birth_date,$dept_no,$from_date,$to_date,$salary,$title){   
        $sql= "SELECT * FROM employees WHERE emp_no=".$emp_no; $q=$this->db->query($sql);
        if ($q->num_rows() < 1) {return "1";}        
        else{
            $sql1 = "UPDATE employees SET first_name = ?, last_name = ?, gender = ?, birth_date = ?, hire_date = ? WHERE emp_no = ?";
            $sql2 = "UPDATE dept_emp SET dept_no = ?, from_date = ?, to_date = ? WHERE emp_no = ?";
            $sql3 = "UPDATE salaries SET salary = ?, from_date = ?, to_date = ? WHERE emp_no = ?";
            $sql4 = "UPDATE titles SET title = ?, from_date = ?, to_date = ? WHERE emp_no = ?";
            $this->db->query($sql1, array($first_name, $last_name, $gender, $birth_date, $from_date, $emp_no));
            $this->db->query($sql2, array($dept_no, $from_date, $to_date, $emp_no));
            $this->db->query($sql3, array($salary, $from_date, $to_date, $emp_no));
            $this->db->query($sql4, array($title, $from_date, $to_date, $emp_no));
            return "0";
        }
    }

    function deleteEmployee($emp_no){
    	  $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/HRService?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $params = array (
            "emp_no" => $emp_no
         );
        $check = $AuthorService->__soapCall('deleteEmployee', array($params));
        return $check;
    }



    function getEmployees(){
       	$this->db->select('*');
        $this->db->from('employees');
        $this->db->limit(30);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

	}

    function getDepartments(){
        $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/Utility?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $deptList = $AuthorService->getDepartments();        
        return $deptList; 
    }

    function getPositions(){
        $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/Utility?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $titleList = $AuthorService->getTitles();        
        return $titleList;
    }

	  function salarybytitle(){
         $sql=" SELECT titles.title, salaries.salary As salary ".
             " FROM salaries, titles".
             " WHERE salaries.emp_no=titles.emp_no".             
             " LIMIT 30";

            
        $q1=$this->db->query($sql);        
        return $q1->result(); 
        
    }
    function totalempbydept(){
         
        $sql=" SELECT  DISTINCT departments.dept_name, COUNT(departments.dept_name) as total".
             " FROM `dept_emp`, `departments`". 
             " WHERE departments.dept_no=dept_emp.dept_no". 
             " GROUP BY departments.dept_name";
            
        $q1=$this->db->query($sql);        
        return $q1->result();         
    }
    function totalsalaryexpensebydept()
    {
         
        $sql=" SELECT  DISTINCT departments.dept_name, SUM(salaries.salary) as total".
             " FROM departments,dept_emp, salaries".
             " WHERE salaries.emp_no=dept_emp.emp_no and dept_emp.dept_no=departments.dept_no".
             " GROUP BY departments.dept_name";
            
        $q1=$this->db->query($sql);        
        return $q1->result();         
    }
    function listmanagerbydept()
    {
         
        $sql=" SELECT departments.dept_name,employees.first_name,employees.last_name, dept_manager.from_date, dept_manager.to_date".
             " FROM dept_manager, employees, departments".
             " WHERE departments.dept_no=dept_manager.dept_no AND dept_manager.emp_no=employees.emp_no".
             " ORDER BY departments.dept_name, dept_manager.from_date";
            
        $q1=$this->db->query($sql);        
        return $q1->result();         
    }
    function totalempbyyear()
    {
         
        $sql=" SELECT YEAR(hire_date) AS year,COUNT(emp_no) AS total".
             " FROM employees".
             " GROUP BY YEAR(hire_date)";
            
        $q1=$this->db->query($sql);        
        return $q1->result();         
    }
    function totalempbyyeardept()
    {
         
        $sql=" SELECT YEAR(hire_date) AS year, Departments.dept_name, COUNT(employees.emp_no) AS total".
             " FROM employees, departments, dept_emp ".
             " WHERE employees.emp_no=dept_emp.emp_no AND dept_emp.dept_no=departments.dept_no". 
             " Group BY YEAR(employees.hire_date), departments.dept_name";
            
        $q1=$this->db->query($sql);        
        return $q1->result();         
    }


    // Search Queries

    function getEmployeeById($id, $limit){
        $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/Search?wsdl";
        // $wsdl_url="http://imrul-u30jc:8080/ServiceApp/Search?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $params = array (
            "arg0" => $id,
            "arg1" => $limit
         );
        $employeesList = $AuthorService->__soapCall('getEmployeeByID', array($params));
        return $employeesList;         
    }

    function getEmployeesByDepartment($dept_no, $limit){
        $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/Search?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $params = array (
            "arg0" => $dept_no, 
            "arg1" => $limit
         );
        $employeesList = $AuthorService->__soapCall('getEmployeesByDepartment', array($params));
        return $employeesList;
    }

    function getEmployeesByGender($gender, $limit){
        $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/Search?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $params = array (
            "arg0" => $gender, 
            "arg1" => $limit
         );
        $employeesList = $AuthorService->__soapCall('getEmployeesByGender', array($params));
        return $employeesList;         

    }

    function getEmployeeByTitle($title, $limit){
        $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/Search?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $params = array (
            "arg0" => $title, 
            "arg1" => $limit
         );
        $employeesList = $AuthorService->__soapCall('getEmployeesByTitle', array($params));
        return $employeesList;        

    }
    function getEmployeeByFn($pattern, $limit){
        $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/Search?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $params = array (
            "arg0" => $pattern, 
            "arg1" => $limit
         );
        $employeesList = $AuthorService->__soapCall('getEmployeesByFirstName', array($params));
        return $employeesList;         
    }

    function getEmployeeByLn($pattern, $limit){
        $wsdl_url = "http://imrul.cloudapp.net:8080/ServiceApp/Search?wsdl";
        $AuthorService = new SoapClient($wsdl_url);
        $params = array (
            "arg0" => $pattern, 
            "arg1" => $limit
         );
        $employeesList = $AuthorService->__soapCall('getEmployeesByLastName', array($params));
        return $employeesList;
    }

}
?>

