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
                        <h4 class="mb-0"> Sales Report</h4>
                    </div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Sales Report</li>
                        <!-- <li class="breadcrumb-item active"><a href="#">Editable Table</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->



        <!-- START: Card Data-->
        <div class="row">

            <div class="col-12 mt-3">
                <?php if ($this->session->flashdata('alert_danger')) :
                    echo '<p class="alert alert-danger" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_danger') . '</p>'; ?>
                <?php endif; ?>

                <?php if ($this->session->flashdata('alert_success')) :
                    echo '<p class="alert alert-success" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_success') . '</p>'; ?>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header  justify-content-between align-items-center">
                        <a href="<?php echo base_url() . 'add_sale' ?>" class="pull-right btn btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                        <h3>Orders</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="chbTable display table dataTable table-striped editable-table">
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Purchased</th>
                                        <th>Client Name</th>
                                        <th>Sub Total</th>
                                        <th>Grand Total</th>
                                        <th>Quantity</th>
                                        <th>Profit</th>
                                        <th>Transaction Type</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $this->db->join('pos_customers', 'pos_customers.customer_id = pos_orders.customer', 'left');
                                    $this->db->order_by('pos_orders.id', 'desc');
                                    $this->db->where('pos_orders.sold_by', $staff['uniqueId']);
                                    $new_order = $this->db->get('pos_orders')->result_array();
                                    foreach ($new_order as $ods) {
                                    ?>
                                        <tr>
                                            <td class="text-uppercase"><a href="<?php echo base_url() ?>app/invoice/<?php echo $ods['invoice_no'] ?>"><?php echo $ods['invoice_no'] ?></a></td>
                                            <td><?php echo $ods['order_date'] ?></td>
                                            <td><?php if ($ods['customer'] == '00') {
                                                    echo 'LOYAL CUSTOMER';
                                                } else {
                                                    echo $ods['customer_name'];
                                                } ?></td>
                                            <td><b> ₦<?php echo number_format(floatval($ods['subTotal'])) ?></b></td>
                                            <td><b> ₦<?php echo number_format(floatval($ods['grandTotal'])) ?></b></td>
                                            <td><?php echo $ods['totalQty'] ?></td>
                                            <td><b> ₦<?php echo number_format(floatval($ods['totalProfit'])) ?></b></td>

                                            <td>
                                                <?php
                                                if ($ods['transactionType'] == "i") {
                                                    echo 'INSTALLMENT';
                                                } elseif ($ods['transactionType'] == "d") {
                                                    echo 'DEPOSIT';
                                                } elseif ($ods['transactionType'] == "n") {
                                                    echo 'NON-INSTALLMENT';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php if ($ods['payment_method'] == "CASH") {
                                                    echo '<b class="badge outline-badge-dark"><i class="fa fa-money-bill"></i> CASH</b>';
                                                } elseif ($ods['payment_method'] == "POS") {
                                                    echo '<b class="badge outline-badge-secondary"><i class="fa fa-terminal"></i> POS</b>';
                                                } elseif ($ods['payment_method'] == "TRANSFER") {
                                                    echo '<b class="badge outline-badge-info"><i class="fa fa-mobile"></i> TRANSFER</b>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (intval($ods['grandTotal']) === intval($ods['total_paid'])) {
                                                    echo '<b class="badge badge-success"><i class="fa fa-check"></i> Completed</b>';
                                                } elseif (intval($ods['grandTotal']) > intval($ods['total_paid'])) {
                                                    echo '<b class="badge badge-warning"><i class="fa fa-walking"></i> Unsettled</b>';
                                                } elseif (intval($ods['grandTotal']) < intval($ods['total_paid'])) {
                                                    echo '<b class="badge badge-danger"><i class="fa fa-times"></i> Overcharged</b>';
                                                } else {
                                                    echo '';
                                                }
                                                ?>
                                            </td>
                                            <td><a title="View Invoice" href="<?php echo base_url() ?>app/invoice/<?php echo $ods['invoice_no'] ?>" class="badge badge-info"><i class="fa fa-receipt"></i> Invoice</a></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Purchased</th>
                                        <th>Client Name</th>
                                        <th>Sub Total</th>
                                        <th>Grand Total</th>
                                        <th>Quantity</th>
                                        <th>Profit</th>
                                        <th>Transaction Type</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
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
<script src="<?php echo base_url() ?>dist/vendors/datatable/jszip/jszip.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>dist/js/datatable.script.js"></script>