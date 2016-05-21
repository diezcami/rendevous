</br>
</br>
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <?php
          echo "<div class='panel-heading'><h4><a href=".site_url('site/edit_user/'.$user->id)."><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;User Profile: ".$user->first_name." ".$user->last_name."</h4></div>";
          echo "<table class='table'>";
          echo "<tr><td><b>First Name: </b></td><td>".$user->first_name."</td></tr>";
          echo "<tr><td><b>Last Name: </b></td><td>".$user->last_name."</td></tr>";
          echo "<tr><td><b>Email: </b></td><td>".$user->email."</td></tr>";
          echo "<tr><td><b>Sex: </b></td><td>".$user->sex."</td></tr>";
          echo "<tr><td><b>Location: </b></td><td>".$user->location."</td></tr>";
          echo "<tr><td><b>Birthdate: </b></td><td>".$user->birthdate."</td></tr>";
          echo "<tr><td><b>Skills: </b></td><td>".$user->skills."</td></tr>";
          echo "<tr><td><b>Work Experience: </b></td><td>".$user->work_exp."</td></tr>";
          echo "<tr><td><b>Projects: </b></td><td>".$user->projects."</td></tr>";

      ?>

      </table>
    </div>
  </div>
</div>