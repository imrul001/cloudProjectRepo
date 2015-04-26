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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/pagination.css"/>
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
<!--                      <li><a href="#tabs-1">Query</a></li>                      -->
                     <li><a href="#tabs-7">Add Employee</a></li>
                     <li><a href="#tabs-8">Summary</a></li>
                     <li><a href="#tabs-9">Search</a></li>
                  </ul>
                 <!-- <div id="tabs-1">
                     <form id="form_report">
                         <input id="salarybytitle_button" type="submit" value="Variation Salary by Title">
                         <input id="totalempbyyear_button" type="submit" value="Total Employee by Year">
                         <input id="totalempbydept_button" type="submit" value="Total Employee by Department"><br>                         
                         <input id="totalempbyyeardept_button" type="submit" value="Total Employee by Year, Department">                        
                         <input id="listmanagerbydept_button" type="submit" value="List Manager by Department">
                         <input id="totalsalaryexpensebydept_button" type="submit" value="Total Salary Expense by Department">  
                     </form>
                     
                     <div id="result_table"></div>
                 </div> -->              
                 <div id="tabs-7">
                   <?php $this->load->view('add_employee_form');?>
                   <div id="emp_result"></div> 
                 </div>
                 <div id="tabs-8">
                 <div id="tableContainer" style="clear:both">
                   <?php $this->load->view("summary_view"); ?>
                  </div>
                  <div>
                  	<div id="demo2"></div>
                  </div>
                 </div>
                 <div id="tabs-9">
                   <?php $this->load->view("search_view");?>
                 </div>
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
            $( "#birth_date" ).datepicker(); 
            $( "#hire_date" ).datepicker();
            $( "#from_date" ).datepicker(); 
            $( "#to_date" ).datepicker();
            
            $("#clearemployee_button").on("click", function () {
                $('#emp_no').val('');
                $('#first_name').val('');
                $('#last_name').val('');
                $('#birth_date').val('');               
                $('#from_date').val('');
                $('#to_date').val('');
                $('#salary').val('');
                $('#gender-0').prop('checked', true);
                $('#gender-1').prop('checked', false);
                $('#dept_no')[0].selectedIndex = 0;
                $('#title')[0].selectedIndex = 0;
                $("#emp_result").html("");
                return false;
            });
            $("#addemployee_button").on("click", function () {
                    var url = "<?php echo base_url(); ?>index.php/report_control/addemployee";
                    var now = new Date();
                    var past = new Date($('#birth_date').val());
                    var nowYear = now.getTime();
                    var pastYear = past.getTime();
                    var age = Math.floor((nowYear - pastYear)/(365.25 * 24 * 60 * 60 * 1000));
                                        
                    if($('#gender-0').val()==="M"){
                        gender="M";
                    }else{
                      gender="F";  
                    } 
                   
                    // if($('#emp_no').val()===""){alert("<Employee No> cannot be empty.");$( '#emp_no' ).focus();}                   
                    // else if($('#first_name').val()===""){alert("<First Name> cannot be empty."); $( '#first_name' ).focus();}
                    // else if($('#last_name').val()===""){alert("<Last Name> cannot be empty.");$( '#last_name' ).focus();}
                    // else if($('#birth_date').val()===""){alert("<Birth Date> cannot be empty.");$( '#birth_date' ).focus();}
                    // else if(age<18){alert("Employee's age must be greater than or equal to 18 years old.");$( '#birth_date' ).focus();}
                    // else if($('#dept_no').val()===""){alert("<Department> cannot be empty.");$( '#dept_no' ).focus();}
                    // else if($('#title').val()===""){alert("<Title> cannot be empty.");$( '#title' ).focus();}
                    // else if($('#from_date').val()===""){alert("<From Date> cannot be empty.");$( '#from_date' ).focus();}
                    // else if($('#to_date').val()===""){alert("<To Date> cannot be empty.");$( '#to_date' ).focus();}
                    // else if($('#from_date').val()<=$('#birth_date').val()){alert("<From Date> must be greater than <Birth Date>.");}                    
                    // else if($('#from_date').val()>=$('#to_date').val()){alert("<From Date> must be less than <To Date>.");}
                    // else if($('#salary').val()===""){alert("<Salary> cannot be empty.");$( '#salary' ).focus();}
                    // else if(!$.isNumeric($('#salary').val())){alert("<Salary> must be numeric.");$( '#salary' ).focus();}
                    // else{
                    if ($('#emp_no').val() != "" && $('#first_name').val() != "" && $('#last_name').val() != "" && $('#salary').val() != ""
                        && $('#from_date').val() != "" && $('#to_date').val() != "" && $('#birth_date').val() != "") {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: "emp_no=" + $('#emp_no').val() + "&first_name=" + $('#first_name').val() +
                                "&last_name=" + $('#last_name').val() + "&gender=" + gender +
                                "&birth_date=" + $('#birth_date').val() +
                                "&dept_no=" + $('#dept_no').val() + "&from_date=" + $('#from_date').val() +
                                "&to_date=" + $('#to_date').val() + "&salary=" + $('#salary').val() +
                                "&title=" + $('#title').val(),
                        success: function (data) {
                            $("#emp_result").html(data);
                        },
                        failure: function () {
                            alert("error");
                        }
                    });
                } else {
                    alert("All Fields are required");
                }
//                    }
                return false;
            });   
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
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.simplePagination.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
			 $("#page").pagination({
               items: 100,
               itemsOnPage: 10,
               cssStyle: 'light-theme'
             });
		})
    </script>
</html>

