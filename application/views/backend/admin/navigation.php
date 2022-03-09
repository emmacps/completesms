    <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                        <!-- /input-group -->
                    </li>
                    <li class="user-pro">
                    <?php
                        $key = $this->session->userdata('login_type') . '_id';
                        $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                        if (!file_exists($face_file)) {
                            $face_file = 'uploads/default.jpg';
                        }
                    ?>
                        <a href="#" class="waves-effect"><img src="<?php echo base_url() . $face_file;?>" alt="user-img" class="img-circle">
                            <span class="hide-menu">
                            <?php
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                        ?>
                            <span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-small-cap m-t-10">--- Main Menu</li>
                    <li> <a href="<?php echo base_url(); ?>admin/dashboard" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard'); ?></span></a> </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-mortar-board" data-icon="7"></i> <span class="hide-menu"> <?php echo get_phrase('Manage Academics'); ?> <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level <?php

                        if($page_name == 'enquiry_category' ||
                           $page_name == 'list_enqiury' ||
                           $page_name == 'club' ||
                           $page_name == 'circular' ||
                           $page_name == 'help_link' ||
                           $page_name == 'help_desk' ||
                           $page_name == 'holiday' ||
                           $page_name == 'formcode' ||
                           $page_name == 'marketPlace' ||
                           $page_name == 'admissionFormPage' ||
                           $page_name == 'todays_though' ||
                           $page_name == 'academic_syllabus') echo 'opened active';

                            ?> ">

                            <li class="<?php if($page_name == 'enquiry_category') echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>admin/enquiry_category">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                    <span class="hide-menu"><?php echo get_phrase('Enquiry Category'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if ($page_name == 'list_enquiry') echo 'active'; ?> ">
                                <a href="<?php echo base_url(); ?>admin/list_enquiry">
                                <i class="fa fa-angle-double-right p-r-10"></i>
                                    <span class="hide-menu"><?php echo get_phrase('view_enquiries'); ?></span>
                                </a>
                            </li>

                            <li class="<?php if ($page_name == 'club') echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>admin/club">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                        <span class="hide-menu"><?php echo get_phrase('school_clubs'); ?></span>
                                    </a>
                            </li>

                            <li class="<?php if ($page_name == 'circular') echo 'active'; ?> ">
                                    <a href="<?php echo base_url(); ?>admin/circular">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                    <span class="hide-menu"> <?php echo get_phrase('manage_circular'); ?></span>
                                    </a>
                            </li>

                            <li class="<?php if ($page_name == 'holiday') echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>admin/holiday">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                        <span class="hide-menu"><?php echo get_phrase('manage_holiday'); ?></span>
                                    </a>
                            </li>

                            <li class="<?php if ($page_name == 'todays_thought') echo 'active'; ?> ">
                                    <a href="<?php echo base_url(); ?>admin/todays_thought">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                        <span class="hide-menu"><?php echo get_phrase('manage_moraltalk'); ?></span>
                                    </a>
                            </li>

                            <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>admin/academic_syllabus">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                        <span class="hide-menu"><?php echo get_phrase('syllabus'); ?></span>
                                    </a>
                            </li>

                            <li class="<?php if ($page_name == 'help_link') echo 'active'; ?> ">
                                    <a href="<?php echo base_url(); ?>admin/help_link">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                        <span class="hide-menu"><?php echo get_phrase('manage_helplink'); ?></span>
                                    </a>
                            </li>

                            <li class="<?php if ($page_name == 'help_desk') echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>admin/help_desk">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                        <span class="hide-menu"><?php echo get_phrase('manage_helpdesk'); ?></span>
                                    </a>
                            </li>

                            <li class="<?php if ($page_name == 'formcode') echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>admin/formcode">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                    <span class="hide-menu"><?php echo get_phrase('Registration Code'); ?></span>
                                    </a>
                            </li>

                            <li class="<?php if ($page_name == 'admissionFormPage') echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>admin/admissionFormPage">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                        <span class="hide-menu"><?php echo get_phrase('approve_student'); ?></span>
                                    </a>
                            </li>

                            <li class="<?php if ($page_name == 'checker') echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>admin/checker">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                        <span class="hide-menu"><?php echo get_phrase('Student Result PIN'); ?></span>
                                    </a>
                            </li>

                            <li class="<?php if ($page_name == 'marketPlace') echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>admin/marketPlace">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                        <span class="hide-menu"><?php echo get_phrase('Market Place'); ?></span>
                                    </a>
                            </li>

                        </ul>
                    </li>
                    <li class="task_manager"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="icon-menu p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('task_manager');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level<?php if(   $page_name == 'team_task'   ||
                                                    $page_name == 'team_task_archived' ||
                                                    $page_name == 'team_task_view' )echo 'in';?>">



                            <li class="<?php if ($page_name == 'team_task') echo 'active';?>">
                                <a href="<?php echo base_url(); ?>admin/team_task">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                <?php echo get_phrase('running_tasks'); ?>
                                </a>
                            </li>



                            <li class="<?php if ($page_name == 'team_task_archived') echo 'active';?>">
                                <a href="<?php echo base_url(); ?>admin/team_task_archived">
                                    <i class="fa fa-angle-double-right p-r-10"></i>
                                    <?php echo get_phrase('archived_tasks'); ?>
                                </a>
                            </li>


                            </ul>
                            </li>


        <li class="staff"> <a href="javascript:void(0);" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-angle-double-right p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Manage Employees');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level<?php
