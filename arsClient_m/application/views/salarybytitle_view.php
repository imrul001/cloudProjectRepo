<table class="table">
    <tr>
           <th>Title</th>                 	
           <th>Salary</th>
    </tr>
    <?php
       if($salarybytitle!=null){
        foreach ($salarybytitle as $row) {
        echo
           '<tr>
               <td>' . $row->title . '</td>
               <td>' . number_format($row->salary) . '</td>                        
           </tr>';
        }
       }
     ?>
</table>

