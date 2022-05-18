
<!-- pagination -->
<div class="row">
  <div class="col-8 offset-2">
    <div class="pagination">
      <?php
      if(function_exists('facetwp_display')) :
        echo facetwp_display( 'facet', 'pagination' );
      else :
        mindwp_pagination();
      endif;
      ?>
    </div>
  </div>
</div>

<!-- /pagination -->
