<?php
require_once 'bootstrap.php';
$title = 'Trang chủ';
include_once('header.php');

// Load 8 newest products
$newest_products = Product::getNewestProducts();

// Load 9 random products
$random_products = Product::getRandomProducts();
?>
<!-- Banner -->
<div id="banner">
	<div id="banner-slider">
		<div class="banner-item"><img src="/img/slide_00.jpg" width="960" height="441" /></div>
		<div class="banner-item"><img src="/img/slide_01.jpg" width="960" height="441" /></div>
		<div class="banner-item"><img src="/img/slide_02.jpg" width="960" height="441" /></div>
	</div>
	<div id="banner-controller">
		<a href="" class="hide-text">1</a>
		<a href="" class="hide-text">2</a>
		<a href="" class="hide-text">3</a>
	</div>		
</div>

<!-- Newest products -->
<div id="newest-products">
	<h2>Sản phẩm mới nhất</h2>
	<div id="my-jcarousel" class="jcarousel-skin-tango">
		<ul class="products clearfix">
		<? foreach ($newest_products as $newest_product) { ?>
			<li class="product">
				<img width="100%" src="/uploads/<?= $newest_product['photo'] ?>.jpg" alt="<?= $newest_product['name'] ?>" />
				<div class="product-info clearfix">
					<h3 class="product-name"><?= $newest_product['name'] ?></h3>
					<span class="product-price"><?= number_format($newest_product['price'], 0, '.', '.') ?> VNĐ</span>
					<a href="/category.php?id=<?= $newest_product['cate_id'] ?>" class="product-view-more">Xem sản phẩm cùng loại</a>
				</div>
			</li>
		<? } ?>
		</ul>
	</div>
</div>

<!-- Content -->
<div id="content" class="clearfix">
	<?php include_once('left_menu.php'); ?>
	<div class="right-content">
		<div class="products-wrapper">
			<h3>Sản phẩm ngẫu nhiên</h3>
			<ul class="products clearfix">
			<? foreach ($random_products as $random_product) { ?>
				<li class="product">
					<img width="100%" src="/uploads/<?= $random_product['photo'] ?>.jpg" alt="<?= $random_product['name'] ?>" />
					<div class="product-info clearfix">
						<h3 class="product-name"><?= $random_product['name'] ?></h3>
						<span class="product-price"><?= number_format($random_product['price'], 0, '.', '.') ?> VNĐ</span>
						<a href="/category.php?id=<?= $random_product['cate_id'] ?>" class="product-view-more">Xem sản phẩm cùng loại</a>
					</div>
				</li>
			<? } ?>
			</ul>
		</div>
	</div>
</div>
<?php
include_once('footer.php');