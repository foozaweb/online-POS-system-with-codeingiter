<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>dist/images/logo.jpg" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->


    <!-- START: Page CSS-->
    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/social-button/bootstrap-social.css">
    <!-- END: Page CSS-->
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/main.css">
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default   ">

    <!-- START: Pre Loader-->
    <!-- <div class="se-pre-con">
        <div class="loader"></div>
    </div> -->
    <!-- END: Pre Loader-->

    <!-- START: Main Content-->

    <div class="container">
        <div class="row vh-100 justify-content-between align-items-center">
            <div class="col-12">


                <form method="post" name="cp_form" action="<?php echo base_url() ?>auth/recover_password" class="row row-eq-height lockscreen  mt-5 mb-5">
                    <div class="lock-image col-12 col-sm-5"> </div>
                    <div class="login-form col-12 col-sm-7">
                        <div class="form-group">
                            <div id="messanger"> </div>
                            <?php if ($this->session->flashdata('login_failed')) { ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('login_failed'); ?></div>
                            <?php } ?>
                        </div>

                        <div class="form-group"> 
                            <label class="control-label sr-only" for="email"></label>
                            <input id="email" type="text" name="email" placeholder="Enter Email Address" class="form-control" required>
                        </div>

                        <button type="button" class="btn_otp btn btn-default btn-lg  btn-block mt20">Get OTP</button>

                        <div class="form-group no-display" id="lbl_otp">
                            <label class="control-label sr-only" for="otp"></label>
                            <input id="otp" type="text" name="otp" placeholder="OTP" class="form-control" required>
                        </div>

                        <div class="form-group no-display" id="lbl_password">
                            <label class="control-label sr-only" for="password"></label>
                            <input id="password" type="password" name="password" placeholder="New Password" class="form-control" required>
                        </div>

                        <button type="submit" name="singlebutton" class="btn btn-default btn-lg btn-block mt20 no-display">Recover Password</button>


                        <div class="d-flex justify-content-between nam-btm mt-3">
                            <a href="javascript:void(0);" class="btn_otp2 no-display">Resend OTP</a>
                            <div>
                                <a href="<?php echo base_url() ?>auth/statics"> or Login Here</a>
                            </div>
                        </div>
                    </div>
                </form>







            </div>

        </div>
    </div>

    <!-- END: Content-->

    <script>
        var base_url = "http://localhost/chbadmin/";
        var CurrentWebPage = "<?php echo $CurrentWebPage; ?>";
    </script>
    <!-- START: Template JS-->
    <script src="<?php echo base_url() ?>dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url() ?>dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- END: Template JS-->


    <!-- START: Page JS-->
    <!-- END: Page JS-->

    <!-- START: APP JS-->
    <script src="<?php echo base_url() ?>dist/js/app.js"></script>
    <!-- END: APP JS-->











    <script>
        $('.btn_otp, .btn_otp2').on('click', function() {
            $('#messanger').html('');
            var email = $('[name="email"]').val();
            if (email) {
                $('.btn_otp').html('Please Wait');
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('auth/otp') ?>",
                    dataType: "JSON",
                    data: {
                        email: email
                    },
                    success: function(data) {
                        if (data != "email_not_found") {
                            $('#lbl_otp').fadeIn('slow');
                            $('.btn_otp').fadeOut('slow');
                            setCookie("otp", data, 1);
                            $('#messanger').html('<span class="text-success">A one time password has been sent to your email address. OTP will expire in 24 hours</span>');
                            $('.btn_otp2').fadeIn('slow');
                        }
                        if (data == "email_not_found") {
                            $('#lbl_otp').fadeOut('slow');
                            $('#messanger').html('<span class="text-danger">Email not Found</span>');
                            $('.btn_otp').html('get OTP');
                        }
                        // else {
                        //     $('#lbl_otp').fadeOut('slow');
                        //     $('#messanger').html('There was an unknown error with your last command. Please try again');
                        //     $('#btn_otp').html('get OTP');
                        // }
                    },
                    error: function(data) {
                        $('#messanger').html('<span class="text-danger">There was an unknown error with your last command. Please try again</span>');
                    }
                });
            } else {
                $('#messanger').html('<span class="text-danger">Please enter your email address</span>');
            }
        });

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
            }
            return "";
        }

        $('#otp').on('keyup', function() {
            var otp = getCookie("otp");
            var user_otp = $('#otp').val();
            if (otp === user_otp) {
                $('#lbl_password').fadeIn('slow');
                $('[name="singlebutton"]').fadeIn('slow');
                $('#messanger').html('');
            } else {
                $('#lbl_password').fadeOut('slow');
                $('[name="singlebutton"]').fadeOut('slow');
                $('#messanger').html('<span class="text-danger">Incorrect One Time Password</span>');
            }
        });

        $(function() {
            if (getCookie('otp')) {
                $('.btn_otp2').fadeIn('slow');
                $('#lbl_otp').fadeIn('slow');
                $('.btn_otp').fadeOut('slow');
                $('#messanger').html('<span class="text-success">A one time password has been sent to your email address. OTP will expire in 24 hours</span>');
                $('.btnResendOtp').fadeIn();
            }
        });




        $('[name="cp_form"]').on('submit', function() {
            deleteCookie('otp');
        });




        function deleteCookie(name) {
            document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/chbadmin/auth;";
        }
    </script>
</body>

</html>