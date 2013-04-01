$(document).ready(function(){

	var _height = 262;

	function add_height(height) {
		if (height > _height) {
			prev_height = _height;
			_height = height;
		}
		$('.block-menu ul').css('height', _height+'px');
		$('.block-menu>ul').css('height', (_height-6)+'px');
		$('.leftcolumn .block-banners').css('margin-top', (_height+93) + 'px');
	}

	function rem_height() {
		var h = 0;
		$('.block-menu ul').each(function(){
			var height = 0;
			$(this).children('li').each(function(){
				height += $(this).outerHeight();
			});
			if (height > h) {
				h = height;
			}
		});
		if (h < _height) {
			_height = h;
		}
		$('.block-menu ul').css('height', _height+'px');
		$('.block-menu>ul').css('height', (_height-6)+'px');
		$('.leftcolumn .block-banners').css('margin-top', (_height+93) + 'px');
	}

	$('.block-menu .dotted').click(function(e){
		e.preventDefault();

		function adapt_shadow(el) {
			var list_level = el.parents('ul').length;
			if (el.hasClass('active')) list_level++;
			var shadow_width = 213 - 12; //width of head ul minus shadow offsets
			shadow_width += (256 - 12)*(list_level - 1); //width of inner uls minus shadow offsets
			$('.bg-menu').width(shadow_width);
		}

		function add_arrow(el) {
			el.append('<img src="images/arrow.png" class="arrow" />');

			var arrow = el.children('.arrow');
			arrow.height(el.outerHeight());

			var pos = el.position();
			var first_offset = 0;
			if ( ! el.parents('.active').length) first_offset = 17;
			arrow.css({ top: pos.top+'px', left: pos.left+el.outerWidth()-first_offset+'px' });
		}

		function remove_arrow(el) {
			el.find('.arrow').remove();
		}

		if ( $(this).hasClass('active') ) {
			//close inner uls
			$(this).parent().find('ul').hide();
			$(this).parent().parent().find('li.active').each(function(){
				remove_arrow($(this));
			});
			$(this).parent().parent().find('.active').removeClass('active');

			rem_height();

			adapt_shadow($(this));
		}
		else {
			//open inner uls
			$('.block-menu .active').each(function(){
				remove_arrow($(this));
			});
			$('.block-menu .active').removeClass('active');
			$('.block-menu ul').hide();

			$(this).attr('id', 1337);
			$('.block-menu li:has(#'+1337+')').addClass('active').children('a').addClass('active').children('ul').show();
			$('.block-menu ul:has(#'+1337+')').show();
			$('.block-menu li:has(#'+1337+')').each(function(){
				add_arrow($(this));
			});
			$('#1337').attr('id', '');

			$(this).parent().children('ul').show();
			$(this).parent().addClass('active');

			var height = 0;
			$.each($(this).parent().children('ul').children('li'), function(){
				height += $(this).outerHeight();
				add_height(height);
			});


			adapt_shadow($(this));
		}
	});

	$('.block-book #year').click(function(e){
		e.preventDefault();

		$('.block-book .filter ul').show();
	});

});