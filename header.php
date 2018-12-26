<?php
include_once('bootstrap.php');

// Load information
$info = Info::getInfo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BabyShop | <?=$title;?></title>
<link rel="stylesheet" type="text/css" href="/css/main.css" />
<link rel="stylesheet" type="text/css" href="/css/tango.css" />
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script type="text/javascript">
var info = {
	name: '<?= $info['name'] ?>',
	address: '<?= $info['address'] ?>',
	phone: '<?= $info['phone'] ?>',
	email: '<?= $info['email'] ?>',
	website: '<?= $info['website'] ?>'
};
</script>
</head>
<body>
<div id="container">
	<!-- Header -->
	<div id="header" class="clearfix">
		<h1 class="logo pull-left"><img src="/img/logo.png" width="568" height="104" alt="logo" /></h1>
		<div class="pull-right">
			<div class="shipping-info">
				<h3>Giao hàng</h3>
				<p><?= $info['phone'] ?><small>Liên hệ <?= $info['name'] ?></small></p>
			</div>
		</div>
	</div>	
	
	<!-- Navigation -->	
	<div id="nav" class="clearfix">
		<ul class="menu-top pull-left">
			<li><a href="/">Trang chủ</a></li>
			<li><a href="/category.php">Loại sản phẩm</a></li>
			<!--<li><a href="">Khuyến mại</a></li>-->
			<li><a href="/contact.php">Liên hệ</a></li>
		</ul>
		<form action="" method="get" class="search-panel pull-right">
			<input type="tex" name="query" value="" placeholder="Tên sản phẩm" />
			<button type="submit" class="btn-search hide-text">Search</button>
		</form>
	</div>