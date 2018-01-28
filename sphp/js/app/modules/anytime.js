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
    function build($input, $opt) {
      console.log("build:");
      var $options = parseOptions($input);
      for (var key in $opt) {
        if ($opt.hasOwnProperty(key))
          $options[key] = $opt[key];
      }
      console.log("AnyTime_picker:" + $options);
      $input.AnyTime_picker($options);
    }
    function parseOptions($input) {
      console.log("parseOptions:");
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
      console.log("parsed options:");
      console.log($options);
      return $options;
    }
    /**
     * @protected
     * @param   {$.fn} $input
     * @returns {Object}
     */
    function init($input) {
      var $lang, $options = {};
      console.log("init:");
      if (typeof $input.data("sphp-locale") !== "undefined") {
        $lang = $input.data("sphp-locale");
        console.log("fetching localization: " + $lang);
        $.getJSON("sphp/ajax/anytime.c.localization.php", {'lang': $lang}, function (data) {
          console.log("localization successfull");
          console.log(data);
          $options = data;
        }).fail(function () {
          console.log("localization error");
        }).always(function () {
          console.log("localization complete");
          //$options = parseOptions($input);
          build($input, $options);
        });
      } else {
        console.log("no localization");
        build($input, $options);
      }
    }
    return this.each(function () {
      console.log("$.fn.SphpAnyTimeInput()");
      var $this = $(this);
      init($this);
    });
  };
}(jQuery));
