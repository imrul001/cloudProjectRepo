<!DOCTYPE html>
<html>
    <head>
        <title>Employee Management System</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery-ui.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/ajaxOverlayStyle.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css"/>
    </head>
    <body>
        <div class="myLoadingImage">
            <div class="myOverlay" style="height: 1519px"></div>
            <div class="imageForLoading">
                <img src="<?php echo base_url(); ?>css/images/ajax-loader.gif" alt="Loading" height="60" />
            </div>
        </div>
        <div id="mainDiv">
            <div id="header">
                <div id="PageTitle">
                    <h1>Employee Management System</h1>
                </div>
            </div>

            <div id="container">
              <div class="logOutButton" style="float: right;">
                <a class="logoutLink" id="logoutButton" href="<?php echo base_url();?>index.php/home/logout">Logout</a>
              </div>
               <h4 class="welcomeMsg">Hello <b><?php echo $username;?></b>!!! You have Successfully Logged In.</h4>
              <div id="userOptionsContainer">
                 <div id="tabs">
                   <ul>
                     <li><a href="#tabs-1">Report</a></li>                     
                     <li><a href="#tabs-7">Add Employee</a></li>
                     <li><a href="#tabs-8">Summary</a></li>
                     <li><a href="#tabs-9">Superadmin</a></li>
                  </ul>
                 <div id="tabs-1">
                     <form id="form_report">
                         <input id="salarybytitle_button" type="submit" value="Variation Salary by Title">
                         <input id="totalempbyyear_button" type="submit" value="Total Employee by Year">
                         <input id="totalempbydept_button" type="submit" value="Total Employee by Department"><br>                         
                         <input id="totalempbyyeardept_button" type="submit" value="Total Employee by Year, Department">                        
                         <input id="listmanagerbydept_button" type="submit" value="List Manager by Department">
                         <input id="totalsalaryexpensebydept_button" type="submit" value="Total Salary Expense by Department">
                         
                     </form>
                     
                     <div id="result_table"></div>
                  
                  
                 </div>              
                 <div id="tabs-7"></div>
                 <div id="tabs-8">
                 <table class="table">
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
                            <td>' . $row->emp_no . '</td>
                            <td>' . $row->first_name . '</td>
                            <td>' . $row->last_name . '</td>
                            <td>' . $row->gender . '</td>
                            <td>' . $row->birth_date . '</td>
                            <td>' . $row->hire_date . '</td>
                        </tr>';
                        }
                     }
                  ?>
                 </table>
                 </div>
                 <div id="tabs-9"></div>
                </div>
              </div>
            </div>
            <div id="Footer">
                  <div class="footerContent">
                    <p>2015 &copy; All Rights Reserved, Footer Content Goes here</p>
                  </div>
            </div>
         </div>       
    </body>
    <script type="text/javascript">
        
        $(document).ready(function () {
        	$("#tabs" ).tabs();
            
            $("#salarybytitle_button").on("click", function () {
                    var url = "<?php echo base_url(); ?>index.php/report_control/salarybytitle";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#form_report").serialize(),
                        success: function (data) {
                            $("#result_table").html(data);
                        },
                        failure: function () {
                            alert("error");
                        }
                    });
                    return false;
            });
            $("#totalempbydept_button").on("click", function () {
                    var url = "<?php echo base_url(); ?>index.php/report_control/totalempbydept";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#form_report").serialize(),
                        success: function (data) {
                            $("#result_table").html(data);
                        },
                        failure: function () {
                            alert("error");
                        }
                    });
                    return false;
            });
            $("#totalempbyyear_button").on("click", function () {
                    var url = "<?php echo base_url(); ?>index.php/report_control/totalempbyyear";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#form_report").serialize(),
                        success: function (data) {
                            $("#result_table").html(data);
                        },
                        failure: function () {
                            alert("error");
                        }
                    });
                    return false;
            });
            $("#totalempbyyeardept_button").on("click", function () {
                    var url = "<?php echo base_url(); ?>index.php/report_control/totalempbyyeardept";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#form_report").serialize(),
                        success: function (data) {
                            $("#result_table").html(data);
                        },
                        failure: function () {
                            alert("error");
                        }
                    });
                    return false;
            });
            $("#listmanagerbydept_button").on("click", function () {
                    var url = "<?php echo base_url(); ?>index.php/report_control/listmanagerbydept";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#form_report").serialize(),
                        success: function (data) {
                            $("#result_table").html(data);
                        },
                        failure: function () {
                            alert("error");
                        }
                    });
                    return false;
            });
            $("#totalsalaryexpensebydept_button").on("click", function () {
                    var url = "<?php echo base_url(); ?>index.php/report_control/totalsalaryexpensebydept";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#form_report").serialize(),
                        success: function (data) {
                            $("#result_table").html(data);
                        },
                        failure: function () {
                            alert("error");
                        }
                    });
                    return false;
            });
            $(document).ajaxStart(function () {
                $(".myLoadingImage").show();
            });
            $(document).ajaxStop(function () {
                $(".myLoadingImage").hide();
            });
			
        });
    </script>
</html>

