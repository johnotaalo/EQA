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
</head>
<body class="navbar-fixed sidebar-nav fixed-nav">
	<header class="navbar">
		<div class="container-fluid">
			<button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">☰</button>
			<a class="navbar-brand" href="<?= @base_url('Dashboard'); ?>"><center>EQA</center></a>
			<ul class="nav navbar-nav hidden-md-down">
				<li class="nav-item">
					<a class="nav-link navbar-toggler layout-toggler" href="#">☰</a>
				</li>
			</ul>
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
						<a class="dropdown-item" href="<?= @base_url('Users/Account'); ?>"><i class="fa fa-user"></i> Profile</a>
						<a class="dropdown-item" href="<?= @base_url('Auth/logout'); ?>"><i class="fa fa-lock"></i> Logout</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">☰</a>
				</li>
			</ul>
		</div>
	</header>
	<div class="sidebar">
		<nav class="sidebar-nav">
			<form>
				<div class="form-group p-h mb-0">
					<input type="text" class="form-control" aria-describedby="search" placeholder="Search...">
				</div>
			</form>
			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link" href="<?= @base_url('Dashboard'); ?>"><i class="icon-speedometer"></i> Dashboard</a>
				</li>
				<li class="divider"></li>
				<?= @$menu; ?>
				<li class="nav-title">
					My Account
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= @base_url('Users/Account'); ?>"><i class="icon-user"></i> Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= @base_url('Auth/logout'); ?>"><i class="icon-power"></i> Logout</a>
				</li>

				<li class="divider m-h"></li>
				<li class="nav-item hidden-cn">
					<a class="nav-label" href="#"><i class="fa fa-circle text-success"></i> Logged in as: <?= @ucwords(strtolower($user_details->user_type)); ?></a>
				</li>
			</ul>
		</nav>
	</div>
	<main class="main">
		<div class="container-fluid pt-2">
			<div class="animated fadeIn">
				<?= $this->load->view($partial, $partialData); ?>
			</div>
		</div>
	</main>

	<?php if(isset($modalView)){ ?>
		<div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><?= @$modalTitle; ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?= @$this->load->view($modalView, $modalData); ?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id = "save-changes">Save changes</button>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
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