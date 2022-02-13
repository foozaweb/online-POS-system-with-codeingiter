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
                        <h4 class="mb-0">Product List</h4>
                    </div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Product List</li>
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
                        <a href="<?php echo base_url() . 'add_sale' ?>" class="pull-right btn btn-primary"><i class="fa fa-plus-circle"></i> New Transaction</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="chbTable display table dataTable table-striped editable-table">
                                <thead>

                                    <tr>
                                        <th><input type="checkbox" name="parent_check_box"></th>
                                        <th>barcode</th>
                                        <th>Product Name</th>
                                        <th>Selling Price</th>
                                        <th>Inventory</th>
                                        <th>Visibility</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $this->db->order_by('chb_products.date_created', 'desc');
                                    $this->db->join('chbadmin', 'chbadmin.uniqueId = chb_products.uploaded_by', 'left');
                                    $products = $this->db->get('chb_products')->result_array();
                                    foreach ($products as $product) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $store_id = $this->db->get_where('chb_offices', array('office_id' => $staff['office']))->row_array()['store_id'];

                                                $req = $this->db->get_where('chb_product_request', array('product_id' => $product['productId'], 'store_id' => $store_id));

                                                if ($product['display'] == 1 && $product['quantity'] > 0 && $req->num_rows() < 1) {
                                                    echo '<input data-product_name="' . $product['product_name'] . '" type="checkbox" name="product_ids" class="product_ids" value="' . $product['productId'] . '">';
                                                } else {
                                                    echo '<input data-product_name="' . $product['product_name'] . '" type="checkbox" name="product_ids" class="disabled" disabled value="' . $product['productId'] . '">';
                                                } ?>

                                            </td>
                                            <td>
                                                <?php echo '<img src="' . $admin_url . 'assets/images/' . $product['main_photo'] . '" class="max_h50"> <br>' . $product['productId']; ?>
                                            </td>
                                            <td><span title="<?php echo $product['product_name']; ?>"><?php echo word_limiter($product['product_name'], 3); ?></span></td>

                                            <td> <strong>₦<?php echo number_format($product['consumer_price']); ?></strong></td>

                                            <td>
                                                <?php
                                                if ($product['quantity'] < 1) {
                                                    echo "<span class='badge badge-danger ml-2'>Out of Stock</span>";
                                                } else if ($product['quantity'] >= 1 && $product['quantity'] < 20) {
                                                    echo $product['quantity'] . "<span class='badge badge-warning ml-2'><i class='fa fa-exclamation-triangle'></i> </span>";
                                                } else if ($product['quantity'] > 20) {
                                                    echo $product['quantity'] . "<span class='badge badge-success ml-2'><i class='fa fa-check'></i> </span>";
                                                } ?>
                                            </td>

                                            <td>
                                                <?php
                                                if ($product['display'] == 1) {
                                                    echo "<span class='badge badge-success ml-2'>Active</span>";
                                                } else {
                                                    echo "<span class='badge badge-danger     ml-2'>Inactive</span>";
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($req->num_rows() < 1) {
                                                    if ($product['display'] == 1 && $product['quantity'] > 0) { ?>
                                                        <a href="javascript:void(0);" onclick="$('.requestForm<?php echo $product['productId']; ?>').toggle();" class="badge badge-primary"><i class="fa fa-hands"></i> Request</a>
                                                        <form class="card mw-200 requestForm<?php echo $product['productId']; ?> no-display" method="POST" action="<?php echo base_url() ?>app/request_stock">
                                                            <div class="card-body">
                                                                <input class="form-control" type="hidden" name="request_product_id" value="<?php echo $product['productId']; ?>">
                                                                <input class="form-control" type="hidden" name="request_staff_office" value="<?php echo $staff['office']; ?>">
                                                                <input class="form-control" placeholder="Quantity" type="number" required name="request_quantity" value="">
                                                                <br>
                                                                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Send Request</button>
                                                            </div>
                                                        </form>
                                                <?php } else {
                                                        echo '<a href="#" class="badge badge-danger disabled" data-toggle="tooltip" data-position="left" title="Can`t request this product. its currently Unavailable"> <i class="fa fa-ban"></i> Unavailable</a>';
                                                    }
                                                } else {
                                                    echo "<href='javascript:void(0);' class='badge badge-warning'> <i class='fa fa-warehouse'></i> Requested</a>";
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><input type="checkbox" name="parent_check_box"></th>
                                        <th>barcode</th>
                                        <th>Product Name</th>
                                        <th>Selling Price</th>
                                        <th>Inventory</th>
                                        <th>Visibility</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>


                            <div class="mt-3 row mb-3 ml-5">
                                <div class="text-grey col-md-2 mt-2">With Selected:</div>
                                <div class="col-md-4 flex-display">
                                    <select class="form-control" name="with_selected">
                                        <option value="request">Request Stock</option>
                                    </select>
                                    <button class="btn btn-primary btnRequestStock">Go</button>
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










<div class="modal fade" id="bulkRequestModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bulk Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <small id="showProductNames"></small><br>
                <div class="input-group">
                    <input type="text" autocomplete="off" required placeholder="Enter Quantity separated with comma(,)" class="form-control mt-3" name="bulkRequestQuantity">

                    <input class="form-control" type="hidden" name="staff_office_bulk" value="<?php echo $staff['office']; ?>">

                </div>

                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="runBulkRequest();" class="btn btn-primary"><i class="fa fa-check"></i> Request Selected Stock</button>
            </div>
        </div>
    </div>
</div>







<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/js_functions'); ?>
<script src="<?php echo base_url() ?>dist/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/editor/mindmup-editabletable.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/datatable/editor/numeric-input-example.js"></script>
<script src="<?php echo base_url() ?>dist/js/datatable.script.js"></script>

<script>
    $('[name="parent_check_box"]').change(function() {
        if (this.checked) {
            $('.product_ids').prop('checked', true);
        } else {
            $('.product_ids').prop('checked', false);
        }
    });


    $('.btnRequestStock').on('click', function() {
        $('#showProductNames').html('');
        $('tbody .product_ids:checked').each(function() {
            $('#showProductNames').append($(this).data('product_name') + ', ');
        });
        $('#bulkRequestModal').modal('show');
    });




    function runBulkRequest() {
        var productIds = '';
        var processState = false;
        var updateIndex;


        productIds = $('tbody .product_ids:checked').map(function() {
            return this.value
        }).get().join(",");

        var staff_office_bulk = $('[name="staff_office_bulk"]').val();
        var quantity = $('[name="bulkRequestQuantity"]').val();
        if (!quantity) {
            alertMe("Please provide quantity for each product selected", 8000);
            $('[name="bulkUpdateQuantity"]').focus();
            return false;
        }

        var regExp = /[a-zA-Z]/g;
        if (regExp.test(quantity)) {
            alertMe(quantity + ' is Not a Number', 10000);
            return false;
        }

        var count_productId = (productIds.match(/,/g) || []).length;
        var count_quantity = (quantity.match(/,/g) || []).length;

        if (count_productId != count_quantity) {
            alertMe(parseInt(count_productId + 1) + " products selected for update, yet " + parseInt(count_quantity + 1) + " quantity value provided. Please make sure quantity is equal to the selected products and in order or precedence", 10000);
            return false;
        }

        for (updateIndex = 0; updateIndex <= count_productId; updateIndex++) {
            $.ajax({
                url: "<?php echo base_url() ?>app/runBulkRequest",
                type: "post",
                dataType: "json",
                async: false,
                data: {
                    product_id: productIds.split(',')[updateIndex],
                    quantity: quantity.split(',')[updateIndex],
                    staff_office_bulk: staff_office_bulk
                },
                success: function(data) {
                    processState = true;
                }
            });
        }
        if (processState == true) {
            toastr.success("Successfully placed Request");
            setTimeout(() => {
                location.reload();
            }, 4000);
        } else {
            toastr.error("An unknown error occurred. This is usually because you have transferred more than available stock in warehouse Please try again.");
            // setTimeout(() => {
            //     location.reload();
            // }, 4000);
        }
    }



    function runBulkTransfer() {
        var productIds = '';
        var processState = '';
        var updateIndex;


        productIds = $('tbody .product_ids:checked').map(function() {
            return this.value
        }).get().join(",");
        var beneficiary = $('[name="beneficiary"]').val();
        var quantity = $('[name="bulkTransferQuantity"]').val();
        var narration = $('[name="bulk_transfer_narration"]').val();


        if (!beneficiary) {
            alertMe("Beneficiary cannot be null", 8000);
            $('[name="beneficiary"]').focus();
            return false;
        }
        if (!productIds) {
            alertMe("No Item Selected for update", 8000);
            return false;
        }
        if (!quantity) {
            alertMe("Please provide quantity for each product selected", 8000);
            $('[name="bulkUpdateQuantity"]').focus();
            return false;
        }
        if (!narration) {
            alertMe("Narration cannot be null", 8000);
            $('[name="bulk_update_narration"]').focus();
            return false;
        }

        var regExp = /[a-zA-Z]/g;
        if (regExp.test(quantity)) {
            alertMe(quantity + ' is Not a Number', 10000);
            return false;
        }

        var count_productId = (productIds.match(/,/g) || []).length;
        var count_quantity = (quantity.match(/,/g) || []).length;

        if (count_productId != count_quantity) {
            alertMe(parseInt(count_productId + 1) + " products selected for transfer, yet " + parseInt(count_quantity + 1) + " quantity value provided. Please make sure quantity is equal to the selected products and in order or precedence", 10000);
            return false;
        }

        for (updateIndex = 0; updateIndex <= count_productId; updateIndex++) {
            $.ajax({
                url: "<?php echo base_url() ?>app/runBulkTransfer",
                type: "post",
                dataType: "json",
                async: false,
                data: {
                    product_id: productIds.split(',')[updateIndex],
                    quantity: quantity.split(',')[updateIndex],
                    narration: narration,
                    beneficiary: beneficiary
                },
                success: function(data) {
                    processState = true;
                },
                error: function() {
                    processState = false;
                }
            });
        }
        if (processState == true) {
            toastr.success("Transfer Successful");
            setTimeout(() => {
                location.reload();
            }, 3000);
        } else {
            toastr.error("An unknown error occurred. This is usually because you have transferred more than available stock in warehouse Please try again.");
            // setTimeout(() => {
            //     location.reload();
            // }, 4000);
        }

    }
</script>