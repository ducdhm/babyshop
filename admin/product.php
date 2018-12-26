<?php
$title = 'Sản phẩm';
include_once('header.php');

// Load users
$products = Product::getProducts();
$categories = Util::toPairs(Category::getCategories(), "id", "name");

?>
<div id="products">
	<? if (isset($_SESSION['msg'])) { ?>
	<div class="alert alert-<?= $_SESSION['msg'][0] ?>">
		<a href="#" data-dismiss="alert" class="close">×</a>
		<span><?= $_SESSION['msg'][1] ?></span>
	</div>
	<? 
		$_SESSION['msg'] = null;
	} ?>
	<form class="form-horizontal">
		<legend>Danh sách sản phẩm</legend>
		<p><a href="/admin/product_save.php" class="btn btn-primary"><i class="icon-plus icon-white"></i> Thêm mới</a></p>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<tr>
					<th>Tên</th>
					<th>Giá</th>
					<th>Loại sản phẩm</th>
					<th width="210">Ảnh</th>
					<th width="130">Thao tác</th>
				</tr>
			</thead>
			<tbody>
			<? foreach ($products as $product) { ?>
				<tr>
					<td class="product-name"><?= $product['name'] ?></td>
					<td><?= number_format($product['price'], 0, '.', '.') ?> VNĐ</td>
					<td><?= $categories[$product['cate_id']] ?></td>
					<td><img src="/uploads/<?= $product['photo'] ?>.jpg" width="210" alt="<?= $product['name'] ?>" /></td>
					<td>
						<a href="/admin/product_save.php?id=<?= $product['id'] ?>" class="btn btn-small btn-edit"><i class="icon-refresh"></i> Sửa</a>
						<a href="/admin/product_delete.php?id=<?= $product['id'] ?>" class="btn btn-small btn-delete"><i class="icon-remove"></i> Xoá</a>
					</td>
				</tr>
			<? } ?>
			</tbody>
		</table>
	</form>
</div>
<?php
include_once('footer.php');