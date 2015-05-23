<div id="tableContainer">
<table class="table table-striped table-hover table-bordered table-condensed">
 <tr>
    <th>Employee No.</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Gender</th>
    <th>Department</th>
    <th>Title</th>
    <th>Options</th>
<!--     <th>Salary</th> -->
</tr>
<?php
    // var_dump($empSearchObject);
        if(!empty($empSearchObject->EmployeeSearhInfo)){
        // echo sizeof($empSearchObject->EmployeeSearhInfo);
        if(sizeof($empSearchObject->EmployeeSearhInfo)==1){
            foreach ($empSearchObject as $row) {
            echo
                '<tr>
                    <td>' . $row->emp_no . '</td>
                    <td>' . $row->first_name . '</td>
                    <td>' . $row->last_name . '</td>
                    <td>' . $row->gender . '</td>
                    <td>' . $row->dept_name . '</td>
                    <td>' . $row->title . '</td>
                    <td>
                    <input emp_no="'.$row->emp_no.'" class="editButton" type="button" value="Edit"/>
                    <input emp_no="'.$row->emp_no.'" class="deleteButton" type="button" value="Delete"/>
                    </td>
                </tr>';
           }
        }else{
            foreach ($empSearchObject->EmployeeSearhInfo as $row) {
            echo
                '<tr>
                    <td>' . $row->emp_no . '</td>
                    <td>' . $row->first_name . '</td>
                    <td>' . $row->last_name . '</td>
                    <td>' . $row->gender . '</td>
                    <td>' . $row->dept_name . '</td>
                    <td>' . $row->title . '</td>
                    <td>
                    <input emp_no="'.$row->emp_no.'" class="editButton" type="button" value="Edit"/>
                    <input emp_no="'.$row->emp_no.'" class="deleteButton" type="button" value="Delete"/>
                    </td>
                </tr>';
        }
        }
        
    }
?>
</table>
<div id="dialog-confirm" title="Delete Employee?" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
    The Employee Record will be Deleted permanently. Are you sure?
  </p>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".editButton").on("click", function(){
            alert($(this).attr("emp_no"));
        })
        $(".deleteButton").on("click", function(){
                var emp_no = $(this).attr("emp_no");
                $(function() {
                    $( "#dialog-confirm" ).dialog({
                        resizable: false,
                        modal: true,
                        width: 400,
                        buttons: {
                        "Delete": function() {
                            $( this ).dialog( "close" );
                            var url = "<?php echo base_url(); ?>index.php/report_control/deleteEmployee";
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: "emp_no="+emp_no,
                                success: function (data) {
                                    console.log(data);
                                    $("#submitBTn").click();
                                },
                                failure: function () {
                                    alert("error");
                                }
                            });
                        },
                        Cancel: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                });
            });
        })
    })
</script>