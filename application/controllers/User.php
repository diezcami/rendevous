<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Community Auth - Examples Controller
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2016, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

class User extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        # New pages must be declared in this array to include them in the nav bar.
        # array('Page Name', 'url', 'view name*' )
        # *the view that will be loaded.
        # Don't forget to add the function for the page below!
    }
    public function delete_user($user_id){
        $this->db->delete('users', array('user_id' => $user_id));
        redirect(site_url('/site/users'));
    }
    
    public function edit_user($user_id){
        $data = array(
               'username' => $_POST['username'],
               'email' => $_POST['email'],
               'name' => $_POST['name'],
               'auth_level' => $_POST['auth_level']
            );
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
        redirect(site_url('/site/users'));
    }

    public function new_user(){
        if(isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['vpassword'])){
            if($_POST['password']==$_POST['vpassword']){
                $this->create_user($_POST['username'], $_POST['password'], $_POST['email'], $_POST['auth_level'], $_POST['name']);
            }else echo "Passwords don't match.";
        }
        
        /*foreach ($query->result() as $row){
           echo $row->username;
           echo $row->email;
        }*/
        redirect('/site/users');
        //$this->view($this->nav[2][2], $data);
    }

    public function create_user($username=null, $pword=null, $email=null, $auth_level=null, $name){
        // Customize this array for your user
        $user_data = array(
            'username'   => $username,
            'passwd'     => $pword,
            'email'      => $email,
            'auth_level' => $auth_level,
            'name'       => $name
        );
        /*$user_data = array(
            'username'   => 'admin',
            'passwd'     => '45passworD',
            'email'      => 'admin@compsat.org',
            'auth_level' => '9', // 9 if you want to login @ examples/index.
        );*/

        $this->is_logged_in();

        //echo $this->load->view('examples/page_header', '', TRUE);

        // Load resources
        $this->load->model('examples_model');
        $this->load->model('validation_callables');
        $this->load->library('form_validation');

        $this->form_validation->set_data( $user_data );

        $validation_rules = array(
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'max_length[12]|is_unique[' . config_item('user_table') . '.username]',
                'errors' => array(
                    'is_unique' => 'Username already in use.'
                )
            ),
            array(
                'field' => 'passwd',
                'label' => 'passwd',
                'rules' => array(
                    'trim',
                    'required',
                    array( 
                        '_check_password_strength', 
                        array( $this->validation_callables, '_check_password_strength' ) 
                    )
                ),
                'errors' => array(
                    'required' => 'The password field is required.'
                )
            ),
            array(
                'field'  => 'email',
                'label'  => 'email',
                'rules'  => 'trim|required|valid_email|is_unique[' . config_item('user_table') . '.email]',
                'errors' => array(
                    'is_unique' => 'Email address already in use.'
                )
            ),
            array(
                'field' => 'auth_level',
                'label' => 'auth_level',
                'rules' => 'required|integer|in_list[1,6,9]'
            )
        );

        $this->form_validation->set_rules( $validation_rules );

        if( $this->form_validation->run() )
        {
            $user_data['passwd']     = $this->authentication->hash_passwd($user_data['passwd']);
            $user_data['user_id']    = $this->examples_model->get_unused_id();
            $user_data['created_at'] = date('Y-m-d H:i:s');

            // If username is not used, it must be entered into the record as NULL
            if( empty( $user_data['username'] ) )
            {
                $user_data['username'] = NULL;
            }

            $this->db->set($user_data)
                ->insert(config_item('user_table'));

            if( $this->db->affected_rows() == 1 );
                //$this->users();
                //echo '<h1>Congratulations</h1>' . '<p>User ' . $user_data['username'] . ' was created.</p>';
        }
        else
        {
            echo '<h1>User Creation Error(s)</h1>' . validation_errors();
        }

        //echo $this->load->view('examples/page_footer', '', TRUE);
    }
}