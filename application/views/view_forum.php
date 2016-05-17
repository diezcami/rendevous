<div class="container">
  <br>
    <h1 class="pull-left">Forum</h1>
    <div class="clearfix"></div>
  <table class="table forum table-striped">
    <thead>
      <tr>
        <th class="cell-stat"></th>
        <th>
          <h3>Announcements</h3>
        </th>
        <th class="cell-stat text-center hidden-xs hidden-sm">Replies</th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Latest Reply</th>
      </tr>
    </thead>
    <tbody>
      <?php
        //var_dump($posts);
          /*if(count($announcements)!=0){
            foreach( $announcements as $announcement ){
              echo "
                <tr>
                  <td class='text-center'><i class='fa fa-question fa-2x text-primary'></i></td>
                  <td>
                    <h4><a href='".site_url('/site/discussion/'.$announcement->discussion_id)."'>".$announcement->title."</a><br><small>".$announcement->excerpt."</small></h4>
                  </td>
                  <td class='text-center hidden-xs hidden-sm'><a href='#''>89 897</a></td>
                  <td class='hidden-xs hidden-sm'>by <a href='#''>".$announcement->username."</a><br><small><i class='fa fa-clock-o'></i> 3 months ago</small></td>
                </tr>
              ";
          }
        }else{*/
          echo '<tr>
            <td></td>
            <td colspan="4" class="center">No topics have been added yet.</td>
          </tr>'; 
       // }
      ?>
    </tbody>
  </table>
  <table class="table forum table-striped">
    <thead>
      <tr>
        <th class="cell-stat"></th>
        <th>
          <h3>Open Discussion</h3>
        </th>
        <th class="cell-stat text-center hidden-xs hidden-sm">Replies</th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Last Post</th>
      </tr>
    </thead>
    <tbody>
      <?php
        //var_dump($posts);
        /*if(count($posts)!=0){
          foreach( $posts as $post ){
            echo "
              <tr>
                <td class='text-center'><i class='fa fa-question fa-2x text-primary'></i></td>
                <td>
                  <h4><a href='".site_url('/site/discussion/'.$announcement->discussion_id)."'>".$announcement->title."</a><br><small>".$announcement->excerpt."</small></h4>
                </td>
                <td class='text-center hidden-xs hidden-sm'><a href='#''>89 897</a></td>
                <td class='hidden-xs hidden-sm'>by <a href='#''>".$announcement->username."</a><br><small><i class='fa fa-clock-o'></i> 3 months ago</small></td>
              </tr>
            ";
          }
        }else{*/
          echo '<tr>
            <td></td>
            <td colspan="4" class="center">No topics have been added yet.</td>
          </tr>'; 
        //}
        

      ?>
      
    </tbody>
  </table>
</div>
</div>