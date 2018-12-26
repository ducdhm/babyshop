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
	$('#my-jcarousel').exist(function () {
		this.jcarousel({
			scroll: 1,
			auto: 1,
			wrap: 'circular',
			animation: 'slow'
		});
	});
	
	$('#map').exist(function () {
		var map = new google.maps.Map(document.getElementById("map"),{
				center: new google.maps.LatLng(20.893316, 106.605851),
				zoom: 16,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: false
			}),		
			marker = new google.maps.Marker({
				position: new google.maps.LatLng(20.893314, 106.605558),
				map: map
			}),		
			infowindow = new google.maps.InfoWindow({
				content: 
					'<div class="contact">' +
						'<h3><strong>BabyShop</strong></h3>' +
						'<p><strong>Địa chỉ</strong>: ' + info.address + '</p>' +
						'<p><strong>Số điện thoại</strong>: ' + info.phone + '</p>' +
						'<p><strong>Email</strong>: <a href="mailto:' + info.email + '">' + info.email + '</a></p>' +
						'<p><strong>Website</strong>: <a href="' + info.website + '">' + info.website + '</a></p>' +
					'</div>'
			});
		
		infowindow.open(map, marker);
	});
	
	$('#banner').exist(function () {
		var $items = this.find('.banner-item'),
			$controllers = this.find('#banner-controller a'),
			current = 0,
			length = $items.length,
			speed = 1000, // Duration of animation
			delay = 3000, // Delay time between animations
			timer;
			
		var runSlider = function () {
			var next;
			
			if (current === length - 1) {
				next = 0;
			} else {
				next = current + 1;
			}
			
			showItem(current, next);
			current = next;
		};
			
		var showItem = function (current, next) {
			$items.eq(current).stop().fadeTo(speed, 0);
			$items.eq(next).stop().fadeTo(speed, 1, function () {
				timer = setTimeout(function () {
					runSlider();
				}, delay);
			});
			
			$controllers.eq(current).removeClass('active');
			$controllers.eq(next).addClass('active');
		};
		
		// Bind event for controllers
		$controllers.each(function (i) {			
			$(this).click(function (e) {
				e.preventDefault();
				
				var $active = $controllers.filter('.active');
					
				clearTimeout(timer);
				showItem($active.index(), i);				
				current = i;
			});
		});
		
		// Set first item and controller are actived
		$items.not(':first').css('display', 'none');
		$controllers.eq(0).addClass('active');
		
		// Run slider
		timer = setTimeout(function () {
			runSlider();
		}, delay);
	});	
	
	$('.products-wrapper').exist(function () {
		this.filter(':odd').addClass('odd');
	});
});


}(jQuery));