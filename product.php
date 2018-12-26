<?php
class Product {
	public static function getProducts() {
		$result = My_Db::current()->select('select * from products');
		return $result;
	}
	
	public static function getNewestProducts() {
		$result = My_Db::current()->select('select * from products order by id desc limit 8');
		return $result;
	}
	
	public static function getRandomProducts() {
		$result = My_Db::current()->select('select * from products order by rand() limit 9');
		return $result;
	}
	
	public static function getNewestProductsByCate($cate_id) {
		$result = My_Db::current()->select("select * from products where cate_id = '$cate_id' order by id desc limit 3");
		return $result;
	}
	
	public static function getProductsByCate($cate_id, $page, $items_per_page) {
		$first_item = ($page - 1) * $items_per_page;
		$result = My_Db::current()->select("select * from products where cate_id = '$cate_id' order by id desc limit $first_item, $items_per_page");
		return $result;
	}
	
	public static function getTotalProductsByCate($cate_id) {
		$result = My_Db::current()->select("select * from products where cate_id = '$cate_id'");
		return count($result);		
	}
	
	public static function getProduct($id) {
		$result = My_Db::current()->select("select * from products where id = '$id'");
		return $result[0];
	}
	
	public static function addProduct($name, $cate_id, $price, $photo) {
		$result = My_Db::current()->insert("insert into products(name, cate_id, price, photo) values('$name', '$cate_id', '$price', '$photo')");
		return $result;
	}
	
	public static function editProduct($id, $name, $cate_id, $price, $photo) {
		$result = My_Db::current()->execute("update products set name = '$name', cate_id = '$cate_id', price = '$price', photo = '$photo' where id = '$id'");
		return $result;
	}
	
	public static function deleteProduct($id) {
		$result = My_Db::current()->execute("delete from products where id = '$id'");
		return $result;
	}
}