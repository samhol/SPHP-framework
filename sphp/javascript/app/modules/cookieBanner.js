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
   * Implements functionality for a cookie banner
   *
   * @memberOf jQuery.fn#
   * @method   cookieBanner
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.cookieBanner = function () {
    return this.each(function () {
      var $cookieBanner = $(this), $accept, $reject, $days = 182, $mydate;
      $accept = $cookieBanner.find('button[data-sphp-accept-cookies]');
      $reject = $cookieBanner.find('button[data-sphp-reject-cookies]');
      $accept.click(function () { //on click event
        //number of days to keep the cookie
        $mydate = new Date();
        $mydate.setTime($mydate.getTime() + ($days * 24 * 60 * 60 * 1000));
        document.cookie = "comply_cookie = comply_yes; expires = " + $mydate.toGMTString(); //creates the cookie: name|value|expiry
        $cookieBanner.slideUp("slow"); //jquery to slide it up
      });
      $reject.click(function () { //on click event
        //number of days to keep the cookie
        $mydate = new Date();
        $mydate.setTime($mydate.getTime() + ($days * 24 * 60 * 60 * 1000));
        removeCookie("comply_cookie");
        $cookieBanner.slideUp("slow");
      });
      function removeCookie($name) {
        var $date = new Date();
        document.cookie = $name + "=; expires = " + $date.toGMTString();
      }
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


