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
            <th>First Name</th>
            <th>Last Name</th>           
            <th>Email</th>
            <th>User Group</th>
            <th></th>
          </tr>
        </thead>
        

        <?php
        if( $users != '300' ){
          //var_dump($users);
          //var_dump($usergroup);
          foreach( $users as $user ){
            echo "<tr>";
            echo "<td>";
            echo "<td>".$user->first_name."</td>";
            echo "<td>".$user->last_name."</td>";
            echo "<td>".$user->email."</td>";
            echo "<td>";
            foreach($usergroup as $ug){
              if($ug->id == $user->id){
                echo $ug->name. " ";
              }
            }
            echo "</td>";
            echo "<td class='details'>
              <a class=\"btn btn-default btn-sm glyphicon glyphicon-minus-sign\" onclick=\"return confirm('Are you sure you want to delete this user?: ".$user->first_name." ".$user->last_name."');\" type='button' href='".site_url("/user/delete_user/".$user->id)."'></a>
              <a class='btn btn-default btn-sm glyphicon glyphicon-list-alt' type='button' href='".site_url("/site/edit_user/".$user->id)."'></a>
            </td>";
            echo"</tr>";
          }
        }else{
            echo "<tr>";
            echo "<td> No entries found. </td>";
            echo "</tr>";
        }
          

          // ADD FORM
            echo "<form action='".site_url("/user/new_user")."' method=\"post\"><tr>
            <td><b>Add User</b></td>
            <td><input type='text' class='form-control' name='first_name' placeholder='First Name'></td>
            <td><input type='text' class='form-control' name='last_name' placeholder='Last Name'></td>
            <td><input type='text' class='form-control' name='email' placeholder='Email'></td>
            <td><input type='text' class='form-control' name='group' placeholder='User Group'></td>
            <td><input type='password' class='form-control' placeholder='Password' name='password'></td>
            <td><input type='password' class='form-control' placeholder='Verify Password' name='vpassword'></td>
            <td><input value= \"Add User\" type=\"submit\" class=\"btn btn-default\"></td>
            </tr></form>";
        ?>
      </table>
    </div>
  </div>
</div>