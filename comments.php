<div class="container">
	<div class="row">
		<div class="col-12">
			<div id="comments" class="comments">
				<?php if (post_password_required()) : ?>
				<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'mindblank' ); ?></p>
			</div>

				<?php return; endif; ?>

			<?php if (have_comments()) : ?>
				<h2><?php comments_number(); ?></h2>
				<ul>
					<?php wp_list_comments(); // Custom callback in functions.php ?>
				</ul>

			<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

				<p><?php _e( 'Comments are closed here.', 'mindblank' ); ?></p>

			<?php endif; ?>

			<?php
			$comment_args = array(
					'class_submit' => 'btn btn-primary submit',
					'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true" required="required"></textarea></p>',
					'fields' => array(
						'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' .
						'<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"/></p>',
						'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
						'<input id="email" name="email" class="form-control" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"/></p>',
						'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
						'<input id="url" name="url" class="form-control" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
						)
				);
				comment_form($comment_args);
			?>

			</div>
		</div>
	</div>
</div>
