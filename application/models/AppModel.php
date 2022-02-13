<?php

class AppModel extends CI_Model
{
	public function sendMail($msg, $email, $subject, $logo, $signout, $sender)
	{
		$localhost = array('::1', '127.0.0.1', 'localhost');
		$protocol = 'mail';
		if (in_array($_SERVER['REMOTE_ADDR'], $localhost)) {
			$protocol = 'smtp';
		}
		// ##############################################################
		// parameters
		// ##############################################################
		$mailToSend = ' 
				<html> 
				<head>   
				    <link href="http://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css"> 
				    <style>
				    	.theme-bg-primary-darken {
							background-color: none; 
						}
						.container,
						.container-fluid,
						.container-xxl,
						.container-xl,
						.container-lg,
						.container-md,
						.container-sm {
							width: 100%;  
						} 
						.section-intro{
							padding:5px 10px 5px 10px;
						}
						.footer {
							background: #434e5e;
							padding:10px;
							text-align:center;
							color:#fff;
							border-radius:5px;
						}
						.py-5 {
							padding-top: 3rem !important;
							padding-bottom: 3rem !important;
						}
						.font-weight-bold {
							font-weight: 700 !important;
							text-align: center;
						}
						.mb-3 {
							margin-bottom: 1rem !important;
						}
						.mx-auto {
							margin-right: auto !important;
							margin-left: auto !important;
						}
						.mb-5 {
							margin-bottom: 3rem !important;
						}
						.text-secondary {
							color: #58677c !important;
						}
						 
				    </style>
				</head>

				<body>  
					<div class="container"> 
						<a class="nav-link nav-index" href="">' . $logo . '</a>
					</div>   
					<hr>
					<hr><br>

					<section class="skills-section section py-3">
						<div class="container"> 
							<div class="section-intro mx-auto text-center mb-5 text-secondary">' . $msg . '</div> 
						</div> 
					</section> 

					<footer class="footer text-light text-center py-2"> 
						<small class="copyright"> Copyright &copy;' . date('Y') . '</small>
					</footer> 
                </body>
            	</html> ';
		// ##############################################################
		$config = array(
			'protocol' => $protocol,
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => '',
			'smtp_pass' => '',
			'mailtype' => 'html',
			'starttls'  => true,
			'newline'   => "\r\n",
		);
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->from($sender);
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($mailToSend);
		$flag = $this->email->send();
		if ($flag) {
			return $flag;
		} else {
			return false;
		}
	}

	function getCategory()
	{
		$this->db->order_by('cat_id', 'desc');
		return $this->db->get('chb_category')->result_array();
	}




	function getSubCategory()
	{
		$this->db->order_by('sub_cat_id', 'desc');
		$this->db->where(array('catName' => $this->input->post('cat')));
		return $this->db->get('pos_sub_category')->result_array();
	}

	function addSubCategory()
	{
		$check = $this->db->get_where('pos_sub_category', array('sub_cat_slug' => url_title($this->input->post('subCatName')), 'sub_cat' => $this->input->post('subCatName'), 'catName' => $this->input->post('catName')));
		if ($check->num_rows() > 0) {
			$this->db->where(array('sub_cat_slug' => url_title($this->input->post('subCatName')), 'sub_cat' => $this->input->post('subCatName'), 'catName' => $this->input->post('catName')));
			$this->db->update('pos_sub_category', array('sub_cat_slug' => url_title($this->input->post('subCatName')), 'sub_cat' => $this->input->post('subCatName'), 'catName' => $this->input->post('catName')));
		} else {
			$this->db->insert('pos_sub_category', array('sub_cat_slug' => url_title($this->input->post('subCatName')), 'sub_cat' => $this->input->post('subCatName'), 'catName' => $this->input->post('catName')));
			return "successful";
		}
	}

	function removeSubCat()
	{
		$this->db->where('sub_cat_slug', $this->input->post('subCat'));
		return $this->db->delete('pos_sub_category');
	}

