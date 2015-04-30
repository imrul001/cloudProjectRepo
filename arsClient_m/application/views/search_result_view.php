<div id="tableContainer">
<table class="table table-striped table-hover table-bordered table-condensed">
 <tr>
    <th>Employee No.</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Gender</th>
    <th>Department</th>
    <th>Title</th>
<!--     <th>Salary</th> -->
</tr>
<?php
    if($empSearchObject!=NULL){
    foreach ($empSearchObject as $row) {
        $dept = $row['dept_emp'];
        $title = $row['titles'];
        $deptLen = sizeof($dept);
        $titlelen = sizeof($title);
                
        echo
            '<tr>
                <td>' . $row['emp_no'] . '</td>
                <td>' . $row['first_name'] . '</td>
                <td>' . $row['last_name'] . '</td>
                <td>' . $row['gender'] . '</td>
                <td>' . $dept[$deptLen - 1]['dept_name'] . '</td>
                <td>' . $title[$titlelen -1]['title'] . '</td>
            </tr>';
        }
    }
?>
</table>
</div>