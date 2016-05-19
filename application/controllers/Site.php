<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    private $nav;
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        # New pages must be declared in this array to include them in the nav bar.
        # array('Page Name', 'url', 'view name*' )
        # *the view that will be loaded.
        # Don't forget to add the function for the page below!
        $this->nav = array( array('Dashboard', site_url('site/dashboard'), 'view_dashboard'),
                            array('Profile', site_url('site/profile'), 'view_profile'),
                            array('Transactions', site_url('site/transactions'), 'view_transactions'),
                            array('Posts', site_url('site/posts'), 'view_posts'),
                            array('Settings', site_url('site/settings'), 'view_settings')
            );
        if($this->ion_auth->is_admin()){
            array_push($this->nav, array('Users', site_url('site/users'), 'view_users'));
            array_push($this->nav, array('Announcements', site_url('site/new_announcement'), 'view_new_announcement'));
        }
        $this->load->vars(array('NavigationArray'=>$this->nav));
        $this->load->library("pagination");
    }
    public function posts(){
        $this->load->helper('text');

        /*$this->db->select('*');
        $this->db->from('post');
        $this->db->join('users', 'post.user_id = users.id');
        $this->db->where('post.type', 'client');
        $this->db->where('post.post_id = post.orig_post');
        if(null !== $this->input->post('search_query') && "" !== $this->input->post('search_query')){      
           $search_query = $this->input->post('search_query');
           $this->db->like('post.title', $search_query, 'both');
           $this->db->or_like('post.description', $search_query, 'both');  
        }
        $query = $this->db->get();*/
        $query_string = "SELECT * FROM `post` JOIN `users` ON `post`.`user_id` = `users`.`id` WHERE `post`.`type` = 'client' AND `post`.`post_id` = `post`.`orig_post`";
        if(null !== $this->input->post('search_query') && "" !== $this->input->post('search_query')){
            $query_string .= " AND (`post`.`title` LIKE '%".$this->input->post('search_query')."%' OR `post`.`description` LIKE '%".$this->input->post('search_query')."%')";
        }

        $query = $this->db->query($query_string);
        echo $this->db->last_query()."<br>";
        $data['jobs'] = $query->result(); 
        /*/$this->db->select('*');
        $this->db->from('post');
        $this->db->join('users', 'post.user_id = users.id');
        $this->db->where('post.type', 'dev');
        $this->db->where('post.post_id = post.orig_post');
        if(null !== $this->input->post('search_query') && "" !== $this->input->post('search_query')){      
           $search_query = $this->input->post('search_query');
           $this->db->like('post.title', $search_query, 'both');
           $this->db->or_like('post.description', $search_query, 'both');
        }*/

        $query_string = "SELECT * FROM `post` JOIN `users` ON `post`.`user_id` = `users`.`id` WHERE `post`.`type` = 'dev' AND `post`.`post_id` = `post`.`orig_post`";
        if(null !== $this->input->post('search_query') && "" !== $this->input->post('search_query')){
            $query_string .= " AND (`post`.`title` LIKE '%".$this->input->post('search_query')."%' OR `post`.`description` LIKE '%".$this->input->post('search_query')."%')";
        }

        $query = $this->db->query($query_string);
        echo $this->db->last_query();
        $data['devs'] = $query->result();
        $data['search_query'] = $this->input->post('search_query');

        $this->view($this->nav[3][2], $data);
    }
    public function post($post_id){
        //var_dump($this->auth_user_id);
        $this->db->select('*');
        $this->db->from('post');
        $this->db->join('users', 'post.user_id = users.id');
        $this->db->where('orig_post', $post_id);
        $query = $this->db->get();

        $data['posts'] = $query->result();

        $this->db->select('title');
        $this->db->from('post');
        $this->db->where('post_id', $post_id);
        $query = $this->db->get();

        $res = $query->result();
        //var_dump($res);
        $data['post_title'] = $res[0]->title;
        $data['post_id'] = $post_id;

        $this->view('view_post', $data);
    }
    public function new_post($post_type, $user_id){
        $data['post_type'] = $post_type;
        $this->view('view_new_post', $data);
    }
    public function view($currentPage = 'view_home', $data = null){
        $signedIn = false;
        $isWelcome = false;
        if(strcasecmp($currentPage, 'view_home') == 0){
            $isWelcome = true;
        }
        $data['user'] = $this->ion_auth->user()->row();
        $data['activeLink'] = $currentPage;
        $data['isWelcome'] = $isWelcome;
        if($this->ion_auth->logged_in()){
            $this->load->view('header', $data);
            $this->load->view($currentPage);
            $this->load->view('footer');
        }else{
            redirect(site_url('site/login'));
        }
        
    }
    public function index(){
        $this->view();
    }
    public function dashboard(){
        $this->load->model("Dashboard_model");
        $config = array();
        $config["per_page"] = 10;
        $config['total_rows'] = $this->Dashboard_model->record_count();
        $config["base_url"] = site_url('site/dashboard');
        $config["num_tag_open"] = "&nbsp;";
        $config["num_tag_close"] = "&nbsp;";
        $this->pagination->initialize($config);
        $data = array();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Dashboard_model->get_posts($config["per_page"], $page);
        $data["pagination"] = $this->pagination->create_links();
        
        // $this->load->view("example1", $data);
        $this->view($this->nav[0][2], $data);
    }
    public function profile(){
        //$this->load->model("User_Model");
        //$data['user'] = $this->ion_auth->user()->row();
        //$data['user'] = $data['user'][0]; // Always just one entry
        //$data['display_user'] = $username==null?false:true;
        $this->view($this->nav[1][2]);  
    }
    public function transactions(){
        $this->view($this->nav[2][2]);
    }
    public function settings(){
        $this->view($this->nav[4][2]);
    }
    public function users(){

        $query = $this->db->get('users');
        $data['users'] = $query->result();

        $this->db->select('users.id, groups.name');
        $this->db->from('users');
        $this->db->join('users_groups', 'users.id = users_groups.user_id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');

        $query = $this->db->get();
        $data['usergroup'] = $query->result();

        $this->view($this->nav[5][2], $data);
    }
    public function new_announcement(){
            $this->view($this->nav[6][2]);
            if(isset($_POST['subject'])){
                $this->send_email($_POST['subject'], $_POST['body']);
            }
    }
    
    public function send_email($subject, $body){
        $query = $this->db->get('users');
        $result = $query->result();
        foreach($result as $user){
            //echo $user->email." ".$subject." ".$body;

            //mail($user->email,$subject,$body);
        }
    }
    public function edit_user($user_id){
        $data['user'] = $this->db->get_where('users', array('id' => $user_id))->result();

        $this->db->select('users.id, groups.name');
        $this->db->from('users');
        $this->db->join('users_groups', 'users.id = users_groups.user_id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
        $this->db->where('users.id', $user_id);

        $query = $this->db->get();
        $data['usergroup'] = $query->result();

        $this->view('view_edit_user', $data);
    }
    public function login(){
        $this->load->view('view_login');
    }
    public function logout(){
        $this->ion_auth->logout();
        redirect(site_url());
    }

}
