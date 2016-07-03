
/**
 * Sphp.Foundation.ProgressBar.js (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery (1.8.2)+</a>
 * 
 * @namespace $
 */
(function ($) {
  'use strict';
  /**
   * 
   * @param   {Number} $progress new progress level in percent (0-100)
   * @param   {String} $text new progress level text
   * @returns {sphp_ProgressBar_L74.$.fn@call;each}
   */
  $.fn.setProgress = function ($progress, $text) {
    return this.each(function () {
      var $this = $(this), $meter, $meterText;
      $meter = $this.children(".progress-meter");
      $meterText = $meter.children(".progress-meter-text");
      if (!$this.hasClass("progress") || !$meter) {
        throw "Element is not a valid Foundation Progress bar";
      }
      $text = typeof $text !== 'undefined' ? $text : $progress + "%";
      $this.attr("aria-valuenow", $progress);
      $this.attr("aria-valuetext", $text);
      $meter.css("width", $progress + "%");
      if ($progress > 0) {
        $meterText.html($progress + "%");
      } else {
        $meterText.html("");
      }
      $(this).trigger("sphp.progressBar.change", {progress: $progress});
    });
  };
  /**
   * 
   * @returns {number}
   */
  $.fn.getProgress = function () {
    return parseInt($(this).attr("aria-valuenow"));
  };
}(jQuery));
