(function( root, $, undefined ) {
	"use strict";

	$(function () {

        var windowWidth = $(window).width();

				if(windowWidth < 576) {
					var menuWidth = windowWidth - 50;
				} else if(windowWidth < 992) {
					var menuWidth = windowWidth/2;
				} else if(windowWidth < 1200) {
					var menuWidth = 400;
				} else {
					var menuWidth = 400;
				}

        var slideout = new Slideout({
            'panel': document.getElementById('main-panel'),
            'menu': document.getElementById('main-nav'),
            'padding': menuWidth,
            'tolerance': 0,
            'side': 'right'
        });

        document.querySelector('.slideout-menu').style.width = windowWidth + 'px';

        //Toggle button
        document.querySelector('.menu-toggle').addEventListener('click', function () {
            slideout.toggle();
        });
				document.querySelector('.menu-toggle-close').addEventListener('click', function () {
            slideout.close();
        });


        slideout.on('beforeclose', function () {
            $('.slideout-menu').fadeOut();
        });
        slideout.on('beforeopen', function () {
            $('.slideout-menu').fadeIn();
        });
        slideout.on('open', function () {
            $('.menu-toggle svg').addClass("fa-window-close").removeClass("fa-bars");

        });
        slideout.on('close', function () {
            $('.menu-toggle svg').addClass("fa-bars ").removeClass("fa-window-close");

        });

        jQuery('body').addClass('fade-in');



    });


} ( this, jQuery ));
