<header class="header top-header" role="banner">
  <div class="container py-1">
    <div class="row justify-content-center">
      <div class="col-8 col-md-5 col-lg-4 logo pt-2 pb-2 my-auto">
        <a href="<?php echo home_url(); ?>">
          <img src="<?php echo get_template_directory_uri() . '/img/logo.svg'; ?>" title="<?php bloginfo( 'name' ); ?>" />
        </a>
      </div>

      <div class="col d-none d-md-block mt-auto">
        <nav class="desktop header-menu text-right">
          <a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>
          <?php mindblank_nav('header-menu'); ?>
        </nav>
      </div>

    </div>
  </div>

  <nav class="main-navigation">
    <div class="container px-0">
      <div class="row">
        <?php mindblank_nav('main-menu'); ?>
      </div>
    </div>
  </nav>
</header>
