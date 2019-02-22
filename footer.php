		<footer class="bottom-footer container mt-2" role="contentinfo">
        <div class="row">
          <div class="col-12 col-md-9 my-auto">
            <p class="mb-0"> &copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>.</p>
          </div>
          <div class="col-8 offset-2 offset-md-0 col-md mb-4 my-auto">
						<small>HAND CRAFTED BY:</small>
						<a href="https://mind.sh/are">
	            <img src="<?php echo get_template_directory_uri() . '/img/mindshare.svg'; ?>" title="Hand Crafted by Mindshare Labs, Inc" alt="Mindshare Labs, Inc">
						</a>
          </div>
        </div>
			</footer>

		</div>
		</div>
		<!-- /wrapper //Opened in layout/navigation.php-->

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
