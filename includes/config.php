<?php
$is_product = false;

// Database
if ($is_product) {
	$db_server = '127.0.0.1';
	$db_username = 'bobkhin_babyshop';
	$db_password = 'zasdcx';
	$db_name = 'bobkhin_babyshop';
} else {
	$db_server = 'localhost';
	$db_username = 'root';
	$db_password = '';
	$db_name = 'babyshop.local';
}

// Upload photo
$upload_dir = '/uploads/';
$allowed_image_types = array(
	'image/pjpeg' => 'jpg',
	'image/jpeg' => 'jpg',
	'image/jpg' => 'jpg',
	'image/png' => 'png',
	'image/x-png' => 'png',
	'image/gif' => 'gif'
);
$max_size = 5;

// Pagination
$items_per_page = 12;