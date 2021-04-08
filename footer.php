<?php
if(function_exists('get_field')) :
	$icons = get_field('social_media_icons', 'options');
	$phone = get_field('contact_phone', 'options');
	$email = get_field('contact_email', 'options');
endif;
?>
	</div>
	<footer class="footer w-100 bg-dark pt-3 pb-3">
		<div class="container">
			<div class="row border-top-dark">

				<div class="col-12 col-md-4 my-md-auto my-4">
					<?php
					if(isset($icons)):
						echo '<div class="d-flex flex-row mb-2">';
						foreach ($icons as $key => $icon) :
							echo '<a class="d-block me-1 text-white" href="' . $icon['link']['url'] . '" target="' . $icon['link']['target'] . '" title="' . $icon['link']['title'] . '"><i class="fa-lg ' . $icon['icon'] . '"></i></a>';
						endforeach;
						echo '</div>';
					endif;

					echo (isset($phone) ? '<div><a class="text-white" href="tel:' . $phone . '">' . mind_format_phone($phone) . '</a></div>' : '');
					echo (isset($email) ? '<div><a class="text-white" href="mailto:' . $email . '">' . $email . '</a></div>' : '');

					?>
				</div>

				<div class="col-12 my-md-auto my-4">
					<?php mindblank_nav('footer-menu'); ?>
				</div>

				<div class="col-12 text-end mt-1 py-1 copyright">
					<p class="mb-0 text-white small muted"> <i class="fas fa-copyright"></i> <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. All rights reserved.</p>
				</div>
			</div>

		</div>
	</footer>
	<div class="container mindshare-credit my-4">
		<div class="row">
				<div class="text-center col-8 offest-2 col-md-4 offset-md-4">
					<span><small class="faded tag-header">MADE WITH LOVE</small></span>
					<div class="my-auto text-center">
						<a href="https://mind.sh/are" title="Mindshare Labs, Inc" class="">
							<img src="<?php echo get_template_directory_uri() . '/img/mindshare.svg'; ?>" title="Hand Crafted by Mindshare Labs, Inc" alt="Mindshare Labs, Inc">
						</a>
					</div>
					<!-- <div class="col-4 offset-0 col-md-2 offset-md-3 my-auto text-center">
						<a href="http://www.invisiblecitydesigns.com/" title="Invisible City Designs" class="">
							<img src="<?php echo get_template_directory_uri() . '/img/icd-logo.svg'; ?>" title="Invisible City Designs" alt="Invisible City Designs">
						</a>
					</div>
					<div class="col-4 offset-0 col-md-2 my-auto text-center">
						<a href="https://pkpublicrelations.com/" title="PK Public Relations" class="">
							<img src="<?php echo get_template_directory_uri() . '/img/pkpr-logo.svg'; ?>" title="PK Public Relations" alt="PK Public Relations">
						</a>
					</div> -->
				</div>



			</div>
		</div>



		<?php wp_footer(); ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-DZB2VPQFWG"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-DZB2VPQFWG');
		</script>
	</body>
</html>
