(function( root, $, undefined ) {
	"use strict";

	$(function () {

        var windowWidth = $(window).width();

        if (windowWidth < 400) {
            var menuWidth = windowWidth - 50;
        } else {
            var menuWidth = 400;
        }
        var slideout = new Slideout({
            'panel': document.getElementById('main-panel'),
            'menu': document.getElementById('main-nav'),
            'padding': menuWidth,
            'tolerance': 0,
            'side': 'left'
        });

        document.querySelector('.slideout-menu').style.width = menuWidth + 'px';

        //Toggle button
        document.querySelector('.menu-toggle').addEventListener('click', function () {
            slideout.toggle();
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
