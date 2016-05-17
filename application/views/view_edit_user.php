</br>
</br>
<div class="container">
  <?php
  $this->load->helper('url');
  ?>
  <div class="row">
    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading"><h4>Edit User</h4></div>
      <!-- Table -->
      <table class="table">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>          
            <th>Email</th>
            <th>Groups</th>
            <th></th>
          </tr>
        </thead>
        <?php
        //var_dump($usergroup);
          echo form_open(site_url('user/edit_user/'.$user[0]->id));
            
            echo "
            <tr>
              <td><input type='text' class='form-control' name='first_name' value='".$user[0]->first_name."'></td>
              <td><input type='text' class='form-control' name='last_name' value='".$user[0]->last_name."'></td>
              <td><input type='text' class='form-control' name='email' value='".$user[0]->email."'></td>";
              echo "<td>";
              foreach($usergroup as $ug){
                  echo $ug->name. " ";
              }
              echo "</td>";
              echo "<td><input value= 'Save' type='submit' class='btn btn-default'></td>
            </tr></form>";
          ?>
      </table>
    </div>
  </div>
</div>