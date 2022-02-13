<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />


<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $this->db->get('chb_settings')->row_array()['logo'] ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/toastr/toastr.min.css">
    <!-- START: Page CSS-->
    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/morris/morris.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/FontAwesome15/css/all.min.css">
    <script src="<?php echo base_url() ?>dist/FontAwesome15/js/all.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- END: Page CSS-->
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/color_picker/jquery.minicolors.css">
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





    <!-- START: Header-->
    <div id="header-fix" class="header fixed-top">
        <div class="site-width">
            <nav class="navbar navbar-expand-lg  p-0">
                <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
                    <a href="#" class="horizontal-logo text-left">
                        <span class="h4 align-self-center mb-0 ml-auto"><b>CHB</b>STORE</span>
                    </a>
                </div>
                <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                    <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                </div>

                <!-- <form class="float-left d-none d-lg-block search-form">
                    <div class="form-group mb-0 position-relative">
                        <input type="text" class="form-control border-0 rounded bg-search pl-5" placeholder="Search anything...">
                        <div class="btn-search position-absolute top-0">
                            <a href="#"><i class="h6 icon-magnifier"></i></a>
                        </div>
                        <a href="#" class="position-absolute close-button mobilesearch d-lg-none" data-toggle="dropdown" aria-expanded="false"><i class="icon-close h5"></i>
                        </a>

                    </div>
                </form> -->
                <div class="navbar-right ml-auto h-100">
                    <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                        <li class="d-inline-block align-self-center  d-block d-lg-none">
                            <a href="#" class="nav-link mobilesearch" data-toggle="dropdown" aria-expanded="false"><i class="icon-magnifier h4"></i>
                            </a>
                        </li>

                        <li class="dropdown align-self-center d-inline-block">
                            <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false"><i class="icon-bell h4"></i>
                                <span class="badge badge-default"> <span class="ring">
                                    </span><span class="ring-point">
                                    </span> </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right border   py-0">
                                <?php
                                $uniqueId = $this->session->userdata('uniqueId');
                                $this->db->join('users', 'users.unique_id = messages.outgoing_msg_id', 'LEFT');
                                $this->db->where('incoming_msg_id', $uniqueId);
                                $this->db->or_where('outgoing_msg_id', $uniqueId);
                                $this->db->order_by('msg_id', 'DESC');
                                $this->db->limit('5');
                                $msgs = $this->db->get('messages')->result_array();

                                foreach ($msgs as $msg) {
                                ?>
                                    <li>
                                        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="javascript:void(0);" onclick="window.open('<?php echo $chat_url ?>', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');">
                                            <div class="media">
                                                <img src="<?php echo $msg['img'] ?>" alt="" class="d-flex mr-3 img-fluid rounded-circle w-50">
                                                <div class="media-body">
                                                    <?php if ($msg['unique_id'] == $admin['uniqueId']) { ?>
                                                        <p class="mb-0 text-success">You:</p>
                                                    <?php } else { ?>
                                                        <p class="mb-0 text-success"><?php echo $msg['fname'] ?>:</p>
                                                    <?php } ?>
                                                    <?php echo $msg['msg'] ?>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>

                                <li>
                                    <a class="dropdown-item text-center py-2" title="Read all Messages" href="javascript:void(0);" onclick="window.open('<?php echo $chat_url ?>', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');">Read All Message <i class="icon-arrow-right pl-2 small"></i></a>
                                </li>

                            </ul>
                        </li>
                        <li class="dropdown user-profile align-self-center d-inline-block">
                            <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                                <div class="media">
                                    <img src="<?php echo $staff['photo'] ?>" alt="" class="d-flex img-fluid rounded-circle" width="29">
                                </div>
                            </a>
                            <div class="dropdown-menu border dropdown-menu-right p-0">
                                <a href="<?php echo base_url() ?>my_profile" class="dropdown-item px-2 align-self-center d-flex"><span class="icon-user mr-2 h6 mb-0"></span> Profile</a>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo base_url() ?>auth/clearSession" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                    <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                            </div>

                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- END: Header-->

    <?php $this->load->view('template/functions'); ?>