<?php

// add submenu page to media
function my_custom_media_tab() {
	add_media_page( 'Image Generator', 'Image Generator', 'read', 'bdt-ai-media-tab', 'my_custom_media_tab_content' );
}

add_action( 'admin_menu', 'my_custom_media_tab' );
/**
 * New
 */

function my_custom_media_tab_enqueue_scripts() {
	wp_enqueue_script( 'my-custom-media-tab', PAPIWP_URL . '/demo-media/script.js', array( 'jquery' ), '1.0.0', true );
}

add_action( 'admin_enqueue_scripts', 'my_custom_media_tab_enqueue_scripts' );

function my_custom_media_tab_content() {
	?>
	<div class="wrap">
		<h2>Image Generator</h2>
		<div id="bdt-ai-media-tab"></div>
	</div>

	<form id="search-form">
		<input type="text" id="search-input" placeholder="Search for images">
		<input type="submit" value="Search">
	</form>
	<style>
		form {
			margin-top: 20px;
			margin-bottom: 20px;
		}

		input[type="text"],
		input[type="submit"] {
			padding: 10px;
			font-size: 16px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}

		input[type="submit"] {
			background-color: #333;
			color: #fff;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #444;
		}

		#paw-images {
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			grid-gap: 20px;
		}

		#paw-images img {
			width: 100%;
			height: auto;
		}
	</style>
	<div id="paw-images"></div>
	<div id="loading-indicator" style="display: none;">Loading...</div>

	<?php
}