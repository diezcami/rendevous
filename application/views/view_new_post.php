</br>
</br>
<div class="container">
  <?php
  $this->load->helper('url');
  //var_dump($post_type);
    /*if($update){
      echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
      echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times</span></button>";
      echo "<strong>Success!</strong> Entry was updated.";

      echo "</div>";
    }//var_dump($users);*/
  ?>
  <div class="row">
    <form action="<?php echo site_url('/post/new_post/'.$post_type.'/'.$user->id);?>" method="post">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="title" class="form-control" name="title" id="title">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="8"></textarea>
      </div>
      <button type="submit" class="btn btn-default">Post</button>
    </form>
      
  </div>
</div>