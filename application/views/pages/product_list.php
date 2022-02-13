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


            <div class="col-12 mt-3 switch_report">
                <div class="card">
                    <div class="card-header  justify-content-between">
                        <a href="<?php echo base_url() . 'request_stock' ?>" class="btn btn-primary"><i class="fa fa-recycle"></i> Request Product</a>

                        <button class="btn btn-warning pull-right" type="button" onclick="$('.switch_report').toggle();"> <i class="fa fa-toggle-on"></i> Toggle Available Stock</button>


                        <?php if ($this->session->flashdata('alert_danger')) :
                            echo '<p class="alert alert-danger" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_danger') . '</p>'; ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('alert_success')) :
                            echo '<p class="alert alert-success" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_success') . '</p>'; ?>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="chbTable display table dataTable table-striped editable-table">
                                <thead>

                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Selling Price</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $office = $this->db->get_where('chb_offices', array('office_id' => $staff['office']))->row_array()['store_id'];
                                    $this->db->order_by('chb_office_products.office_product_id', 'desc');
                                    $this->db->join('chb_products', 'chb_products.productId = chb_office_products.product_id', 'left');
                                    $this->db->join('chbadmin', 'chbadmin.uniqueId = chb_products.uploaded_by', 'left');

                                    $this->db->where('chb_office_products.store_id', $office);
                                    $products = $this->db->get('chb_office_products')->result_array();
                                    foreach ($products as $product) {
                                    ?>
                                        <tr>
                                            <td><?php echo $product['productId'] ?></td>
                                            <td><?php echo $product['product_name']; ?></td>
                                            <td> <strong>₦<?php echo number_format($product['consumer_price']); ?></strong></td>
                                            <td><?php echo str_replace('-', ' ', $product['productBrand']); ?></td>

                                            <td><?php
                                                if ($product['store_quantity'] < 1) {
                                                    echo "<span class='badge outline-badge-danger ml-2'>Out of Stock</span>";
                                                } else if ($product['store_quantity'] > 1 && $product['store_quantity'] < 20) {
                                                    echo "<strong class='text-warning ml-2'> " . $product['store_quantity'] . "</strong>";
                                                } else if ($product['store_quantity'] > 20) {
                                                    echo "<strong class='text-success ml-2'>" . $product['store_quantity'] . "</strong>";
                                                } ?>
                                            </td>
                                            <td><?php echo $product['category']; ?></td>
                                            <td><?php echo str_replace('-', ' ', $product['subCategory']); ?></td>
                                            <td><?php echo $product['date_created']; ?></td>

                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Selling Price</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Date Created</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 no-display switch_report">
                <div class="card">
                    <div class="card-header  justify-content-between">
                        <a href="<?php echo base_url() . 'request_stock' ?>" class="btn btn-primary"><i class="fa fa-recycle"></i> Request Product</a>

                        <button class="btn btn-warning " type="button" onclick="$('.switch_report').toggle();"> <i class="fa fa-toggle-on"></i> Toggle All</button>


                        <?php if ($this->session->flashdata('alert_danger')) :
                            echo '<p class="alert alert-danger" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_danger') . '</p>'; ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('alert_success')) :
                            echo '<p class="alert alert-success" style="text-align:center;"><button type="button" class="close mr-2" data-dismiss="alert">&times;</button>' . $this->session->flashdata('alert_success') . '</p>'; ?>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="chbTable display table dataTable table-striped editable-table">
                                <thead>

                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Selling Price</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $office = $this->db->get_where('chb_offices', array('office_id' => $staff['office']))->row_array()['store_id'];
                                    $this->db->order_by('chb_office_products.office_product_id', 'desc');
                                    $this->db->join('chb_products', 'chb_products.productId = chb_office_products.product_id', 'left');
                                    $this->db->join('chbadmin', 'chbadmin.uniqueId = chb_products.uploaded_by', 'left');

                                    $this->db->where('chb_office_products.store_id', $office);
                                    $this->db->where('chb_office_products.store_quantity >', '0');
                                    $products = $this->db->get('chb_office_products')->result_array();
                                    foreach ($products as $product) {
                                    ?>
                                        <tr>
                                            <td><?php echo $product['productId'] ?></td>
                                            <td><?php echo $product['product_name']; ?></td>
                                            <td> <strong>₦<?php echo number_format($product['consumer_price']); ?></strong></td>
                                            <td><?php echo str_replace('-', ' ', $product['productBrand']); ?></td>

                                            <td><?php
                                                if ($product['store_quantity'] < 1) {
                                                    echo "<span class='badge outline-badge-danger ml-2'>Out of Stock</span>";
                                                } else if ($product['store_quantity'] > 1 && $product['store_quantity'] < 20) {
                                                    echo "<strong class='text-warning ml-2'> " . $product['store_quantity'] . "</strong>";
                                                } else if ($product['store_quantity'] > 20) {
                                                    echo "<strong class='text-success ml-2'>" . $product['store_quantity'] . "</strong>";
                                                } ?>
                                            </td>
                                            <td><?php echo $product['category']; ?></td>
                                            <td><?php echo str_replace('-', ' ', $product['subCategory']); ?></td>
                                            <td><?php echo $product['date_created']; ?></td>

                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Selling Price</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Date Created</th>
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