	// ################################################################################################
	// ################################################################################################



	function thereIsAnActivity($activity)
	{
		$uniqueId = $this->session->userdata('uniqueId');
		$row = $this->db->get_where('chbadmin', array('uniqueId' => $uniqueId))->row_array();
		$name = $row['name'];
		return $this->db->insert('chb_activity', array('activity' => $name . ' ' . $activity, 'uniqueId' => $uniqueId, 'act_date' => date('d M Y H:i:s a')));
	}

	function getPType()
	{
		$this->db->order_by('p_brand_id', 'desc');
		return $this->db->get('chb_product_brand')->result_array();
	}



	function getInvoice($ref)
	{
		$this->db->join('chbadmin', 'chbadmin.uniqueId = pos_orders.sold_by', 'left');
		$this->db->join('chb_offices', 'chb_offices.office_id = chbadmin.office', 'left');
		$this->db->join('pos_customers', 'pos_customers.customer_id = pos_orders.customer', 'left');
		$this->db->where('pos_orders.invoice_no', $ref);
		return $this->db->get('pos_orders')->row_array();
	}

	function registerSupplier()
	{
		$supplier_name = $this->input->post('supplier_name');
		$supplier_address = $this->input->post('supplier_address');
		$contact_person = $this->input->post('contact_person');
		$supplier_phone = $this->input->post('supplier_phone');
		$data = array(
			'supplier_name' => $supplier_name,
			'supplier_address' => $supplier_address,
			'contact_person' => $contact_person,
			'supplier_phone' => $supplier_phone,
			'date_registered' => date('D d M Y, H:i:s a'),
		);

		$check = $this->db->get_where('chb_supplier', array('supplier_name' => $supplier_name));
		if ($check->num_rows() > 0) {
			$this->db->where(array('supplier_name' => $supplier_name));
			$this->db->update('chb_supplier', $data);
		} else {
			$this->session->set_flashdata('alert_success', 'Supplier has been registered');
			$this->db->insert('chb_supplier', $data);
			return $this->thereIsAnActivity('Registered New Supplier');
		}
	}


	function deleteSupplier($id)
	{
		$this->db->where(array('supplier_id' => $id));
		$this->db->delete('chb_supplier');
		return $this->thereIsAnActivity('Deleted a Supplier');
	}

	function getCustomer($id)
	{
		$this->db->join('pos_wallet', 'pos_wallet.customer_id = pos_customers.customer_id', 'left');
		$this->db->where(array('pos_customers.customer_id' => $id));
		return $this->db->get('pos_customers')->row_array();
	}

	function getProduct($id)
	{
		$uniqueId = $this->session->userdata('uniqueId');
		$staff = $this->db->get_where('chbadmin', array('uniqueId' => $uniqueId))->row_array()['office'];
		$store_id = $this->db->get_where('chb_offices', array('office_id' => $staff))->row_array()['store_id'];



		$this->db->join('chb_products', 'chb_products.productId = chb_office_products.product_id', 'left');
		$this->db->join('chbadmin', 'chbadmin.uniqueId = chb_products.uploaded_by', 'left');
		$this->db->where(array('chb_office_products.product_' => $id, 'chb_office_products.store_id' => $store_id));
		return $this->db->get('chb_office_products')->row_array();
	}

	function fetchProduct()
	{
		$uniqueId = $this->session->userdata('uniqueId');
		$staff = $this->db->get_where('chbadmin', array('uniqueId' => $uniqueId))->row_array()['office'];
		$office = $this->db->get_where('chb_offices', array('office_id' => $staff))->row_array()['store_id'];
		$this->db->join('chb_products', 'chb_products.productId = chb_office_products.product_id');
		$this->db->group_by('chb_office_products.product_id');
		$this->db->like('chb_products.product_name', $this->input->post('search'));
		$this->db->where('chb_office_products.store_id', $office);
		return $this->db->get('chb_office_products')->result_array();
	}

