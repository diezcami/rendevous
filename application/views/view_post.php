<div class="container"> <!-- Start page content -->
<div class="row">
  <div class="col-md-12">
    <div class="pull-right">
      &nbsp;
      &nbsp;
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-9 col-sm-9 col-xs-9">  
    <h4 class="text-truncated"><?php echo $job_title ?></h4>
  </div>
</div>
<?php
//var_dump($posts);
echo '<div class="clearfix top-border">&nbsp;</div>';
foreach ($posts as $post) {
  echo '
<div class="panel panel-default" id="a9">
  <div class="panel-heading">     
    <!--<div class="panel-title">    
      <div class="pull-right">  
        <div class="btn-group hidden-md hidden-lg"></div>
      </div>
    </div>-->
  </div>  
  <div class="panel-body thread-row"> 
    <div class="row thread-row">
      <div class="col-xs-12 visible-xs-block">
        <div class="clerafix top-border">&nbsp;</div>
      </div>
      <div class="col-md-2 col-sm-3 hidden-xs text-center userblock">
        <div class="clerafix">&nbsp;</div>
        <div class="push_bottom_5"></div>'.$post->first_name.' '.$post->last_name.' 
        <div class="text-muted text-left"><small>'.$post->email.'</small></div>
        <div class="clerafix">&nbsp;</div>
      </div>
      <div class="col-md-5 col-sm-6 col-xs-8">
        <div class="clerafix hidden-xs">&nbsp;</div>
        <div class="text-muted"><span class="hidden-md hidden-lg"><i class="fa fa-calendar"></i> </span><small><span class="hidden-sm hidden-xs">Posted: </span>'.date('j M Y', strtotime($post->timestamp)).'</small></div>   
      </div>    
      <div class="col-md-10 col-sm-9 col-xs-12">
        <div class="clerafix">&nbsp;</div>
        <div class="content_body"><p>'.$post->description.'</p></div>
        <div class="clerafix">&nbsp;</div>
      </div>
    </div>
  </div>
  <div class="panel-footer clearfix">   
    <div class="pull-right">
      &nbsp;
    </div>
  </div>
</div>';
}
?>
<div class="row">
  <div class="col-md-12">
    <div class="clearfix">&nbsp;</div>
    <div id="fastreply" style="display: block; padding: 0px;">
    <?php echo form_open(site_url('post/new_reply/'.$job_id.'/'.$user->id));?>
    <div class="form-group">
      <label for="body">Reply</label>
      <textarea name="body" class="form-control" id="body" rows="12"></textarea>
    </div>
    <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Submit Post">
  </form>
    <?php echo form_open(site_url('post/accept_job/'.$job_id.'/'.$user->id));?>
    <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Accept Job">
  </form>
    </div>
  </div>
</div>
<br>
</div>