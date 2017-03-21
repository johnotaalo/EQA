<?php $assets_url = $this->config->item('assets_url') . 'dashboard/';  ?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="EQA::">
	<meta name="author" content="Mareka Willy, Chispine Otaalo">
	<title>EQA::<?= @$pagetitle; ?></title>
	<link href="<?= @$assets_url; ?>css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= @$assets_url; ?>css/simple-line-icons.css" rel="stylesheet">
	<link href="<?= @$assets_url; ?>css/glyphicons.css" rel="stylesheet">
	<link href="<?= @$assets_url; ?>css/glyphicons-filetypes.css" rel="stylesheet">
	<link href="<?= @$assets_url; ?>css/glyphicons-social.css" rel="stylesheet">

	<?= @$page_css; ?>
	<link href="<?= @$assets_url; ?>css/style.css" rel="stylesheet">
	<style>
		.nav-list li a{
			display: block;
			text-decoration: none;
			padding: .5em 1em;
		}

		.nav-list li.active, .nav-list li:hover{
			background-color: #0088cc;
		}

		.nav-list li:hover a{
			color: #ffffff;
			text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
			text-decoration: none;
		}
		.nav-list>.active>a, .nav-list>.active>a:hover, .nav-list>.active>a:focus {
			color: #ffffff;
			text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
			text-decoration: none;
		}
	</style>
</head>
<body class="navbar-fixed fixed-nav">
	<header class="navbar">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?= @base_url('Dashboard'); ?>"><center>EQA</center></a>
			
			<ul class="nav navbar-nav pull-right hidden-md-down">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<img style = "width: 30px;height:30px;" src="<?php if($user_details->avatar){ echo $user_details->avatar; }else{ echo 'https://www.kirkleescollege.ac.uk/wp-content/uploads/2015/09/default-avatar.png'; }?>" class="img-avatar" alt="<?= @$user_details->email_address; ?>">
						<span class="hidden-md-down"><?= @ucwords(strtolower($user_details->firstname . " " . $user_details->lastname)); ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="dropdown-header text-xs-center">
							<strong>Account</strong>
						</div>
						<!-- <a class="dropdown-item" href="<?= @base_url('Users/Account'); ?>"><i class="fa fa-user"></i> Profile</a> -->
						<a class="dropdown-item" href="<?= @base_url('Participant/Readiness/logout'); ?>"><i class="fa fa-lock"></i> Logout</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">☰</a>
				</li>
			</ul>
		</div>
	</header>

	<main class="main">
		<div class="container-fluid pt-2">
			<div class="animated fadeIn">
				<?= $this->load->view($partial, $partialData); ?>
			</div>
		</div>
	</main>

	
	<footer class="footer" style = "background: #2c3e50;">
		<span class="text-left">
			<a href="#">External Quality Assurance</a> © <?= @date("Y"); ?>
		</span>
		<span class="pull-right">
			Powered by <a href="#">CHAI</a>
		</span>
	</footer>

	<script src="<?= @$assets_url; ?>js/libs/jquery.min.js"></script>
	<script src="<?= @$assets_url; ?>js/libs/tether.min.js"></script>
	<script src="<?= @$assets_url; ?>js/libs/bootstrap.min.js"></script>
	<script src="<?= @$assets_url; ?>js/libs/pace.min.js"></script>
	<script src="<?= @$assets_url; ?>js/app.js"></script>

	<?= @$page_js; ?>
	<?php if(isset($javascript_file)) { ?>
		<?php $this->load->view($javascript_file, $javascript_data); ?>
	<?php } ?>
</body>
</html>