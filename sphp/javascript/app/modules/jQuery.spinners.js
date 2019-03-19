/**
 * jQuery.spinners.js (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery (1.8.2)+</a>
 * 
 */
(function ($) {
  'use strict';
  /**
   * Sets the loader element (an animated gif image) to the given {@link jQuery.fn}.
   *
   * @author   Sami Holck <sami.holck@gmail.com>
   * @memberOf jQuery.fn#
   * @method   appendSpinner
   * @param    {Object} options {z_index: int div.WaitLoader-elementin z-indeksi (oletus 20000),
   *                          duration: int appearance duration in ms (default: 1000 ms)}
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.appendSpinner = function (options) {
    var opts = $.extend({}, $.fn.appendSpinner.defaults, options);
    return this.each(function () {
      var $this = $(this), $loader, $o;
      console.log("appending spinner...");
      $o = $.meta ? $.extend({}, opts, $this.data()) : opts;
      $loader = $('<span/>', {
        'class': 'sphp-loader spinner',
        css: {
          'z-index': $o.zIndex,
          position: 'relative',
        }
      });
      $loader.append('<img src="sphp/pics/spinner.gif" alt="Loading...">');
      $loader.appendTo($this);
      $loader.fadeIn($o.duration);
    });
  };
  $.fn.appendSpinner.defaults = {
    zIndex: 'inherit',
    duration: 1000
  };

  /**
   * Poistaa div.WaitLoader-elementin annettuista jQuery-objekteista.
   *
   * @author   Sami Holck <sami.holck@gmail.com>
   * @since    2012-09-23
   * @memberOf jQuery.fn#
   * @method   removeWaitLoader
   * @param    {Object} options {duration: int postumisefektin kesto millisekunneissa (oletus 1000 ms)}
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.removeSpinners = function (options) {
    var opts = $.extend({}, $.fn.removeSpinners.defaults, options);
    return this.each(function () {
      var $this = $(this), $loader = $this.find(".sphp-loader"), $o;
      console.log("removing spinners...");
      $o = $.meta ? $.extend({}, opts, $this.data()) : opts;
      $loader.fadeOut($o.duration, function () {
        $loader.remove();
      });
    });
  };
  $.fn.removeSpinners.defaults = {
    duration: 1000
  };

}(jQuery));
