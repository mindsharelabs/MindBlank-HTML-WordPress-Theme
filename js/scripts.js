(function( root, $, undefined ) {
	"use strict";

	$(function () {

        var windowWidth = $(window).width();

				if(windowWidth < 576) {
					$(document).on('click', 'li.menu-item-has-children:not(.expanded)', function(e) {
						e.preventDefault();
						$(this).toggleClass('expanded');
					})
				} else if(windowWidth < 992) {
					var menuWidth = windowWidth/2;
				} else if(windowWidth < 1200) {
					var menuWidth = 400;
				} else {
					var menuWidth = 400;
				}

				$(window).scroll(function() {
	        if ($(document).scrollTop() > 10) {
	          $('header.header').addClass('scrolled');
	        }
	        else {
	          $('header.header').removeClass('scrolled');
	        }
		    });


				$(document).on('click', '#mobileMenuToggle', function(e) {

					if($('#mobileMenu').hasClass('show')) {
						$('#mobileMenu').css('height', '0px');
						setTimeout( function() {
	            $('#mobileMenu').toggleClass('show');
	       		}, 100);
					} else {
						$('#mobileMenu').css('height', '100vh');
						setTimeout( function() {
	            $('#mobileMenu').toggleClass('show');
	       		}, 100);
					}



					$(this).toggleClass('active');

				});





        jQuery('body').addClass('fade-in');


    });


} ( this, jQuery ));
