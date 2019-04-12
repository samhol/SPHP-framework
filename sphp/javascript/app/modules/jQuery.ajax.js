
(function ($) {
  'use strict';
  /**
   * The jQuery plugin namespace.
   * @external "jQuery.fn"
   * @see {@link http://learn.jquery.com/plugins/|jQuery Plugins}
   *
   * Loads the data from the server pointed on the data attribute 'data-sph-load' using 
   * jQuery's Ajax capabilities and places the returned HTML into the object.
   * 
   * @function external:"jQuery.fn".sphpAjaxPrepend
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpAjaxPrepend = function () {
    return this.each(function () {
      var $this = $(this),
              $url = $this.attr("data-sphp-ajax-prepend"),
              $content = $("<div>");
      //console.log("initializing Sphp ajax prepending...");
      $this.appendSpinner();
      $this.on("sphp-ajax-prepend-finished", function () {
        //console.log("SPHP Ajax prepending finished...");
        $(this).foundation();
        $this.removeSpinners({duration: 1000});
        $this.removeAttr("data-sphp-ajax-prepend");
      });
      $content = $("<div>").load($url, function (response, status, xhr) {
        if (status === "error") {
          $(".callout.error").html('<strong class="error">ERROR</strong> while loading resource: ' + xhr.status + " " + xhr.statusText);
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
   * @method   sphpAjaxAppend
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpAjaxAppend = function () {
    return this.each(function () {
      var $this = $(this),
              $url = $this.attr("data-sphp-ajax-append"),
              $content = $("<div>");
      //console.log("initializing Sphp ajax appending...");
      $this.appendSpinner();
      $this.on("sphp-ajax-append-finished", function () {
        console.log("SPHP Ajax appending finished...");
        $(this).foundation();
        $this.removeSpinners({duration: 1000});
        $this.removeAttr("data-sphp-ajax-append");
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
  $.fn.sphpLoadContent = function () {
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



