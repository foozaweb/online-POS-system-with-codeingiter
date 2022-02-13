<script>
    setTimeout(() => {
        for (let i = 0; i < 13; i++) {
            var sum = 0;
            var sales = parseFloat($(".grandTotalHtml" + [i]).html());
            $('table').find(".purchase" + [i]).each(function() {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            $('table').find(".purchaseHtml" + [i]).html(formatMoney(0 + sum));
            $('.grandTotalHtml' + [i]).html(formatMoney(0 + sales));
        }

        var sum = 0;
        var sales = parseFloat($(".grandTotalHtml").html());
        $('table').find(".purchase").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $('table').find(".purchaseHtml").html(formatMoney(0 + sum));
        $('.grandTotalHtml').html(formatMoney(0 + sales));
    }, 1000);

    $(function() {
        var sum = 0;
        var sales = parseFloat($(".salesToday").html());
        $('.card-liner-content').find(".purch").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $('.card-liner-content').find(".showProfit").html(formatMoney(0 + sum));
        $('.salesToday').html(formatMoney(0 + sales));
    });

    $(function() {
        var sum = 0;
        var sales = parseFloat($(".salesThisMonth").html());
        $('.card-liner-content').find(".purch2").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $('.card-liner-content').find(".showProfit2").html(formatMoney(0 + sum));
        $('.salesThisMonth').html(formatMoney(0 + sales));
    });


    $(function() {
        var sum = 0;
        var sales = parseFloat($(".salesThisYear").html());
        $('.card-liner-content').find(".purch3").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $('.card-liner-content').find(".showProfit3").html(formatMoney(0 + sum));
        $('.salesThisYear').html(formatMoney(0 + sales));
    });


    function formatMoney(number) {
        return number.toLocaleString('en-US', {
            style: 'currency',
            currency: 'NGN'
        });
    }

    $('[name="invoice_order_status"]').on('change', function() {
        var status = $(this).val();
        var reference = $(this).data('ref');
        $.ajax({
            url: "<?php echo base_url() ?>app/updateOrder",
            type: "post",
            dataType: "json",
            data: {
                status: status,
                reference: reference
            },
            success: function(data) {
                window.location.reload();
            }
        });
    });



    $('tbody').on('click', '.deleteSupplier', function() {
        if (confirm("Are you sure?")) {
            window.location.href = $(this).data('url');
        }
    });






















    var autoLogoutTimer;
    resetTimer();
    $(document).on('mouseover mousedown touchstart click keydown mousewheel DDMouseScroll wheel scroll', document, function(e) {
        resetTimer();
    });

    function resetTimer() {
        clearTimeout(autoLogoutTimer);
        autoLogoutTimer = setTimeout(idleLogout, 600000);
    }

    function idleLogout() {
        window.location.href = '<?php echo base_url() ?>auth/lockScreen';
    }
</script>





























<script>
    $('[name="first_installment"]').on('keyup', function() {
        var sTotal = parseInt($('#subTotal').val());
        var extra = 10 / 100 * sTotal;
        var calc = parseInt(sTotal + extra) - parseInt($(this).val());
        $('.remaining_balance').html(formatMoney(calc));
    });

    $('#transactionType').on('change', function() {
        var selected = $(this).val();
        var sTotal = parseInt($('#subTotal').val());
        if (selected === 'i') {
            $('.installmentDiv').fadeIn();
            $('[name="first_installment"]').val('');
            var extra = 10 / 100 * sTotal;
            $('.totalToPay').html('Customer to pay a total of ' + formatMoney(parseInt(extra + sTotal)));
        } else {
            $('.installmentDiv').fadeOut();
            $('[name="first_installment"]').val('');
        }
    });



    var sn = '';
    var qty = '';
    $('.btnAddProduct').on('click', function() {
        var sn = $('#tBody tr').length + 1;
        // sn++;
        var name = $('#searchText').val();
        var desc = $('#selectedProductDesc').val();
        var pId = $('#selectedProductId').val();
        var price = $('#selectedProductSellingPrice').val();
        var profit = $('#selectedProductProfit').val();
        var availableQty = $('#availableQty').val();
        qty = $('#qty').val();
        if (parseInt(qty) > parseInt(availableQty)) {
            qty = availableQty;
            toastr.error("This Product has just " + availableQty + " Pieces Available. We have set the your order to " + availableQty);
        } else {
            qty = $('#qty').val();
        }
        var html = '<tr class="cartRow" id="row' + sn + '">' +
            '<td>' + sn + '</td>' +
            '<td class="cart' + sn + '" data-id="' + pId + '" data-qty="' + qty + '" data-price="' + qty * price + '" data-profit="' + qty * profit + '">' + name + '</td>' +
            '<td>' + desc + '</td>' +
            '<td class="cartQty">' + qty + '</td>' +
            '<td class="cartPrice">' + qty * price + '</td>' +
            '<td class="cartPft avoid-this">' + qty * profit + '</td>' +
            '<td class="avoid-this"><button class="btn btn-danger removeCart" data-target="row' + sn + '"><i class="fa fa-trash"></i></button</td>' +
            '</tr>';

        // if value found, append data to table
        if (name != "" && desc != "" && price != "" && profit != "" && qty != "") {
            $('#tBody').append(html);
        } else {
            toastr.error('Select Product to Append');
        }
        $('#searchText').val('');
        $('#selectedProductName').val('');
        $('#selectedProductDesc').val('');
        $('#selectedProductSellingPrice').val('');
        $('#selectedProductProfit').val('');
        $('#availableQty').val('');
        $('#qty').val('1');
        calculateTotals();
        $('#searchText').focus();
        
        
        var selected =  $('#transactionType').val();
        var sTotal = parseInt($('#subTotal').val());
        if (selected === 'i') {
            $('.installmentDiv').fadeIn();
            $('[name="first_installment"]').val('');
            var extra = 10 / 100 * sTotal;
            $('.totalToPay').html('Customer to pay a total of ' + formatMoney(parseInt(extra + sTotal)));
        } else {
            $('.installmentDiv').fadeOut();
            $('[name="first_installment"]').val('');
        } 
    });


    $('#searchText').focus();
    $('#searchText').on('change', function() {
        searches($(this).val());
    });

    $('#searchText').on('keyup', function() {
        searches($(this).val());
    });

    $('.sBtn').on('keyup', function() {
        searches($('#searchText').val());
    });


    $('.showResult').on('click', '.pid', function() {
        $('#searchText').val($(this).data('name'));
        $('#selectedProductId').val($(this).data('id'));
        $('#selectedProductDesc').val($(this).data('desc'));
        $('#selectedProductSellingPrice').val($(this).data('price'));
        $('#selectedProductProfit').val($(this).data('profit'));
        $('#availableQty').val($(this).data('aty'));
        $('.showResult').html('');
        $('.showResult').hide();
        $('.btnAddProduct').fadeIn('slow');
    });


    $('.showResult').on('mouseover', function() {
        $('#searchText').blur();
    });




    function searches(search) {
        if (search) {
            $.ajax({
                url: "<?php echo base_url() ?>app/fetchProduct",
                type: "POST",
                dataType: "JSON",
                data: {
                    search: search
                },
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        if (data[i].store_quantity > 0) {
                            html += '<p><a class="pid" href="javascript:void(0)" data-id="' + data[i].product_id + '" data-profit="' + parseInt(data[i].consumer_price - data[i].purchase_price) + '" data-desc="' + data[i].productDesc.substr(0, 20) + '..." data-price="' + data[i].consumer_price + '" data-name="' + data[i].product_name + '" data-aty="' + data[i].store_quantity + '">' + data[i].product_name + ' | ' + formatMoney(parseInt(data[i].consumer_price)) + ' (' + data[i].store_quantity + ' Pieces Available)</a></p>';
                        } else {
                            html += '<p><a href="javascript:void(0)" data-id="' + data[i].productId + '" data-profit="' + parseInt(data[i].consumer_price - data[i].purchase_price) + '" data-desc="' + data[i].productDesc.substr(0, 20) + '..." data-price="' + data[i].consumer_price + '" data-name="' + data[i].product_name + '" data-aty="' + data[i].store_quantity + '">' + data[i].product_name + ' | ' + formatMoney(parseInt(data[i].consumer_price)) + ' (' + data[i].store_quantity + ' Pieces Available)</a></p>';
                        }

                    }
                    $('.showResult').html(html);
                    $('.showResult').show();
                },
                error: function(data) {
                    $('.showResult').html("No Matching Product '" + search + "' Found");
                    toastr.error("No Matching Product Found");
                }
            });
        } else {
            $('.showResult').html('');
            $('.showResult').hide();
        }
    }


    $('.table').on('click', '.removeCart', function() {
        if (confirm('Are you sure?')) {
            $('table').find('#' + $(this).data('target')).remove();
            calculateTotals();
        }
    });


    var cartPrice = 0;
    var cartQty = 0;
    var cartPft = 0;

    function calculateTotals() {
        // Calculate total price 
        $('#tBody').find(".cartPrice").each(function() {
            cartPrice += parseFloat($(this).html());
        });
        // Calculate total Quantity
        $('#tBody').find(".cartQty").each(function() {
            cartQty += parseFloat($(this).html());
        });
        // Calculate total Profit
        $('#tBody').find(".cartPft").each(function() {
            cartPft += parseFloat($(this).html());
        });
        // assign each calculations to respective fields and show symbol
        $('#totalQty').html(cartQty);
        $('#totalAmt').html(formatMoney(parseInt(cartPrice)));
        $('#totalPft').html(formatMoney(parseInt(cartPft)));
        $('#subTotal').val(cartPrice);
        $('#subTotalProfit').val(cartPft);

        cartPrice = 0;
        cartQty = 0;
        cartPft = 0;
    }



    $('.print').on('click', function() {
        var tType = '';
        var transactionType = $('#transactionType').val();
        var sTotal = parseInt($('#subTotal').val());
        var tmt = '';
        var extra = 0;
        var iBalance = 0;

        if (transactionType === 'i') {
            extra = 10 / 100 * sTotal;
            tmt = formatMoney(parseInt(sTotal + extra));
            tType = 'Installment';
            iBalance = parseInt(sTotal + extra) - parseInt($('[name="first_installment"').val());
        } else if (transactionType === 'd') {
            tType = 'Deposit';
            tmt = $('#totalAmt').html();
        } else {
            tType = 'Non-Installment';
            tmt = $('#totalAmt').html();
        }

        const prependThis = '<div class="text-center p10">CHBLUXURY<br/> <?php echo $staff['location'] ?> <br>+234 708 242 7348</div> <br><br> <h3><strong>SALES INVOICE</strong></h3> <br> <div class=" text-uppercase p10">BRANCH: <span class="pull-right"><?php echo $staff['office_name'] ?></span><br> ACCOUNT: <span class="pull-right">(' + $('#customer_name').find(':selected').data('name') + ')</span> <br> SOLD BY: <span class="pull-right"><?php echo $staff['name'] ?></span> <br> invoice no: <span class="pull-right">' + $('#invoiceNo').val() + '</span><br> trans. Date: <span class="pull-right"><?php echo date('d-m-Y') ?></span><br> date Posted: <span class="pull-right"><?php echo date('D d M Y H:i:s a') ?></span></div>';

        const appendThis = '<div class="text-uppercase p10"> <hr> Transaction Type: <span class="pull-right">' + tType + '</span> <hr>pos fidelity: <span class="pull-right">' + tmt + '</span> <hr> invoice Total: <span class="pull-right">(' + tmt + ')</span> <hr> invoice Balance: <span class="pull-right">' + formatMoney(iBalance) + '</span>   <hr> Demurrage: <span class="pull-right">' + formatMoney(extra) + '</span>  <br><br><div class="text-center">...Thank you</div></div>';

        $(".table").print({
            globalStyles: true,
            mediaPrint: true,
            stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
            iframe: false,
            noPrintSelector: ".avoid-this",
            prepend: prependThis,
            append: appendThis,
            deferred: $.Deferred().done(function() {
                location.reload();
                // console.log('Printing done', arguments);
            })
        });
    });









    var cartProductId = '';
    var cartQty = '';
    var cartPrice = '';
    var cartPft = '';


    $('.submitInvoice').on('click', function() {
        var paymentMethod = $('#paymentMethod').val();
        var transactionType = $('#transactionType').val();
        var orderNote = $('#orderNote').val();
        var customer = $('#customer_name').val();
        var invoiceNo = $('#invoiceNo').val();
        var totalQty = $('#totalQty').html();
        var subTotal = $('#subTotal').val();
        var totalProfit = $('#subTotalProfit').val();
        var first_installment = $('[name="first_installment"]').val();
        var verified = $('#customer_name').find(':selected').data('verified_customer');

        if (transactionType === 'i') {
            if (customer == '00' || verified === 0) {
                alertMe('Customer not liable for selected transaction type', 6000);
                return false;
            }
            if (!first_installment) {
                alertMe('Please enter first installment payment', 6000);
                return false;
            }
        }


        // alert(paymentMethod + '====' + orderNote + '====' + customer + '====' + invoiceNo + '====' + totalQty + '====' + subTotal + '====' + totalProfit);
        for (let i = 0; i <= $('.cartRow').length; i++) {
            $('.cart' + i).each(function() {
                cartProductId = $(this).data('id');
                cartQty = $(this).data('qty');
                cartPrice = $(this).data('price');
                cartPft = $(this).data('profit');
                $.ajax({
                    url: "<?php echo base_url() ?>app/submitInvoice",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        invoiceNo: invoiceNo,
                        totalQty: totalQty,
                        subTotal: subTotal,
                        totalProfit: totalProfit,
                        cartProductId: cartProductId,
                        cartQty: cartQty,
                        cartPrice: cartPrice,
                        cartPft: cartPft,
                        customer: customer,
                        orderNote: orderNote,
                        paymentMethod: paymentMethod,
                        transactionType: transactionType,
                        first_installment: first_installment
                    },
                    success: function(data) {
                        if (i >= $('.cartRow').length) {
                            $('.print').fadeIn('slow');
                            toastr.success("Successfully submitted");
                            $('.print').click();
                        }
                    },
                });
                cartProductId = '';
                cartQty = '';
                cartPrice = '';
                cartPft = '';
            });
        }
    });
</script>