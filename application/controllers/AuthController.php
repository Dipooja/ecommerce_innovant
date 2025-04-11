<?php
class AuthController extends CI_Controller {
    public function login() {
        $this->load->view('admin/login');
    }

    public function login_process() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->load->model('Admin_model');
        $admin = $this->Admin_model->get_admin_by_username($username);

        if ($admin && password_verify($password, $admin->password)) {
            $this->session->set_userdata('admin_id', $admin->id);
            redirect('admin/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid login credentials.');
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('admin_id');
        redirect('auth/login');
    }
}
