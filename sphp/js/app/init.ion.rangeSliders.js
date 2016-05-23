
/**
 * initIonRangeSlider.js (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery (1.9)+</a>
 * 
 * @namespace $
 */
(function ($) {
  'use strict';
  $.fn.initIonRangeSlider = function () {
    return this.each(function () {
      var $this = $(this), $options, $data = $this.attr("data-ion-rangeslider");
      console.log("ionRangeSlider options:" + $data.replace(/'/gi, "\""));
      $options = JSON.parse($data.replace(/'/gi, "\""));
      $this.ionRangeSlider($options);
    });
  };
}(jQuery));