<table class="table">
    <tr>
           <th>Department Name</th>                 	
           <th>Total Salary</th>
    </tr>
    <?php
       if(!empty($totalsalaryexpensebydept)){
           foreach ($totalsalaryexpensebydept as $row) {
        echo
           '<tr>
               <td>' . $row->dept_name . '</td>
               <td>' . number_format($row->total) . '</td>                        
           </tr>';
        }
       }
     ?>
</table>   
