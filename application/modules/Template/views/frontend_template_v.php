<?php $assets_url = $this->config->item('assets_url'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>EQA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1, max-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Lato|Raleway|Roboto" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700|Open+Sans:400,400i,600,600i,700,700i" rel="stylesheet"> -->
    <link href="<?= @$assets_url; ?>frontend/css/style.css" rel="stylesheet">
    <style type="text/css">
        body ul#main-menu li a{
            /*font-family: 'Roboto', sans-serif;*/
            font-family: 'Lato', sans-serif;
            font-family: 'Raleway', sans-serif;
            font-size: 15px;
        }
    </style>
    <?= @$page_css; ?>
</head>
<body>
    <div id="website-loading">
        <div class="loader">
            <div class="la-ball-newton-cradle">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div><!-- .loader end -->
    </div>

    <div id = "full-container">
        <header id="header" data-scroll-index="0">
            <div id="header-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="logo" href="#">
                                <img height="50px" width="50px" src="<?= @$assets_url; ?>frontend/images/files/gok.png" alt="">
                                <img height="60px" width="180px" src="<?= @$assets_url; ?>frontend/images/files/ministry.png" alt="">
                                <h5><span class="colored">Scour</span></h5>
                                <span>Landing Template</span>
                            </a>

                            <div>
                                
                            </div>

                            <ul id="main-menu" class="main-menu">
                                <li><a data-scroll-nav="0" href="#header">Home</a></li>
                                <li><a data-scroll-nav="1" href="#aboutus">About Us</a></li>
                                <li><a data-scroll-nav="2" href="#library">Library</a></li>
                                <li><a data-scroll-nav="4" href="#contactus">Contact Us</a></li>
                            </ul>
                            <a class="header-btn btn small colorful hover-dark" href="<?= @base_url('Auth/signup'); ?>">Register</a>
                            <a style="margin-right: 10px;" class="header-btn btn small colorful hover-dark" href="<?= @base_url('Auth/signin'); ?>">Login</a>
                            <div class="mobile-menu-btn hamburger hamburger--slider">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                            <div id="mobile-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <?= $this->load->view($partial, $partialData); ?>
    </div>
    
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/jquery.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/jRespond.min.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/jquery.easing.min.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/jquery.fitvids.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/jquery.waypoints.min.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/jquery.stellar.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/owl.carousel.min.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/jquery.mb.YTPlayer.min.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/hoverIntent.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/simple-scrollbar.min.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/superfish.js"></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/scrollIt.min.js"></script>
    <script src='<?= @$this->config->item('assets_url'); ?>frontend/js/jquery.magnific-popup.min.js'></script>
    <script src="<?= @$this->config->item('assets_url'); ?>frontend/js/jssocials.min.js"></script>
    <script src='<?= @$this->config->item('assets_url'); ?>frontend/js/jquery.validate.min.js'></script>
    <script src='<?= @$this->config->item('assets_url'); ?>frontend/js/functions.js'></script>
    <?= @$page_js; ?>
</body>
</html>