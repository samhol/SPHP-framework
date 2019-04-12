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
   * Implements Tipso functionality
   *
   * @memberOf jQuery.fn#
   * @method   sphpTipso
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpTipso = function () {
    //console.log('tipso initializing...');
    return this.each(function () {
      var $this = $(this), $options;
      //console.log('tipso initialized');
      //console.log($this.hasAttr("data-sphp-tipso-options"));
      if ($this.hasAttr("data-sphp-tipso-options")) {
        try {
          $options = JSON.parse($this.attr('data-sphp-tipso-options'));
          $this.tipso($options);
        } catch (err) {
          $this.tipso({useTitle: true});
        }
      } else {
        $this.tipso({useTitle: true});
      }
    });
  };
}(jQuery));
