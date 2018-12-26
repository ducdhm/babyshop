<?
class User {
	public static function login($username, $password) {
		$result = My_Db::current()->select('select * from users where username = "' . $username . '" and password = "' . Util::encryptPassword($password) . '"');
		return $result;
	}
	
	public static function changePassword($id, $password) {
		$result = My_Db::current()->execute("update users set password = '" . Util::encryptPassword($password) . "' where id = '$id'");
		return $result;
	}
}