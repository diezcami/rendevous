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
          <h3>My Listings</h3>
        </th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Accepted by</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //var_dump($accepted_jobs);
          if(count($my_listings)!=0){
            foreach( $my_listings as $listing ){
              echo "
                <tr>
                  <td class='text-center'></td>
                  <td>
                    <h4><a href='".site_url('/site/post/'.$listing->job_id)."'>".$listing->title."</a><br><small>".word_limiter($listing->description, 15)."</small></h4>
                  </td>
                  
                  <td class='hidden-xs hidden-sm'>by <a href='#''>".$listing->dev_first." ".$listing->dev_last."</a><br><small><i class='fa fa-clock-o'></i> ".date('j M Y', strtotime($listing->timestamp))."</small></td>
                </tr>
              ";
          }
        }else{
          echo '<tr>
            <td></td>
            <td colspan="4" class="center">No listings have been added yet.</td>
          </tr>'; 
       }
      ?>
    </tbody>
  </table>
  <table class="table forum table-striped">
      <thead>
      <tr>
        <th class="cell-stat"></th>
        <th>
          <h3>Accepted</h3>
        </th>
        <th class="cell-stat-2x hidden-xs hidden-sm">Poster</th>
      </tr>
    </thead>
    <tbody>
      <?php
          if(count($accepted_jobs)!=0){
            foreach( $accepted_jobs as $listing ){
              echo "
                <tr>
                  <td class='text-center'></td>
                  <td>
                    <h4><a href='".site_url('/site/post/'.$listing->job_id)."'>".$listing->title."</a><br><small>".word_limiter($listing->description, 15)."</small></h4>
                  </td>
                  <td class='hidden-xs hidden-sm'>by <a href='#''>".$listing->first_name." ".$listing->last_name."</a><br><small><i class='fa fa-clock-o'></i> ".date('j M Y', strtotime($listing->timestamp))."</small></td>
                </tr>
              ";
          }
        }else{
          echo '<tr>
            <td></td>
            <td colspan="4" class="center">No listings have been added yet.</td>
          </tr>'; 
       }
      ?>
    </tbody>
  </table>
</div>