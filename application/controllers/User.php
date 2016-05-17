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

class User extends CI_Controller{
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
        $this->db->delete('users', array('id' => $user_id));
        redirect(site_url('/site/users'));
    }
    
    public function edit_user($user_id){

        $data = array(
               'first_name' => $this->input->post('first_name'),
               'last_name' => $this->input->post('last_name'),
               'email' => $this->input->post('email')
            );
        $this->ion_auth->update($user_id, $data);
        redirect(site_url('/site/users'));
    }

    public function new_user(){
        if(isset($_POST['email'], $_POST['password'], $_POST['vpassword'])){
            if($_POST['password']==$_POST['vpassword']){
                $this->create_user($_POST['password'], $_POST['email'], $_POST['group'], $_POST['first_name'], $_POST['last_name']);
            }else echo "Passwords don't match.";
        }
        
        /*foreach ($query->result() as $row){
           echo $row->username;
           echo $row->email;
        }*/
        redirect('/site/users');
        //$this->view($this->nav[2][2], $data);
    }

    public function login(){
        if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $this->input->post('remember')=='on'))
            {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
            }
            else
            {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                 // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
            redirect(site_url());
    }

    public function create_user($pword=null, $email=null, $group=null, $first_name=null, $last_name=null){
        $additional_data = array(
                                'first_name' => $first_name,
                                'last_name' => $last_name,
                                );
        if($group=='1'){
            $group = array('1','2');
        }else if($group=='2'){
            $group = array('2');
        }

        $this->ion_auth->register($email, $pword, $email, $additional_data, $group);
    }
}