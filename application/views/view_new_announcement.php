</br>
</br>
<div class="container">
  <?php
  $this->load->helper('url');
    /*if($update){
      echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
      echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times</span></button>";
      echo "<strong>Success!</strong> Entry was updated.";

      echo "</div>";
    }//var_dump($users);*/
  ?>
  <div class="row">
    <form action="<?php echo base_url('index.php/site/new_announcement')?>" method="post">
      <div class="form-group">
        <label for="subject">Subject</label>
        <input type="subject" class="form-control" name="subject" id="subject">
      </div>
      <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" name="body" id="body" rows="8"></textarea>
      </div>
      <button type="submit" class="btn btn-default">Broadcast Announcement</button>
    </form>
      
  </div>
</div>