<section class="brand">
    <div class="row justify-content-between">
        <!-- logo -->
        <div class="col-12 col-md-5 logo">
            <a href="<?php echo home_url(); ?>">
                <img style="max-width: 150px;" src="<?php echo get_template_directory_uri(); ?>/img/mmw-default.jpg" alt="Molten Metal Works" class="logo-img">
            </a>
        </div>
        <div class="social-icons d-flex align-items-center ml-3">
          <a class="icons" href="/"><i class="fab fa-facebook fa-lg"></i></a>
          <a class="icons" href="/"><i class="fab fa-instagram fa-lg"></i></a>
          <a class="icons" href="/"><i class="fab fa-yelp fa-lg"></i></a>
        </div>
    </div>
    <div class="row top-menu">
      <?php mindblank_nav('header-menu'); ?>
    </div>
</section>
<hr>
