<?php

/** File Name:employees.php
 *  Created on: 20th February 2015
 *  Author: Hasan 
 *  Purpose: Its a test query.
 * */
class Model_employees extends CI_Model {

    function addemployee($emp_no, $first_name, $last_name, $gender, $birth_date, $dept_no, $from_date, $to_date, $salary, $title) {
        $m = new MongoClient();
        $db = $m->TestMongoDB;
        $c1 = $db->employees;
        $c2 = $db->dept_emp;
        $c3 = $db->titles;
        $c4 = $db->salaries;
        $arrayName = array('emp_no' => (int) $emp_no);
        $response = "0";
        $check = $c1->count($arrayName);

        if ($check == 0) {
            $empArray = array('emp_no' => (int) $emp_no,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'gender' => $gender,
                'birth_date' => date('Y-m-d', strtotime($birth_date)),
                'hire_date' => date('Y-m-d', strtotime($from_date)));

            $deptArray = array('emp_no' => (int)$emp_no,
                'dept_no' => $dept_no,
                'from_date' => date('Y-m-d', strtotime($from_date)),
                'to_date' => date('Y-m-d', strtotime($to_date)));

            $titlesArray = array('emp_no' => (int)$emp_no,
                'title' => $title,
                'from_date' => date('Y-m-d', strtotime($from_date)),
                'to_date' => date('Y-m-d', strtotime($to_date)));

            $salaryArray = array('emp_no' => (int)$emp_no,
                'salary' => (int) $salary,
                'from_date' => date('Y-m-d', strtotime($from_date)),
                'to_date' => date('Y-m-d', strtotime($to_date)));

            $c1->insert($empArray);
            $c2->insert($deptArray);
            $c3->insert($titlesArray);
            $c4->insert($salaryArray);
            $response = "1";
        }
        return $response;
    }

    function getEmployees() {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $empList = $collection->find()->limit(2);
        return $empList;
    }

    function salarybytitle() {

        $sql = " SELECT titles.title, salaries.salary As salary " .
                " FROM salaries, titles" .
                " WHERE salaries.emp_no=titles.emp_no" .
                " LIMIT 30";


        $q1 = $this->db->query($sql);
        return $q1->result();
    }

    function getDepartments() {

        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $deptList = $collection->distinct("dept_emp.dept_name");
        return $deptList;
    }

    function getPositions() {

        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $postList = $collection->distinct("titles.title");
        return $postList;
    }

    function totalempbydept() {

        $sql = " SELECT  DISTINCT departments.dept_name, COUNT(departments.dept_name) as total" .
                " FROM `dept_emp`, `departments`" .
                " WHERE departments.dept_no=dept_emp.dept_no" .
                " GROUP BY departments.dept_name";

        $q1 = $this->db->query($sql);
        return $q1->result();
    }

    function totalsalaryexpensebydept() {

        $sql = " SELECT  DISTINCT departments.dept_name, SUM(salaries.salary) as total" .
                " FROM departments,dept_emp, salaries" .
                " WHERE salaries.emp_no=dept_emp.emp_no and dept_emp.dept_no=departments.dept_no" .
                " GROUP BY departments.dept_name";

        $q1 = $this->db->query($sql);
        return $q1->result();
    }

    function listmanagerbydept() {

        $sql = " SELECT departments.dept_name,employees.first_name,employees.last_name, dept_manager.from_date, dept_manager.to_date" .
                " FROM dept_manager, employees, departments" .
                " WHERE departments.dept_no=dept_manager.dept_no AND dept_manager.emp_no=employees.emp_no" .
                " ORDER BY departments.dept_name, dept_manager.from_date";

        $q1 = $this->db->query($sql);
        return $q1->result();
    }

    function totalempbyyear() {

        $sql = " SELECT YEAR(hire_date) AS year,COUNT(emp_no) AS total" .
                " FROM employees" .
                " GROUP BY YEAR(hire_date)";

        $q1 = $this->db->query($sql);
        return $q1->result();
    }

    function totalempbyyeardept() {

        $sql = " SELECT YEAR(hire_date) AS year, Departments.dept_name, COUNT(employees.emp_no) AS total" .
                " FROM employees, departments, dept_emp " .
                " WHERE employees.emp_no=dept_emp.emp_no AND dept_emp.dept_no=departments.dept_no" .
                " Group BY YEAR(employees.hire_date), departments.dept_name";

        $q1 = $this->db->query($sql);
        return $q1->result();
    }

//    Search Query

    function getEmployeeById($id, $limit) {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $param= array('emp_no' => (int)$id);
        $empInfo = $collection->find($param)->limit($limit);
        return $empInfo ;
    }
    
    function getEmployeesByGender($gender, $limit) {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $param= array('gender' => $gender);
        $empInfo = $collection->find($param)->limit($limit);
        return $empInfo ;
    }
    
    function getEmployeeByTitle($title, $limit) {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $param= array('titles.title' => $title);
        $empInfo = $collection->find($param)->limit($limit);
        return $empInfo ;
    }
    
    function getEmployeesByDepartment($dept, $limit) {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $param= array('dept_emp.dept_name' => $dept);
        $empInfo = $collection->find($param)->limit($limit);
        return $empInfo ;
    }
    

    function getEmployeeByFn($pattern, $limit) {
        $sql = " SELECT employees.emp_no, employees.first_name, employees.last_name, employees.gender, departments.dept_name,titles.title" .
                " FROM employees,dept_emp,departments,titles" .
                " WHERE employees.first_name LIKE '%$pattern%' AND employees.emp_no=titles.emp_no AND departments.dept_no=dept_emp.dept_no AND titles.emp_no=dept_emp.emp_no" .
                " LIMIT " . $limit;
        $q1 = $this->db->query($sql);
        return $q1->result();
    }

}
?>

