<?php
// Load categories
$categories = Category::getCategories();
?>
<div class="pull-left menu-left">
	<h3>Loại sản phẩm</h3>
	<ul class="clearfix">
	<? foreach ($categories as $category) { ?>
		<li><a href="/category.php?id=<?= $category['id'] ?>"><?= $category['name'] ?></a></li>
	<? } ?>
	</ul>
</div>