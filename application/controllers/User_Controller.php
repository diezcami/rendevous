<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class User_Controller extends REST_Controller {

   /**
    * This method returns all users
    * MAGIS TODO: Use last_updated_TS
    *
    * WORKING BUILD
    *
    * @flow: Server->App
    * @post_params: none
    * @output: JSON containing users
    */
   function users_post(){
        $this->load->model('User_Model');
        $data = $this->User_Model->get_users();
        $this->response($data, 404);
   }
}
