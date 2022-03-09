<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

// Starting login controller
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    // load login index page
    public function index() {
        if($this->session->userdata('admin_login') == 1) redirect('admin/dashboard', 'refresh');
        $this->load->view('backend/login');
    }

    // check login function
    public function check_login() {
        $this->login_model->adminLoginFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
        redirect('admin/dashboard', 'refresh');
     }

     // logout user
     function logout(){
        $this->session->sess_destroy();
        redirect('login', 'refresh');
     }


}
