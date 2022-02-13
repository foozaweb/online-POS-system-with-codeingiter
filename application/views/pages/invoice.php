<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>

<!-- START: Main Content-->
<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto">
                        <h4 class="mb-0">Invoice</h4>
                        <p class="text-uppercase"><?php echo $invoice['invoice_no'] ?></p>
                    </div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Orders</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row" id="thisInvoice">



            <div class="col-md-4 mt-3">
                <div class="">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="card-title">Sales Info.</h2>
                        <?php if ($this->session->flashdata('alert_danger')) :
                            echo '<p class="alert alert-danger" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_danger') . '</p>'; ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('alert_success')) :
                            echo '<p class="alert alert-success" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_success') . '</p>'; ?>
                        <?php endif; ?>
                    </div>
                    <div class="card-content">
                        <div class="card-body p-0">
                            <ul class="list-group list-unstyled">

                                <li class="p-2 border-bottom text-left">
                                    <div class="media d-flex w-100">
                                        <div class="media-body align-self-center"><br>
                                            <span class="mb-0 font-w-600 text-uppercase"><i class="fa fa-shopping-bag"></i> Invoice ID : <strong><?php echo $invoice['invoice_no'] ?></strong></span><br>
                                            <p class="mb-0 font-w-500 tx-s-12">
                                                <i class="fa fa-user"></i> Customer:
                                                <?php if ($invoice['customer'] == '00') {
                                                    echo '<strong>LOYAL CUSTOMER</strong>';
                                                } else {
                                                    echo '<strong>' . $invoice['customer_name'] . '</strong>';
                                                } ?>
                                            </p>
                                            <p class="mb-0 font-w-500 tx-s-12"><i class="icon-calendar"></i> OrderDate : <strong><?php echo $invoice['order_date'] ?></strong></p>
                                            <p class="mb-0 font-w-500 tx-s-12"><i class="icon-wallet"></i> Payment Method : <strong><?php echo $invoice['payment_method'] ?></strong></p>
                                            <p class="mb-0 font-w-500 tx-s-12"><i class="fa fa-file-code"></i> Transaction Type :
                                                <?php
                                                if ($invoice['transactionType'] == "i") {
                                                    echo '<strong>INSTALLMENT</strong>';
                                                } elseif ($invoice['transactionType'] == "d") {
                                                    echo '<strong>DEPOSIT</strong>';
                                                } elseif ($invoice['transactionType'] == "n") {
                                                    echo '<strong>NON-INSTALLMENT</strong>';
                                                } else {
                                                    echo '<strong>UNKNOWN</strong>';
                                                }
                                                ?>
                                            </p>

                                            <p class="mb-0 font-w-500 tx-s-12"><i class="fa fa-shopping-bag"></i> Order Status:
                                                <?php
                                                if ($invoice['order_status'] == 1) {
                                                    echo '<b class="badge badge-success"><i class="fa fa-check"></i> Completed</b>';
                                                } elseif ($invoice['order_status'] == 0) {
                                                    echo '<b class="badge badge-warning"><i class="fa fa-shopping-basket"></i> Pending</b>';
                                                } elseif ($invoice['order_status'] == 2) {
                                                    echo '<b class="badge badge-danger"><i class="fa fa-times"></i> Cancelled</b>';
                                                } elseif ($invoice['order_status'] == 11) {
                                                    echo '<b class="badge badge-danger"><i class="fa fa-walking"></i> Started</b>';
                                                } else {
                                                    echo '<b class="badge badge-danger"><i class="fa fa-globe"></i> Not found</b>';
                                                }
                                                ?>
                                            </p>
                                            <p class="mb-0 font-w-500 tx-s-12"><i class="fa fa-check-square"></i> Payment Status:
                                                <?php
                                                if (intval($invoice['grandTotal']) === intval($invoice['total_paid'])) {
                                                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> Completed</span>';
                                                } elseif (intval($invoice['grandTotal']) > intval($invoice['total_paid']) && $invoice['transactionType'] == "i") {
                                                    echo '<span class="badge badge-warning"><i class="fa fa-anchor"></i> Unsettled</span>';
                                                } elseif (intval($invoice['grandTotal']) >= intval($invoice['total_paid']) && $invoice['transactionType'] != "i") {
                                                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> Completed</span>';
                                                } elseif (intval($invoice['grandTotal']) < intval($invoice['total_paid'])) {
                                                    echo '<span class="badge badge-danger"><i class="fa fa-times"></i> Overcharged</span>';
                                                }
                                                ?>
                                            </p>


                                            <?php
                                            if ($invoice['transactionType'] == "i") {
                                                if ($invoice['grandTotal'] > $invoice['total_paid']) {
                                                    echo '<p class="text-danger mb-0 font-w-500 tx-s-12"><i class="fa fa-hand-holding-usd"></i>  Uncleared Balance: <strong>₦' .  number_format(intval($invoice['grandTotal'] - $invoice['total_paid'])) . '</strong></p>';

                                                    echo '<p class="text-success mb-0 font-w-500 tx-s-12"><i class="fa fa-check"></i>  Amount Cleared: <strong>₦' .  number_format(intval($invoice['total_paid'])) . '</strong></p>';
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3"></div>

            <div class="col-md-4 mt-3">
                <div class="">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="card-title">Billing Info.</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="list-group list-unstyled">
                                <li class="p-2 border-bottom">
                                    <div class="media d-flex w-100">
                                        <div class="media-body align-self-center pl-2 text-right">
                                            <p class="mb-0 font-w-500 tx-s-12">Sold By: <strong><?php echo $invoice['name'] ?></strong></p>

                                            <p class="mb-0 font-w-500 tx-s-12">Demurrage: <strong>₦<?php echo number_format(floatval($invoice['extra'])) ?></strong></p>

                                            <p class="mb-0 font-w-500 tx-s-12">Sub Total: <strong>₦<?php echo number_format(floatval($invoice['subTotal'])) ?></strong></p>

                                            <p class="mb-0 font-w-500 tx-s-12">Grand Total: <strong>₦<?php echo number_format(floatval($invoice['grandTotal'])) ?></strong></p>

                                            <p class="mb-0 font-w-500 tx-s-12">POS Fidelity: <strong>₦<?php echo number_format(floatval($invoice['grandTotal'])) ?></strong></p>

                                            <p class="mb-0 font-w-500 tx-s-12 avoid-this">Total Profit: <strong>₦<?php echo number_format(floatval($invoice['totalProfit'])) ?></strong></p>

                                            <p class="mb-0 font-w-500 tx-s-12">Total Quantity: <strong><?php echo $invoice['totalQty'] ?></strong></p>

                                            <p class="mb-0 font-w-500 tx-s-12">Order Note: <strong><?php echo $invoice['order_note'] ?></strong></p>

                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>





            <div class="col-12 col-md-12 col-lg-12 mt-3">
                <div class="">
                    <div class="card-header  justify-content-between align-items-center">
                        <h6 class="card-title">Order Items</h6>
                    </div>
                    <div class="card-body table-responsive p-0">

                        <table class="table  mb-0">
                            <thead>


                                <tr>
                                    <th>SN</th>
                                    <th>Product Name</th>
                                    <th class="avoid-this">Product Description</th>
                                    <th>Amount</th>
                                    <th>Quantity</th>
                                    <th class="avoid-this">Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $this->db->join('pos_orders', 'pos_orders.invoice_no = pos_order_items.invoice_no', 'left');
                                $this->db->where('pos_order_items.invoice_no', $invoice['invoice_no']);
                                $this->db->order_by('pos_order_items.item_id', 'desc');
                                $items = $this->db->get('pos_order_items')->result_array();
                                $index = '';
                                foreach ($items as $item) {
                                    $index++; ?>
                                    <tr>
                                        <td><?php echo $index; ?></td>
                                        <td>
                                            <div>
                                                <?php echo $this->db->get_where('chb_products', array('productId' => $item['product_id']))->row_array()['product_name'] ?>
                                            </div>
                                        </td>
                                        <td class="avoid-this">
                                            <?php
                                            echo word_limiter($this->db->get_where('chb_products', array('productId' => $item['product_id']))->row_array()['productDesc'], 50);
                                            ?>
                                        </td>
                                        <td> ₦<?php echo number_format($item['amount']) ?> </td>
                                        <td> <?php echo $item['quantity'] ?> </td>
                                        <td class="avoid-this"> ₦<?php echo number_format($item['profit']) ?> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 mt-5">
                <div class="col-md-12 bottomLeft mt-5 text-right">

                    <?php
                    if ($invoice['transactionType'] == "i") {
                        if ($invoice['grandTotal'] > $invoice['total_paid']) {
                            echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#paymentModal" class="btn btn-success avoid-this mt-5 ml-3"> <i class="fa fa-money-bill"></i> Make Payment</a>';
                        }
                    }
                    ?>

                    <?php
                    if ($invoice['order_status'] == 11) {
                        echo '<a href="'.base_url().'app/finishTransaction/'.$invoice['invoice_no'].'" class="btn btn-success avoid-this mt-5 ml-3"> <i class="fa fa-check"></i> Finish Transaction</a>';
                    }
                    ?> 
                    <a href="javascript:void(0);" class="btn btn-primary print avoid-this mt-5"> <i class="fa fa-print"></i> Print Invoice</a>


                </div>
            </div>
        </div>
        <!-- END: Card DATA-->
    </div>
</main>
<!-- END: Content-->

<?php $this->load->view('template/footer'); ?>





<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="post" action="<?php echo base_url() ?>app/make_payment">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Make Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                if ($invoice['transactionType'] == "i") {
                    if ($invoice['grandTotal'] > $invoice['total_paid']) {
                        echo '<a href="javascript:void(0)" data-debt="' . intval($invoice['grandTotal'] - $invoice['total_paid']) . '" class="debt badge badge-danger"> Pay:  ₦' .  number_format(intval($invoice['grandTotal'] - $invoice['total_paid'])) . '</a>';
                    }
                }
                ?>

                <input type="hidden" name="invoiceId" value="<?php echo $invoice['invoice_no'] ?>">
                <select class="form-control mt-3" id="paymentMethod" name="paymentMethod">
                    <option value="" disabled>Payment Method</option>
                    <option selected value="CASH">CASH</option>
                    <option value="POS">POS</option>
                    <option value="TRANSFER">TRANSFER</option>
                </select>
                <input type="number" name="payment_amount" class="form-control mt-3" placeholder="Enter Amount">
                <label id="remainingBalance" class="mt-3"></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit Payment</button>
            </div>
        </form>
    </div>
</div>



<script src="<?php echo base_url() ?>dist/js/jQuery.print.min.js"></script>
<script>
    const prependThis = '<div class="text-center p10">CHBLUXURY<br/> <?php echo $staff['location'] ?> <br>+234 708 242 7348</div> <br><br> <h3><strong>SALES INVOICE</strong></h3> <br> <div class=" text-uppercase p10">BRANCH: <span class="pull-right"><?php echo $staff['office_name'] ?></span></div>';
    const appendThis = '<div class="text-uppercase p10"> <div class="text-center">...Thank you</div></div>';


    $('.print').on('click', function() {
        $("#thisInvoice").print({
            globalStyles: true,
            mediaPrint: true,
            stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
            iframe: false,
            noPrintSelector: ".avoid-this",
            prepend: prependThis,
            append: appendThis,
            deferred: $.Deferred().done(function() {
                // console.log('Printing done', arguments);
            })
        });
    });

    function formatMoney(number) {
        return number.toLocaleString('en-US', {
            style: 'currency',
            currency: 'NGN'
        });
    }


    $('[name="payment_amount"]').on('keyup', function() {
        var sTotal = '<?php echo intval($invoice['grandTotal'] - $invoice['total_paid']) ?>';

        var calc = parseInt(sTotal) - parseInt($(this).val());
        $('#remainingBalance').html('Balance ' + formatMoney(calc));
    });

    $('.debt').on('click', function() {
        $('[name="payment_amount"]').val($(this).data('debt'));
    });
</script>
<?php //$this->load->view('template/js_functions'); 
?>