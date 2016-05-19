<?php
// a model to load the posts.
class Job_model extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
	
	public function get_my_listings($user_id, $query_term) {
        $query_string = "SELECT * FROM `jobs` JOIN `users` ON `jobs`.`poster_id` = `users`.`id` JOIN `post` ON `jobs`.`post_id` = `post`.`post_id` WHERE `jobs`.`type` = 'client' AND `jobs`.`status` = 'not accepted' AND `jobs`.`client_id`='".$user_id."'";
        if(null !== $query_term && "" !== $query_term){
            $query_string .= " AND (`jobs`.`title` LIKE '%".$query_term."%' OR `post`.`description` LIKE '%".$query_term."%')";
        }
        $query = $this->db->query($query_string);
        return $query->result();
    }

    public function get_accepted_jobs($user_id, $query_term) {
        $query_string = "SELECT * FROM `jobs` JOIN `users` ON `jobs`.`poster_id` = `users`.`id` JOIN `post` ON `jobs`.`post_id` = `post`.`post_id` WHERE `jobs`.`type` = 'client' AND `jobs`.`status` = 'accepted' AND `jobs`.`developer_id`='".$user_id."'";
        if(null !== $query_term && "" !== $query_term){
            $query_string .= " AND (`jobs`.`title` LIKE '%".$query_term."%' OR `post`.`description` LIKE '%".$query_term."%')";
        }
        $query = $this->db->query($query_string);
        return $query->result();
    }

    public function get_all_listings($query_term) {
        $query_string = "SELECT * FROM `jobs` JOIN `users` ON `jobs`.`poster_id` = `users`.`id` JOIN `post` ON `jobs`.`post_id` = `post`.`post_id` WHERE `jobs`.`type` = 'client' AND `jobs`.`status` = 'not accepted'";
        if(null !== $query_term && "" !== $query_term){
            $query_string .= " AND (`jobs`.`title` LIKE '%".$query_term."%' OR `post`.`description` LIKE '%".$query_term."%')";
        }
        $query = $this->db->query($query_string);
        return $query->result();
    }
}
?>