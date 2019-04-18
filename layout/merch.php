<?php $products = get_posts(array('post_type' => 'product'));
if ($products):
?>
<section class="merch container">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="section-title">Merch</h2>
        <?php echo do_shortcode('[featured_products per_page="4" columns="4"]'); ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
