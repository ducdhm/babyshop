<?php
include_once('../bootstrap.php');

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$product = Product::getProduct($id);	
	Product::deleteProduct($id);
	
	$_SESSION['msg'] = array(
		0 => 'success',
		1 => 'Xoá <strong>' . $product['name'] . '</strong> thành công!'
	);
	
	$image_name = '../uploads/' . $product['photo'] . '.jpg';
	
	if (file_exists($image_name)) {
		unlink($image_name);
	}
	
	header("Location: product.php");
}