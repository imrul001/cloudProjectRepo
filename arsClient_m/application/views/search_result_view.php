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
    if(count($empSearchObject)==2){
    foreach ($empSearchObject as $row) {
        echo
            '<tr>
                <td>' . $row['emp_no'] . '</td>
                <td>' . $row['first_name'] . '</td>
                <td>' . $row['last_name'] . '</td>
                <td>' . $row['gender'] . '</td>
                <td>' . $row['dept_name'] . '</td>
                <td>' . $row['title'] . '</td>
            </tr>';
        break;
        }
    }
?>
</table>
</div>