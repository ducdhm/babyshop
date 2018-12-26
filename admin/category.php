<?php
$title = 'Loại sản phẩm';
include_once('header.php');

// Load categories
$categories = Category::getCategories();
?>
<div id="categories">
	<? if (isset($_SESSION['msg'])) { ?>
	<div class="alert alert-<?= $_SESSION['msg'][0] ?>">
		<a href="#" data-dismiss="alert" class="close">×</a>
		<span><?= $_SESSION['msg'][1] ?></span>
	</div>
	<? 
		$_SESSION['msg'] = null;
	} ?>
	<form class="form-horizontal">
		<legend>Danh sách loại sản phẩm</legend>
		<p><a href="/admin/category_save.php" class="btn btn-primary"><i class="icon-plus icon-white"></i> Thêm mới</a></p>
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<tr>
					<th>Loại sản phẩm</th>
					<th width="30%">Thao tác</th>
				</tr>
			</thead>
			<tbody>
			<? foreach ($categories as $category) { ?>
				<tr>
					<td class="category-name"><?= $category['name'] ?></td>
					<td>
						<a href="/admin/category_save.php?id=<?= $category['id'] ?>" class="btn btn-small btn-edit"><i class="icon-edit"></i> Sửa</a>
						<a href="/admin/category_delete.php?id=<?= $category['id'] ?>" class="btn btn-small btn-delete"><i class="icon-remove"></i> Xoá</a>
					</td>
				</tr>
			<? } ?>
			</tbody>
		</table>
	</form>
</div>
<?php
include_once('footer.php');