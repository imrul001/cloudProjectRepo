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
                     <li><a href="#tabs-1">Salary by Title</a></li>
                     <li><a href="#tabs-2">Total of Employees by Department</a></li>
                     <li><a href="#tabs-3">Total of Salary Expense by Department</a></li>
                     <li><a href="#tabs-4">List of Manager by Department</a></li>
                     <li><a href="#tabs-5">Total Hire Employees by Year</a></li>
                     <li><a href="#tabs-6">Total Hire Employees by Year,Department</a></li>
                     <li><a href="#tabs-7">Add Employee</a></li>
                     <li><a href="#tabs-8">Summary</a></li>
                     <li><a href="#tabs-9">Superadmin</a></li>
                  </ul>
                 <div id="tabs-1">                      
                     <table class="table">
                        <tr>
                               <th>Title</th>                 	
                               <th>Salary</th>
                        </tr>
                        <?php
                           if(!empty($salarybytitle)){
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
                 </div>
                 <div id="tabs-2">
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
                 </div>                    
                 <div id="tabs-3">
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
                 </div>
                 <div id="tabs-4">
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
                 </div>
                 <div id="tabs-5">
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
                 </div>
                 <div id="tabs-6">
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
            //$("#search").on("click", function () {
           
            $(document).ajaxStart(function () {
                $(".myLoadingImage").show();
            });
            $(document).ajaxStop(function () {
                $(".myLoadingImage").hide();
            });
			
        });
    </script>
</html>

