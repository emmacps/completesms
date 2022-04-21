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

                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/staff/" . $_FILES["file_name"]["name"]);	// upload files
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff/' . $librarian_id . '.jpg');			// image with user ID
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



		    function insert_accountant(){
		      $page_data = array(
		        'name' => $this->input->post('name'),
		        'accountant_number' => $this->input->post('accountant_number'),
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
		      $check_email = $this->db->get_where('accountant', array('email' => $data['email']))->row()->email;	// checking if email exists in database

		      if($check_email != null) {
		          $this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
		            redirect('admin/accountant/', 'refresh');
		          }else {
		                $this->db->insert('accountant', $page_data);
		                $accountant_id = $this->db->insert_id();

		                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/accountant_image/" . $_FILES["file_name"]["name"]);	// upload files
		                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $accountant_id . '.jpg');			// image with user ID
		                //  $this->email_model->account_opening_email('librarian', $page_data['email']); //Send email to receipient email adddrress upon account opening
		          }

		    }

		    function update_accountant($param2){
		          $page_data = array(
		            'name' => $this->input->post('name'),
		            'accountant_number' => $this->input->post('accountant_number'),
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
		          $this->db->where('accountant_id', $param2);
		          $this->db->update('accountant', $page_data);
		          move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/accountant_image/" . $param2 . '.jpg');	// upload files
		        }

		    function delete_accountant($param2){
		        $this->db->where('accountant_id', $param2);
		        $this->db->delete('accountant');
		    }

				function insert_hostel(){
			 	 $page_data = array(
			 		 'name' => $this->input->post('name'),
			 		 'hostel_number' => $this->input->post('hostel_number'),
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
			 	 $check_email = $this->db->get_where('hostel', array('email' => $data['email']))->row()->email;	// checking if email exists in database

			 	 if($check_email != null) {
			 			 $this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
			 				 redirect('admin/hostel/', 'refresh');
			 			 }else {
			 						 $this->db->insert('hostel', $page_data);
			 						 $hostel_id = $this->db->insert_id();

			 						 move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/hostel_image/" . $_FILES["file_name"]["name"]);	// upload files
			 						 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $accountant_id . '.jpg');			// image with user ID
			 						 //  $this->email_model->account_opening_email('librarian', $page_data['email']); //Send email to receipient email adddrress upon account opening
			 			 }

			  }

			  function update_hostel($param2){
			 			 $page_data = array(
			 				 'name' => $this->input->post('name'),
			 				 'hostel_number' => $this->input->post('hostel_number'),
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
			 			 $this->db->where('hostel_id', $param2);
			 			 $this->db->update('hostel', $page_data);
			 			 move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/hostel_image/" . $param2 . '.jpg');	// upload files
			 		 }

			  function delete_hostel($param2){
			 		 $this->db->where('hostel_id', $param2);
			 		 $this->db->delete('hostel');
			  }


				function insert_hrm(){
			        $page_data = array(		// array data that postulate the input fileds
			            'name' 				=> $this->input->post('name'),
			            'hrm_number' 	    => $this->input->post('hrm_number'),
			            'birthday' 			=> $this->input->post('birthday'),
			            'sex' 				=> $this->input->post('sex'),
			            'religion' 			=> $this->input->post('religion'),
			            'blood_group' 		=> $this->input->post('blood_group'),
			            'address' 			=> $this->input->post('address'),
			            'phone' 			=> $this->input->post('phone'),

			            'facebook' 			=> $this->input->post('facebook'),
			            'twitter' 			=> $this->input->post('twitter'),
			            'googleplus' 		=> $this->input->post('googleplus'),
			            'linkedin' 			=> $this->input->post('linkedin'),
			            'qualification' 	=> $this->input->post('qualification'),
			            'marital_status'	=> $this->input->post('marital_status'),
			            'password' 			=> sha1($this->input->post('password'))
			            );

			        $page_data['file_name'] = $_FILES["file_name"]["name"];
					$page_data['email'] = $this->input->post('email');
					$check_email = $this->db->get_where('hrm', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
					if($check_email != null)
					{
					$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
			        redirect(base_url() . 'admin/hrm/', 'refresh');
					}
					else
					{
			        $this->db->insert('hrm', $page_data);
			        $hrm_id = $this->db->insert_id();

			            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/hrm_image/" . $_FILES["file_name"]["name"]);	// upload files
			        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hrm_image/' . $hrm_id . '.jpg');			// image with user ID
					    //$this->email_model->account_opening_email('hrm', $data['email']); //Send email to receipient email adddrress upon account opening
			            }
			    }


			    function update_hrm($param2){
			        $page_data = array(			// array starts from here
			            'name'				=> $this->input->post('name'),
			            'birthday'			=> $this->input->post('birthday'),
			            'sex' 				=> $this->input->post('sex'),
			            'religion' 			=> $this->input->post('religion'),
			            'blood_group' 		=> $this->input->post('blood_group'),
			            'address' 			=> $this->input->post('address'),
			            'phone' 			=> $this->input->post('phone'),

			            'email' 			=> $this->input->post('email'),
			            'facebook' 			=> $this->input->post('facebook'),
			            'twitter' 			=> $this->input->post('twitter'),
			            'googleplus' 		=> $this->input->post('googleplus'),
			            'linkedin' 			=> $this->input->post('linkedin'),
			            'qualification' 	=> $this->input->post('qualification'),
			            'marital_status' 	=> $this->input->post('marital_status')
			            );

			                $this->db->where('hrm_id', $param2);
			                $this->db->update('hrm', $page_data);
			                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hrm_image/' . $param2 . '.jpg');
			    }

			    function delete_hrm($param2){
			        $this->db->where('hrm_id', $param2);
			        $this->db->delete('hrm');
			    }

	public function system_logo(){
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
	}


public function update_settings(){

	        $data['description']    =   $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('system_title');
        $this->db->where('type', 'system_title');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('address');
        $this->db->where('type', 'address');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('phone');
        $this->db->where('type', 'phone');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('paypal_email');
        $this->db->where('type', 'paypal_email');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('currency');
        $this->db->where('type', 'currency');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('system_email');
        $this->db->where('type', 'system_email');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('language');
        $this->db->where('type', 'language');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('text_align');
        $this->db->where('type', 'text_align');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('running_session');
        $this->db->where('type', 'session');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('footer');
        $this->db->where('type', 'footer');
        $this->db->update('settings', $data);
}


public function update_theme(){
	$data['description']    =   $this->input->post('skin_colour');
    $this->db->where('type', 'skin_colour');
    $this->db->update('settings', $data);
}

public function change_admin_pass(){
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
}



}
