<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.11.0.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/simple-sidebar.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/common.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/ajaxOverlayStyle.css"/>
    </head>
    <body>
        <div class="myLoadingImage">
            <div class="myOverlay" style="height: 1519px"></div>
            <div class="imageForLoading">
                <img src="<?php echo base_url(); ?>/images/ajax-loader.gif" alt="Loading" height="60" />
            </div>
        </div>
        <div class="container">
            <div class="totalContent" style="border: 1px solid #ddd;">
                 <?php //$this->load->view("sidebar_view"); ?>
                <div class="container-fluid" style="float: left; width: 77.8811%;">
                    <?php //$this->load->view("topview_info"); ?>
                    <div class="contentBody"  style="min-height: 455px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-md-9"></div>
                                <div class="col-md-2"><h6 class="exportPDF" id="exportpdfButton">Export As PDF</h6></div>
                                <!--<div class="col-md-1"><h6 class="logoutButton" id="logoutButton">Logout</h6></div>-->
                                <div class="col-md-1"><h6><a href="home/logout">Logout</a><h6></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">

                                </div>
                            </div>
                        </div>
                        <div id="homeMainContent">
                            <?php //$this->load->view("homeContent_info"); ?>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="row footerRow">
                        <div class="col-lg-12">
                            <p class="version">Version 1.0</p>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#logoutButton").on("click", function () {
                
                window.location.href = "<?php echo base_url() ?>index.php/home/logout";
            });
            
	    $("#exportpdfButton").on("click", function () {
				window.print();
            });
			
            $(".sidebar-nav li a.GepRep").css({
                'font-weight': 'bold',
                'text-decoration': 'underline'
            });
            $("#dateRange").on("change", function () {
                var date = $(this).val().trim().split("_");
                var postDate = "minDate=" + date[0] + "&maxDate=" + date[1];
                var url = "<?php echo base_url() ?>index.php/home/getContentByDateRang";
                $.ajax({
                    type: "GET",
                    url: url,
                    data: postDate,
                    success: function (data) {
                        $("#homeMainContent").html(data);
                    },
                    failure: function (data) {
                        alert("error");
                    }
                });
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

