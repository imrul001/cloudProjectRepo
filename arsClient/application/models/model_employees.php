<?php

/** File Name:employees.php
 *  Created on: 20th February 2015
 *  Author: Hasan 
 *  Purpose: Its a test query.
 **/

class Model_employees extends CI_Model{
    function addemployee($emp_no,$first_name,$last_name,$gender,$birth_date,$dept_no,$from_date,$to_date,$salary,$title)
    {   
        $sql= "SELECT * FROM employees WHERE emp_no=".$emp_no; $q=$this->db->query($sql);
        if ($q->num_rows() > 0) {return "0";}        
        else{
            $str = str_replace("-", " ", $title);
            $data = array(  'emp_no' => $emp_no ,'first_name' => $first_name ,'last_name' => $last_name,
                            'gender'=>$gender, 'birth_date'=>date('Y-m-d', strtotime($birth_date)),
                            'hire_date'=>date('Y-m-d', strtotime($from_date)),
                    );        
            $data_dept = array('emp_no' => $emp_no ,'dept_no' => $dept_no ,'from_date'=>date('Y-m-d', strtotime($from_date)),
                            'to_date'=>date('Y-m-d', strtotime($to_date)),
                    );     
            $data_title = array('emp_no' => $emp_no ,'title' => $str ,'from_date'=>date('Y-m-d', strtotime($from_date)),
                            'to_date'=>date('Y-m-d', strtotime($to_date)),
                    );
            $data_salary = array('emp_no' => $emp_no ,'salary' => $salary ,'from_date'=>date('Y-m-d', strtotime($from_date)),
                            'to_date'=>date('Y-m-d', strtotime($to_date)),
                    );
            $this->db->insert('employees', $data); $this->db->insert('dept_emp', $data_dept);
            $this->db->insert('salaries', $data_salary); $this->db->insert('titles', $data_title);
            return "1";
        }
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

        $sql=" SELECT * FROM departments ";
        $q1=$this->db->query($sql);        
        return $q1->result(); 
    }

    function getPositions(){
        $sql= "SELECT DISTINCT title FROM titles";
        $q1=$this->db->query($sql);
        return $q1->result();
    }

	function salarybytitle()
    {
         
        $sql=" SELECT titles.title, salaries.salary As salary ".
             " FROM salaries, titles".
             " WHERE salaries.emp_no=titles.emp_no".             
             " LIMIT 30";

            
        $q1=$this->db->query($sql);        
        return $q1->result(); 
        
    }
    function totalempbydept()
    {
         
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

        $sql =" SELECT employees.emp_no, employees.first_name, employees.last_name,employees.gender,departments.dept_name, titles.title, salaries.salary".
              " FROM employees,dept_emp,departments,titles,salaries".
              " WHERE employees.emp_no=".$id." AND dept_emp.emp_no=".$id." AND departments.dept_no=dept_emp.dept_no AND titles.emp_no=".$id." AND salaries.emp_no=".$id.
              " ORDER BY employees.emp_no ". 
              " LIMIT ".$limit;
        $q1=$this->db->query($sql);        
        return $q1->result();         
    }

    function getEmployeesByDepartment($dept_no, $limit){

        $sql =" SELECT e.emp_no, e.first_name, e.last_name, e.gender, dp.dept_name,t.title". 
              " FROM employees e,dept_emp de, departments dp,titles t".
              " WHERE de.dept_no='".$dept_no."' AND e.emp_no=de.emp_no AND dp.dept_no='".$dept_no."' AND t.emp_no=de.emp_no".            
              "    AND  t.from_date IN (SELECT MAX(tt.from_date) FROM titles tt WHERE tt.emp_no=e.emp_no)".
	      " ORDER BY e.emp_no".  
              " LIMIT ".$limit;
        
        $q1=$this->db->query($sql);        
        return $q1->result();         
    }

    function getEmployeesByGender($gender, $limit){
        $sql =" SELECT e.emp_no, e.first_name, e.last_name, e.gender, dp.dept_name,t.title".
              " FROM employees e,dept_emp de,departments dp,titles t".
              " WHERE e.gender='".$gender."' AND e.emp_no=de.emp_no AND dp.dept_no=de.dept_no AND t.emp_no=de.emp_no".
              "    AND  t.from_date IN (SELECT MAX(tt.from_date) FROM titles tt WHERE tt.emp_no=e.emp_no)".
              " ORDER BY e.emp_no". 
              " LIMIT ".$limit;
        $q1=$this->db->query($sql);        
        return $q1->result();         

    }

    function getEmployeeByTitle($title, $limit){
        $sql = " SELECT e.emp_no, e.first_name, e.last_name, e.gender, dp.dept_name,t.title".
               " FROM employees e,dept_emp de,departments dp,titles t".
               " WHERE t.title='".$title."' AND e.emp_no=t.emp_no AND dp.dept_no=de.dept_no AND t.emp_no=de.emp_no".
               "    AND  de.from_date IN (SELECT MAX(dd.from_date) FROM dept_emp dd WHERE dd.emp_no=e.emp_no)".
               " ORDER BY e.emp_no".  
               " LIMIT ".$limit;
        $q1=$this->db->query($sql);        
        return $q1->result();         

    }
    function getEmployeeByFn($pattern, $limit){
        $sql = " SELECT e.emp_no, e.first_name, e.last_name, e.gender, dp.dept_name,t.title".
               " FROM employees e,dept_emp de,departments dp,titles t".
               " WHERE e.first_name LIKE '%$pattern%' AND e.emp_no=t.emp_no AND dp.dept_no=de.dept_no AND t.emp_no=de.emp_no".
              "    AND  t.from_date IN (SELECT MAX(tt.from_date) FROM titles tt WHERE tt.emp_no=e.emp_no)".
               " ORDER BY e.emp_no".
               " LIMIT ".$limit;
        $q1=$this->db->query($sql);        
        return $q1->result();         
    }

    function getEmployeeByLn($pattern, $limit){
       $sql = " SELECT e.emp_no, e.first_name, e.last_name, e.gender, dp.dept_name,t.title".                   
              " FROM employees e,dept_emp de,departments dp,titles t".
              " WHERE e.last_name LIKE '%$pattern%' AND e.emp_no=t.emp_no AND dp.dept_no=de.dept_no AND t.emp_no=de.emp_no".
              "    AND  t.from_date IN (SELECT MAX(tt.from_date) FROM titles tt WHERE tt.emp_no=e.emp_no)".
              " ORDER BY e.emp_no".
              " LIMIT ".$limit;
        $q1=$this->db->query($sql);        
        return $q1->result();         
    }

}

// $sql ="SELECT DISTINCT employees.emp_no, employees.first_name, employees.last_name,employees.gender, departments.dept_name, titles.title ".
//               "FROM employees,departments,titles".
//               "WHERE employees.emp_no IN (SELECT emp_no FROM dept_emp WHERE dept_no=".$dept_no.") AND departments.dept_no=".$dept_no." AND titles.emp_no=employees.emp_no ".
//               "LIMIT ".$limit;
?>

