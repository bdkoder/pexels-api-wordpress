<?php
// add tab in media library
add_filter('media_upload_tabs', 'add_pexels_tab');
function add_pexels_tab($tabs) {
    $newtab = array('pexels' => 'Pexels');
    return array_merge($tabs, $newtab);
}

add_action('media_upload_pexels', 'media_upload_pexels');
function media_upload_pexels() {
    wp_iframe('media_upload_pexels_form');
}

function media_upload_pexels_form() {
    ?>
    <h2>Pexels</h2>
    <p>Search for images on Pexels</p>
    <form action="" method="post">
        <input type="text" name="pexels_search" value="" />
        <input type="submit" name="pexels_search_submit" value="Search" />
    </form>
    <?php
}


/**
 * New
 */

function my_custom_media_tab_enqueue_scripts() {
	wp_enqueue_script( 'my-custom-media-tab', PAPIWP_URL . '/demo-media/script.js', array( 'media-views' ), '1.0.0', true );
}
add_action( 'wp_enqueue_media', 'my_custom_media_tab_enqueue_scripts' );


function my_custom_tab_content() {
    ?>
    <div id="my_custom_tab_content">
        <h2>My Custom Tab Content</h2>
        <p>This is where you can add custom content for your new tab.</p>
    </div>
    <?php
}
add_action('print_media_templates', 'my_custom_tab_content');

