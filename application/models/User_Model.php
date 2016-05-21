<?php 
    class User_Model extends CI_Model {
        public function __construct() {
            parent::__construct();
        }

        public function get_user($user_id){
            //return $this->ion_auth->user($user_id);
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('users.id',$user_id);
            $query = $this->db->get();
            return $query->result();
        }
        
        public function update_user($username, $first_name, $last_name, $birthdate, $sex, $skills, $work_exp, $project){
            $this->db->query( "UPDATE user SET first_name = '{$first_name}', last_name = '{$last_name}', birthdate = '{$birthdate}', sex = '{$sex}', skills = '{$skills}', work_exp = '{$work_exp}', project = '{$project}' WHERE username = '{$id}'");
        }

        public function get_all_users(){
            $query = $this->db->get('users');
            return $query->result();
        }

        public function get_user_groups($user_id=null){
            $this->db->select('users.id, groups.name');
            $this->db->from('users');
            $this->db->join('users_groups', 'users.id = users_groups.user_id');
            $this->db->join('groups', 'groups.id = users_groups.group_id');
            if($user_id!=null)$this->db->where('users.id', $user_id);

            $query = $this->db->get();
            return $query->result();
        }
    }

?>