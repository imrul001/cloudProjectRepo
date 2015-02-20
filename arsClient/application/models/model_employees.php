<?php

/** File Name:employees.php
 *  Created on: 20th February 2015
 *  Author: Hasan 
 *  Purpose: Its a test query.
 **/

class Model_employees extends CI_Model{

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
}
?>

