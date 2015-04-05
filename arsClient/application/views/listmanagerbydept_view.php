<table class="table">
    <tr>
           <th>Department Name</th>                 	
           <th>First Name</th>
           <th>Last Name</th>
           <th>From Date</th>
           <th>To Date</th>
    </tr>
    <?php
       if(!empty($listmanagerbydept)){
           foreach ($listmanagerbydept as $row) {
        echo
           '<tr>
               <td>' . $row->dept_name . '</td>
               <td>' . $row->first_name . '</td>
               <td>' . $row->last_name . '</td>
               <td>' . $row->from_date . '</td>
               <td>' . $row->to_date . '</td>
           </tr>';
        }
       }
     ?>
</table>        