	function getLoginAccount()
	{
		$uniqueId = $this->session->userdata('uniqueId');
		$this->db->join('chb_offices', 'chb_offices.office_id = chbadmin.office', 'left');
		return $this->db->get_where('chbadmin', array('chbadmin.uniqueId' => $uniqueId))->row_array();
	}


	function make_payment()
	{
		$stats = '0';
		$invoiceId = $this->input->post('invoiceId');
		$paymentMethod = $this->input->post('paymentMethod');
		$payment_amount = $this->input->post('payment_amount');

		$res = $this->db->get_where('pos_orders', array('invoice_no' => $invoiceId))->row_array();
		$cus = $res['customer'];
		$total_paid = $res['total_paid'];

		if (intval($total_paid + $payment_amount) >= intval($res['grandTotal'])) {
			$stats = '1';
		} else if (intval($total_paid + $payment_amount) < intval($res['grandTotal'])) {
			$stats = '0';
		}
		$installment_data = array(
			'invoice_no' => $invoiceId,
			'amount_paid' => $payment_amount,
			'date_paid' => date('D d M Y'),
			'customer_id' => $cus,
			'paymentMethod' => $paymentMethod
		);
		$this->db->insert('pos_payments', $installment_data);

		$this->thereIsAnActivity('made payment for an invoice with Id: ' . $invoiceId);
		$this->db->where('invoice_no', $invoiceId);
		return $this->db->update('pos_orders', array('total_paid' => $total_paid + $payment_amount, 'order_status' => $stats));
	}



	function submitInvoice()
	{
		$extra = 0;
		$order_status = '1';
		$uniqueId = $this->session->userdata('uniqueId');
		$staff = $this->db->get_where('chbadmin', array('uniqueId' => $uniqueId))->row_array()['office'];
		$store_id = $this->db->get_where('chb_offices', array('office_id' => $staff))->row_array()['store_id'];

		$invoiceNo = $this->input->post('invoiceNo');
		$itemData = array(
			'invoice_no' => $invoiceNo,
			'product_id' => $this->input->post('cartProductId'),
			'quantity' => $this->input->post('cartQty'),
			'amount' => $this->input->post('cartPrice'),
			'profit' => $this->input->post('cartPft')
		);

		$installment_data = array(
			'invoice_no' => $invoiceNo,
			'amount_paid' => $this->input->post('first_installment'),
			'date_paid' => date('D d M Y'),
			'customer_id' => $this->input->post('customer'),
			'paymentMethod' => $this->input->post('paymentMethod')
		);

		if ($this->input->post('transactionType') == 'i') {
			$this->db->insert('pos_payments', $installment_data);
			$extra = 10 / 100 * $this->input->post('subTotal');
			$order_status = 0;
		}

		$orderData = array(
			'invoice_no' => $invoiceNo,
			'customer' => $this->input->post('customer'),
			'order_note' => $this->input->post('orderNote'),
			'subTotal' => $this->input->post('subTotal'),
			'grandTotal' => $this->input->post('subTotal') + $extra,
			'payment_method' => $this->input->post('paymentMethod'),
			'order_month' => date('m'),
			'order_year' => date('Y'),
			'order_date' => date('D d M Y, H:i:s a'),
			'sold_by' => $uniqueId,
			'totalProfit' => $this->input->post('totalProfit'),
			'totalQty' => $this->input->post('totalQty'),
			'transactionType' => $this->input->post('transactionType'),
			'extra' => $extra,
			'total_paid' => $this->input->post('first_installment'),
			'order_status' => $order_status,
			'store_id' => $store_id
		);

		$check = $this->db->get_where('pos_order_items', $itemData);
		if ($check->num_rows() > 0) {
			$this->db->where($itemData);
			$this->db->update('pos_order_items', $itemData);
		} else {
			$stock = 0 + $this->db->get_where('chb_office_products', array('product_id' => $this->input->post('cartProductId'), 'store_id' => $store_id))->row_array()['store_quantity'];
			if ($stock > 0) {
				$newQty = $stock - $this->input->post('cartQty');
			} else {
				$newQty = '0';
			}
			$this->db->where(array('product_id' => $this->input->post('cartProductId'), 'store_id' => $store_id));
			$this->db->update('chb_office_products', array('store_quantity' => $newQty));
			$this->db->insert('pos_order_items', $itemData);
		}

		$check1 = $this->db->get_where('pos_orders', array('invoice_no' => $invoiceNo));
		if ($check1->num_rows() > 0) {
			$this->db->where(array('invoice_no' => $invoiceNo));
			$this->db->update('pos_orders', $orderData);
		} else {
			$this->db->insert('pos_orders', $orderData);
			$this->thereIsAnActivity('Made new Sale with invoice No: ' . $invoiceNo);
		}
		return true;
	}


