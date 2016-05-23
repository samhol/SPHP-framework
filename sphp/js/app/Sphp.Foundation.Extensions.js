


/**
 * commonJqueryPlugins.js (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery (1.8.2)+</a>
 * 
 * @namespace $
 */
(function ($) {
	'use strict';
	
	
	/**
	 * Replaces the selected part of the attribute value
	 *
	 * @memberOf jQuery.fn#
	 * @method   gsubAttr
	 * @returns  {jQuery.fn} object for method chaining
	 */
	$.fn.SphpFoundationModal = function () {
		return this.each(function () {
			var $this = $(this);
			$this.attr(attr, $attrValue.gsub(find, replace));
		});
	};

	/**
	 * Loads the data from the server pointed on the data attribute 'data-sph-load' using 
	 * jQuery's Ajax capabilities and places the returned HTML into the object.
	 * 
	 * @memberOf jQuery.fn#
	 * @method   foundationModalCloser
	 * @returns  {jQuery.fn} object for method chaining
	 */
	$.fn.SphpFoundationModalCloser = function () {
		return this.each(function () {
			var $this = $(this),
					$modal = $("#" + $this.attr("data-sphp-reveal-id"));
			$this.click(function () {
				$modal.foundation('reveal', 'close');
			});
		});
	};
}(jQuery));


/**
 * Contains all sph functionality.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @name sphp
 * @namespace sphp
 */
(function (sphp, $, undefined) {
	"use strict";
	
	var $modal;
	/**
	 * 
	 * @returns {String} httpRoot the http root path to be used in the sphp namespace
	 */
	sphp.foundationSetup = function () {
		console.log("sphp.foundationSetup()");
		$modal = $(".reveal-modal");
		return $httpRoot;
	};
}(window.sphp = window.sphp || {}, jQuery));