<?php $assets_url = $this->config->item('assets_url');?>

<!DOCTYPE html>
<html>
<head>
    <title>EQA Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Muli|Open+Sans|Poiret+One" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="<?php echo $assets_url; ?>dashboard/maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   <link href="<?php echo $assets_url; ?>dashboard/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
   <link href="<?php echo $assets_url; ?>dashboard/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="<?php echo $assets_url; ?>dashboard/dist/css/pixeladmin.min.css" rel="stylesheet" type="text/css">
   <link href="<?php echo $assets_url; ?>dashboard/dist/css/widgets.min.css" rel="stylesheet" type="text/css">
   <link href="<?php echo $assets_url; ?>dashboard/dist/demo/demo.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" type="text/css" href="<?php echo $assets_url; ?>dashboard/default.min.css">

   <script>function _pxDemo_loadStylesheet(a,b,c){var c=c||decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-theme")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"default"),d="rtl"===document.getElementsByTagName("html")[0].getAttribute("dir");document.write(a.replace(/^(.*?)((?:\.min)?\.css)$/,'<link href="$1'+(c.indexOf("dark")!==-1&&a.indexOf("https://mighty-ravine-84144.herokuapp.com/css/")!==-1&&a.indexOf("https://mighty-ravine-84144.herokuapp.com/themes/")===-1?"-dark":"")+(d&&a.indexOf("assets/index.html")===-1?".rtl":"")+'$2" rel="stylesheet" type="text/css"'+(b?'class="'+b+'"':"")+">"))}</script>

  <!-- DEMO ONLY: Set RTL direction -->
  <script>"1"===decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-rtl")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"0")&&document.getElementsByTagName("html")[0].setAttribute("dir","rtl");</script>

  <!-- DEMO ONLY: Load PixelAdmin core stylesheets -->
  <script>
    _pxDemo_loadStylesheet('<?php echo $assets_url; ?>dashboard/dist/css/bootstrap.min.css', 'px-demo-stylesheet-core');
    _pxDemo_loadStylesheet('<?php echo $assets_url; ?>dashboard/dist/css/pixeladmin.min.css', 'px-demo-stylesheet-bs');
    _pxDemo_loadStylesheet('<?php echo $assets_url; ?>dashboard/dist/css/widgets.min.css', 'px-demo-stylesheet-widgets');
  </script>

  <!-- DEMO ONLY: Load theme -->
  <script>
    function _pxDemo_loadTheme(a){var b=decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-theme")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"default");_pxDemo_loadStylesheet(a+b+".min.css","px-demo-stylesheet-theme",b)}
    //_pxDemo_loadTheme('https://mighty-ravine-84144.herokuapp.com/dist/css/themes/');
  </script>

    <?= @$page_css; ?>
</head>
<body>


    <?= $this->load->view($partial, $partialData); ?>



    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src = "<?php echo $assets_url; ?>dashboard/dist/demo/demo.js"></script>
    <script type="text/javascript" src = "<?php echo $assets_url; ?>dashboard/cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js"></script>
    <script type="text/javascript" src = "<?php echo $assets_url; ?>dashboard/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src = "<?php echo $assets_url; ?>dashboard/dist/js/pixeladmin.min.js"></script>
<script>
    pxDemo.initializeDemoSidebar();

    pxInit.push(function() {
      // $('#px-demo-sidebar').pxSidebar();
      pxDemo.initializeDemo();
    });
  </script>
    <script type="text/javascript">
    pxInit.unshift(function() {
      var file = String(document.location).split('<?php echo $assets_url; ?>dashboard/mighty-ravine-84144.herokuapp.com/').pop();

      // Remove unnecessary file parts
      file = file.replace(/(\.html).*/i, '$1');

      if (!/.html$/i.test(file)) {
        file = 'index.html';
      }

      // Activate current nav item
      $('#px-demo-nav')
        .find('.px-nav-item > a[href="' + file + '"]')
        .parent()
        .addClass('active');

      $('#px-demo-nav').pxNav();
      $('#px-demo-footer').pxFooter();
    });

    for (var i = 0, len = pxInit.length; i < len; i++) {
      pxInit[i].call(null);
    }
  </script>

    <?= @$page_js; ?>
</body>
</html>