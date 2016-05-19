<div class="container">
  <br>
  <div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6">
      <?php echo form_open(site_url('site/posts/')); ?>
      <div class="input-group">
        
        <input type="text" name='search_query' id='search_query' class="form-control" placeholder="Search for..." <?php if(isset($search_query))echo 'value="'.$search_query.'"';?>>
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">Go!</button>
        </span>
        
      </div>
      </form>
    </div>
  </div>
  <br>
  <table class="table forum table-striped">
      <thead>
      <tr>
        <th class="cell-stat"></th>
        <th>
          <h3>Jobs   <a href="<?php echo site_url('site/new_post/client/'.$user->id)?>"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a></h3>
        </th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Poster</th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Latest Reply</th>
      </tr>
    </thead>
    <tbody>
      <?php
          if(count($jobs)!=0){
            foreach( $jobs as $job ){
              echo "
                <tr>
                  <td class='text-center'></td>
                  <td>
                    <h4><a href='".site_url('/site/post/'.$job->job_id)."'>".$job->title."</a><br><small>".word_limiter($job->description, 15)."</small></h4>
                  </td>
                  <td class='hidden-xs hidden-sm'>by <a href='#''>".$job->first_name." ".$job->last_name."</a><br><small><i class='fa fa-clock-o'></i> ".date('j M Y', strtotime($job->timestamp))."</small></td>
                  <td class='hidden-xs hidden-sm'>by <a href='#''>".$job->first_name." ".$job->last_name."</a><br><small><i class='fa fa-clock-o'></i> ".date('j M Y', strtotime($job->timestamp))."</small></td>
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
          <h3>For Hire   <a href="<?php echo site_url('site/new_post/dev/'.$user->id)?>"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a></h3>
        </th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Poster</th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Latest Reply</th>
      </tr>
    </thead>
    <tbody>
      <?php

        //var_dump($posts);
          if(count($devs)!=0){
            foreach( $devs as $dev ){
              echo "
                <tr>
                  <td class='text-center'></td>
                  <td>
                    <h4><a href='".site_url('/site/post/'.$dev->job_id)."'>".$dev->title."</a><br><small>".word_limiter($dev->description, 15)."</small></h4>
                  </td>
                  <td class='hidden-xs hidden-sm'>by <a href='#''>".$dev->first_name." ".$dev->last_name."</a><br><small><i class='fa fa-clock-o'></i> ".date('j M Y', strtotime($dev->timestamp))."</small></td>
                  <td class='hidden-xs hidden-sm'>by <a href='#''>".$dev->first_name." ".$dev->last_name."</a><br><small><i class='fa fa-clock-o'></i> ".date('j M Y', strtotime($dev->timestamp))."</small></td>
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