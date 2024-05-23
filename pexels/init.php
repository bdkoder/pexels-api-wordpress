<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/generator.php';
require_once __DIR__ . '/api.php';


new PexelsWp\Api();
new PexelsWp\Generator();