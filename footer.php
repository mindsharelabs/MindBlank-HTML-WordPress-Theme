
	</div>
	<div class="w-100 bg-dark pt-3 pb-3 mindshare-credit">
		<div class="container">
			<div class="row border-top-dark">
				<div class="col-6 offset-3 offset-md-0 col-md-2 left">
					<span class="crafted">HAND CRAFTED BY:</span>
					<a href="https://mind.sh/are" class="">
						<img src="<?php echo get_template_directory_uri() . '/img/mindshare.svg'; ?>" title="Hand Crafted by Mindshare Labs, Inc" alt="Mindshare Labs, Inc">
					</a>
				</div>
				<div class="col-12 col-md-10 my-md-auto my-4 text-md-end text-center">
					<p class="mb-0 text-white"> <i class="fas fa-copyright"></i> <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. All rights reserved.</p>
				</div>
			</div>
		</div>
	</div>

		<?php wp_footer(); ?>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-16159409-37"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-16159409-37');
            </script>

	</body>
</html>
