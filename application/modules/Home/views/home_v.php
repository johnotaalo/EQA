<!DOCTYPE html>
<html>
<head>
	<title>WELCOME TO EQA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Muli|Open+Sans|Poiret+One" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url().'assets/plugin/bootstrap-3.3.7/css/bootstrap.min.css'?>" />
	<link rel="stylesheet" href="<?php echo base_url().'assets/plugin/jquery-ui.1.12.1/jquery-ui.min.css'?>" />
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/main.css'?>" />

    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/plugin/jquery-ui.1.12.1/jquery-ui.min.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/plugin/bootstrap-3.3.7/js/bootstrap.min.js'?>"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'assets/js/main.js'?>"></script>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">About</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Login</a></li>
            <li><a href="#">Register</a></li>
            <!-- <li role="separator" class="divider"></li> -->
            <!-- <li><a href="#">Separated link</a></li> -->
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	<div class="container-fluid">

	 	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner carousel-height" role="listbox">
			    
			    <div class="item active">
			      <img src="<?php echo base_url().'assets/media/images/lab.jpg'?>" alt="...">
			      <div class="carousel-caption">
			        ...
			      </div>
			    </div>
			    <div class="item">
			      <img src="<?php echo base_url().'assets/media/images/stethoscope.jpg'?>" alt="...">
			      <div class="carousel-caption">
			        ...
			      </div>
			    </div>
			    <div class="item">
			      <img src="<?php echo base_url().'assets/media/images/nurse.jpg'?>" alt="...">
			      <div class="carousel-caption">
			        ...
			      </div>
			    </div>
			    ...
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>






		</div>


	<!-- <div class = "welcome-div">
		<center><h1>WELCOME TO EQA</h1></center>
	</div> -->
</body>
</html>