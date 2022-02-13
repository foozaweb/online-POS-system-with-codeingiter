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
                        <h4 class="mb-0">Suppliers</h4>
                    </div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Suppliers</li>
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
                    <div class="card-header justify-content-between align-items-center">
                        <a href="javascript:void(0);" onclick="$('#addSupplier').toggle();" class="btn btn-primary"><i class="fa fa-user-plus"></i> Register New Supplier</a>
                    </div>
                    <?php if ($this->session->flashdata('alert_danger')) :
                        echo '<p class="alert alert-danger" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_danger') . '</p>'; ?>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('alert_success')) :
                        echo '<p class="alert alert-success" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_success') . '</p>'; ?>
                    <?php endif; ?>


                    <div class="card-body no-display" id="addSupplier">
                        <form method="post" action="<?php echo base_url() ?>app/registerSupplier" class="table-responsive">



                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-home"></i></span>
                                    </div>
                                    <input required autocomplete="off" name="supplier_name" placeholder="Supplier Name" type="text" class="form-control form-control-lg float-input inside-label validate">
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input required name="supplier_phone" placeholder="Supplier Phone Number" type="tel" class="form-control form-control-lg float-input inside-label validate">
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input required name="contact_person" placeholder="Contact Person" type="text" class="form-control form-control-lg float-input inside-label validate">
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-location-arrow"></i></span>
                                    </div>
                                    <textarea required name="supplier_address" placeholder="Office Address" class="form-control form-control-lg float-input inside-label validate"></textarea>
                                </div>
                            </div>


                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-danger">Register Supplier</button>
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
                                        <th>Phone</th>
                                        <th>Contact Person</th>
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $output = '';
                                    $suppliers = $this->db->get('chb_supplier')->result_array();
                                    foreach ($suppliers as $supplier) {
                                    ?>
                                        <tr>
                                            <td><?php echo $supplier['supplier_name']; ?></td>
                                            <td><?php echo $supplier['supplier_phone']; ?></td>
                                            <td><?php echo $supplier['contact_person']; ?></td>
                                            <td><?php echo $supplier['supplier_address']; ?></td>
                                            <td><a href="javascript:void(0);" data-url="<?php echo base_url() ?>app/deleteSupplier/<?php echo $supplier['supplier_id']; ?>" class="btn btn-danger deleteSupplier" title="Delete Supplier" position="top" toggle="tooltip"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Contact Person</th>
                                        <th>Address</th>
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
<script src="<?php echo base_url() ?>dist/js/datatableedit.script.js"></script>