<?php $assets_url = $this->config->item('assets_url');?>
<!DOCTYPE html>

<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $pagetitle;?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,800,300&amp;subset=latin" rel="stylesheet" type="text/css">
  <link href="<?php echo $assets_url; ?>dashboard/maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $assets_url; ?>dashboard/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">

  <!-- DEMO ONLY: Function for the proper stylesheet loading according to the demo settings -->
  <script>function _pxDemo_loadStylesheet(a,b,c){var c=c||decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-theme")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"default"),d="1"===decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-rtl")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"0");document.write(a.replace(/^(.*?)((?:\.min)?\.css)$/,'<link href="$1'+(c.indexOf("dark")!==-1&&a.indexOf("https://mighty-ravine-84144.herokuapp.com/css/")!==-1&&a.indexOf("https://mighty-ravine-84144.herokuapp.com/themes/")===-1?"-dark":"")+(d&&a.indexOf("assets/index.html")===-1?".rtl":"")+'$2" rel="stylesheet" type="text/css"'+(b?'class="'+b+'"':"")+">"))}</script>

  <!-- DEMO ONLY: Set RTL direction -->
  <script>"1"===decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-rtl")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"0")&&document.getElementsByTagName("html")[0].setAttribute("dir","rtl");</script>

  <!-- DEMO ONLY: Load PixelAdmin core stylesheets -->
  <script>
    _pxDemo_loadStylesheet('<?php echo $assets_url; ?>dashboard/dist/css/bootstrap.min.css', 'px-demo-stylesheet-core');
    _pxDemo_loadStylesheet('<?php echo $assets_url; ?>dashboard/dist/css/pixeladmin.min.css', 'px-demo-stylesheet-bs');
  </script>

  <!-- DEMO ONLY: Load theme -->
  <script>
    function _pxDemo_loadTheme(a){var b=decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-theme")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"default");_pxDemo_loadStylesheet(a+b+".min.css","px-demo-stylesheet-theme",b)}
    _pxDemo_loadTheme('https://mighty-ravine-84144.herokuapp.com/dist/css/themes/');
  </script>

  <!-- Demo assets -->
  <script>_pxDemo_loadStylesheet('<?php echo $assets_url; ?>dashboard/dist/demo/demo.css');</script>
  <script src="<?php echo $assets_url; ?>dashboard/dist/demo/demo.js"></script>
  <?= @$page_css;?>
  <!-- / Demo assets -->
</head>
<body>
  <script>var pxInit = [];</script>

  <!-- Custom styling -->
  
  <!-- / Custom styling -->

  <!-- Javascript -->
  <script>
    pxInit.push(function() {
      $(function() {
        pxDemo.initializeBgsDemo('body', 1, '#000', function(isBgSet) {
          $('#px-demo-signin-link, #px-demo-signin-link a')
            .addClass(isBgSet ? 'text-white' : 'text-muted')
            .removeClass(isBgSet ? 'text-muted' : 'text-white');
        });
      });
    });
  </script>
  <!-- / Javascript -->

  <?= $this->load->view($partial, $partialData); ?>


  <!-- Initialize demo sidebar on page load -->
 

  <!-- Get jQuery from Google CDN -->
  <!--[if !IE]> -->
    <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js">'+"<"+"/script>"); </script>
  <!-- <![endif]-->
  <!--[if lte IE 9]>
    <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js">'+"<"+"/script>"); </script>
  <![endif]-->

  <script src="<?php echo $assets_url; ?>dashboard/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo $assets_url; ?>dashboard/dist/js/pixeladmin.min.js"></script>
  <?= @$page_js; ?>
  <?php if(isset($javascript_file)) { ?>
    <?php $this->load->view($javascript_file, $javascript_data); ?>
  <?php } ?>
  <!-- <script type="text/javascript">
    pxInit.unshift(function() {
      $(function() {
        pxDemo.initializeDemo();
      });
    });

    for (var i = 0, len = pxInit.length; i < len; i++) {
      pxInit[i].call(null);
    }
  </script> -->
</body>

</html>
