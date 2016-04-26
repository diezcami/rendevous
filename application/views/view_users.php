</br>
</br>
<div class="container">
  <?php
  $this->load->helper('url');
    /*if($update){
      echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
      echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times</span></button>";
      echo "<strong>Success!</strong> Entry was updated.";

      echo "</div>";
    }//var_dump($users);*/
  ?>
  <div class="row">
    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading"><h4>Users</h4></div>
      <!-- Table -->
      <table class="table">
        <thead>
          <tr>
            <th></th>
            <th>Username</th>           
            <th>Email</th>
            <th>Authentication Level</th>
            <th></th>
          </tr>
        </thead>
        

        <?php
        if( $users != '300' ){
          //var_dump($users);
          foreach( $users as $user ){
            echo "<tr>";
            echo "<td>";
            echo "<td>".$user->username."</td>";
            echo "<td>".$user->email."</td>";
            echo "<td>".$user->auth_level."</td>";
            //echo "<td class='details'><a class='btn btn-default btn-sm' type='button' href='".site_url("site/edit_user/$user->id_number")."'><span class='glyphicon glyphicon-list-alt'></span></a></td>";
            echo"</tr>";
          }
        }else{
            echo "<tr>";
            echo "<td> No entries found. </td>";
            echo"</tr>";
        }
          

          // ADD FORM
            echo "<form action=\"\" method=\"post\"><tr>";
            echo "<td><b>Add User</b></td>";
            echo "<td><input type='text' class='form-control' name='username' value='Username'></td>";
            echo "<td><input type='text' class='form-control' name='email' value='Email'></td>";
            echo "<td><input type='password' class='form-control' placeholder='Password' name='password'></td>";
            echo "<td><input type='password' class='form-control' placeholder='Verify Password' name='vpassword'></td>";
            echo "<td><input value= \"Add User\" type=\"submit\" class=\"btn btn-default\"></td>";
            echo"</tr></form>";
        ?>
      </table>
    </div>
  </div>
</div>