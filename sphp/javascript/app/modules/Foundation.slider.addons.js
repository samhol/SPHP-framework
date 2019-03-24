/**
 * QtipAdapter.js (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery+</a>
 * 
 */
(function ($) {
  'use strict';

  /**
   * Shows the mouse coordinates when ever the mouse is onver the containing document
   * 
   * @memberOf jQuery.fn#
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpFoundationRangeSliderValueViewer = function () {
    return this.each(function () {
      var $this = $(this), $minInput, $maxInput, $minOutput, $maxOutput;
      console.log('Init sphpFoundationRangeSliderValueViewer()');
      $minOutput = $this.find('[data-sphp-min]');
      console.log('find #' + $minOutput.attr('data-sphp-min'));
      $minInput = $('#' + $minOutput.attr('data-sphp-min'));
      console.log($minInput.val());
      $maxOutput = $this.find('[data-sphp-max]');
      $maxInput = $('#' + $maxOutput.attr('data-sphp-max'));
      $this.on('moved.zf.slider', function () {
        console.log("Inputs changed");
        $minOutput.html($minInput.val());
        $maxOutput.html($maxInput.val());
      });
    });
  };
}(jQuery));
