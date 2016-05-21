</br>
</br>
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <?php
          echo form_open(site_url('user/edit_user/'.$user_edit->id));
          echo "<div class='panel-heading'><h4><a href=".site_url('site/edit_user/'.$user_edit->id)."><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;User Profile: ".$user_edit->first_name." ".$user_edit->last_name."</h4></div>";
          echo "<table class='table'>";
          echo "<tr><td><b>First Name: </b></td><td><input type='text' class='form-control' name='first_name' value='".$user_edit->first_name."'></td></tr>";
          echo "<tr><td><b>Last Name: </b></td><td><input type='text' class='form-control' name='last_name' value='".$user_edit->last_name."'></td></tr>";
          echo "<tr><td><b>Email: </b></td><td>".$user_edit->email."</td></tr>";
          echo "<tr><td><b>Sex: </b></td><td><input type='text' class='form-control' name='sex' value='".$user_edit->sex."'></td></tr>";
          echo "<tr><td><b>Location: </b></td><td><input type='text' class='form-control' name='location' value='".$user_edit->location."'></td></tr>";
          echo "<tr><td><b>Birthdate: </b></td><td><input type='text' class='form-control' name='birthdate' value='".$user_edit->birthdate."'></td></tr>";
          echo "<tr><td><b>Skills: </b></td><td><input type='text' class='form-control' name='skills' value='".$user_edit->skills."'></td></tr>";
          echo "<tr><td><b>Work Experience: </b></td><td><input type='text' class='form-control' name='work_exp' value='".$user_edit->work_exp."'></td></tr>";
          echo "<tr><td><b>Projects: </b></td><td><input type='text' class='form-control' name='projects' value='".$user_edit->projects."'></td></tr>";
          echo "<tr><td><input value= 'Save' type='submit' class='btn btn-default'></td></tr>";
          echo "</form>";

      ?>

      </table>
    </div>
  </div>
</div>`
      </table>
    </div>
  </div>
</div>