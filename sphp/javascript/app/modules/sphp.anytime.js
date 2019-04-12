/**
 * commonJqueryPlugins.js (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery (1.8.2)+</a>
 * 
 */
(function ($) {
  'use strict';

  /**
   * Sets the dateTimeInput
   * 
   * @memberOf jQuery.fn#
   * @method   dateTimeInput
   * 
   * @returns {$.fn} for fluent interface
   */
  $.fn.SphpAnyTimeInput = function () {
    /**
     * Builds AnyTime_picker
     * 
     * @param   {$.fn} $input
     * @param   {Object} $opt
     * @returns {undefined}  
     */
    function build($input, $opt) {
      //console.log("build: SphpAnyTimeInput");
      var $options = parseOptions($input);
      for (var key in $opt) {
        if ($opt.hasOwnProperty(key))
          $options[key] = $opt[key];
      }
      $input.AnyTime_picker($options);
    }
    /**
     * 
     * @param   {$.fn} $input
     * @returns {Object}
     */
    function parseOptions($input) {
      var $options = {};
      if ($input.data("format") !== undefined) {
        $options.format = $input.data("format");
      } else {
        $options.format = "%Y-%m-%d %H:%i";
      }
      if ($input.data("sphp-firstdow") !== undefined) {
        $options.firstDOW = $input.attr("data-sphp-firstdow");
      } else {
        $options.firstDOW = 1;
      }
      $options.firstDOW = 1;
      return $options;
    }
    /**
     * @protected
     * @param   {$.fn} $input
     * @returns {Object}
     */
    function init($input) {
      var $lang, $options = {};
      if (typeof $input.data("sphp-locale") !== "undefined") {
        $lang = $input.data("sphp-locale");
        $.getJSON("sphp/ajax/anytime.c.localization.php", {'lang': $lang}, function (data) {
          $options = data;
        }).fail(function () {
          console.error("localization error");
        }).always(function () {
          build($input, $options);
        });
      } else {
        build($input, $options);
      }
    }
    return this.each(function () {
      var $this = $(this);
      init($this);
    });
  };
}(jQuery));
