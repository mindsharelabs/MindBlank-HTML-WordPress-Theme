<!-- sidebar -->
<aside class="sidebar col-md-3 col-12" role="complementary">

	<?php get_template_part('searchform'); ?>
	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
	</div>

</aside>
<!-- /sidebar -->
