<?php
$title = 'Thêm/sửa sản phẩm';
include_once('header.php');

// Load categories
$categories = Category::getCategories();

// Data of edited product
$name = '';
$cate_id = '';
$price = '';
$photo = '';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	
	// Load product
	$product = Product::getProduct($id);
	$name = $product['name'];
	$cate_id = $product['cate_id'];
	$price = $product['price'];
	$photo = $product['photo'];
}

// Save product
if (isset($_POST['name'])) {
	$id = '';
	
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	
	$name = $_POST['name'];
	$cate_id = $_POST['cate_id'];
	$price = $_POST['price'];
	$photo = $_POST['photo'];
	
	if ($id == '') {
		Product::addProduct($name, $cate_id, $price, $photo);
		$action = 'Thêm';
	} else {
		Product::editProduct($id, $name, $cate_id, $price, $photo);
		$action = 'Sửa';
	}	
	
	$_SESSION['msg'] = array(
		0 => 'success',
		1 => $action . ' <strong>' . $name . '</strong> thành công!'
	);
	Util::redirect('/admin/product.php');
}
?>
<div id="products">
	<form class="form-horizontal" action="" method="post" id="form-add-product">
		<legend>Thêm/sửa sản phẩm</legend>
		<div class="alert alert-error hide" id="alert">
			<a href="#" class="close">×</a>
			<ul></ul>
		</div>
		<? if (isset($_GET['id'])) { ?>
			<input type="hidden" name="id" value="<?= $_GET['id'] ?>" />
		<? } ?>
		<div class="control-group">
			<label class="control-label" for="name">Tên sản phẩm:</label>
			<div class="controls">
				<input type="text" id="name" value="<?= $name ?>" class="input-xlarge" name="name" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="cate_id">Loại sản phẩm:</label>
			<div class="controls">
				<select name="cate_id" id="cate_id">
				<? foreach ($categories as $category) { ?>
					<option <?= $cate_id == $category['id'] ? 'selected="selected"' : '' ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
				<? } ?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="price">Giá sản phẩm:</label>
			<div class="controls">
				<div class="input-append">
					<input type="text" id="price" value="<?= $price ?>" class="input-medium" name="price" /><span class="add-on">VNĐ</span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Ảnh sản phẩm:</label>
			<div class="controls">
				<? if ($photo == '') { ?>
					<div id="photo-preview" class="hide">
						<img src="" width="210" alt="" id="previewer" />
						<a href="#" id="delete-preview" class="btn btn-danger" title="Xoá ảnh"><i class="icon-remove icon-white"></i></a>
					</div>
					<input type="hidden" value="" name="photo" id="photo" />
					<button type="button" class="btn btn-success" id="uploader">Tải ảnh sản phẩm</button>
				<? } else { ?>
					<div id="photo-preview">
						<img src="/uploads/<?= $photo ?>.jpg" width="210" alt="" id="previewer" />
						<a href="#" id="delete-preview" class="btn btn-danger" title="Xoá ảnh"><i class="icon-remove icon-white"></i></a>
					</div>
					<input type="hidden" value="<?= $photo ?>" name="photo" id="photo" />
					<button type="button" class="btn btn-success hide" id="uploader">Tải ảnh sản phẩm</button>
				<? } ?>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" id="add-user">Lưu</button>
			<button type="reset" class="btn">Nhập lại</button>
		</div>
	</form>
</div>
<?php
include_once('footer.php');