<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('adminmodel');
        //$this->form_validation->CI =& $this;
        
    }

    public function index() {
        if ($this->session->userdata('userID')) {
            redirect(base_url() . 'admin/adminuser');
        }
        $this->layout->setLayout('adminLogin');
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "POST":
                $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
                $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
                if ($this->form_validation->run()) {
                    $username = trim($this->input->post('username', true));
                    $password = trim($this->input->post('password', true));
                    $sessionData = $this->adminmodel->logins($username, $password);
                    if ($sessionData) {
                        if ($sessionData['user_type'] == 1) {
                            redirect(base_url() . 'admin/adminuser');
                        } else {
                            redirect(base_url() . 'admin/user');
                        }
                    } else {
                        $this->data['error'] = '<p class="error">Username & password do not match.</p>';
                    }
                }
                break;
            case "GET":

                break;
        }
        $this->layout->view('index', $this->data);
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }
}