if ($page_name == 'teacher' ||
    $page_name == 'librarian'|| $page_name == 'hrm'||
    $page_name == 'accountant'||
    $page_name == 'hostel')
echo 'opened active';
?> ">




<li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
<a href="<?php echo base_url(); ?>admin/teacher">
<i class="fa fa-angle-double-right p-r-10"></i>
     <span class="hide-menu"><?php echo get_phrase('teachers'); ?></span>
</a>
</li>




<li class="<?php if ($page_name == 'librarian') echo 'active'; ?> ">
<a href="<?php echo base_url(); ?>admin/librarian">
<i class="fa fa-angle-double-right p-r-10"></i>
      <span class="hide-menu"><?php echo get_phrase('librarians'); ?></span>
</a>
</li>





<li class="<?php if ($page_name == 'accountant') echo 'active'; ?> ">
<a href="<?php echo base_url(); ?>admin/accountant">
<i class="fa fa-angle-double-right p-r-10"></i>
      <span class="hide-menu"><?php echo get_phrase('accountants'); ?></span>
</a>
</li>



                        <li class="<?php if ($page_name == 'hostel') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/hostel">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('hostel_manager'); ?></span>
                        </a>
                        </li>



                        <li class="<?php if ($page_name == 'hrm') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/hrm">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('human_resources'); ?></span>
                        </a>
                        </li>


                        </ul>
                        </li>


                        <li class="student"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-users p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('manage_students');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level<?php
if ($page_name == 'new_student' ||
    $page_name == 'student_class' ||
    $page_name == 'student_information' ||
    $page_name == 'view_student' ||
    $page_name == 'searchStudent' ||
    $page_name == 'student_promotion')
echo 'opened active has-sub';
?> ">



    <li class="<?php if ($page_name == 'new_student') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>admin/new_student">
        <i class="fa fa-angle-double-right p-r-10"></i>
              <span class="hide-menu"><?php echo get_phrase('admission_form'); ?></span>
        </a>
    </li>



     <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_information' || $page_name == 'view_student') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>admin/student_information">
        <i class="fa fa-angle-double-right p-r-10"></i>
              <span class="hide-menu"><?php echo get_phrase('list_students'); ?></span>
        </a>
    </li>



    <li class="<?php if ($page_name == 'student_promotion') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>admin/student_promotion">
        <i class="fa fa-angle-double-right p-r-10"></i>
             <span class="hide-menu"><?php echo get_phrase('promote_students'); ?></span>
        </a>
    </li>


<li class="<?php if ($page_name == 'studentCategory') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>studentcategory/studentCategory">
        <i class="fa fa-angle-double-right p-r-10"></i>
             <span class="hide-menu"><?php echo get_phrase('Student Categories'); ?></span>
        </a>
</li>

<li class="<?php if ($page_name == 'studentHouse') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>studenthouse/studentHouse">
        <i class="fa fa-angle-double-right p-r-10"></i>
             <span class="hide-menu"><?php echo get_phrase('Student House'); ?></span>
        </a>
</li>

