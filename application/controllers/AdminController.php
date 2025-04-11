<?php 
class AdminController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/login');
        }
    }

    public function dashboard() {
        $this->load->view('admin/dashboard');
    }
}