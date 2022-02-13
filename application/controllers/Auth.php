<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);


class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Africa/Lagos');
    }


    function statics()
    {
        if (!file_exists(APPPATH . 'views/auth/login.php')) {
            redirect('app/error');
        }
        $data['page'] = '';
        $data['title'] = 'CHBLUXURY POS | Login';
        $this->load->view('auth/login', $data);
    }

    function passwordAuth()
    {
        if (!file_exists(APPPATH . 'views/auth/recover_password.php')) {
            redirect('app/error');
        }
        $data['page'] = '';
        $data['title'] = 'Recover Password';
        $this->load->view('auth/recover_password', $data);
    }


    function vE($id)
    {
        if ($this->AuthModel->vE($id)) {
            $this->session->set_flashdata('alert_success', 'Thank you! Your Email has been successfully verified.');
            redirect(base_url() . 'auth/statics');
        }
    }


    function createAccount()
    {
        if (!file_exists(APPPATH . 'views/auth/register.php')) {
            redirect('app/error');
        }
        $data['page'] = '';
        $data['title'] = 'CHBLUXURY POS | Register';
        $this->load->view('auth/register', $data);
    }

    function cA()
    {
        $phone = $this->security->sanitize_filename($this->input->post('phone'));
        $name = $this->security->sanitize_filename($this->input->post('name'));
        $email = $this->security->sanitize_filename($this->input->post('email'));
        $password = $this->security->sanitize_filename(md5($this->input->post('password')));
        if ($this->AuthModel->cA($name, $email, $password, $phone)) {
            redirect(base_url() . 'auth/statics?AccountStatus=1|EmailStatus=0|user=' . str_replace(' ', '', $name));
        } else {
            $this->goBack();
        }
    }

    function registerStaff()
    {
        $name = $this->security->sanitize_filename($this->input->post('staffName'));
        if ($this->AuthModel->registerStaff()) {
            redirect(base_url() . 'staff_add');
        } else {
            $this->goBack();
        }
    }

    function clearScreen()
    {
        $loginId = $this->session->userdata('chbEmail');
        $password = $this->security->sanitize_filename($this->input->post('password'));
        if ($this->AuthModel->access($loginId, $password)) {
            redirect($this->session->userdata('currentUrl'));
        } else {
            $this->goBack();
        }
    }


    function access()
    {
        $loginId = $this->security->sanitize_filename($this->input->post('loginId'));
        $password = $this->security->sanitize_filename($this->input->post('password'));
        if ($this->AuthModel->access($loginId, $password)) {
            redirect(base_url() . 'app/lib?LoginStatus=1');
        } else {
            $this->goBack();
        }
    }

    function change_password()
    {
        if ($this->AuthModel->change_password()) {
            redirect(base_url() . 'my_profile');
        } else {
            $this->goBack();
        }
    }



    public function clearSession()
    {
        $activity = "Logged Out";
        $this->AuthModel->logout();
        if ($this->AuthModel->thereIsAnActivity($activity)) {
            $data['screen_locked']   = $this->session->userdata('screen_locked');
            $data['uniqueId']   = $this->session->userdata('uniqueId');
            $data['accountType']   = $this->session->userdata('accountType');
            $data['chbEmail']   = $this->session->userdata('chbEmail');
            $data['chbAuth']   = $this->session->userdata('chbAuth');
            if ($data['chbAuth'] == TRUE) {
                $array_items = array('uniqueId', 'accountType', 'chbEmail', 'chbAuth', 'screen_locked');
                $this->session->unset_userdata($array_items);
                redirect(base_url());
            } else {
                session_destroy();
                redirect(base_url());
            }
        }
    }


    function lockScreen()
    {
        $data['webpage'] = 'auth/lockscreen';
        $data['staff'] = $this->AuthModel->getLoginAccount();
        $this->session->set_userdata(array('screen_locked' => true));
        $this->load->view('auth/lockscreen', $data);
    }

    public function PhotoUpload()
    {
        if ($_FILES["profile_photo"]["name"] != '') {
            $output = '';
            $config["upload_path"] = 'assets/profile_photo';
            $config["allowed_types"] = '*';
            $config["overwrite"] = TRUE;
            $config["detect_mime"] = TRUE;
            $config["mod_mime_fix"] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            for ($count = 0; $count < count($_FILES["profile_photo"]["name"]); $count++) {
                $_FILES["file"]["name"] = $_FILES["profile_photo"]["name"][$count];
                $_FILES["file"]["type"] = $_FILES["profile_photo"]["type"][$count];
                $_FILES["file"]["tmp_name"] = $_FILES["profile_photo"]["tmp_name"][$count];
                $_FILES["file"]["error"] = $_FILES["profile_photo"]["error"][$count];
                $_FILES["file"]["size"] = $_FILES["profile_photo"]["size"][$count];
                if ($this->upload->do_upload('file')) {
                    $data = $this->upload->data();
                    $output .= $data['file_name'];
                    // $this->AuthModel->PhotoUpload($output);
                }
            }
            echo $output;
        } else {
            return false;
        }
    }




    function otp()
    {
        if ($data = $this->AuthModel->otp()) {
            echo json_encode($data);
        }
    }


    function recover_password()
    {
        if ($this->AuthModel->recover_password()) {
            redirect(base_url() . 'auth/statics');
        } else {
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
