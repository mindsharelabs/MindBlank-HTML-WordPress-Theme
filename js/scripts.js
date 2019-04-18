(function( root, $, undefined ) {
	"use strict";

	$(function () {

        var windowWidth = $(window).width();

        var slideout = new Slideout({
            'panel': document.getElementById('main-panel'),
            'menu': document.getElementById('main-nav'),
            'padding': windowWidth,
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
