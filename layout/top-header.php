<header class="header top-header" role="banner">
  <div class="container py-1">
    <div class="row">
      <div class="col-8 col-md-5 col-lg-4 logo pt-1 pb-1 my-auto">
        <a href="<?php echo home_url(); ?>">
          <img src="<?php echo get_template_directory_uri() . '/img/mindshare.svg'; ?>" title="<?php bloginfo( 'name' ); ?>" />
        </a>
      </div>

      <div class="col d-none d-md-block ">
        <nav class="desktop header-menu text-right">
          <a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>
          <?php mindblank_nav('header-menu'); ?>
        </nav>
      </div>

    </div>
  </div>
</header>
