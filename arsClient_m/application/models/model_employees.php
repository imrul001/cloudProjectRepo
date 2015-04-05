<?php

/** File Name:employees.php
 *  Created on: 20th February 2015
 *  Author: Hasan 
 *  Purpose: Its a test query.
 **/

class Model_employees extends CI_Model{


    function getEmployees(){
        $m = new MongoClient();
        $db = $m->TestMongoDB;
        $collection = $db->employees;
        $empList = $collection->find()->limit(30);
        return $empList;
    }

    // function salarybytitle_m(){
    //     $m = new MongoClient();
    //     $db = $m->TestMongoDB;
    //     $scope = array("greeter" => "Fred");
    //     $func = "function getSalaryByTitle(){
    //       var db = connect('TestMongoDB');
    //       var titles = db.titles.find({},{emp_no:1, title:1}).limit(30);
    //       var titles_detail = titles.next();
    //       var salaries = db.salaries.find({emp_no:{ $in: titles_detail } }).limit(30);
    //       return titles_detail;}";
    //     $code = new MongoCode($func, $scope);
    //     $response = $db->execute($code,array("Goodbye", "Joe"));
    //     return $response;
    // }
	function salarybytitle(){
         
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
}
?>

