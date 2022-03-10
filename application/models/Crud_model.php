<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// universal crud
class Crud_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

    // get unique value by id
	 function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        $this->db->where($type . '_id', $type_id);
        $query = $this->db->get($type);
        $result = $query->result_array();
        foreach ($result as $row)
        return $row[$field];
    }

    // get image
     function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';
        return $image_url;
    }

    // insert cat
    function enquiry_cat(){

        $page_data['category']  =   $this->input->post('category');
        $page_data['purpose']   =   $this->input->post('purpose');
        $page_data['whom']      =   $this->input->post('whom');
        $this->db->insert('enquiry_category', $page_data);
    }

    // udate cat
    function update_cat($param2){
        $page_data['category']  =   $this->input->post('category');
        $page_data['purpose']   =   $this->input->post('purpose');
        $page_data['whom']      =   $this->input->post('whom');
        $this->db->where('enquiry_category_id', $param2);
        $this->db->update('enquiry_category', $page_data);
    }

    // delete cat
    function delete_cat($param2){
        $this->db->where('enquiry_category_id', $param2);
        $this->db->delete('enquiry_category');
    }

    // delete enquiry list
    function delete_enquire($param2){
        $this->db->where('enquiry_id', $param2);
        $this->db->delete('enquiry');
    }

    // add club
    function add_club(){
        $page_data['club_name']     =   $this->input->post('club_name');
        $page_data['desc']          =   $this->input->post('desc');
        $page_data['date']          =   $this->input->post('date');
        $this->db->insert('club', $page_data);
    }

    function edit_club($param2){
        $page_data['club_name']     =   $this->input->post('club_name');
        $page_data['desc']          =   $this->input->post('desc');
        $page_data['date']          =   $this->input->post('date');
        $this->db->where('club_id', $param2);
        $this->db->update('club', $page_data);
    }


    function del_club($param2){
        $this->db->where('club_id', $param2);
        $this->db->delete('club');
    }

    function insert_parent(){
      $page_data = array(
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password'),
        'phone' => $this->input->post('phone'),
        'address' => $this->input->post('address'),
        'profession' => $this->input->post('profession')
      );
        $this->db->insert('parent', $page_data);
    }

    function update_parent($param2){
      $page_data = array(
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'password' => sha1($this->input->post('password')),
        'phone' => $this->input->post('phone'),
        'address' => $this->input->post('address'),
        'profession' => $this->input->post('profession')
      );
        $this->db->where('parent_id', $param2);
        $this->db->update('parent', $page_data);
    }


    function delete_parent($param2){
        $this->db->where('parent_id', $param2);
        $this->db->delete('parent');
    }


    function insert_librarian(){
      $page_data = array(
        'name' => $this->input->post('name'),
        'librarian_number' => $this->input->post('librarian_number'),
        'birthday' => $this->input->post('birthday'),
        'sex'	=> $this->input->post('sex'),
        'religion' => $this->input->post('religion'),
        'blood_group'	=> $this->input->post('blood_group'),
				'email'	=> $this->input->post('email'),
        'address'	=> $this->input->post('address'),
        'phone'	=> $this->input->post('phone'),
        'facebook'	=> $this->input->post('facebook'),
        'twitter'	=> $this->input->post('twitter'),
        'googleplus'	=> $this->input->post('googleplus'),
        'linkedin'	=> $this->input->post('linkedin'),
        'qualification'	=> $this->input->post('qualification'),
        'marital_status' => $this->input->post('marital_status'),
        'password'	=> sha1($this->input->post('password'))
      );
      $page_data['file_name'] = $_FILES["file_name"]["name"];
      //$page_data['email'] = $this->input->post('email');
      $check_email = $this->db->get_where('librarian', array('email' => $data['email']))->row()->email;	// checking if email exists in database

      if($check_email != null) {
          $this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
            redirect('admin/librarian/', 'refresh');
          }else {
                $this->db->insert('librarian', $page_data);
                $librarian_id = $this->db->insert_id();

                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/librarian_image/" . $_FILES["file_name"]["name"]);	// upload files
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $librarian_id . '.jpg');			// image with user ID
                //  $this->email_model->account_opening_email('librarian', $page_data['email']); //Send email to receipient email adddrress upon account opening
          }

    }

    function update_librarian($param2){
          $page_data = array(
            'name' => $this->input->post('name'),
            'librarian_number' => $this->input->post('librarian_number'),
            'birthday' => $this->input->post('birthday'),
            'sex'	=> $this->input->post('sex'),
            'religion' => $this->input->post('religion'),
            'blood_group'	=> $this->input->post('blood_group'),
            'address'	=> $this->input->post('address'),
            'phone'	=> $this->input->post('phone'),
            'facebook'	=> $this->input->post('facebook'),
            'twitter'	=> $this->input->post('twitter'),
            'googleplus'	=> $this->input->post('googleplus'),
            'linkedin'	=> $this->input->post('linkedin'),
            'qualification'	=> $this->input->post('qualification'),
            'marital_status' => $this->input->post('marital_status')
          );

          $page_data['email'] = $this->input->post('email');
          $this->db->where('librarian_id', $param2);
          $this->db->update('librarian', $page_data);
          move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/librarian_image/" . $param2 . '.jpg');	// upload files
        }

    function delete_librarian($param2){
        $this->db->where('librarian_id', $param2);
        $this->db->delete('librarian');
    }








}