<li class="<?php if ($page_name == 'clubActivity') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>activity/clubActivity">
        <i class="fa fa-angle-double-right p-r-10"></i>
             <span class="hide-menu"><?php echo get_phrase('Student Activity'); ?></span>
        </a>
</li>

<li class="<?php if ($page_name == 'socialCategory') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>socialcategory/socialCategory">
        <i class="fa fa-angle-double-right p-r-10"></i>
             <span class="hide-menu"><?php echo get_phrase('Social Category'); ?></span>
        </a>
</li>

<li class="<?php if ($page_name == 'searchStudent') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>report/searchStudent">
        <i class="fa fa-angle-double-right p-r-10"></i>
             <span class="hide-menu"><?php echo get_phrase('search_students'); ?></span>
        </a>
    </li>

        <li class="<?php if ($page_name == 'studentResetPassword') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>resetpassword/studentResetPassword">
        <i class="fa fa-angle-double-right p-r-10"></i>
             <span class="hide-menu"><?php echo get_phrase('Reset Password'); ?></span>
        </a>
    </li>



 </ul>
</li>




        <li class="attendance"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-hospital-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('manage_attendance');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level<?php
if ($page_name == 'manage_attendance' || $page_name == 'staff_attendance' ||
    $page_name == 'attendance_report')
echo 'opened active';
?>">


    <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>admin/manage_attendance/<?php echo date("d/m/Y"); ?>">
        <i class="fa fa-angle-double-right p-r-10"></i>
              <span class="hide-menu"><?php echo get_phrase('mark_attendance'); ?></span>
        </a>
    </li>


    <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>admin/attendance_report">
        <i class="fa fa-angle-double-right p-r-10"></i>
              <span class="hide-menu"><?php echo get_phrase('view_attendance'); ?></span>
        </a>
    </li>



    <li class="<?php if ($page_name == 'staff_attendance') echo 'active'; ?> ">
        <a href="<?php echo base_url(); ?>admin/staff_attendance">
        <i class="fa fa-angle-double-right p-r-10"></i>
              <span class="hide-menu"><?php echo get_phrase('staff_attendance'); ?></span>
        </a>
    </li>


 </ul>
</li>



<li class="ticket"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-envelope p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('support_ticket');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level<?php
if ($page_name == 'support_ticket_create' || $page_name == 'support_ticket' ||
    $page_name == 'support_ticket_view')
echo 'opened active';
?>">


<li class="<?php if ($page_name == 'support_ticket') echo 'active'; ?> ">
<a href="<?php echo base_url(); ?>admin/support_ticket">
<i class="fa fa-angle-double-right p-r-10"></i>
   <span class="hide-menu"><?php echo get_phrase('list_tickets'); ?></span>
</a>
</li>



<li class="<?php if ($page_name == 'support_ticket_create') echo 'active'; ?> ">
<a href="<?php echo base_url(); ?>admin/support_ticket_create">
<i class="fa fa-angle-double-right p-r-10"></i>
    <span class="hide-menu"><?php echo get_phrase('new_ticket'); ?></span>
</a>
</li>


 </ul>
</li>




<li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-download p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('download_page');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level<?php
if ($page_name == 'assignment' ||
    $page_name == 'study_material')
echo 'opened active';
?> ">


<li class="<?php if ($page_name == 'assignment') echo 'active'; ?>">
<a href="<?php echo base_url(); ?>assignment/assignment">
<i class="fa fa-angle-double-right p-r-10"></i>
    <span class="hide-menu"><?php echo get_phrase('assignments'); ?></span>
</a>
</li>



<li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
<a href="<?php echo base_url(); ?>studymaterial/study_material">
<i class="fa fa-angle-double-right p-r-10"></i>
      <span class="hide-menu"><?php echo get_phrase('study_materials'); ?></span>
</a>
</li>


 </ul>
</li>


<li class=" <?php if($page_name == 'parent')echo 'active';?>">
                    <a href="<?php echo base_url();?>admin/parent" >
                    <i class="fa fa-users p-r-10"></i>
                    <span class="hide-menu"><?php echo get_phrase('manage_parents');?></span>
                    </a>
                    </li>


            <li class="<?php if($page_name == 'alumni')echo 'active';?>">
                <a href="<?php echo base_url();?>admin/alumni" >
                    <i class="fa fa-users p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('manage_alumni');?></span>
                    </a>
            </li>


                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
