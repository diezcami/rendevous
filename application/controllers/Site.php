<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {

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
                            array('Settings', site_url('site/settings'), 'view_settings')
            );
        if($this->verify_min_level(9)){
            array_push($this->nav, array('Users', site_url('site/users'), 'view_users'));
            array_push($this->nav, array('Announcements', site_url('site/new_announcement'), 'view_new_announcement'));
        }
        $this->load->vars(array('NavigationArray'=>$this->nav));
        $this->load->library("pagination");
    }
    public function users(){
        $query = $this->db->get('users');
        if(isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['vpassword'])){
            if($_POST['password']==$_POST['vpassword']){
                //echo $_POST['username']." ".$_POST['email']." ".$_POST['password']." ".$_POST['vpassword'];
                $this->create_user($_POST['username'], $_POST['password'], $_POST['email'], '1');
            }else echo "Passwords don't match.";
        }
        $data['users'] = $query->result();
        /*foreach ($query->result() as $row){
           echo $row->username;
           echo $row->email;
        }*/
        if($this->verify_min_level(9)){
            $this->view($this->nav[4][2], $data);
        }
    }
    public function new_announcement(){
        if($this->verify_min_level(9)){
            $this->view($this->nav[5][2]);
            if(isset($_POST['subject'])){
                $this->send_email($_POST['subject'], $_POST['body']);
            }
            
        }
    }
    public function view($currentPage = 'view_home', $data = null){
        $signedIn = false;
        $isWelcome = false;
        if(strcasecmp($currentPage, 'view_home') == 0){
            $isWelcome = true;
        }
        $data['activeLink'] = $currentPage;
        $data['isWelcome'] = $isWelcome;
        //$data = array( 'activeLink' => $currentPage,
        //              'isWelcome'=> $isWelcome);
        $this->load->view('header', $data);
        $this->load->view($currentPage);
        $this->load->view('footer');
    }
    public function index(){
        if( $this->require_min_level(1) ){
            $this->view();
        }
        
    }
    public function home(){
        $this->view();
    }
    public function profile(){
        $this->view($this->nav[1][2]);
    }
    public function transactions(){
        $this->view($this->nav[2][2]);
    }
    public function settings(){
        $this->view($this->nav[3][2]);
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

        if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
            $this->require_min_level(1);

        $this->setup_login_form();
        //$html = $this->load->view('examples/page_header', '', TRUE);
        $this->load->view('view_login');
        //$html .= $this->load->view('examples/page_footer', '', TRUE);
    }

    public function create_user($username=null, $pword=null, $email=null, $auth_level=null){
        // Customize this array for your user
        $user_data = array(
            'username'   => $username,
            'passwd'     => $pword,
            'email'      => $email,
            'auth_level' => $auth_level, // 9 if you want to login @ examples/index.
        );/*
        $user_data = array(
            'username'   => 'admin',
            'passwd'     => '45passworD',
            'email'      => 'admin@compsat.org',
            'auth_level' => '9', // 9 if you want to login @ examples/index.
        );*/

        $this->is_logged_in();

        //echo $this->load->view('examples/page_header', '', TRUE);

        // Load resources
        $this->load->model('examples_model');
        $this->load->model('validation_callables');
        $this->load->library('form_validation');

        $this->form_validation->set_data( $user_data );

        $validation_rules = array(
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'max_length[12]|is_unique[' . config_item('user_table') . '.username]',
                'errors' => array(
                    'is_unique' => 'Username already in use.'
                )
            ),
            array(
                'field' => 'passwd',
                'label' => 'passwd',
                'rules' => array(
                    'trim',
                    'required',
                    array( 
                        '_check_password_strength', 
                        array( $this->validation_callables, '_check_password_strength' ) 
                    )
                ),
                'errors' => array(
                    'required' => 'The password field is required.'
                )
            ),
            array(
                'field'  => 'email',
                'label'  => 'email',
                'rules'  => 'trim|required|valid_email|is_unique[' . config_item('user_table') . '.email]',
                'errors' => array(
                    'is_unique' => 'Email address already in use.'
                )
            ),
            array(
                'field' => 'auth_level',
                'label' => 'auth_level',
                'rules' => 'required|integer|in_list[1,6,9]'
            )
        );

        $this->form_validation->set_rules( $validation_rules );

        if( $this->form_validation->run() )
        {
            $user_data['passwd']     = $this->authentication->hash_passwd($user_data['passwd']);
            $user_data['user_id']    = $this->examples_model->get_unused_id();
            $user_data['created_at'] = date('Y-m-d H:i:s');

            // If username is not used, it must be entered into the record as NULL
            if( empty( $user_data['username'] ) )
            {
                $user_data['username'] = NULL;
            }

            $this->db->set($user_data)
                ->insert(config_item('user_table'));

            if( $this->db->affected_rows() == 1 );
                //$this->users();
                //echo '<h1>Congratulations</h1>' . '<p>User ' . $user_data['username'] . ' was created.</p>';
        }
        else
        {
            echo '<h1>User Creation Error(s)</h1>' . validation_errors();
        }

        echo $this->load->view('examples/page_footer', '', TRUE);
    }
    public function logout(){
        $this->authentication->logout();

        // Set redirect protocol
        $redirect_protocol = USE_SSL ? 'https' : NULL;

        redirect( site_url( LOGIN_PAGE . '?logout=1', $redirect_protocol ) );
    }

}
