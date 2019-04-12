/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 *
 * Requires <a href="http://jquery.com/">jQuery (1.8.2)+</a> 
 */

(function ($) {
  'use strict';

  /**
   * Implements switchBoard functionality
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
