<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Post_model');
    }
    public function new_reply($job_id, $user_id){
        $this->Post_model->new_reply_post($this->input->post('body'), $user_id, $job_id);
        redirect(site_url('/site/post/'.$job_id));
    }

    public function new_post($post_type, $user_id){
        $job_id = $this->Post_model->new_listing($user_id, $post_type, $this->input->post('title'), $this->input->post('description'));
        redirect(site_url('site/post/'.$job_id));
    }
    public function accept_job($job_id, $user_id){
        $this->Post_model->accept_job($job_id, $user_id);
        redirect(site_url('site/posts'));
    }
}