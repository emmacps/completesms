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

        // crud function for circular
        function circular($param1 = '', $param2 = '', $param3 = ''){

          if($param1 == 'insert'){
          $this->crud_model->insert_circular();
          $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
          redirect('admin/circular', 'refresh');
          }

          if($param1 == 'update'){
            $this->crud_model->update_circular($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
            redirect('admin/circular', 'refresh');
          }

          if($param1 == 'delete'){
            $this->crud_model->delete_circular($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Successfully'));
            redirect('admin/circular', 'refresh');
          }

          $page_data['page_name'] = 'circular';
          $page_data['page_title'] =  get_phrase('Manage Circular');
          $page_data['select_circular'] = $this->db->get('circular')->result_array();
          $this->load->view('backend/index', $page_data);
        }


        // crud function for parents
        function parent($param1 = '', $param2 = '', $param3 = ''){

          if($param1 == 'insert'){
          $this->crud_model->insert_parent();
          $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
          redirect('admin/parent', 'refresh');
          }

          if($param1 == 'update'){
            $this->crud_model->update_parent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
            redirect('admin/parent', 'refresh');
          }

          if($param1 == 'delete'){
            $this->crud_model->delete_parent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Successfully'));
            redirect('admin/parent', 'refresh');
          }

          $page_data['page_name'] = 'parent';
          $page_data['page_title'] =  get_phrase('Manage Parents');
          $page_data['select_parent'] = $this->db->get('parent')->result_array();
          $this->load->view('backend/index', $page_data);
        }


        // crud function for labrarian
        function librarian($param1 = '', $param2 = '', $param3 = ''){

          if($param1 == 'insert'){
          $this->crud_model->insert_librarian();
          $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
          redirect('admin/librarian', 'refresh');
          }

          if($param1 == 'update'){
            $this->crud_model->update_librarian($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
            redirect('admin/librarian', 'refresh');
          }

          if($param1 == 'delete'){
            $this->crud_model->delete_librarian($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Successfully'));
            redirect('admin/librarian', 'refresh');
          }

          $page_data['page_name'] = 'librarian';
          $page_data['page_title'] =  get_phrase('Manage librarian');
          $page_data['select_librarian'] = $this->db->get('librarian')->result_array();
          $this->load->view('backend/index', $page_data);
        }


        // crud function for accountant
        function accountant($param1 = '', $param2 = '', $param3 = ''){

          if($param1 == 'insert'){
          $this->crud_model->insert_accountant();
          $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
          redirect('admin/accountant', 'refresh');
          }

          if($param1 == 'update'){
            $this->crud_model->update_accountant($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
            redirect('admin/accountant', 'refresh');
          }

          if($param1 == 'delete'){
            $this->crud_model->delete_accountant($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Successfully'));
            redirect('admin/accountant', 'refresh');
          }

          $page_data['page_name'] = 'accountant';
          $page_data['page_title'] =  get_phrase('Manage Accountant');
          $page_data['select_accountant'] = $this->db->get('accountant')->result_array();
          $this->load->view('backend/index', $page_data);
        }


        // crud function for hostel manage
        function hostel($param1 = '', $param2 = '', $param3 = ''){

          if($param1 == 'insert'){
          $this->crud_model->insert_hostel();
          $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
          redirect('admin/hostel', 'refresh');
          }

          if($param1 == 'update'){
            $this->crud_model->update_hostel($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
            redirect('admin/hostel', 'refresh');
          }

          if($param1 == 'delete'){
            $this->crud_model->delete_hostel($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Successfully'));
            redirect('admin/hostel', 'refresh');
          }

          $page_data['page_name'] = 'hostel';
          $page_data['page_title'] =  get_phrase('Manage Hostel');
          $page_data['select_hostel'] = $this->db->get('hostel')->result_array();
          $this->load->view('backend/index', $page_data);
        }


        function hrm($param1 = '', $param2 = '', $param3 = ''){

                if ($param1 == 'insert'){

                    $this->crud_model->insert_hrm();

                    $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
                    redirect(base_url(). 'admin/hrm', 'refresh');
                }


                if($param1 == 'update'){

                    $this->crud_model->update_hrm($param2);
                    $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
                    redirect(base_url(). 'admin/hrm', 'refresh');

                }

                if($param1 == 'delete'){
                    $this->crud_model->delete_hrm($param2);
                    $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
                    redirect(base_url(). 'admin/hrm', 'refresh');

                }

                $page_data['page_name']         = 'hrm';
                $page_data['page_title']        = get_phrase('Manage HRM');
                $page_data['select_hrm']        = $this->db->get('hrm')->result_array();
                $this->load->view('backend/index', $page_data);
            }





































































































        // function manage_language($param1 = null, $param2 = null, $param3 = null){
        //
        //   if($param1 == 'edit_phrase'){
        //     $page_data['edit_profile'] = $param2;
        //   }
        //
        //   if($param1 == 'add_language'){
        //   $this->language_model->createNewLanguage();
        //   $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
        //   redirect('admin/manage_language', 'refresh');
        //   }
        //
        //   if($param1 == 'add_phrase'){
        //     $this->language_model->createNewLanguagePhrase();
        //     $this->session->set_flashdata('flash_message', get_phrase('Data Saved Successfully'));
        //     redirect('admin/manage_language', 'refresh');
        //   }
        //
        //   if($param1 == 'delete_language'){
        //     $this->language_model->deleteLanguage($param2);
        //     $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Successfully'));
        //     redirect('admin/manage_language', 'refresh');
        //   }
        //
        //   $page_data['page_name'] = 'manage_language';
        //   $page_data['page_title'] =  get_phrase('Manage Language');
        //   $page_data['select_accountant'] = $this->db->get('accountant')->result_array();
        //   $this->load->view('backend/index', $page_data);
        //
        // }
        //
        //
        // function updatePhraseWithAjax(){
        //   $checker['phrase_id'] = $this->input->post(phraseId);
        //   $updater[$this->input->post('currentEditingLanguage')] = $this->input->post('updatedValue');
        //
        //   $this->db->where('phrase_id', $checker['phrase_id']);
        //   $this->db->update('language', $updater);
        //
        //   echo $checker['phrase_id']. ' '.$this->input->post('currentEditingLanguage').' '.$this->input->post('updatedValue');
        // }
        //






}
