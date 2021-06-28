
	</div>
	<footer class="top-footer py-3">
		<div class="container">
			<div class="row">

				<div class="col-12 col-md-8 mb-3 mb-md-0">
					<div class="row">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-left-widgets')) ?>
					</div>
				</div>

				<div class="col-12 col-md-4">
					<div class="row">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-right-widgets')) ?>
					</div>
				</div>


			</div>
		</div>
	</footer>

<footer class="lower-footer py-2">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md text-center text-md-start copyright my-auto">
				<p class="mb-0 text-white small muted"> <i class="fas fa-copyright"></i> <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. All rights reserved.</p>
			</div>
			<?php
			if(function_exists('get_field')) :
				$icons = get_field('social_media', 'options');
				if($icons) :
					echo '<div class="col-12 col-md order-first order-md-last text-center text-md-end mb-3 mb-md-0">';
					foreach ($icons as $key => $icon) :
						echo '<a class="ms-1" href="' . $icon['link']['url'] . '" target="' . $icon['link']['target'] . '" title="' . $icon['link']['title'] . '"><i class="' . $icon['icon'] . '"></i></a>';
					endforeach;
					echo '</div>';
				endif;
			endif;


			 ?>
		</div>
	</div>
</footer>





	<div class="container mindshare-credit my-2">
		<div class="row">
			<div class="text-center col-8 offset-2 col-md-2 offset-md-5">
				<div class="my-auto text-center">
					<a href="https://mind.sh/are" title="Mindshare Labs, Inc" style="color:#CAA74F">
						<i class="fak fa-2xl fa-mindshare"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>

	</body>
</html>
