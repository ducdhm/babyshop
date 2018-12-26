<?php
require_once 'bootstrap.php';
$title = 'Loại sản phẩm';
include_once('header.php');
?>
<!-- Content -->
<div id="content" class="clearfix">
	<?php include_once('left_menu.php'); ?>
	<div class="right-content">
	<? if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$category = Category::getCategory($id);
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$products = Product::getProductsByCate($id, $page, $items_per_page);
		
		$pages = ceil(Product::getTotalProductsByCate($id) / $items_per_page);
	?>
		<div class="products-wrapper">	
			<h3><?= $category['name'] ?></h3>
			<ul class="products clearfix">
			<? foreach ($products as $product) { ?>
				<li class="product">
					<img width="100%" src="/uploads/<?= $product['photo'] ?>.jpg" alt="<?= $product['name'] ?>" />
					<div class="product-info clearfix">
						<h3 class="product-name"><?= $product['name'] ?></h3>
						<span class="product-price"><?= number_format($product['price'], 0, '.', '.') ?> VNĐ</span>
					</div>
				</li>
			<? } ?>
			</ul>
		</div>
		<div class="pagination"> Trang
			<? for ($i = 1; $i <= $pages; $i++) { ?>
				<a <?= $i == $page ? 'class="active"' : '' ?> href="/category.php?id=<?= $id ?>&page=<?= $i ?>"><?= $i ?></a>
			<? } ?>
		</div>
	<? } else {
		foreach ($categories as $category) { ?>
		<div class="products-wrapper">
			<h3><?= $category['name'] ?></h3>
			<ul class="products clearfix">
			<? $products = Product::getNewestProductsByCate($category['id']);
			foreach ($products as $product) { ?>
				<li class="product">
					<img width="100%" src="/uploads/<?= $product['photo'] ?>.jpg" alt="<?= $product['name'] ?>" />
					<div class="product-info clearfix">
						<h3 class="product-name"><?= $product['name'] ?></h3>
						<span class="product-price"><?= number_format($product['price'], 0, '.', '.') ?> VNĐ</span>
						<a href="/category.php?id=<?= $product['cate_id'] ?>" class="product-view-more">Xem sản phẩm cùng loại</a>
					</div>
				</li>
			<? } ?>
			</ul>
		</div>
		<? } ?>
	<? } ?>
	</div>
</div>
<?php
include_once('footer.php');