/**
 * backToTopController.js (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery (1.8.2)+</a>
 * 
 */
(function ($) {
  'use strict';

  /**
   * Sets the Back to top controller
   * 
   * @function external:"jQuery.fn".backToTopController
   * @param    {Object} options {content: String the content of the popper,
   *                           delay: int visibility time (default 3000 ms)}
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.backToTopController = function (options) {
    var opts = $.extend({}, $.fn.backToTopController.defaults, options);
    return this.each(function () {
      var $this = $(this), $o, $window = $(window);
      $o = $.meta ? $.extend({}, opts, $this.data()) : opts;
      function setVisibility() {
        if ($window.scrollTop() > $o.offset) {
          $this.fadeIn($o.duration);
        } else {
          $this.fadeOut($o.duration);
        }
      }
      setVisibility(); 
      $window.scroll(function () {
        setVisibility();
      });
      $this.click(function () {
        $('html, body').animate({scrollTop: 0}, $o.duration);
        return false;
      });
    });
  };

  $.fn.backToTopController.defaults = {
    offset: 0,
    duration: 500
  };
}(jQuery));
