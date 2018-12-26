<?php
include_once('config.php');

chmod($upload_dir, 0777);

//  Resize Image
function resizeImage($image) {
	$image_data = getimagesize($image);
	$image_width = $image_data[0];
	$image_height = $image_data[1];
	
	if ($image_width > $image_height) {
		$new_width = 210;
		$new_height = $image_height * 210 / $image_width;
		$new_x = 0;
		$new_y = (170 - $new_height) / 2;
	} else {
		$new_width = $image_width * 170 / $image_height;
		$new_height = 170;		
		$new_x = (210 - $new_width) / 2;
		$new_y = 0;
	}
	
	// New image
	$new_image = imagecreatetruecolor(210, 170);
	// set background to white
	$white = imagecolorallocate($new_image, 255, 255, 255);
	imagefill($new_image, 0, 0, $white);
	
	// Old image
	$old_image = imagecreatefromjpeg($image);
		
	imagecopyresampled(
		$new_image, 
		$old_image, 
		$new_x, $new_y,
		0, 0,
		$new_width, $new_height,
		$image_width, $image_height
	);
	
	imagejpeg($new_image, $image, 90);		
	chmod($image, 0777);
	
	return $image;
}

// Upload image
if ($_POST['do'] == 'upload') {
	//Get the file information
	$image_name = $_FILES['image']['name'];
	$image_temp = $_FILES['image']['tmp_name'];
	$image_size = $_FILES['image']['size'];
	$image_type = $_FILES['image']['type'];
	$image_ext = strtolower(substr($image_name, strrpos($image_name, '.') + 1));
	
	//Only process if the file is a JPG and below the allowed limit
	if ((!empty($_FILES['image'])) && ($_FILES['image']['error'] == 0)) {
		
		foreach ($allowed_image_types as $mime_type => $ext) {
			//loop through the specified image types and if they match the extension then break out
			//everything is ok so go and check file size
			if ($image_ext == $ext && $image_type == $mime_type){
				$error = '';
				break;
			} else {
				$error = 'Chỉ ảnh định dạng *.jpg, *.png, *.gif \n';
			}
		}
		//check if the file size is above the allowed limit
		if ($image_size > ($max_size * 1024 * 1024)) {
			$error.= 'Ảnh sản phẩm phải nhỏ hơn ' . $max_size . 'MB!';
		}
		
	} else {
		$error= 'Hãy chọn ảnh cho sản phẩm!';
	}
	
	//Everything is ok, so we can upload the image.
	if (strlen($error) == 0) {
		// New name for photo
		$random_name = 'product_' . strtotime(date('Y-m-d H:i:s')) . '_' . rand();
		$file_temp_location = $upload_dir . $random_name . '.jpg';
		
		move_uploaded_file($image_temp, $file_temp_location);
		chmod($file_temp_location, 0777);
		
		$uploaded = resizeImage($file_temp_location);
		
		echo 'success|' . $random_name;
	} else {
		echo 'error|' . $error;
	}
}

// Delete image
if ($_POST['do'] == 'delete') {
	$image_name = $upload_dir . $_POST['name'] . '.jpg';
	
	if (file_exists($image_name)) {
		unlink($image_name);
	}
	
	echo 'success';
}