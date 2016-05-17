<?php
// a model to load the posts.
class Post_model extends CI_Model {
	public $type = 'dev';
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function set_type($type)
	{
		$this->type = $type;
	}
	
	public function record_count() {
        return $this->db->where('type', $this->type)->from('post')->count_all_results();
    }
	
	// returns posts as an array.
	public function get_posts($start = 0, $numPosts = 10)
	{
		// $this->db->where('type', 'dev')
		$query = $this->db->where('type', $this->type)->get('post', $start, $numPosts);
		return $query->result_array();
	}
}
?>