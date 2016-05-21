</br>
</br>
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <?php
          echo "<div class='panel-heading'><h4><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;User Profile: ".$user_other->first_name." ".$user_other->last_name."</h4></div>";
          echo "<table class='table'>";
          echo "<tr><td><b>First Name: </b></td><td>".$user_other->first_name."</td></tr>";
          echo "<tr><td><b>Last Name: </b></td><td>".$user_other->last_name."</td></tr>";
          echo "<tr><td><b>Email: </b></td><td>".$user_other->email."</td></tr>";
          echo "<tr><td><b>Sex: </b></td><td>".$user_other->sex."</td></tr>";
          echo "<tr><td><b>Location: </b></td><td>".$user_other->location."</td></tr>";
          echo "<tr><td><b>Birthdate: </b></td><td>".$user_other->birthdate."</td></tr>";
          echo "<tr><td><b>Skills: </b></td><td>".$user_other->skills."</td></tr>";
          echo "<tr><td><b>Work Experience: </b></td><td>".$user_other->work_exp."</td></tr>";
          echo "<tr><td><b>Projects: </b></td><td>".$user_other->projects."</td></tr>";

      ?>

      </table>
    </div>
  </div>
</div>