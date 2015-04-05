
<table class="table">
    <tr>
           <th>Department Name</th>                 	
           <th>Total Employees</th>
    </tr>
    <?php
       if(!empty($totalempbydept)){
           foreach ($totalempbydept as $row) {
        echo
           '<tr>
               <td>' . $row->dept_name . '</td>
               <td>' . number_format($row->total) . '</td>                        
           </tr>';
        }
       }
     ?>
</table>

