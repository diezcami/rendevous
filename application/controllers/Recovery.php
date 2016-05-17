<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Community Auth - Examples Controller
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2016, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

class Recovery extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        # New pages must be declared in this array to include them in the nav bar.
        # array('Page Name', 'url', 'view name*' )
        # *the view that will be loaded.
        # Don't forget to add the function for the page below!
    }
    public function recover(){
        // Load resources
        $this->load->model('examples_model');

        /// If IP or posted email is on hold, display message
        if( $on_hold = $this->authentication->current_hold_status( TRUE ) )
        {
            $view_data['disabled'] = 1;
        }
        else
        {
            // If the form post looks good
            if( $this->tokens->match && $this->input->post('email') )
            {
                if( $user_data = $this->examples_model->get_recovery_data( $this->input->post('email') ) )
                {
                    // Check if user is banned
                    if( $user_data->banned == '1' )
                    {
                        // Log an error if banned
                        $this->authentication->log_error( $this->input->post('email', TRUE ) );

                        // Show special message for banned user
                        $view_data['banned'] = 1;
                    }
                    else
                    {
                        /**
                         * Use the authentication libraries salt generator for a random string
                         * that will be hashed and stored as the password recovery key.
                         * Method is called 4 times for a 88 character string, and then
                         * trimmed to 72 characters
                         */
                        $recovery_code = substr( $this->authentication->random_salt() 
                            . $this->authentication->random_salt() 
                            . $this->authentication->random_salt() 
                            . $this->authentication->random_salt(), 0, 72 );

                        // Update user record with recovery code and time
                        $this->examples_model->update_user_raw_data(
                            $user_data->user_id,
                            array(
                                'passwd_recovery_code' => $this->authentication->hash_passwd($recovery_code),
                                'passwd_recovery_date' => date('Y-m-d H:i:s')
                            )
                        );

                        // Set the link protocol
                        $link_protocol = USE_SSL ? 'https' : NULL;

                        // Set URI of link
                        $link_uri = 'recovery/recovery_verification/' . $user_data->user_id . '/' . $recovery_code;

                        $view_data['special_link'] = anchor( 
                            site_url( $link_uri, $link_protocol ), 
                            site_url( $link_uri, $link_protocol ), 
                            'target ="_blank"' 
                        );

                        $view_data['confirmation'] = 1;
                        $body = "Your password can be reset through this link: ".site_url( $link_uri, $link_protocol );
                        echo anchor(site_url( $link_uri, $link_protocol ));
                        //mail($this->input->post('email'),"JCAPLDP Website Password Reset",$body);
                    }
                }

                // There was no match, log an error, and display a message
                else
                {
                    // Log the error
                    $this->authentication->log_error( $this->input->post('email', TRUE ) );

                    $view_data['no_match'] = 1;
                }
            }
        }

        echo $this->load->view('view_recovery_done', ( isset( $view_data ) ) ? $view_data : '', TRUE );
    }
    public function recovery_verification( $user_id = '', $recovery_code = '' ){
            /// If IP is on hold, display message
            if( $on_hold = $this->authentication->current_hold_status( TRUE ) )
            {
                $view_data['disabled'] = 1;
            }
            else
            {
                // Load resources
                $this->load->model('examples_model');

                if( 
                    /**
                     * Make sure that $user_id is a number and less 
                     * than or equal to 10 characters long
                     */
                    is_numeric( $user_id ) && strlen( $user_id ) <= 10 &&

                    /**
                     * Make sure that $recovery code is exactly 72 characters long
                     */
                    strlen( $recovery_code ) == 72 &&

                    /**
                     * Try to get a hashed password recovery 
                     * code and user salt for the user.
                     */
                    $recovery_data = $this->examples_model->get_recovery_verification_data( $user_id ) )
                {
                    /**
                     * Check that the recovery code from the 
                     * email matches the hashed recovery code.
                     */
                    if( $recovery_data->passwd_recovery_code == $this->authentication->check_passwd( $recovery_data->passwd_recovery_code, $recovery_code ) )
                    {
                        $view_data['user_id']       = $user_id;
                        $view_data['username']     = $recovery_data->username;
                        $view_data['recovery_code'] = $recovery_data->passwd_recovery_code;
                    }

                    // Link is bad so show message
                    else
                    {
                        $view_data['recovery_error'] = 1;

                        // Log an error
                        $this->authentication->log_error('');
                    }
                }

                // Link is bad so show message
                else
                {
                    $view_data['recovery_error'] = 1;

                    // Log an error
                    $this->authentication->log_error('');
                }

                /**
                 * If form submission is attempting to change password 
                 */
                if( $this->tokens->match )
                {
                    $this->examples_model->recovery_password_change();
                }
            }

            //echo $this->load->view('examples/page_header', '', TRUE);

            echo $this->load->view( 'choose_password_form', $view_data, TRUE );

            //echo $this->load->view('examples/page_footer', '', TRUE);
        }
    }