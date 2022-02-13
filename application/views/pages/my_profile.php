<?php $this->load->view('template/header'); ?>

<link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/icheck/skins/all.css">
<?php $this->load->view('template/nav'); ?>


<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto">
                        <h4 class="mb-0">My Profile</h4>
                    </div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">My Profile</li>
                        <!-- <li class="breadcrumb-item active"><a href="#">Editable Table</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 col-md-7 mt-3">
                <div class="card">
                    <div class="card-body">

                        <form class="tab-content" method="post" action="<?php echo base_url() . 'auth/updateProfile' ?>">

                            <?php if ($this->session->flashdata('alert_danger')) :
                                echo '<p class="alert alert-danger" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_danger') . '</p>'; ?>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('alert_success')) :
                                echo '<p class="alert alert-success" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_success') . '</p>'; ?>
                            <?php endif; ?>



                            <div class="form-group col-sm-12 mb-5">
                                <div class="input-group ">
                                    <img id="staffPhoto" src="<?php echo $staff['photo'] ?>" class="img-responsive img-thumbnail max_h200" alt="Profile Photo"> 
                                </div>
                                <div class="pt-2 pl-5"> 
                                <?php 
                                    $date = new DateTime($staff['bday']);
                                    $now = new DateTime();
                                    $interval = $now->diff($date); 
                                    echo $interval->y 
                                ?> Years Old
                                </div>
                            </div>


                            <div class="form-group col-sm-12 mt-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="icon-user"></i></span>
                                    </div>
                                    <input readonly name="staffName" type="text" class="form-control form-control-lg float-input inside-label validate" id="username" value="<?php echo $staff['name'] ?>">
                                    <label class="form-control-placeholder inside" for="username">Staff Name</label>
                                </div>
                            </div>


                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-envelope-open"></i></span>
                                    </div>
                                    <input readonly name="staffEmail" type="email" class="form-control form-control-lg float-input inside-label validate" id="email" value="<?php echo $staff['email'] ?>">
                                    <label class="form-control-placeholder inside" for="email">Email Address</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input readonly name="staffPhone" type="tel" class="form-control form-control-lg float-input inside-label validate" id="phone" value="<?php echo $staff['phone'] ?>">
                                    <label class="form-control-placeholder inside" for="phone">Phone Number</label>
                                </div>
                            </div>

                            <div class="form-group  col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input readonly name="staffDob" type="date" class="form-control form-control-lg float-input inside-label validate" id="dob" value="<?php echo $staff['bday'] ?>" onchange="this.setAttribute('value', this.value); $('#staffDobHtml').html($(this).val());">
                                    <label class="form-control-placeholder inside" for="dob">Date of Birth</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <label>Gender</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($staff['sex'] == 'Male') {
                                                                echo 'checked';
                                                            } ?> onclick="$('#staffGenderHtml').html('Male'); $('#staffSex').val('Male');" class="custom-control-input" id="rdoMale" readonly name="rdoSex">
                                        <label class="custom-control-label checkbox-primary outline" for="rdoMale">Male</label>
                                    </span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" <?php if ($staff['sex'] == 'Female') {
                                                                echo 'checked';
                                                            } ?> onclick="$('#staffGenderHtml').html('Female'); $('#staffSex').val('Female');" class="custom-control-input" id="rdoFemale" readonly name="rdoSex">
                                        <label class="custom-control-label checkbox-warning outline" for="rdoFemale">Female</label>
                                    </span>
                                </div>
                                <input type="hidden" value="Male" readonly name="staffSex" id="staffSex">
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0" id="basic-addon1"><i class="fa fa-robot"></i></span>
                                    </div>
                                    <textarea readonly name="staffBio" class="form-control validate" id="bio"> <?php echo $staff['bio'] ?> </textarea>
                                    <label class="form-control-placeholder inside" for="bio">Brief Biography</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0" id="basic-addon1"><i class="fa fa-home"></i></span>
                                    </div>
                                    <textarea readonly name="staffAddress" class="form-control validate" id="home"><?php echo $staff['address'] ?></textarea>
                                    <label class="form-control-placeholder inside" for="home">Home Address</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-home"></i></span>
                                    </div>
                                    <input type="text" id="office" readonly name="staff_office" class="form-control form-control-lg float-input inside-label validate" value="<?php echo $this->db->get_where('chb_offices', array('office_id' => $staff['office']))->row_array()['office_name'];
                                                                                                                                                                                ?> ">
                                    <label class="form-control-placeholder inside" for="office">Office</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-user-secret"></i></span>
                                    </div>
                                    <input class="form-control form-control-lg float-input inside-label validate" id="position" readonly name="staff_position" type="text"  value="Sales Attendant">
                                    <label class="form-control-placeholder inside" for="position">Position</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-money-check"></i></span>
                                    </div>
                                    <input readonly name="staffSalary" type="password" class="form-control form-control-lg float-input inside-label" id="salary" value="<?php echo number_format($staff['salary']) ?>">
                                    <label class="form-control-placeholder inside" for="salary">Salary</label>
                                </div>
                                 <label class="pt-2 pl-5"><input type="checkbox" name="show_password">Toggle Salary</label>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <form method="POST" action="<?php echo base_url() ?>auth/change_password" class="col-12 col-md-5 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0 ml-3">Change Password</h4>
                        </div>
                        <div class="form-group input-danger col-sm-12 mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-lock"></i></span>
                                </div>
                                <input name="staffPassword" type="password" class="form-control form-control-lg float-input inside-label validate" id="password" value="">
                                <label class="form-control-placeholder inside" for="password">Current Password</label>
                            </div>
                        </div>

                        <div class="form-group input-danger col-sm-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-lock"></i></span>
                                </div>
                                <input name="newPassword" type="password" class="form-control form-control-lg float-input inside-label validate" id="n_password" value="">
                                <label class="form-control-placeholder inside" for="n_password">New Password</label>
                            </div>
                        </div>
                        <div class="d-flex  mt-5">
                            <button type="submit" class="btn btn-primary btn-block">Change Account Password</button>
                        </div>


                    </div>
                </div>
            </form>


        </div>
        <!-- END: Card DATA-->
    </div>
</main>
<!-- END: Content-->


<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/js_functions'); ?>
<script src="<?php echo base_url() ?>dist/vendors/icheck/icheck.min.js"></script>
<script src="<?php echo base_url() ?>dist/js/icheck.script.js"></script>

<script>
    $('[name="show_password"]').change(function() {
        if (this.checked) {
            $('[name="staffSalary"]').attr('type', 'text');
        } else {
            $('[name="staffSalary"]').attr('type', 'password');
        }
    });
</script>