<?php
get_header();
?>
<main role="main" aria-label="Content">
<section class="lost-page">
  <div class="techy-background">
    <div class="container py-5">
      <div class="row py-5">
        <div class="col-12 col-md-6 offset-0 offset-md-3 text-md-left my-auto">
          <div class="lost-box">
            <div class="box__ghost">
              <div class="symbol"></div>
              <div class="symbol"></div>
              <div class="symbol"></div>
              <div class="symbol"></div>
              <div class="symbol"></div>
              <div class="symbol"></div>

              <div class="box__ghost-container">
                <div class="box__ghost-eyes">
                  <div class="box__eye-left"></div>
                  <div class="box__eye-right"></div>
                </div>
                <div class="box__ghost-bottom">
                  <div></div>
                  <div></div>
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
              </div>
              <div class="box__ghost-shadow"></div>
            </div>



          </div>
        </div>
        <div class="col-12 col-md-6 offset-0 offset-md-3 text-center my-auto">

          <h2 class="text-white text-center"><?php _e('Lonely Ghost couldn\'t find what you\'re looking for.', 'mindblank'); ?></h2>
          <a class="text-white mt-5 d-block" href="<?php echo home_url(); ?>"><i class="fal fa-arrow-left"></i> <?php _e('Return home', 'mindblank'); ?> </a>

        </div>
      </div>
    </div>
  </div>
</section>
</main>
<script>
  //based on https://dribbble.com/shots/3913847-404-page

  var pageX = jQuery(document).width();
  var pageY = jQuery(document).height();
  var mouseY=0;
  var mouseX=0;

  jQuery(document).mousemove(function( event ) {
    //verticalAxis
    mouseY = event.pageY;
    yAxis = (pageY/2-mouseY)/pageY*300;
    //horizontalAxis
    mouseX = event.pageX / -pageX;
    xAxis = -mouseX * 100 - 100;

    jQuery('.box__ghost-eyes').css({ 'transform': 'translate('+ xAxis +'%,-'+ yAxis +'%)' });


  });
</script>
<?php
get_footer();
