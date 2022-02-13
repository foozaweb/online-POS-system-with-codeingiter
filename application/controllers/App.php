<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
// error_reporting(E_ERROR | E_PARSE);


class App extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Africa/Lagos');
        $this->load->model('AppModel');
    }

    function lib($page = 'index')
    {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            redirect('app/error');
        }
        $data['chat_url'] = 'https://chatv2.chbluxury.com.ng/';
        $data['admin_url'] = 'https://admin.chbluxury.com.ng/';
        $data['user_url'] = 'https://chbluxury.com.ng/';
        $data['webpage'] = 'app/' . $page;
        $data['staff'] = $this->AppModel->getLoginAccount();
        $data['pType'] = $this->AppModel->getPType();
        $data['cat'] = $this->AppModel->getCategory();
        $data['title'] = 'CHB POS | ' . ucfirst($page);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('auth/conn', $data);
    }

    function invoice($ref)
    {
        $data['chat_url'] = 'https://chatv2.chbluxury.com.ng/';
        $data['admin_url'] = 'https://admin.chbluxury.com.ng/';
        $data['user_url'] = 'https://chbluxury.com.ng/';
        $data['webpage'] = 'app/invoice';
        $data['staff'] = $this->AppModel->getLoginAccount();
        $data['pType'] = $this->AppModel->getPType();
        $data['invoice'] = $this->AppModel->getInvoice($ref);
        $data['cat'] = $this->AppModel->getCategory();
        $data['title'] = 'CHB POS | INVOICE';
        $this->load->view('pages/invoice', $data);
        $this->load->view('auth/conn', $data);
    }

    function editProduct($id)
    {
        $data['chat_url'] = 'https://chatv2.chbluxury.com.ng/';
        $data['admin_url'] = 'https://admin.chbluxury.com.ng/';
        $data['user_url'] = 'https://chbluxury.com.ng/';
        $data['webpage'] = 'app/product';
        $data['staff'] = $this->AppModel->getLoginAccount();
        $data['pType'] = $this->AppModel->getPType();
        $data['product'] = $this->AppModel->getProduct($id);
        $data['cat'] = $this->AppModel->getCategory();
        $data['title'] = 'EDIT PRODUCT | ' . $data['product']['product_name'];
        $this->load->view('pages/product_edit', $data);
        $this->load->view('auth/conn', $data);
    }


    function error()
    {
        $data['title'] = 'Page not found!';
        $this->load->view('auth/404', $data);
    }


    function addCategory()
    {
        if ($data = $this->AppModel->addCategory()) {
            echo json_encode($data);
        }
    }

    function removeCat()
    {
        if ($data = $this->AppModel->removeCat()) {
            echo json_encode($data);
        }
    }

    function submitProduct()
    {
        if ($data = $this->AppModel->submitProduct()) {
            echo json_encode($data);
        }
    }

    function registerSupplier()
    {
        if ($this->AppModel->registerSupplier()) {
            redirect(base_url() . 'suppliers');
        } else {
            redirect(base_url() . 'suppliers');
        }
    }

    function thereIsAnActivity()
    {
        $activity = $this->input->post('activity');
        if ($data = $this->AppModel->thereIsAnActivity($activity)) {
            echo json_encode($data);
        }
    }


    function getSubCategory()
    {
        if ($data = $this->AppModel->getSubCategory()) {
            echo json_encode($data);
        }
    }

    function addSubCategory()
    {
        if ($data = $this->AppModel->addSubCategory()) {
            echo json_encode($data);
        }
    }

    function removeSubCat()
    {
        if ($data = $this->AppModel->removeSubCat()) {
            echo json_encode($data);
        }
    }

    function addProductBrand()
    {
        if ($data = $this->AppModel->addProductBrand()) {
            echo json_encode($data);
        }
    }
    function RemoveProductBrand()
    {
        if ($data = $this->AppModel->RemoveProductBrand()) {
            echo json_encode($data);
        }
    }
    function updateOrder()
    {
        if ($data = $this->AppModel->updateOrder()) {
            echo json_encode($data);
        }
    }
    function fetchProduct()
    {
        if ($data = $this->AppModel->fetchProduct()) {
            echo json_encode($data);
        }
    }

    function registerOffice()
    {
        if ($this->AppModel->registerOffice()) {
            redirect(base_url() . 'office');
        } else {
            $this->session->set_flashdata('alert_danger', 'There was an error registering office');
            $this->goBack();
        }
    }

    function registerCustomer()
    {
        if ($this->AppModel->registerCustomer()) {
            redirect(base_url() . 'clients');
        } else {
            $this->session->set_flashdata('alert_danger', 'There was an error registering customer');
            $this->goBack();
        }
    }

    function deleteSupplier($id)
    {
        if ($this->AppModel->deleteSupplier($id)) {
            $this->session->set_flashdata('alert_success', 'Supplier Successfully Deleted');
            redirect(base_url() . 'suppliers');
        } else {
            $this->session->set_flashdata('alert_danger', 'There was an error deleting Supplier');
            $this->goBack();
        }
    }

    function trashCus($id)
    {
        if ($this->AppModel->trashCus($id)) {
            redirect(base_url() . 'clients');
        } else {
            $this->session->set_flashdata('alert_danger', 'There was an error registering office');
            $this->goBack();
        }
    }

    function submitInvoice()
    {
        if ($data = $this->AppModel->submitInvoice()) {
            echo json_encode($data);
        }
    }

    function request_stock()
    {
        if ($this->AppModel->request_stock()) {
            redirect(base_url() . 'request_stock');
        } else {
            $this->session->set_flashdata('alert_danger', 'There was an error sending request');
            $this->goBack();
        }
    }

    function runBulkRequest()
    {
        if ($data = $this->AppModel->runBulkRequest()) {
            echo json_encode($data);
        }
    }

    function make_payment()
    {
        $invoiceId = $this->input->post('invoiceId');
        if ($this->AppModel->make_payment()) {
            redirect(base_url() . 'app/invoice/' . $invoiceId);
        } else {
            $this->session->set_flashdata('alert_danger', 'There was an error processing your last instruction');
            $this->goBack();
        }
    }



    function finishTransaction($invoice_no){ 
        if ($this->AppModel->finishTransaction($invoice_no)) {
            redirect(base_url() . 'app/invoice/' . $invoice_no);
        } else {
            $this->session->set_flashdata('alert_danger', 'There was an error processing your last instruction');
            $this->goBack();
        }
    }

















    function goBack()
    {
?>
        <script>
            window.history.back();
        </script>
<?php
    }
}
