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
			this.menuToggle();
			this.stickyHeaderShowOnScrollUp();
			this.checkIfHeroIsFirstElement();
		},

		/**
		* Call functions when window load.
		*/
		load: function() {		
			// Call Animate On Scroll script
			AOS.init({ duration: 700 });
		},

		// CUSTOM FUNCTIONS BELOW
		menuToggle: function() {
			$('.menu-toggle').on('click', function(){
				$(this).toggleClass('is-active');
				$('#nav_overlay').toggleClass('active');

				$('#nav_overlay.active #main_menu').find('li').each(function(a, b){
					var menuItem = $(this);
					setTimeout(function() {
						menuItem.addClass('slide-in-up');
					}, 100 + (100 * a));
				});
				$('#nav_overlay:not(.active) #main_menu').find('li').removeClass('slide-in-up');

				$('#nav_overlay.active #main_menu').find('.nav-cta-container, .search-form, .nav-cta').each(function(a, b){
					var menuCTA = $(this);
					setTimeout(function(){
						menuCTA.addClass('slide-in-up');
					}, 100 + (100 * a) + ($('#nav_overlay #main_menu li').length * 100));
				});
				$('#nav_overlay:not(.active) #main_menu').find('.nav-cta-container, .search-form, .nav-cta').removeClass('slide-in-up');
			});
		},

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
		},

		checkIfHeroIsFirstElement: function() {
			var $body = $('body'),
					$header = $('header[role="banner"]'),
					$ele = $('section[role="main"]').find('section:first-of-type');

			if( !$ele.hasClass( 'module-hero' ) && !$ele.hasClass('dark') ) {
				$header.addClass('is-header-dark');
			}
		},

	};

})(jQuery);