<?php $this->load->view('template/header'); ?>
<link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/datatable/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css">

<?php $this->load->view('template/nav'); ?>


<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto">
                        <h4 class="mb-0">CHB Customer's List</h4>
                    </div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Customer List</li>
                        <!-- <li class="breadcrumb-item active"><a href="#">Editable Table</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->



        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header  justify-content-between align-items-center">

                        <h2>List of Customers</h2>

                        <a href="javascript:void(0);" onclick="$('#addCustomer').toggle();" class="btn btn-primary pull-right"><i class="fa fa-user-plus"></i> Register New Customer</a>

                        <?php if ($this->session->flashdata('alert_danger')) :
                            echo '<p class="alert alert-danger" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_danger') . '</p>'; ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('alert_success')) :
                            echo '<p class="alert alert-success" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_success') . '</p>'; ?>
                        <?php endif; ?>
                    </div>
                    <div class="card-body no-display" id="addCustomer">
                        <form method="post" action="<?php echo base_url() ?>app/registerCustomer" class="table-responsive">
                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input required autocomplete="off" name="customer_name" placeholder="Customer Name" type="text" class="form-control form-control-lg float-input inside-label validate">
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input required name="customer_phone" placeholder="Customer Phone Number" type="tel" class="form-control form-control-lg float-input inside-label validate">
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input required name="email" placeholder="Email" type="text" class="form-control form-control-lg float-input inside-label validate">
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-home"></i></span>
                                    </div>
                                    <textarea required name="customer_address" placeholder="Office Address" class="form-control form-control-lg float-input inside-label validate"></textarea>
                                </div>
                            </div>


                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-danger">Register Customer</button>
                                </div>
                            </div>

                        </form>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table dataTable table-striped editable-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Member Since</th>
                                        <th>Order Count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $customer = $this->db->get('pos_customers')->result_array();
                                    foreach ($customer as $cus) {
                                        $this->db->where('customer', $cus['customer_id']);
                                        $this->db->select_sum('grandTotal');
                                        $income = $this->db->get_where('pos_orders', array('customer' => $cus['customer_id']))->row_array();

                                        $sort = $this->db->get_where('pos_orders', array('customer' => $cus['customer_id']))->num_rows();
                                    ?>
                                        <tr>
                                            <td><?php echo $cus['customer_name']; ?></td>
                                            <td><?php echo $cus['email']; ?></td>
                                            <td><?php echo $cus['phone']; ?></td>
                                            <td><?php echo $cus['date_created']; ?></td>
                                            <td><span class='badge badge-warning'><?php echo '₦' . number_format(0 + $income['grandTotal']) ?></span><br>
                                                <?php echo shortNumber($sort);
                                                if ($sort > 1) {
                                                    echo " Orders";
                                                } else {
                                                    echo " Order";
                                                } ?>
                                            </td>
                                            <td><a href="javascript:void(0);" data-url="<?php echo base_url() ?>app/trashCus/<?php echo $cus['customer_id']; ?>" class="btn btn-danger trashCus" title="Trash Customer" position="top" toggle="tooltip"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Member Since</th>
                                        <th>Order Count</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- END: Card DATA-->
    </div>
</main>
<!-- END: Content-->


<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/js_functions'); ?>
<script src="<?php echo base_url() ?>dist/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/editor/mindmup-editabletable.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/editor/numeric-input-example.js"></script>
<script src="<?php echo base_url() ?>dist/js/datatable.script.js"></script>


<script>
    $('table').on('click', '.trashCus', function() {
        if (confirm("Are you sure?")) {
            location.href = $(this).data('url');
        }
    });
</script>