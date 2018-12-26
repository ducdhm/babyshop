<?php
class Util {
	public static function encryptPassword($original) {
		return md5('$4t1' . $original . 'S/-\\-|-|_');
	}
	
	public static function getPath() {
		$uri_parts = parse_url($_SERVER['REQUEST_URI']);
		return $uri_parts['path'];
	}
	
	public static function toPairs(array $array, $key, $value) {
		$data = array();

		foreach($array as $one) {
			$data[$one[$key]] = $one[$value];
		}
		
		return $data;
	}
	
	public static function toArrayWithKey(array $array, $key) {
		$data = array();
		
		foreach($array as $one) {
			$data[$one[$key]] = $one;
		}
	}
	
	public static function redirect($url) {
		echo '<script type="text/javascript">window.location.href = "' . $url . '";</script>';
	}
}