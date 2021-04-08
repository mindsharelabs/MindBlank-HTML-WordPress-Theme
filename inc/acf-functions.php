<?php
function mind_acf_init() {
	acf_update_setting('google_api_key', 'xxx');
}
add_action('acf/init', 'mind_acf_init');


if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Website Settings',
        'menu_title'	=> 'Website Settings',
        'menu_slug' 	=> 'website-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

}
