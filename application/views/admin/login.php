<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Gulshan-e-Sultan | Login</title>

        <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/admin/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/custom.css" rel="stylesheet">


        
    </head>

    <body class="gray-bg login-body" style="background-image: url('<?php echo base_url(); ?>assets/admin/img/login/background.jpg'); background-position: center; background-repeat: no-repeat;">

        <div class="loginColumns animated fadeInDown">
            <div class="row login-box">

                <div class="col-md-6 login-box-des">
                    <h2 class="font-bold">Welcome to Gulshan-e-Sultan</h2>

                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.
                    </p>

                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </p>

                    <p>
                        <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                    </p>

                </div>
                <div class="col-md-6">
                    <div class="ibox-content login-box2">
                        <div class="hide alert alert-danger alert-dismissable" id="error_msg">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <b>Alert! </b><span></span>
                        </div>
                        <form class="m-t" role="form" action="index.html">
                            <div class="form-group" id="email_group">
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" required="">
                            </div>
                            <div class="form-group" id="password_group">
                                <input type="password" id="password" class="form-control" placeholder="Enter Password" required="">
                                <span class="text-danger hide">Password is required</span>
                            </div>


                            <button type="submit" id="login_button" class="btn btn-primary block full-width m-b" onclick="return validate();">Login</button>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#">
                                        <small>Forgot password?</small>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <img id="loader" align="center" class="hide pull-right" src="<?php echo base_url() . LOADER; ?>">
                                </div>

                            </div>


                        </form>
                        <p class="m-t">
                            <small>Gulshan-e-Sultan Housing Scheme  &copy; <?php echo (date('Y') - 1) . '-' . date('Y'); ?></small>
                        </p>
                    </div>
                </div>

            </div>
            <hr/>

        </div>
        <script type="text/javascript">
            function validate() {
                var email = $('#email').val();
                var password = $('#password').val();
                if (email == "") {
                    $("#email_group").addClass("has-error");
                    $("#error_msg span").text('Email is required');
                    $("#error_msg").fadeIn(2000);
                    return false;
                } else if (password == "") {
                    $("#password_group").addClass("has-error");
                    $("#error_msg span").text('Password is required');
                    $("#error_msg").fadeIn(2000);
                    return false;
                } else {
                    $("#loader").show();
                    $("#login_button").attr('disabled', 'disabled');

                    $.post("<?php echo base_url(); ?>admin/login/auth", {email: email, password: password})
                            .done(function (data) {
                                if (data == 'authrized') {
                                    window.location.replace("<?php echo base_url(); ?>admin/dashboard");
                                } else {
                                    $("#email_group").addClass("has-error");
                                    $("#password_group").addClass("has-error");
                                    $("#error_msg span").text('Email or Password is invalid!');
                                    $("#error_msg").fadeIn(2000);
                                    $("#login_button").attr('disabled', false);
                                    $("#loader").hide();
                                    return false;
                                }
                            });

                }

            }

        </script>

        
        <!-- Mainly scripts -->
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery-3.1.1.min.js"></script>
    </body>

</html>
