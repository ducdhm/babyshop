<?php
$title = 'Thông tin';
include_once('header.php');

$error = 0;

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	$result = Info::setInfo($id, $name, $address, $phone, $email, $website);	
} else {
	// Load information
	$info = Info::getInfo();
	$id = $info['id'];
	$name = $info['name'];
	$address = $info['address'];
	$phone = $info['phone'];
	$email = $info['email'];
	$website = $info['website'];
}
?>
<div id="info">
	<form class="form-horizontal info-form" action="" method="post">
		<legend>Thông tin của hàng</legend>
		<input type="hidden" name="id" value="<?= $id ?>" />
		<div class="alert alert-success <?= isset($_POST['id']) ? '' : 'hide' ?>">
			<a href="#" data-dismiss="alert" class="close">×</a> Lưu thông tin thành công!
		</div>
		<div class="control-group">
			<label class="control-label" for="name">Tên chủ hàng:</label>
			<div class="controls">
				<input type="text" id="name" value="<?= $name ?>" class="input-xlarge" name="name" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="address">Địa chỉ:</label>
			<div class="controls">
				<textarea rows="3" name="address" class="input-xlarge" id="address"><?= $address ?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="phone">Số điện thoại:</label>
			<div class="controls">
				<input type="text" id="phone" value="<?= $phone ?>" class="input-xlarge" name="phone" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email:</label>
			<div class="controls">
				<input type="text" id="email" value="<?= $email ?>" class="input-xlarge" name="email" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="website">Website:</label>
			<div class="controls">
				<input type="text" id="website" value="<?= $website ?>" class="input-xlarge" name="website" />
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