<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// starting admin controller
class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
    }

    // load admin index page
    public function index(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(). 'login', 'refresh');
        if($this->session->userdata('admin_login') == 1) redirect(base_url(). 'admin/dashboard', 'refresh');
    }

    // load admin dashboard
    public function dashboard() {
        if($this->session->userdata('admin_login') != 1) redirect(base_url(). 'login', 'refresh');

       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] =  get_phrase('Admin Dashboard');
        $this->load->view('backend/index', $page_data);
    }

    // manage profile crud
    public function manage_profile($param1 = '', $param2 = '', $param3 = ''){

        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {

            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');

            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect('admin/manage_profile', 'refresh');
        }

        if($param1 == 'change_password'){

            $data['new_password']  =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']  =   sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->row()->password;

            if($data['new_password'] == $data['confirm_new_password']){
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array('password' => $data['new_password']));
                $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            } else{
                $this->session->set_flashdata('error_message', get_phrase('Password Not changed'));
            }
            redirect('admin/manage_profile', 'refresh');
        }

        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] =  get_phrase('Manage Profile');
        $page_data['edit_profile'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    // category enquiry crud function
    function enquiry_category($param1 = '', $param2 = '', $param3 = ''){

      if($param1 == 'insert'){
      $this->crud_model->enquiry_cat();
      $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
      redirect('admin/enquiry_category', 'refresh');
    }

    if($param1 == 'update'){
      $this->crud_model->update_cat($param2);
      $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
      redirect('admin/enquiry_category', 'refresh');
    }

    if($param1 == 'delete'){
      $this->crud_model->delete_cat($param2);
      $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Successfully'));
      redirect('admin/enquiry_category', 'refresh');
    }

    $page_data['page_name'] = 'enquiry_category';
    $page_data['page_title'] =  get_phrase('Manage Category');
    $page_data['enquiry_category'] = $this->db->get('enquiry_category')->result_array();
    $this->load->view('backend/index', $page_data);
  }

  // list enquiry function
  function list_enquiry($param1 = '', $param2 = '', $param3 = ''){

    if($param1 == 'delete'){
      $this->crud_model->delete_enquire($param2);
      $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Successfully'));
      redirect('admin/list_enquiry', 'refresh');
    }

    $page_data['page_name'] = 'list_enquiry';
    $page_data['page_title'] =  get_phrase('All Enquiries');
    $page_data['select_enquiry'] = $this->db->get('enquiry')->result_array();
    $this->load->view('backend/index', $page_data);
  }

        // school clud crud function
        function club($param1 = '', $param2 = '', $param3 = ''){

          if($param1 == 'insert'){
          $this->crud_model->add_club();
          $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
          redirect('admin/club', 'refresh');
          }

          if($param1 == 'update'){
            $this->crud_model->edit_club($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
            redirect('admin/club', 'refresh');

          }

          if($param1 == 'delete'){
            $this->crud_model->del_club($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Successfully'));
            redirect('admin/club', 'refresh');
          }

          $page_data['page_name'] = 'club';
          $page_data['page_title'] =  get_phrase('Manage Club');
          $page_data['select_club'] = $this->db->get('club')->result_array();
          $this->load->view('backend/index', $page_data);
        }






}
