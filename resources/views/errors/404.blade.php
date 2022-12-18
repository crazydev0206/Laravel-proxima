<!DOCTYPE html>
<html>

<!-- Mirrored from www.ncodeart.com/themeforest/travel-error-page/nc/version-4/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Oct 2022 06:49:46 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proximaride | Page Not Found</title>
  
  <!-- FONTS -->
  <link href='http://fonts.googleapis.com/css?family=Signika:400,300,600,700' rel='stylesheet' type='text/css'>
  <!-- EXTERNAL STYLESHEETS -->
  <link href="<?php echo url('assets/404/css/font-awesome-4.2.0/font-awesome-4.2.0/css/font-awesome.min.css'); ?>" rel="stylesheet">

  <!-- EFFECT -->
  <link rel="stylesheet" href="<?php echo url('assets/404/lib/snow-3d/snow-effect.css'); ?>">

  <!-- ANIMATION -->
  <link href="<?php echo url('assets/404/css/animation.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- MAIN STYLESHEETS -->
  <link rel="stylesheet" href="<?php echo url('assets/404/css/main.css'); ?>">
  <!-- Favicons -->
     
  <link rel="shortcut icon" href="<?php echo url('images/favicon/favicon-32x32.png'); ?>" type="image/x-icon" />
<link rel="icon" href="<?php echo url('images/favicon/favicon-32x32.png'); ?>" type="image/x-icon">
</head>
<body onload="init()">
  <!-- ANIMATION -->
  <div class="fix-wrp">
    <div class="animate-wrp">
      <div class="sky">
        <div class="car-wheels"></div>
        <div class="car">
          <div class="msg"><b><span>Oops!</span>May be I am on wrong way.</b></div>
        </div>
        <div class="car-wheels c1"></div>
        <div class="car1 c1"></div>
        <div class="cloud"></div>
        <div class="cloud2"></div>
        <div class="cloud1"></div>
        <div class="grass1"></div>
        <div class="grass"></div>
        <div class="grass2"></div>
        <div class="mountain"></div>
        <div class="mountain1"></div>
        <div class="tree"></div>
        <div class="tree-front"></div>
        <div class="road"></div>
        <div class="road-front"></div>
      </div>  
    </div>
  </div>
  <!--/animate-wrp -->

  <!-- MAIN WRAPPER -->
  <div class="main-wrapper">

    <!-- SNOW -->
    <div id="snow-wrp">
      
    </div>
    <!-- SNOW END -->


    <!-- CONTAINER -->
    <div class="container">
      
      <!-- CLOUD MESSAGE -->
      <div class="cloud-message">
        <div class="message-wrp">
          <div class="message">
            <strong class="t1">OOPS!</strong>
            <strong class="t2">Error 404 : Page Not Found.</strong>
            <p class="t3">Looks like something went completely wrong!</p>
          </div>
        </div>
        <img src="<?php echo url('assets/404/images/cloud-large1.png'); ?>" alt="cloud" />
      </div>
      <!--/cloud message -->
      
      <!-- NAVIGATION LINKS -->
      <div class="nav-wrapper">
        <a href="<?php echo url('/'); ?>">Home</a>
        <a href="<?php echo url('/students'); ?>">Students</a>
        <a href="<?php echo url('/sigin'); ?>">Register / Login</a>

      </div>
      <!--/nav-wrapper -->
      
      <!-- SOCIAL LINKS -->
     
      <!--/social-links -->
    </div>
    <!--/container -->
  </div>
  <!--/main-wrapper -->
  
  <!-- COMMON SCRIPT -->
  <script src="<?php echo url('assets/404/js/jquery-1.11.1.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo url('assets/404/lib/snow-3d/ThreeCanvas.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo url('assets/404/lib/snow-3d/Snow.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo url('assets/404/lib/snow-3d/snow-effect.js'); ?>"></script>

  <script>
    function mainWindow(){
      $(".main-wrapper").css({
        width: $('html').width(),
        height: $('html').height() > $(window).height() ? $('html').height() : $(window).height()  
      });
    }
    function animateWindow(){
      $(".animate-wrp").css({
        width: $(window).width(),
        height: $('.main-wrapper').height()
      });
    }
    $(document).ready(function() {
      mainWindow();
      animateWindow();
    });
    $(window).resize(function(event) {
      mainWindow();
      animateWindow();
    });
  </script>
</body>

<!-- Mirrored from www.ncodeart.com/themeforest/travel-error-page/nc/version-4/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Oct 2022 06:49:51 GMT -->
</html>