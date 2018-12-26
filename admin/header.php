<?php
include_once('../bootstrap.php');

if (!isset($_SESSION['admin'])) {
	if (Util::getPath() != '/admin/login.php') {
		header("Location: login.php");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BabyShop - Quản trị | <?= $title ?></title>
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="/css/admin.css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/js/jquery.dataTablet.Bootstrap.js"></script>
<script type="text/javascript" src="/js/admin.js"></script>
</head>
<body>
<div class="container">
<? if (isset($_SESSION['admin'])) { ?>
	<div class="navbar">
		<div class="navbar-inner">
			<a class="brand">Babyshop</a>
			<ul class="nav">
				<li><a href="/">Trang chủ</a></li>
				<li><a href="/admin/info.php">Thông tin</a></li>
				<li><a href="/admin/category.php">Loại sản phẩm</a></li>
				<li><a href="/admin/product.php">Sản phẩm</a></li>
			</ul>
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?= $_SESSION['admin'] ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="password.php"><i class="icon-cog"></i> Thay đổi mật khẩu</a></li>
						<li class="divider"></li>
						<li><a href="logout.php"><i class="icon-off"></i> Đăng xuất</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
<? }