	function trashCus($id)
	{
		$this->thereIsAnActivity('Deleted a customer wit ID: ' . $id);
		$this->db->where('customer_id', $id);
		return $this->db->delete('pos_customers');
	}



	function registerCustomer()
	{

		$this->db->order_by('id', 'desc');
		$ids = $this->db->get('pos_customers')->row_array();
		$cid = 0 + $ids['id'] + 1;

		$email = $this->input->post('email');
		$data = array(
			'customer_id' => 'C' . str_pad($cid, 5, '0', STR_PAD_LEFT),
			'customer_name' => $this->input->post('customer_name'),
			'customer_address' => $this->input->post('customer_address'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('customer_phone'),
			'date_created' => date('D d M Y, H:i:s a'),
			'month_created' => date('Y'),
			'year_created' => date('Y')
		);
		$check = $this->db->get_where('pos_customers', array('email' => $email));
		if ($check->num_rows() > 0) {
			$this->db->where(array('email' => $email));
			$this->db->update('pos_customers', $data);
		} else {
			$this->session->set_flashdata('alert_success', 'Customer has been registered');
			$this->db->insert('pos_customers', $data);
			return $this->thereIsAnActivity('Registered New Customer');
		}
	}

	function request_stock()
	{
		$product_id = $this->input->post('request_product_id');
		$office = $this->input->post('request_staff_office');
		$quantity = $this->input->post('request_quantity');
		$store_id = $this->db->get_where('chb_offices', array('office_id' => $office))->row_array()['store_id'];
		$data = array(
			'product_id' => $product_id,
			'store_id' => $store_id,
			'request_quantity' => $quantity,
			'request_date' => date('D d M Y, H:i:s a'),
		);
		$this->session->set_flashdata('alert_success', 'Stock request successfully Placed');
		$this->db->insert('chb_product_request', $data);
		return $this->thereIsAnActivity('Requested a new stock with ID: ' . $product_id);
	}

	function runBulkRequest()
	{
		$product_id = $this->input->post('product_id');
		$office = $this->input->post('staff_office_bulk');
		$quantity = $this->input->post('quantity');
		$store_id = $this->db->get_where('chb_offices', array('office_id' => $office))->row_array()['store_id'];
		$data = array(
			'product_id' => $product_id,
			'store_id' => $store_id,
			'request_quantity' => $quantity,
			'request_date' => date('D d M Y, H:i:s a'),
		);
		$this->session->set_flashdata('alert_success', 'Stock request successfully Placed');
		$this->db->insert('chb_product_request', $data);
		return $this->thereIsAnActivity('Requested a new stock with ID: ' . $product_id);
	}


	function finishTransaction($invoice_no)
	{
		$this->db->where('invoice_no', $invoice_no);
		$this->db->update('pos_orders', array('order_status' => '1'));
		return $this->thereIsAnActivity('finished a transaction with ID: ' . $invoice_no);
	}
}
