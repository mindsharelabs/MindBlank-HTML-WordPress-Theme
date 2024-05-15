(function( root, $, undefined ) {
	"use strict";

	$(function () {

        // var windowWidth = $(window).width();


		$(window).scroll(function() {
			if ($(document).scrollTop() > 10) {
			$('.main-navigation ').addClass('scrolled');
			}
			else {
			$('.main-navigation ').removeClass('scrolled');
			}
		});

		$(document).on('click', '#mobileMenuToggle', function(e) {
			if($('#mobileMenu').hasClass('show')) {
				$('#mobileMenu').removeClass('show').css('height', '0px');
			} else {
				$('#mobileMenu').addClass('show').css('height', '100vh');
			}
			$(this).toggleClass('active');

		});


		$(document).on('click', '#mobileMenu li.menu-item-has-children a', function(e) {
			if($(this).parent().hasClass('menu-item-has-children')) {
				e.preventDefault();
			}

			$(this).parent().toggleClass('expanded');
		});

		$(window).on("load", function() {
			jQuery('body').addClass('fade-in');

		});



    });


} ( this, jQuery ));
