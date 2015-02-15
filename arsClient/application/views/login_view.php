<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head lang="en">
        <title>Login Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/loginViewStyle.css"/>
    </head>
    <body>
        <div class="container myContainer">
            <div class="row"></div>
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="myH myh1">Employee Management System</h2>
                </div>
            </div>
            <?php echo validation_errors(); ?>
            <?php echo form_open('verifylogin'); ?>
            <div class="row myRow">
                <div class="col-xs-12">
                    <div class="formContainer">
                        <div class="row" style="margin-top: 10%;">
                            <div class="col-xs-12 myContent">
                                <h5 class="myH ">Your Email</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 myContent">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="email"></label>  
                                    <div class="col-md-6">
                                        <input id="emailFieldId" name="email" type="text" placeholder="" class="form-control input-md">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 2%;">
                            <div class="col-xs-12 myContent">
                                <h5 class="myH">Your Password</h4>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 1%;">
                            <div class="col-xs-12 myContent">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="password"></label>  
                                    <div class="col-md-6">
                                        <input id="passwordFieldId" name="password" type="password" placeholder="" class="form-control input-md">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 2%;">
                            <div class="col-xs-12">
                                <div class="buttonContainer">
                                    <button id="singlebutton" name="singlebutton" class="btn btn-inverse myBtn">Login</button>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10%; margin-top: 2%">
                            <div class="col-xs-12 myContent">
                                <p class="forgotPassword"><a href="<?php echo base_url();?>index.php/forgotPassword">Forgot Password?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</body>
</html>
