</br>
</br>
<div class="container">
<?php
var_dump($user)
?>
  <div class="row">
    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading"><h4>Users</h4></div>
      <!-- Table -->
      <table class="table">
        <thead>
          <tr>
            <th>ID Number</th>           
            <th>Name</th>
            <th>PIN</th>
            <th>Balance</th>
            <th style="text-align:center;">Edit</th>
          </tr>
        </thead>
        

        <?php
            echo "<tr>";
            echo "<td>".$user->user_id."</td>";
            echo "<td>".$user->first_name." ".$user->last_name."</td>";
            echo "<td>".$user->birthdate."</td>";
            echo "<td>".$user->sex."</td>";

            echo"</tr>";
          
        ?>
      </table>
    </div>
  </div>
</div>