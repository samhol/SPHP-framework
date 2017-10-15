/**
 * ajax.js (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery (1.8.2)+</a>
 * 
 * @namespace $
 */
(function ($) {
  'use strict';

  /**
   * Loads the data from the server pointed on the data attribute 'data-sph-load' using 
   * jQuery's Ajax capabilities and places the returned HTML into the object.
   * 
   * @memberOf jQuery.fn#
   * @method   sphLoadContent
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpAjaxPrepend = function () {
    return this.each(function () {
      var $this = $(this),
              $url = $this.attr("data-sphp-ajax-prepend"),
              $content = $("<div>");
              var d = new Date();
      console.log("initializing Sphp ajax prepending...");
      console.log(d.getSeconds());
      $this.appendSpinner();
      $this.on("sphp-ajax-prepend-finished", function () {
        console.log("SPHP Ajax prepending finished...");
        $(this).foundation();
        $this.removeSpinners({duration: 1000});
        $this.removeAttr("data-sphp-ajax-prepend");
        d = new Date();
        console.log(d.getSeconds());
      });
      $content = $("<div>").load($url, function (response, status, xhr) {
        if (status === "error") {
          $(".callout.error").html("<strong>ERROR</strong> while loading resource: " + xhr.status + " " + xhr.statusText);
          $content.html(
                  "<strong>ERROR</strong> while loading resource: '<u><var>"
                  + $url + "</var></u>'<br> <strong>"
                  + xhr.status + " " + xhr.statusText + "</strong>");
        }
        $this.prepend($content.html());
        $this.trigger("sphp-ajax-prepend-finished");
      });
    });
  };

  /**
   * Loads the data from the server pointed on the data attribute 'data-sph-load' using 
   * jQuery's Ajax capabilities and places the returned HTML into the object.
   * 
   * @memberOf jQuery.fn#
   * @method   sphLoadContent
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpAjaxAppend = function () {
    return this.each(function () {
      var $this = $(this),
              $url = $this.attr("data-sphp-ajax-append"),
              $content = $("<div>");
              var d = new Date();
      console.log("initializing Sphp ajax appending...");
      console.log(d.getSeconds());
      $this.appendSpinner();
      $this.on("sphp-ajax-append-finished", function () {
        console.log("SPHP Ajax appending finished...");
        $(this).foundation();
        $this.removeSpinners({duration: 1000});
        $this.removeAttr("data-sphp-ajax-append");
        d = new Date();
        console.log(d.getSeconds());
      });
      $content = $("<div>").load($url, function (response, status, xhr) {
        if (status === "error") {
          $("#error").html("<strong>ERROR</strong> while loading resource: " + xhr.status + " " + xhr.statusText);
          $content.html(
                  "<strong>ERROR</strong> while loading resource: '<u><var>"
                  + $url + "</var></u>'<br> <strong>"
                  + xhr.status + " " + xhr.statusText + "</strong>");
        }
        $this.append($content.html());
        $this.trigger("sphp-ajax-append-finished");
      });
    });
  };

  /**
   * Loads the data from the server pointed on the data attribute 'data-sph-load' using 
   * jQuery's Ajax capabilities and places the returned HTML into the object.
   * 
   * @memberOf jQuery.fn#
   * @method   sphLoadContent
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphLoadContent = function () {
    return this.each(function () {
      var $this = $(this), $url = $this.attr("data-sph-load");
      $this.addWaitLoader();
      $this.load($url, function (response, status, xhr) {
        if (status === "error") {
          $this.html(
                  "<strong>ERROR</strong> while loading resource: '<u><var>"
                  + $url + "</var></u>'<br> <strong>"
                  + xhr.status + " " + xhr.statusText + "</strong>");
        }
      });
    });
  };
}(jQuery));



