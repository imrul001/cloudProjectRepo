<table class="table">
    <tr>
           <th>Year</th>                 	
           <th>Total Hired Employees</th>                               
    </tr>
    <?php
       if(!empty($totalempbyyear)){
           foreach ($totalempbyyear as $row) {
        echo
           '<tr>
               <td>' . $row->year . '</td>
               <td>' . number_format($row->total) . '</td>                                 
           </tr>';
        }
       }
     ?>
</table>