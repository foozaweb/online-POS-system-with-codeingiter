<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <title>screen locked</title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>dist/images/logo.jpg" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/flags-icon/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/main.css">
</head>

<body id="main-container" class="default">

    <!-- START: Pre Loader-->
    <div class="se-pre-con">
        <div class="loader"></div>
    </div>
    <!-- END: Pre Loader-->

    <!-- START: Main Content-->

    <div class="container">
        <div class="row vh-100 justify-content-between align-items-center">
            <div class="col-12">
                <form action="<?php echo base_url() ?>auth/clearScreen" method="post" class="row row-eq-height lockscreen mt-5 mb-5">
                    <div class="lock-image col-12 col-sm-5"></div>
                    <div class="login-form col-12 col-sm-7 text-center">
                        <?php if ($this->session->flashdata('alert_danger')) :
                            echo '<p class="alert alert-danger" style="text-align:center;"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_danger') . '</p>'; ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('alert_success')) :
                            echo '<p class="alert alert-success" style="text-align:center;"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_success') . '</p>'; ?>
                        <?php endif; ?>
                        <img src="<?php echo $staff['photo']; ?>" alt="" class="img-fluid rounded-circle mb-3" width="100">
                        <br><span class="text-danger">You were inactive for a while. Please input your account password to continue</span>
                        <div class="form-group mb-3">
                            <input class="form-control" type="hidden" name="loginId" value="<?php echo $staff['email'] ?>">

                            <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                        </div>
                        <div class="form-group mb-0 text-right">
                            or -<a href="<?php echo base_url() ?>auth/clearSession" class="text-danger text-right">Logout</a>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- END: Content-->

    <script>
        var base_url = "<?php echo base_url() ?>";
    </script>
    <script src="<?php echo base_url() ?>dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url() ?>dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url() ?>dist/js/app.js"></script>


    <?php 
        if (!$this->session->userdata('chbAuth') || $this->session->userdata('chbAuth') == "") {
            redirect(base_url() . 'auth/statics?AuthStatus=failed');
        }
    ?>
</body>

</html>