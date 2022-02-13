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
                    </div>

                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-4 mt-3">
                <div class="card">
                    <div class="card-body bg-primary">
                        <a href="<?php echo base_url() ?>add_sale">
                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                <i class="fa fa-shopping-cart fs-100 icons card-liner-icon text-white"> </i>
                                <div class='card-liner-content'><br><br>
                                    <h3 class="text-white">New</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>




            <div class="col-12 col-sm-6 col-xl-4 mt-3">
                <div class="card">
                    <div class="card-body bg-dark">
                        <a href="<?php echo base_url() ?>sales">
                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                <i class="fa fa-history fs-100 icons card-liner-icon text-white"> </i>
                                <div class='card-liner-content'><br><br>
                                    <h3 class="text-white">History</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4 mt-3">
                <div class="card">
                    <div class="card-body bg-dark">
                        <a href="<?php echo base_url() ?>clients">
                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                <i class="fa fa-users fs-100 icons card-liner-icon text-white"> </i>
                                <div class='card-liner-content'><br><br>
                                    <h3 class="text-white">Customers</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <div class="col-12 col-sm-6 col-xl-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <i class="icon-basket icons card-liner-icon mt-2"></i>
                            <div class='card-liner-content'>
                                <?php
                                $this->db->group_by('invoice_no');
                                $this->db->where('sold_by', $staff['uniqueId']);
                                $sales = $this->db->get('pos_orders')->num_rows();
                                ?>
                                <h1 class="card-liner-title">
                                    <?php echo shortNumber(0 + $sales) ?>
                                </h1>
                                <h6 class="card-liner-subtitle">Total Sales</h6>

                            </div>
                        </div>
                        <div id="apex_today_order"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <i class="fa fa-shopping-basket icons card-liner-icon mt-2"></i>
                            <div class='card-liner-content'>
                                <h1 class="card-liner-title"><b>
                                        <?php
                                        $ec = 0;
                                        $this->db->group_by('invoice_no');
                                        $this->db->where('sold_by', $staff['uniqueId']);
                                        $sales = $this->db->get('pos_orders')->result_array();
                                        foreach ($sales as $sale) {
                                            $ec = $ec + $this->db->get_where('pos_order_items', array('invoice_no' => $sale['invoice_no']))->num_rows();
                                        }
                                        echo shortNumber(0 + $ec);
                                        ?>
                                    </b></h1>
                                <h6 class="card-liner-subtitle">Total Item Sold</h6>
                            </div>
                        </div>
                        <span class="bg-primary card-liner-absolute-icon text-white card-liner-small-tip"> </span>
                        <div id="apex_today_visitors"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <i class="icon-bag icons card-liner-icon mt-2"></i>
                            <div class='card-liner-content'>
                                <?php
                                $this->db->where('sold_by', $staff['uniqueId']);
                                $this->db->select_sum('subTotal');
                                $saleToday = $this->db->get('pos_orders')->row_array();
                                ?>
                                <h1 class="card-liner-title">₦<?php echo number_format($saleToday['subTotal']); ?>.00</h1>
                                <h6 class="card-liner-subtitle">Total Sale</h6>
                            </div>
                        </div>
                        <div id="apex_today_sale"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <span class="card-liner-icon mt-1"><i class="fa fa-money-check"></i></span>
                            <div class='card-liner-content'>
                                <?php
                                $this->db->where('sold_by', $staff['uniqueId']);
                                $this->db->select_sum('totalProfit');
                                $totalProfit = $this->db->get('pos_orders')->row_array();
                                ?>
                                <h2 class="card-liner-title">₦<?php echo number_format($totalProfit['totalProfit']); ?>.00</h2>
                                <h6 class="card-liner-subtitle">Total Profit</h6>
                            </div>
                        </div>
                        <div id="apex_today_profit"></div>
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