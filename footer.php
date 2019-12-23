		<footer class="bottom-footer container mt-2 mb-2" role="contentinfo">
      <div class="row pt-4 pb-4">
        <div class="col-12 my-auto text-center">
          <p class="mb-0"> &copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>.</p>
        </div>
      </div>
		</footer>


	</div>
	<div class="w-100 container-fluid bg-primary pt-3 pb-3 mindshare-credit">
		<div class="row border-top-dark bg-primary">
			<div class="col-6 offset-3 col-md-2 offset-md-5 text-center">
				<span class="crafted">HAND CRAFTED BY:</span>
				<a href="https://mind.sh/are" class="">
					<img src="<?php echo get_template_directory_uri() . '/img/mindshare.svg'; ?>" title="Hand Crafted by Mindshare Labs, Inc" alt="Mindshare Labs, Inc">
				</a>
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
