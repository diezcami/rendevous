
<!DOCTYPE html>
<html <?php 
if($isWelcome==true){
		echo 'class="welcome"';
	}
?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<?php
		$this->load->helper('url')
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/font-awesome.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css')?>">
	<title>Rendevous</title>
</head>
<body>
	
	<div class="navbar-default" role="navigation">
			
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			    <span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="<?php echo base_url('index.php')?>" style="color: #FFF">
			  	<i class="fa fa-leaf fa-lg" aria-hidden="true"></i>
			  </a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
			  	<?php
			  		foreach($NavigationArray as $entry){
			  			if( strcasecmp($activeLink, $entry[2]) == 0){
			  				echo "<li class='active'><a href='".$entry[1]."'>".ucfirst($entry[0])."</a></li>";
			  			}else{
			  				echo "<li><a href='".$entry[1]."'>".ucfirst($entry[0])."</a></li>";
			  			}
			  		}
			  		#echo "<li class='active'><a href='#'>HAHA</a></li>";
			  	?>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
			  	<li><a href="<?php echo base_url('index.php')?>/site/logout">Logout</a> </li>
			  </ul>
			</div><!-- /.navbar-collapse -->
	</div>
	<P>
	