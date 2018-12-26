<?php
class Category {
	public static function getCategories() {
		$result = My_Db::current()->select('select * from categories');
		return $result;
	}
	
	public static function getCategory($id) {
		$result = My_Db::current()->select("select * from categories where id = '$id'");
		return $result[0];
	}
	
	public static function addCategory($name) {
		$result = My_Db::current()->insert("insert into categories(name) values('$name')");
		return $result;
	}
	
	public static function editCategory($id, $name) {
		$result = My_Db::current()->execute("update categories set name = '$name' where id = '$id'");
		return $result;
	}
	
	public static function deleteCategory($id) {
		$result = My_Db::current()->execute("delete from categories where id = '$id'");
		return $result;
	}
}