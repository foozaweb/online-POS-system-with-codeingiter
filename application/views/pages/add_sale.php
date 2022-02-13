<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/calculator_controller'); ?>

<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto">
                        <h4 class="mb-0">Add Sale</h4>
                    </div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Add Sale</li>
                        <!-- <li class="breadcrumb-item active"><a href="#">Editable Table</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">

            <div class="col-12 col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="show sales" id="tab1">
                            <div class="form">
                                <div class="form-group col-sm-12 row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input name="searchText" type="search" class="form-control" id="searchText" value="" placeholder="Enter Product Name or scan barcode">
                                            <div class="input-group-prepend">
                                                <button type="button" class="sBtn btn btn-primary">
                                                    <i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 input-group">
                                        <input name="qty" type="number" class="form-control" id="qty" value="1" placeholder="Quantity">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btnAddProduct btn btn-secondary no-display">
                                                <i class="fa fa-plus-circle"></i> Add</button>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="card-body showResult no-display">

                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-sm-12">

                                    <div class="table-responsive">
                                        <table class="display table table-striped editable-table p10">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Product Name</th>
                                                    <th>Description</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                    <th class="avoid-this">Profit</th>
                                                    <th class="avoid-this"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tBody">

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        <h5><strong>Total:</strong></h5>
                                                    </th>
                                                    <th>
                                                        <h5><strong id="totalQty"></strong></h5>
                                                    </th>
                                                    <th>
                                                        <h5><strong id="totalAmt"></strong></h5>
                                                    </th>
                                                    <th class="avoid-this">
                                                        <h5><strong id="totalPft"></strong></h5>
                                                    </th>
                                                    <th class="avoid-this"></th>
                                                </tr>
                                            </tfoot>
                                        </table>


                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-7 flex-display">
                                                    <select class="form-control" id="transactionType">
                                                        <option value="" disabled>Transaction Type</option>
                                                        <option selected value="n">NON INSTALLMENT</option>
                                                        <option value="d">DEPOSIT</option>
                                                        <option value="i">INSTALLMENT</option>
                                                    </select>
                                                    <select class="form-control" id="paymentMethod">
                                                        <option value="" disabled>Payment Method</option>
                                                        <option selected value="CASH">CASH</option>
                                                        <option value="POS">POS</option>
                                                        <option value="TRANSFER">TRANSFER</option>
                                                    </select>
                                                    <select class="form-control" id="customer_name">
                                                        <option value="" disabled>Select Customer</option>
                                                        <option selected value="00" data-name="LOYAL CUSTOMER">LOYAL CUSTOMER</option>
                                                        <?php
                                                        foreach ($this->db->get('pos_customers')->result_array() as $cs) {
                                                            echo '<option data-verified_customer="' . $cs['verified_customer'] . '" data-name="' . $cs['customer_name'] . '" value="' . $cs['customer_id'] . '">' . $cs['customer_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <textarea cols="10" rows="1" required class="form-control" placeholder="Optional Note" id="orderNote"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 no-display text-danger installmentDiv mt-3"> Installment purchases attracts 10% addition on all purchase
                                                <div class="flex-display">
                                                    <label class="totalToPay pt-1 mt-1 mr-3 badge badge-danger"></label>
                                                    <input type="number" placeholder="First Installment" class="form-control" name="first_installment">
                                                    <h5 class="remaining_balance ml-3 mt-1 badge badge-info"></h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <a href="javascript:void(0);" class="btn btn-info print no-display"> <i class="fa fa-print"></i> Print Invoice</a>
                                    <button type="button" class="btn btn-primary pull-right submitInvoice"><i class="fa fa-save"></i> Save Transaction</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!-- END: Card DATA-->
    </div>
</main>
<!-- END: Content-->


<a href="javascript:void(0);" data-toggle="tooltip" data-position="left" title="Open Calculator or press F6" class="toggle_calculator" onclick="$('.foozawebMenu').fadeIn('fast')"><i class="fa fa-calculator"></i></a>


<div class="form-group">
    <?php
    $store_id = $this->db->get_where('chb_offices', array('office_id' => $staff['office']))->row_array()['office_name'];
    $this->db->order_by('id', 'desc');
    $ids = $this->db->get('pos_orders')->row_array();
    $id = 0 + $ids['id'] + 1;
    ?>
</div>

<input type="hidden" value="<?php echo substr($store_id, 0, 4) . str_pad($id, 4, '0', STR_PAD_LEFT); ?>" class="form-control text-uppercase" id="invoiceNo">
<input type="hidden" class="form-control" id="selectedProductId">
<input type="hidden" class="form-control" id="selectedProductDesc">
<input type="hidden" class="form-control" id="selectedProductSellingPrice">
<input type="hidden" class="form-control" id="selectedProductProfit">
<input type="hidden" class="form-control" id="subTotal">
<input type="hidden" class="form-control" id="subTotalProfit">
<input type="hidden" class="form-control" id="availableQty">

<?php $this->load->view('template/footer'); ?>

<script src="<?php echo $user_url ?>js/jQuery.print.min.js"></script>
<?php $this->load->view('template/js_functions'); ?>


<script>
    window.onbeforeunload = function (event) {
    	event.returnValue = "Refreshing browser...";
    };
</script>