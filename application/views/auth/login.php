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
    <!--<div class="se-pre-con">-->
    <!--    <div class="loader"></div>-->
    <!--</div>-->
    <!-- END: Pre Loader-->

    <!-- START: Main Content-->

    <div class="container">
        <div class="row vh-100 justify-content-between align-items-center">
            <div class="col-12">
                <form method="POST" action="<?php echo base_url() ?>auth/access" class="row row-eq-height lockscreen  mt-5 mb-5">
                    <div class="lock-image col-12 col-sm-5"></div>
                    <div class="login-form col-12 col-sm-7">

                        <?php if ($this->session->flashdata('alert_success')) :
                            echo '<p class="alert alert-success" style="text-align:center;"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_success') . '</p>'; ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('alert_danger')) :
                            echo '<p class="alert alert-danger" style="text-align:center;"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_danger') . '</p>'; ?>
                        <?php endif; ?>

                        <div class="form-group mb-3">
                            <label for="email">Email address</label>
                            <input class="form-control" type="email" name="loginId" id="email" required="" placeholder="Enter your email or phone">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password">
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked="">
                                <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                        </div> 
                        <div class="mt-3">Can't remember your password? <a href="<?php echo base_url() ?>auth/passwordAuth">Recover it here...</a></div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- END: Content-->

    <script>
        var base_url = "<?php echo base_url()?>";
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



</body>

</html>