<?php 
    class User_Model extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        function get_user($username){
            $query = $this->db->query ("SELECT * FROM users WHERE username = '{$username}'");
            if($query->num_rows() > 0) {
                $ret = $query->result();
            } else {
                $ret = null;
                //$ret = 'A user with this username does not exist.';
            }

            return $ret;
        }
        
        function update_user($username, $first_name, $last_name, $birthdate, $sex, $skills, $work_exp, $project){
            $this->db->query( "UPDATE user SET first_name = '{$first_name}', last_name = '{$last_name}', birthdate = '{$birthdate}', sex = '{$sex}', skills = '{$skills}', work_exp = '{$work_exp}', project = '{$project}' WHERE username = '{$id}'");
        }
    }

?>