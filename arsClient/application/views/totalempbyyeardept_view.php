<table class="table">
    <tr>
           <th>Year</th>
           <th>Department Name</th>  
           <th>Total Hired Employees</th>                               
    </tr>
    <?php
       if(!empty($totalempbyyeardept)){
           foreach ($totalempbyyeardept as $row) {
        echo
           '<tr>
               <td>' . $row->year . '</td>
               <td>' . $row->dept_name . '</td> 
               <td>' . number_format($row->total) . '</td>                                 
           </tr>';
        }
       }
     ?>
</table>