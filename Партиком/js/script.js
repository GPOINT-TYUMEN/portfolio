$(function() {
	var $carousel = $('#carousel'),
			$pager = $('#thumb');
	 
	function getCenterThumb() {
		var $visible = $pager.triggerHandler('currentVisible'),
				center = Math.floor($visible.length / 2);
		return center;
	}
	 
	$carousel.carouFredSel({
		circular: false,
		infinite: false,
		width: 810,
		height: 555,
		items: {
			visible: 1,
			width: 810,
			height: 555
		},
		auto: false,
		scroll: {
			onBefore: function( data ) {
				var src = data.items.visible.first().children("img").attr('src');
				src = src.split('/large/').join('/small/');
	 
				$pager.trigger( 'slideTo', [ 'img[src="'+ src +'"]', -getCenterThumb() ] );
				$pager.find( 'img' ).removeClass( 'selected' );
			},
			onAfter: function() {
				$pager.find('img').eq( getCenterThumb() ).addClass('selected');
			}
		},
		prev: {
			button: "#prev"
		},
		next: {
			button: "#next"
		}
	});
	
	$pager.carouFredSel({
		width: '100%',
		auto: false,
		height: 140,
		items: {
			visible: 4
		},
		scroll: 1,
		onCreate: function() {
			var center = getCenterThumb();
			$pager.trigger('slideTo', [ -center, { duration: 0 } ] );
			$pager.find('.item img').eq(center).addClass('selected');
		}
	});
	
	$pager.find( 'img' ).click(function() {
		var src = $(this).attr( 'src' );
		src = src.split('/small/').join('/large/');
		$carousel.trigger('slideTo', [ 'img[src="'+ src +'"]' ] );
	});
});