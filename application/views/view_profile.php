</br>
</br>
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <?php
        //var_dump($display_user);
        //if ($display_user) {
          echo "<div class='panel-heading'><h4>User Profile: ".$user->username."</h4></div>";
          echo "<table class='table'>";
          echo "<tr><td><b>Username: </b></td><td>".$user->username."</td></tr>";
          echo "<tr><td><b>Name: </b></td><td>".$user->first_name." ".$user->last_name."</td></tr>";
          echo "<tr><td><b>Sex: </b></td><td>".$user->sex."</td></tr>";
          echo "<tr><td><b>Location: </b></td><td>".$user->location."</td></tr>";
          echo "<tr><td><b>Birthdate: </b></td><td>".$user->birthdate."</td></tr>";
          echo "<tr><td><b>Skills: </b></td><td>".$user->skills."</td></tr>";
          echo "<tr><td><b>Work Experience: </b></td><td>".$user->work_exp."</td></tr>";
          echo "<tr><td><b>Projects: </b></td><td>".$user->projects."</td></tr>";
        //} else {
         // echo "<div class='panel-heading'><h4>View Profile</h4></div>";
       // }
            echo "<form action=\"".site_url("site/profile/")."\" method=\"post\"><tr>";
            echo "<td><input type='text' class='form-control' name='username' value='Username'></td>";
            echo "<td><input type=\"submit\" class=\"btn btn-default\"></td>";
            echo"</tr></form>";

      ?>

      </table>
    </div>
  </div>
</div>