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

class Post extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        # New pages must be declared in this array to include them in the nav bar.
        # array('Page Name', 'url', 'view name*' )
        # *the view that will be loaded.
        # Don't forget to add the function for the page below!
    }
    public function new_reply($job_id, $user_id){
        $data = array(
           'description' => $_POST['body'],
           'user_id' => $user_id,
           'job_id' => $job_id
        );
        $this->db->insert('post', $data);

        redirect(site_url('/site/post/'.$job_id));
    }

    public function new_post($post_type, $user_id){
        
        $data = array(
            'poster_id' => $user_id,
            'title' => $this->input->post('title'),
            'type' => $post_type,
            'client_id' => $user_id
        );
        $this->db->insert('jobs', $data);
        $job_id = $this->db->insert_id();
        $data = array(
               'user_id' => $user_id,
               'description' => $this->input->post('description'),
               'job_id' => $job_id
            );
        $this->db->insert('post', $data);
        $post_id = $this->db->insert_id();

        $data = array(
                'post_id' => $post_id
            );
        $this->db->where('job_id', $job_id);
        $this->db->update('jobs', $data);

        redirect(site_url('site/post/'.$job_id));
    }
    public function accept_job($job_id, $user_id){
        //do thisz
        $data = array(
                'status' => 'accepted',
                'developer_id' => $user_id
            );
        $this->db->where('job_id', $job_id);
        $this->db->update('jobs', $data);
        redirect(site_url('site/posts'));
    }
}