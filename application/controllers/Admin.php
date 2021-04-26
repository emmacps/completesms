<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');

    }

    public function index()
	{
        if($this->session->userdata('admin_login') != 1) redirect(base_url(). 'login', 'refresh');
        if($this->session->userdata('admin_login') == 1) redirect(base_url(). 'admin/dashboard', 'refresh');

    }

    public function dashboard() {

        if($this->session->userdata('admin_login') != 1) redirect(base_url(). 'login', 'refresh');

       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] =  get_phrase('Admin Dashboard');
        $this->load->view('backend/index', $page_data);
    }


    public function manage_profile($param1 = '', $param2 = '', $param3 = ''){

        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {

            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');

            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'admin/manage_profile', 'refresh');

        }

        if($param1 == 'change_password'){

            $data['new_password']  =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']  =   sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->row()->password;

            if($data['new_password'] == $data['confirm_new_password']){
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array('password' => $data['new_password']));
                $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }

            else{
                $this->session->set_flashdata('error_message', get_phrase('Password Not changed'));
            }
            redirect(base_url() . 'admin/manage_profile', 'refresh');
        }

        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] =  get_phrase('Manage Profile');
        $page_data['edit_profile'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }



}