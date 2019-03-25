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

  /**
   * Shows the mouse coordinates when ever the mouse is onver the containing document
   * 
   * @memberOf jQuery.fn#
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpFoundationSliderValueViewer = function () {
    return this.each(function () {
      var $slider = $(this), $inputs, $output;
      console.log('Init sphpFoundationSliderValueViewer()');
      $inputs = $slider.find('input');
      $output = $('[data-sphp-sider-value-for="' + $slider.attr('id') + '"]');
      if ($inputs.length === 2) {
        rangeSlider();
      } else {
        slider();
      }
      function center($handle, $value) {
        var $width = $handle.width(), $output = $handle.find('.output'), $outputWidth = $handle.width();
        console.log("$width: " + $width);
        console.log("$outputWidth: " + $outputWidth);
        $output.html($value);
        $output.css({
          left: Math.floor(($width / 2 - $outputWidth / 2)) + 'px'
        });
      }
      function rangeSlider() {
        var $minInput, $maxInput, $handle1, $handle2, $minPaddleOutput, $maxPaddleOutput;
        $handle1 = $($slider.find('.slider-handle').get(0));
        $handle2 = $($slider.find('.slider-handle').get(1));
        $minInput = $($inputs.get(0));
        $maxInput = $($inputs.get(1));
        $minPaddleOutput = $('<div class="output">');
        $handle1.html($minPaddleOutput);
        $maxPaddleOutput = $('<div class="output">');
        $handle2.html($maxPaddleOutput);
        $slider.on('moved.zf.slider', function () {
          var $min = $minInput.val(), $max = $maxInput.val();
          //console.log("Inputs changed");
          $output.html('<samp>' + $minInput.val() + '</samp>-<samp>' + $maxInput.val() + '</samp>');
          $minPaddleOutput.html($min);
          $maxPaddleOutput.html($max);
          center($handle1, $min);
          center($handle2, $max);
        });
      }
      function slider() {
        var $input;
        $input = $($inputs.get(0));
        $slider.on('moved.zf.slider', function () {
          //console.log("Input changed");
          $output.html($input.val());
        });
      }
    });
  };
}(jQuery));
