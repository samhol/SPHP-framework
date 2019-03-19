/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

(function ($) {
  'use strict';

  /**
   * Replaces the selected part of the attribute value
   *
   * @memberOf jQuery.fn#
   * @method   setProgress
   * @param    {Number} $progress new progress level in percent (0-100)
   * @param    {String} $text new progress level text
   * @returns  {jQuery.fn} object for method chaining
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
