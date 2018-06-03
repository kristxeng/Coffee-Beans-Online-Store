<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Coffee Beans House</title>

    <!-- define base url -->
    <script>const BASE_URL = '<?php echo base_url() ?>'</script>
    <!--  jQuery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--  Font Awesome  -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
    <script src=<?php echo base_url('public/js/nav.js') ?>></script>
    <script src=<?php echo base_url('public/js/'.$jsfile.'.js') ?>></script>
    <link rel="stylesheet" type="text/css" href=<?php echo base_url('public/css/'.$cssfile.'.css') ?> />
    <link rel="stylesheet" type="text/css" href=<?php echo base_url('public/css/nav.css') ?> />
  </head>
  <body>
    <!-- NaveBar -->
    <div class="topnav">
      <div class="nav__container">
        <div class="sm-menu__wrapper">
          <div class="nav__logo">
            <a class="nav__item" href=<?php echo base_url() ?>>
              <img src=<?php echo base_url("public/img/bean-logo.png") ?> />
            </a>
          </div>
          <div class="menu__toggle">
            <i class="fa fa-bars"></i>
          </div>
        </div>
        <div class="nav__menu">
          <a class="menu__item" href="<?php echo base_url('about') ?>">關於我們</a>
          <a class="menu__item" href="<?php echo base_url('products') ?>">選購咖啡豆</a>
          <a class="menu__item" href="<?php echo base_url('contact') ?>">聯絡我們</a>
          <a class="menu__item" href="<?php echo base_url('cart') ?>"><i class="fas fa-shopping-cart"></i></a>
        </div>
      </div>
    </div>

    <!-- float cart icon -->
    <div id="float-cart" class="fa-5x fa-layers">
      <i class="fas fa-shopping-cart" data-fa-transform="left-2 shrink-4"></i>
      <span class="fa-layers-counter" style="background:Tomato;">0</span>
    </div>

