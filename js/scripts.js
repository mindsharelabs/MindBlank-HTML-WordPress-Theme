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

        

        jQuery('body').addClass('fade-in');


    });


} ( this, jQuery ));
