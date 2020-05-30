<html><head>
<title></title><?php wp_head(); ?>
<style>
#heart {
  font-size: 50px;
  cursor: pointer;
  user-select: none;
}

#heart:hover {
  color: darkred;
}
</style>


</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<a class="navbar-brand" > <!-- logo -->
    <img src="<?php echo get_stylesheet_directory_uri(), "/template-parts/logo.png" ?>" width="30" height="30" class="d-inline-block align-top" alt="">
    Movies
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <!-- buton care deschide navbar-ul pe ecrane mici (butonul nu apare pe ecrane mari)-->

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <?php wp_nav_menu(array(
      'theme_location' => 'header-menu',
      'depth' => 2,
      'container' => false,
      'container_class' => 'collapse navbar-collapse',
      'container_id' => 'bs-example-navbar-collapse-1',
      'menu_class' => 'navbar-nav mr-auto',
      'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
      'walker' => new WP_Bootstrap_Navwalker()
  )); 
    get_search_form(); ?>
    
  </div>
</nav>
<div class="content container bg-light"> <!-- content container open here, closed in footer -->
</body>

</html>

