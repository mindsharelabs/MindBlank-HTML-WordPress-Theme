<header class="header top-header" role="banner">
  <div class="container py-1">
    <div class="row">
      <div class="col-4 col-md-2 logo pt-1 pb-1 my-auto">
        <a href="<?php echo home_url(); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="MindBlank HTML 5" class="logo-img">
        </a>
      </div>
      <div class="col my-auto d-none d-md-block ">
        <nav class="desktop header-menu text-right">
          <?php mindblank_nav('header-menu'); ?>
        </nav>
      </div>
      <div class="col-1 text-right my-auto d-block d-md-none">
        <span class="menu-toggle"><i class="fas fa-bars"></i></span>
      </div>
    </div>
  </div>
</header>
