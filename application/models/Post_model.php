<?php
// a model to load the posts.
class Post_model extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
	public function record_count() {
        return $this->db->count_all("post");
    }
	public function get_posts($start = 0, $numPosts = 10){
		$query = $this->db->get('post', $start, $numPosts);
		return $query->result_array();
	}
	public function new_reply_post($body, $user_id, $job_id){
        $data = array(
           'description' => $body,
           'user_id' => $user_id,
           'job_id' => $job_id
        );
    	$this->db->insert('post', $data);
    }
    public function new_listing($user_id, $post_type, $title, $description){
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
        return $job_id;
    }
    public function accept_job($job_id, $user_id){
    	$data = array(
                'status' => 'accepted',
                'developer_id' => $user_id
            );
        $this->db->where('job_id', $job_id);
        $this->db->update('jobs', $data);
    }
}
?>