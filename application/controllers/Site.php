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
                            array('Forum', site_url('site/forum'), 'view_forum'),
                            array('Settings', site_url('site/settings'), 'view_settings')
            );
        if($this->ion_auth->is_admin()){
            array_push($this->nav, array('Users', site_url('site/users'), 'view_users'));
            array_push($this->nav, array('Announcements', site_url('site/new_announcement'), 'view_new_announcement'));
        }
        $this->load->vars(array('NavigationArray'=>$this->nav));
        $this->load->library("pagination");
    }
    
    public function forum(){

        /*$this->db->select('*');
        $this->db->from('posts');
        $this->db->join('users', 'posts.user_id = users.user_id');
        $this->db->where('posts.post_id=discussion_id');
        $this->db->where('type', '0');

        $query = $this->db->get();

        $data['announcements'] = $query->result();

        $this->db->select('*');
        $this->db->from('posts');
        $this->db->join('users', 'posts.user_id = users.user_id');
        $this->db->where('posts.post_id=discussion_id');
        $this->db->where('type', '1');

        $query = $this->db->get();

        $data['posts'] = $query->result();

        $this->view($this->nav[5][2], $data);*/
        $this->view($this->nav[3][2]);
    }
    public function new_announcement(){
        //if($this->verify_min_level(9)){
            $this->view($this->nav[6][2]);
            if(isset($_POST['subject'])){
                $this->send_email($_POST['subject'], $_POST['body']);
            }
        //}
    }
    public function view($currentPage = 'view_home', $data = null){
        $signedIn = false;
        $isWelcome = false;
        if(strcasecmp($currentPage, 'view_home') == 0){
            $isWelcome = true;
        }
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
    public function send_email($subject, $body){
        $query = $this->db->get('users');
        $result = $query->result();
        foreach($result as $user){
            //echo $user->email." ".$subject." ".$body;

            mail($user->email,$subject,$body);
        }
    }
    public function login(){
        // Method should not be directly accessible
        //if( $this->uri->uri_string() == 'examples/login')
        //   show_404();

       // if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
         //   $this->require_min_level(1);

        //$this->setup_login_form();
        //$html = $this->load->view('examples/page_header', '', TRUE);
        $this->load->view('view_login');
        //$html .= $this->load->view('examples/page_footer', '', TRUE);
    }
    public function logout(){
        $this->ion_auth->logout();
        redirect(site_url());
    }

}
