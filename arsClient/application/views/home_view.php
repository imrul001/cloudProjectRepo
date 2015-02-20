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
                <img src="<?php echo base_url(); ?>/images/ajax-loader.gif" alt="Loading" height="60" />
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
                     <li><a href="#tabs-1">Search</a></li>
                     <li><a href="#tabs-2">Add Employee</a></li>
                     <li><a href="#tabs-3">Summery</a></li>
                     <li><a href="#tabs-4">Superadmin</a></li>
                  </ul>
                 <div id="tabs-1" style="padding-bottom: 165px; padding-top: 30px;"></div>
                 <div id="tabs-2"></div>
                 <div id="tabs-3">
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
                    if(!empty($employeeObject))
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
                  ?>
                 </table>
                 </div>
                 <div id="tabs-4"></div>
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
            // $("#logoutButton").on("click", function () {
                
            //     window.location.href = "<?php echo base_url() ?>index.php/home/logout";
            // });		
            $(document).ajaxStart(function () {
                $(".myLoadingImage").show();
            });
            $(document).ajaxStop(function () {
                $(".myLoadingImage").hide();
            });
			
        });
    </script>
</html>

