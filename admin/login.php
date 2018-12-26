<?php
include_once('../bootstrap.php');
$login_error = 0;

if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$user = User::login($username, $password);
	
	if (count($user) > 0) {
		$_SESSION['admin'] = $username;
		header("Location: index.php");
	} else {
		$login_error = 1;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BabyShop - Quản trị | Đăng nhập</title>
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="/css/admin.css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/admin.js"></script>
</head>
<body>
<div class="container">
	<div class="row login-panel">
		<div class="span4 offset4 well">
			<legend>Xin vui lòng đăng nhập</legend>
			<div class="alert alert-error <?= $login_error === 1 ? '' : 'hide' ?>">
				<a href="#" data-dismiss="alert" class="close">&times;</a>Tên đăng nhập hoặc mật khẩu không đúng!
			</div>
			<form accept-charset="UTF-8" action="" method="POST">
				<input type="text" placeholder="Tên truy cập" name="username" class="span4" id="username" />
				<input type="password" placeholder="Mật khẩu" name="password" class="span4" id="password" />
				<button class="btn btn-primary btn-block" name="submit" type="submit">Đăng nhập</button>
			</form>    
		</div>
	</div>
</div>
</body>
</html>