(function($) {
	'use strict';

	$(document).ready(function() {
		init.ready();
	});

	$(window).on('load',function() {
		init.load();
	});

	var init = {

		/**
		* Call functions when document ready
		*/
		ready: function() {
			this.stickyHeaderShowOnScrollUp();
		},

		/**
		* Call functions when window load.
		*/
		load: function() {		
			// Call Animate On Scroll script
			AOS.init({ duration: 700 });
		},

		// CUSTOM FUNCTIONS BELOW

		stickyHeaderShowOnScrollUp: function() {
			var $body = $('body'),
					$header = $('header[role="banner"].sticky-scroll'),
					lastScrollTop = 0;

			if($header.length > 0){
				var $headerHeight = $header.outerHeight()
				
				$(window).scroll(function(event){
					var st = $(this).scrollTop();
					if( st > $headerHeight ) {
						$header.addClass( 'is-scrolling' );
					}
					if ( st > lastScrollTop ){
						// downscroll
						$header.removeClass( 'is-scrolling-up' );
					} else if( st == 0 ) {
						// at scrolltop
						$header.removeClass( 'is-scrolling is-scrolling-up' );
					} else {
						// upscroll
						$header.addClass( 'is-scrolling-up' );
					}
					lastScrollTop = st;
				});
			}
		}

	};

})(jQuery);