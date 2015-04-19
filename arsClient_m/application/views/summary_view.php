<div id="tableContainer">
<table class="table table-striped table-hover table-bordered table-condensed">
 <tr>
    <th>Employee No.</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Gender</th>
    <th>Birth Date</th>
    <th>Hire Date</th>
</tr>
<?php
   
    if(!empty($employeeObject)){
    foreach ($employeeObject as $row) {
        echo
            '<tr>
                <td>' . $row["emp_no"] . '</td>
                <td>' . $row["first_name"] . '</td>
                <td>' . $row["last_name"] . '</td>
                <td>' . $row["gender"] . '</td>
                <td>' . date('Y-M-d', $row["birth_date"]->sec) . '</td>
                <td>' . date('Y-M-d',$row["hire_date"]->sec) . '</td>
            </tr>';
        }
   }
?>
</table>
</div>
<div id="paginationHolder" style="width:38%; margin: 0 auto;">
    <div id="page"></div>  
</div>






