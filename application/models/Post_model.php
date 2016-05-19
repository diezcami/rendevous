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
}
?>