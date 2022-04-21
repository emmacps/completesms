<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// system settings controller
class Systemsetting extends CI_Controller {

    function __construct(){
        parent::__construct();
    }

    // system settings crud function
    function system_settings($param1 = '', $param2 = '', $param3 = ''){

        if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');

        if ($param1 == 'do_update') {

            $this->crud_model->update_settings();

        $this->session->set_flashdata('flash_message', get_phrase('Data Updated'));
        redirect('systemsetting/system_settings', 'refresh');
    }

     if ($param1 == 'upload_logo') {
       $this->crud_model->system_logo();
       $this->session->set_flashdata('flash_message', get_phrase('Logo Uploaded'));
       redirect('systemsetting/system_settings', 'refresh');
    }

    if ($param1 == 'themeSettings') {
        $this->crud_model->update_theme();
        $this->session->set_flashdata('flash_message', get_phrase('Theme Selected'));
        redirect('systemsetting/system_settings', 'refresh');
    }

        $page_data['page_name']     = 'system_settings';
        $page_data['page_title']    =  get_phrase('System Settings');
        $this->load->view('backend/index', $page_data);
    }



}
