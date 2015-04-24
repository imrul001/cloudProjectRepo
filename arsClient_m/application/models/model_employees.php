<?php

/** File Name:employees.php
 *  Created on: 20th February 2015
 *  Author: Hasan 
 *  Purpose: Its a test query.
 * */
class Model_employees extends CI_Model {

    function addemployee($emp_no, $first_name, $last_name, $gender, $birth_date, $dept_name, $from_date, $to_date, $salary, $title) {
        
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $arrayName = array('emp_no' => (int) $emp_no);
        $response = "0";
        $check = $collection->count($arrayName);
        if ($check == 0) {

            $deptArray[0] = array("from_date" => new MongoDate(strtotime($from_date)),
                "to_date" => new MongoDate(strtotime($to_date)),
                "dept_name" => $dept_name);
            $dept_manager = "";
            $salaryArray[0] = array("from_date" => new MongoDate(strtotime($from_date)),
                "to_date" => new MongoDate(strtotime($to_date)),
                "salary" => (int) $salary);
            $titleArray[0] = array("from_date" => new MongoDate(strtotime($from_date)),
                "to_date" => new MongoDate(strtotime($to_date)),
                "title" => $title);
            $empArray = array('emp_no' => (int) $emp_no,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'gender' => $gender,
                'birth_date' => new MongoDate(strtotime($birth_date)),
                'hire_date' => new MongoDate(strtotime($from_date)),
                'dept_emp' => $deptArray,
                'dept_manager' => $dept_manager,
                'salaries' => $salaryArray,
                'titles' => $titleArray
            );
            $collection->insert($empArray);
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

//    Search Query

    function getEmployeeById($id, $limit) {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $param = array('emp_no' => (int) $id);
        $empInfo = $collection->find($param)->limit($limit);
        return $empInfo;
    }

    function getEmployeesByGender($gender, $limit) {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $param = array('gender' => $gender);
        $empInfo = $collection->find($param)->limit($limit);
        return $empInfo;
    }

    function getEmployeeByTitle($title, $limit) {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $param = array('titles.title' => $title);
        $empInfo = $collection->find($param)->limit($limit);
        return $empInfo;
    }

    function getEmployeesByDepartment($dept, $limit) {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $param = array('dept_emp.dept_name' => $dept);
        $empInfo = $collection->find($param)->limit($limit);
        return $empInfo;
    }

    function getEmployeeByFn($pattern, $limit) {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $regex = new MongoRegex("/^" . $pattern . "/i");
        $param = array('first_name' => $regex);
        $empInfo = $collection->find($param)->limit($limit);
        return $empInfo;
    }

    function getEmployeeByLn($pattern, $limit) {
        $m = new MongoClient();
        $db = $m->employees;
        $collection = $db->empCollection;
        $regex = new MongoRegex("/^" . $pattern . "/i");
        $param = array('last_name' => $regex);
        $empInfo = $collection->find($param)->limit($limit);
        return $empInfo;
    }
}
?>

