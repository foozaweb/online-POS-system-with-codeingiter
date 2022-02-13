<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>

<!-- END: Main Menu-->
<!-- START: Main Content-->
<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row">
            <div class="col-12 align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto">
                        <h4 class="mb-0">Update Product</h4>
                    </div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active"><a href="#">Update Product</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 col-md-3 mt-3"></div>
                            <div class="col-6 col-md-6 mt-3">
                                <div class="card">
                                    <a href="javascript:void(0);" class="toggle_ecommerce_tab" data-obj="ecommerce_detail_section">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h4 class="card-title">Product Information</h4>
                                            <small>Fill all information Below</small>
                                        </div>
                                    </a>
                                    <div class="card-body ecommerce_detail_section">

                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="tab1">
                                                <div class="form">
                                                    <div class="form-group">
                                                        <label class="">Product Name</label>
                                                        <input type="text" required class="myField validate form-control bg-transparent" placeholder="" name="product_name" value="<?php echo $product['product_name'] ?>">
                                                        <small class="form-text">Only letters, numbers, and underscores are allowed.</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="">Available Quantity</label>
                                                        <input type="number" required class="myField validate form-control bg-transparent" placeholder="100" name="quantity" value="<?php echo $product['quantity'] ?>">
                                                        <small class="form-text">Only letters, numbers, and underscores are allowed.</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="">Arrival Date</label>
                                                        <input type="date" required class="myField validate form-control bg-transparent" name="arrivalDate" value="<?php echo $product['arrivalDate'] ?>">
                                                        <small class="form-text">Only date format allowed.</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="">Expiry Date</label>
                                                        <input type="date" required class="myField validate form-control bg-transparent" name="expiryDate" value="<?php echo $product['expiryDate'] ?>">
                                                        <small class="form-text">Only date format allowed.</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="">Product category</label>
                                                        <div class="flex-display">
                                                            <select name="category" id="catSelect" class="myField validate form-control bg-transparent">
                                                                <option value="" disabled>Select Category</option>
                                                                <?php foreach ($cat as $cat) { ?>
                                                                    <option <?php if ($product['category'] == $cat['cat_slug']) {
                                                                                echo "selected";
                                                                            } ?> value="<?php echo $cat['cat_slug'] ?>"><?php echo $cat['cat'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="">Product Sub Category</label>
                                                        <div class="flex-display">
                                                            <select name="subCategory" id="subCatSelect" class="myField form-control bg-transparent">
                                                                <option value="<?php echo $product['subCategory'] ?>" selected><?php echo str_replace('-', ' ', $product['subCategory']) ?></option>

                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="">Product Brand</label>
                                                        <div class="flex-display">
                                                            <select name="productBrand" id="productBrandSelect" class="myField form-control bg-transparent">
                                                                <option value="" disabled>Select Product Brand</option>
                                                                <?php foreach ($pType as $p) { ?>
                                                                    <option <?php if ($product['productBrand'] == $p['p_brand_slug']) {
                                                                                echo "selected";
                                                                            } ?> value="<?php echo $p['p_brand_slug'] ?>"><?php echo $p['p_brand_name'] ?></option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>
                                                    </div>



                                                    <div class="form-group">
                                                        <label class="">Supplier</label>
                                                        <div class="flex-display">
                                                            <select name="productSupplier" id="productSupplierSelect" required class="myField form-control bg-transparent">
                                                                <option value="" selected disabled>Select Supplier</option>
                                                                <?php
                                                                foreach ($this->db->get('chb_supplier')->result_array() as $sup) { ?>
                                                                    <option <?php if ($product['productSupplier'] == $sup['supplier_id']) {
                                                                                echo "selected";
                                                                            } ?> value="<?php echo $sup['supplier_id'] ?>"><?php echo $sup['supplier_name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="">Purchase Price</label>
                                                        <input type="number" required class="myField validate form-control bg-transparent" placeholder="Purchase Price" name="purchase_price" value="<?php echo $product['purchase_price'] ?>">
                                                        <small class="form-text">Only numbers, are allowed.</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="">Selling Price</label>
                                                        <input type="number" required class="myField validate form-control bg-transparent" placeholder="Selling Price" name="selling_price" value="<?php echo $product['selling_price'] ?>">
                                                        <small class="form-text">Only numbers are allowed.</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="">Product Description</label>
                                                        <textarea cols="10" rows="4" required class="form-control bg-transparent validate" placeholder="" name="productDesc" id="productDesc">
                                                        <?php echo $product['productDesc'] ?> </textarea>
                                                        <small class="form-text">Brief Description</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="">Product ID</label>
                                                        <input type="text" required class="form-control bg-transparent validate" value="<?php echo $product['productId'] ?>" readonly name="productId">
                                                        <small class="form-text">Readonly</small>
                                                    </div>

                                                    <button type="button" class="submitProduct btn float-right btn-success"><i class="fa fa-check"></i> Submit Product Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<?php $this->load->view('template/footer'); ?>
<script src="<?php echo base_url() ?>dist/js/product_upload.js"></script>