
	</div>
	<footer class="footer w-100 bg-dark pt-3 pb-3">
		<div class="container">
			<div class="row border-top-dark">
				<div class="col-12 text-center mt-1 py-1 copyright">
					<p class="mb-0 text-white small muted"> <i class="fas fa-copyright"></i> <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. All rights reserved.</p>
				</div>
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
<?php

	echo '<nav id="mobileMenu" class="mobile-nav d-block d-md-none">';
		echo '<div class="mobile-logo my-4 mx-auto w-50">';
			echo '<a href="' . home_url() . '">';
				echo '<img src="' . get_template_directory_uri() . '/img/mindshare.svg" alt="' . get_bloginfo( "name" ) . '" class="logo-img">';
			echo '</a>';
		echo '</div>';
		mindblank_nav('mobile-menu');
	echo '</nav>';

	echo '<nav id="mobileMenuToggle" class="menu-toggle d-flex d-md-none">';
		include get_template_directory() . '/img/menuToggle.svg';
	echo '</nav>';

 ?>


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
