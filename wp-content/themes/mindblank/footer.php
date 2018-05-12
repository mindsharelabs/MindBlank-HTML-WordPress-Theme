			<!-- footer -->
			<footer class="bottom-footer container-fluid" role="contentinfo">
                <div class="row">
                    <div class="col">
                        <p class="align-middle"> &copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>.</p>
                    </div>
                    <div class="col">
                        <img src="<?php echo get_template_directory_uri() . '/img/mindshare.svg'; ?>" title="Hand Crafted by Mindshare Labs, Inc" alt="Mindshare Labs, Inc">
                    </div>
                </div>
			</footer>
			<!-- /footer -->

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
