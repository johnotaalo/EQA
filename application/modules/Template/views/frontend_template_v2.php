<?php $assets_url = $this->config->item('assets_url'); ?>

<!DOCTYPE html>
<!--[if IE 9]>
<html class="ie" lang="en">
<![endif]-->
<html lang="zxx">


<!-- Mirrored from www.styllustheme.com/ThemeUnit/thirdeye-preview/thirdeye/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Apr 2017 11:04:22 GMT -->
<head>
    <!-- Basic Page Needs  -->
    <meta charset="utf-8">
    <title>EQA</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Mega  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= @$assets_url; ?>home/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= @$assets_url; ?>home/css/font-awesome.min.css">
    <!--Owl Carousel CSS -->
    <link rel="stylesheet" href="<?= @$assets_url; ?>home/css/owl.carousel.min.css">
    <!-- Animated CSS -->
    <link rel="stylesheet" href="<?= @$assets_url; ?>home/css/animate.min.css">
    <!-- Preloader Css -->
    <link rel="stylesheet" href="<?= @$assets_url; ?>home/css/csspin.css">
    <!-- Theme CSS-->
    <link rel="stylesheet" href="<?= @$assets_url; ?>home/css/default.css">
    <link rel="stylesheet" href="<?= @$assets_url; ?>home/css/style.css">
    <link rel="stylesheet" href="<?= @$assets_url; ?>home/css/responsive.css">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?= @$assets_url; ?>home/img/favicon.png">
    <?= @$page_css; ?>
</head>

<body data-spy="scroll" data-target="#scroll-menu" data-offset="65">
    <!-- Preloader Starts -->
    <div class="preloader-wrap">
        <div class="preloader-inside">
            <div class="cp-spinner cp-meter"></div>>
        </div>
    </div>
    <!-- Preloader Ends -->
    <!-- Nav Section -->
    <header>
        <!-- Nav Section -->
        <nav class="navbar navbar-default navbar-fixed-top nav-area" id="scroll-menu">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="<?= @$assets_url; ?>home/img/logo.png" alt="responsive img"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#home" class="smoothscroll">Home</a></li>
                        <li><a href="#expert" class="smoothscroll">Expert</a></li>
                        <li><a href="#thirdeye" class="smoothscroll">About</a></li>
                        <li><a href="#team" class="smoothscroll">Team</a></li>
                        <li><a href="#price" class="smoothscroll">Price</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Sub Menu 1</a></li>
                                <li><a href="#">Sub Menu 2</a></li>
                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sub Menu</a>
                                    <ul class="dropdown-menu sub-menu">
                                        <li><a href="#">Sub Menu 1</a></li>
                                        <li><a href="#">Sub Menu 2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#contact" class="smoothscroll">Contact</a></li>
                    </ul>
                    <div class="nav navbar-nav navbar-right hidden-xs hidden-sm">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" placeholder="Search...." class="form-control placeholder" id="text-mail2">
                                    <span class="input-group-btn">
                                                    <a href="#" class="btn btn-default btn-search"><i class="fa fa-search"></i></a>
                                                </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
    </header>
    <!-- End Nav Section -->
    <!-- Hero Section -->

    <?= $this->load->view($partial, $partialData); ?>

    <!-- Footer Section -->
    <footer>
        <div class="footer-area inner-padding" id="contact">
            <!-- Contact Form Section -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section-title-1">
                            <h2 class="title-1">Get In Touch</h2>
                            <p>Lorem provide best expert consectetur adipiscing elit, sed do eiusmod tempor dolor sit amet adipiscing elit, sed do eiusmod tempor incididunt ut labore et lor gna aliqua. </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-4 col-md-offset-1">
                        <ul class="footer-list">
                            <li>
                                <div class="footer-content">
                                    <h4>HEADQUATER</h4>
                                    <p>123 King St, Green Bay Melbourne VIC 3000,</p>
                                    <p> Australia</p>
                                    <p>(+0084) 4256 9658</p>
                                </div>
                            </li>
                            <li>
                                <div class="footer-content">
                                    <h4>SERVICE OFFICE</h4>
                                    <p>35 Lincoln St, Green Bay Cano, WI, United </p>
                                    <p>States</p>
                                    <p>(+0084) 9673 123 765</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-6">
                        <div class="contact-form-area">
                            <div class="form-area-title">
                                <h4>REQUEST A QUICK QUOTE</h4>
                            </div>
                            <div class="form-area">
                                <div class="cf-msg"></div>
                                <form class="form-inline" action="http://www.styllustheme.com/ThemeUnit/thirdeye-preview/thirdeye/sendMail.php" method="post" id="cf">
                                    <div class="row">
                                        <ul class="contact-form">
                                            <li class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="fname">Your name</label>
                                                    <div class="input-group">
                                                        <input type="text" id="fname" name="fname" class="form-control2" placeholder="Your name">
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="fname">Email here</label>
                                                    <div class="input-group">
                                                        <input type="email" class="form-control2" id="email" name="email" placeholder="Email here">
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="subject">Subject</label>
                                                    <div class="input-group">
                                                        <input type="text" id="subject" class="form-control2" placeholder="Subject" name="subject">
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="fname">Write here</label>
                                                    <div class="input-group">
                                                        <textarea rows="5" class="form-control2 form-message" placeholder="Write here" id="msg" name="msg"></textarea>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-xs-12">
                                            <button type="submit" id="submit" name="submit" class="btn btn-default btn-form">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Ends Footer Section -->
    <!-- Copyright Section -->
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p class="footer-copyright">Copyright © 2017. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Ends Copyright Section -->
    <!-- Scripts -->
    <script src="<?= @$assets_url; ?>home/js/jquery-2.1.1.min.js"></script>
    <script src="<?= @$assets_url; ?>home/js/bootstrap.min.js"></script>
    <script src="<?= @$assets_url; ?>home/js/scrollreveal.min.js"></script>
    <script src="<?= @$assets_url; ?>home/js/jquery.waypoints.min.js"></script>
    <script src="<?= @$assets_url; ?>home/js/jquery.counterup.min.js"></script>
    <script src="<?= @$assets_url; ?>home/js/owl.carousel.min.js"></script>
    <script src="<?= @$assets_url; ?>home/js/theme.js"></script>
    <?= @$page_js; ?>
</body>


<!-- Mirrored from www.styllustheme.com/ThemeUnit/thirdeye-preview/thirdeye/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Apr 2017 11:05:58 GMT -->
</html>
