<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>dist/images/favicon.ico" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/social-button/bootstrap-social.css">
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/main.css">
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default">

    <!-- START: Pre Loader-->
    <!-- <div class="se-pre-con">
        <div class="loader"></div>
    </div> -->
    <!-- END: Pre Loader-->

    <!-- START: Main Content-->

    <div class="container">
        <div class="row vh-100 justify-content-between align-items-center">
            <div class="col-12">
                <form name="formRegister" action="<?php echo base_url() ?>auth/cA" method="POST" class="row row-eq-height lockscreen  mt-5 mb-5">
                    <div class="lock-image col-12 col-sm-5"></div>
                    <div class="login-form col-12 col-sm-7">
                        <?php if ($this->session->flashdata('alert_danger')) :
                            echo '<p class="alert alert-danger" style="text-align:center;"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_danger') . '</p>'; ?>
                        <?php endif; ?>

                        <div class="form-group mb-3">
                            <input type="text" required class="form-control" placeholder="Full Name" name="name">
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" required name="email" class="form-control" placeholder="E-mail">
                        </div>

                        <div class="form-group mb-3">
                            <input type="tel" required name="phone" class="form-control" placeholder="Phone Number">
                        </div>

                        <div class="form-group mb-3">
                            <input type="password" name="p1" required class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group mb-2">
                            <input type="password" name="password" required class="form-control" placeholder="Confirm Password">
                        </div>

                        <div class="form-group mb-2">
                            <label id="regMsg"></label>
                        </div>

                        <div class="form-group mb-0">
                            <button class="btn btn-primary btn-block regBtn" type="button"> Register </button>
                        </div>
                        <!-- <p class="my-2 text-muted">--- Or register with ---</p>
                        <a class="btn btn-social btn-dropbox text-white mb-2">
                            <i class="icon-social-dropbox align-middle"></i>
                        </a>
                        <a class="btn btn-social btn-facebook text-white mb-2">
                            <i class="icon-social-facebook align-middle"></i>
                        </a>
                        <a class="btn btn-social btn-github text-white mb-2">
                            <i class="icon-social-github align-middle"></i>
                        </a>
                        <a class="btn btn-social btn-google text-white mb-2">
                            <i class="icon-social-google align-middle"></i>
                        </a> -->
                        <div class="mt-2">Already have an account? <a href="<?php echo base_url() ?>auth/statics">Sign In</a></div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- END: Content-->

    <script>
        var base_url = "http://localhost/chbadmin";
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
        var err;
        $(".regBtn").on("click", function(e) {
            e.preventDefault();

            $('.form-control').each(function() {
                if (!$(this).val()) {
                    var obj = $(this).attr('name');
                    $('[name="' + obj + '"]').focus();
                    err = $(this).attr('placeholder') + ' is empty';
                    $('#regMsg').html('<b class="text-danger">Null: ' + err + '</b>');
                    console.log(err);
                    return false;
                } else {
                    err = '';
                }
            });

            if (err === "") {
                submitForm();
            }

        });

        function submitForm() {
            var p1 = $('[name="p1"]').val();
            var p2 = $('[name="password"]').val();

            if (p1 == $('[name="email"]').val() || p2 == $('[name="email"]').val()) {
                $('#regMsg').html('<strong class="text-danger">You can\'t use your email for password</strong>');
                return false;
            }

            if ($('[name="p1"]').val().length < 8 || $('[name="password"]').val().length < 8) {
                $('#regMsg').html('<strong class="text-danger">Password is too short. Must be a minimum of 8 characters</strong>');
                return false;
            }
            if (p1 != p2) {
                $('#regMsg').html('<strong class="text-danger">Error: password mismatch</strong>');
                return false;
            } else {
                $('#regMsg').html('');
                $('[name="formRegister"]').submit();
            }
        }
    </script>

</body>

</html>