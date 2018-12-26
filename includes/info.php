<?php
class Info {
	public static function getInfo() {
		$result = My_Db::current()->select('select * from info');
		return $result[0];
	}
	
	public static function setInfo($id, $name, $address, $phone, $email, $website) {
		$result = My_Db::current()->execute("update info set name = '$name', address = '$address', phone = '$phone', email = '$email', website = '$website' where id = $id;");
		return $result;
	}
}