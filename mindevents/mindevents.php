<?php
add_action('mindevents_before_main_content', function () {
  include get_template_directory() . '/layout/top-header.php';
});
add_action('mindevents_after_main_content', function () {
  include get_template_directory() . '/layout/top-footer.php';
});


add_action('mindevents_archive_loop_start', function() {
  include get_template_directory() . '/layout/archive-header.php';
});
