(function ($) {
$.fn.exist = function (callback) {
	if (this.length > 0) {
		callback.call(this);
	}
};

if (!String.prototype.trim) {
	String.prototype.trim = function () {
		return this.replace(/^\s+|\s+$/g, '');
	};
}

$(function () {
	$('#categories').exist(function () {
		var $list = this.find('table');
		
		$list.on('click', '.btn-delete', function () {
			var $this = $(this),
				$tr = $this.parent().parent(),
				category = $tr.find('.category-name').html();
				
			return confirm('Bạn có chắc bạn muốn xoá "' + category + '"?');
		});
	});
	
	$('#users').exist(function () {
		var $list = this.find('table');
		
		$list.on('click', '.btn-delete', function (e) {
			var $this = $(this),
				$tr = $this.parent().parent(),
				username = $tr.find('.user-name').html();
				
			return confirm('Bạn có chắc bạn muốn xoá "' + username + '"?');
		});
	});	
	
	$('#products').exist(function () {
		var $list = this.find('table');
		
		$list.on('click', '.btn-delete', function (e) {
			var $this = $(this),
				$tr = $this.parent().parent(),
				product = $tr.find('.product-name').html();
				
			return confirm('Bạn có chắc bạn muốn xoá "' + product + '"?');
		});
		
		$list.dataTable({
			"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span12'p>>",
			"bStateSave": true,
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "Hiển thị _MENU_ sản phẩm",
				"sZeroRecords": "Không có sản phẩm nào.",
				"sInfo": "",
				"sInfoEmpty": "",
				"sInfoFiltered": "",
				"sSearch": "Tìm kiếm:",
				"oPaginate": {
					"sFirst": "Đầu tiên",
					"sLast": "Cuối cùng",
					"sPrevious": "Trước",
					"sNext": "Sau"
				}
			},
			"aoColumnDefs":[{
				"bSortable":false,
				"aTargets": [3, 4]
			}, {
				"aaSorting": [], 
				"aTargets": ["_all"]
			}],
			"bPaginate": true,
			"bFilter": true
		});
	});
	
	$('#form-add-product').exist(function () {
		var 
			$name = $('#name'), // Input name
			$catId = $('#cate_id'), // Selectbox cate_id
			$price = $('#price'), // Input price
			$uploader = $('#uploader'), // Button upload
			$previewerWrapper = $('#photo-preview'), // The priviewer panel
			$previewer = $('#previewer'), // The image display product photo
			$photo = $('#photo'), // Input hidden store name of image
			$btnAdd = $('#add-user'), // Button `Lưu`
			$alert = $('#alert'); // Alert panel
			
		$('#delete-preview').click(function (e) {
			e.preventDefault();
			
			var $this = $(this);
			
			if (!$this.hasClass('disabled')) {
				$this.addClass('disabled');
				
				$.ajax({
					url: '/includes/image.php',
					type: 'post',
					data: {
						do: 'delete',
						name: $photo.val()
					},
					success: function (data) {
						if (data === 'success') {
							$photo.val('');
							$uploader.removeClass('hide');
							$previewerWrapper.addClass('hide');
						}
						$this.removeClass('disabled');
					},
					error: function () {
						$this.removeClass('disabled');
					}
				});
			}
		});
		
		// Uploader
		new AjaxUpload($uploader, {
			action: '/includes/image.php',
			name: 'image',
			data: {
				do: 'upload'
			},
			onSubmit: function(file, ext) {
				if (!$uploader.hasClass('disabled')) {
					if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
						alert('Hảy chọn ảnh có định dạng *.jpg, *.png hoặc *.gif!');
						return false;
					} else {
						$uploader.addClass('disabled').html('Đang tải...');
					}
				}
			},
			onComplete: function(file, response){
				response = response.split('|');
				
				var type = response[0],
					msg = response[1];
					
				$uploader.removeClass('disabled').html('Tải ảnh sản phẩm');
				
				if (type === 'error') {
					alert('msg');
				} else {
					$uploader.addClass('hide');
					$previewerWrapper.removeClass('hide');
					$previewer.attr('src', '/uploads/' + msg + '.jpg');
					$photo.val(msg);
				}
			}
		});
		
		$btnAdd.click(function (e) {
			var error = '';
			
			if ($name.val().trim() === '')  {
				error += '<li><strong>Tên sản phẩm</strong> không được để trống.</li>';
			}
			
			if ($price.val().trim() === '') {
				error += '<li><strong>Giá sản phẩm</strong> không được để trống.</li>';
			} else {
				if (isNaN($price.val())) {
					error += '<li><strong>Giá sản phẩm</strong> phải là số.</li>';
				}
			}
			
			if ($photo.val().trim() === '') {
				error += '<li><strong>Ảnh sản phẩm</strong> không được để trống.</li>';
			}
			
			if (error !== '') {
				e.preventDefault();
				
				$alert.removeClass('hide').find('ul').html(error);
			}
		});
	});
});


}(jQuery));