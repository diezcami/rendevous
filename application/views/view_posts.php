<div class="container">
  <br>
  <table class="table forum table-striped">
      <thead>
      <tr>
        <th class="cell-stat"></th>
        <th>
          <h3>Jobs</h3>
        </th>
        <th class="cell-stat text-center hidden-xs hidden-sm">Replies</th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Latest Reply</th>
      </tr>
    </thead>
    <tbody>
      <?php

        //var_dump($posts);
          if(count($jobs)!=0){
            foreach( $jobs as $job ){
              echo "
                <tr>
                  <td class='text-center'></td>
                  <td>
                    <h4><a href='".site_url('/site/post/'.$job->post_id)."'>".$job->title."</a><br><small>".word_limiter($job->description, 15)."</small></h4>
                  </td>
                  <td class='text-center hidden-xs hidden-sm'><a href='#''>89 897</a></td>
                  <td class='hidden-xs hidden-sm'>by <a href='#''>".$job->first_name." ".$job->last_name."</a><br><small><i class='fa fa-clock-o'></i> 3 months ago</small></td>
                </tr>
              ";
          }
        }else{
          echo '<tr>
            <td></td>
            <td colspan="4" class="center">No topics have been added yet.</td>
          </tr>'; 
       }
      ?>
    </tbody>
  </table>
  <table class="table forum table-striped">
    <thead>
      <thead>
      <tr>
        <th class="cell-stat"></th>
        <th>
          <h3>For Hire</h3>
        </th>
        <th class="cell-stat text-center hidden-xs hidden-sm">Replies</th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Latest Reply</th>
      </tr>
    </thead>
    <tbody>
      <?php

        //var_dump($posts);
          if(count($devs)!=0){
            foreach( $devs as $devforhire ){
              echo "
                <tr>
                  <td class='text-center'><i class='fa fa-question fa-2x text-primary'></i></td>
                  <td>
                    <h4><a href='".site_url('/site/job/'.$job->post_id)."'>".$job->title."</a><br><small>".word_limiter($job->description, 15)."</small></h4>
                  </td>
                  <td class='text-center hidden-xs hidden-sm'><a href='#''>89 897</a></td>
                  <td class='hidden-xs hidden-sm'>by <a href='#''>".$job->first_name." ".$job->last_name."</a><br><small><i class='fa fa-clock-o'></i> 3 months ago</small></td>
                </tr>
              ";
          }
        }else{
          echo '<tr>
            <td></td>
            <td colspan="4" class="center">No topics have been added yet.</td>
          </tr>'; 
       }
      ?>
    </tbody>
  </table>
</div>