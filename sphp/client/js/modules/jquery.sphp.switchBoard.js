/**
 * jquery.sphp.switchBoard.js (UTF-8)
 * Copyright (c) 2022 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery (3.6.0)+</a>
 * 
 */
(function ($) {
  'use strict';
 
  /**
   * Implements Bootstrap based switchBoard functionality
   *
   * @memberOf jQuery.fn#
   * @method   switchBoard
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.switchBoard = function () {
    return this.each(function () {
      var $this = $(this), $toggler, $options, $optCount;
      $toggler = $this.find('input[data-toggle-all]');
      $options = $this.find('.options input[type="checkbox"]');
      $optCount = $options.length;
      console.log('switchBoard loaded...');
      if (allChecked()) {
        $toggler.prop('checked', true);
      }
      $toggler.click(function () {
        $options.prop('checked', this.checked);
      });
      $options.click(function () {
        if (allChecked()) {
          $toggler.prop('checked', true);
        } else {
          $toggler.prop('checked', false);
        }
      });
      function allChecked() {
        return $this.find('.options input:checked').length === $optCount;
      }
    });
  };
}(jQuery));
