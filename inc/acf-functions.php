<?php
function mind_acf_init() {
	acf_update_setting('google_api_key', 'xxx');
}
add_action('acf/init', 'mind_acf_init');


if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme Settings Page Title',
        'menu_title'	=> 'Theme Settings Menu Title',
        'menu_slug' 	=> 'mindblank-theme-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    // acf_add_options_sub_page(array(
    //     'page_title' 	=> 'Sub Page Title',
    //     'menu_title'	=> 'Sub Page Menu Title',
    //     'parent_slug'	=> 'mindblank-theme-settings',
    // ));



}
