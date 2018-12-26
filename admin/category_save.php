<?php
$title = 'Thêm/sửa loại sản phẩm';
include_once('header.php');

if (isset($_GET['id'])) {
	$category = Category::getCategory($_GET['id']);
}

if (isset($_POST['name'])) {
	$name = $_POST['name'];
	$msg;
	
	if (isset($_POST['id'])) {
		$msg = 'Sửa <strong>' . $name . '</strong> thành công!';
	} else {
		Category::addCategory($name);
		$msg = 'Thêm <strong>' . $name . '</strong> thành công!';
	}
	
	$_SESSION['msg'] = array(
		0 => 'success',
		1 => $msg
	);
	Util::redirect('/admin/category.php');
}
?>
<div id="categories">
	<form class="form-horizontal" action="" method="post" id="form-add-category">
		<legend>Thêm/sửa loại sản phẩm</legend>
		<? if (isset($category)) { ?>
			<input type="hidden" name="id" value="<?= $category['id'] ?>"  />		
		<? } ?>
		<div class="control-group">
			<label class="control-label" for="name">Tên loại sản phẩm:</label>
			<div class="controls">
				<input type="text" id="name" value="<?= isset($category) ? $category['name'] : '' ?>" class="input-xlarge" name="name" />
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Lưu</button>
			<button type="reset" class="btn">Nhập lại</button>
		</div>
	</form>
</div>
<?php
include_once('footer.php');