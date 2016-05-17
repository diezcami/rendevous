<html>
<head>
  <meta charset="utf-8">
  <!-- Latest compiled and minified CSS -->
  <?php
    $this->load->helper('url')
  ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css')?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css')?>">
  <title>JCAPLDP</title>
</head>
<body>
<div class="container">
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Login Form View
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2016, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

if( ! isset( $optional_login ) )
{
  echo '<h1>Login</h1>';
}

if( ! isset( $on_hold_message ) )
{
  if( isset( $login_error_mesg ) )
  {
    echo '
      <div style="border:1px solid red;">
        <p>
          Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . ': Invalid Username, Email Address, or Password.
        </p>
        <p>
          Username, email address and password are all case sensitive.
        </p>
      </div>
    ';
  }

  if( $this->input->get('logout') )
  {
    echo '
      <div style="border:1px solid green">
        <p>
          You have successfully logged out.
        </p>
      </div>
    ';
  }

  echo form_open( site_url('auth/login'), array( 'class' => 'std-form form-signin' ) ); 
?>

  <div class="container">
    <label for="identity" class="form_label">Email</label>
    <input type="text" name="identity" id="identity" class="form-control form_input" autocomplete="off" maxlength="255" />

    <br />

    <label for="password" class="form_label">Password</label>
    <input type="password" name="password" id="password" class="form-control form_input password" maxlength="<?php echo config_item('max_chars_for_password'); ?>" autocomplete="off" readonly="readonly" onfocus="this.removeAttribute('readonly');" />
    <br>


    <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Login" id="submit_button"  />

  </div>
</form>
<?php
  }

/* End of file login_form.php */
/* Location: /community_auth/views/examples/login_form.php */ 