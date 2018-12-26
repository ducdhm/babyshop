<?php
include_once('../bootstrap.php');

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$category = Category::getCategory($id);	
	Category::deleteCategory($id);
	
	$_SESSION['msg'] = array(
		0 => 'success',
		1 => 'Xoá <strong>' . $category['name'] . '</strong> thành công!'
	);
	header("Location: category.php");
}