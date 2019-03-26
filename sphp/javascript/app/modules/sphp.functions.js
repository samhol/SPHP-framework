
/**
 * Contains misc functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @namespace sphp
 */
;
(function (sphp, $, undefined) {
  "use strict";

  sphp.numbers = {};

  sphp.numbers.precision = function (a) {
    if (!isFinite(a)) {
      return 0;
    }
    var e = 1, p = 0;
    while (Math.round(a * e) / e !== a) {
      e *= 10;
      p++;
    }
    return p;
  };

  /**
   * Generates a random string
   * 
   * @param  int n
   * @return string
   */
  sphp.randomString = function (n) {
    var s = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return Array(n).join().split(',').map(function () {
      return s.charAt(Math.floor(Math.random() * s.length));
    }).join('');
  };
  var idCounter = 0;
  sphp.generateUniqueId = function () {
    var uniqueID;
    do {
      uniqueID = generateId(length);
    } while (document.getElementById(uniqueID));
    console.log('accepted id: ' + uniqueID);
    return uniqueID;
  };
  function generateId() {
    //console.log('generateId');
    return 'id-' + idCounter++;
  }
  ;
  /*
   *
   * Function to load SVG safely using AJAX,
   * including fallback to png files when
   * SVG is not supported
   *
   * Pass the selector and the URL of the files
   * without its extenstion as the function
   * will take care of it.
   *
   * Based on http://css-tricks.com/ajaxing-svg-sprite/
   *
   * 
   * @param {type} selector
   * @param {type} url
   * @returns {undefined}
   */
  function loadSvg(selector, url) {
    var target = document.querySelector(selector);

    // If SVG is supported
    if (typeof SVGRect != "undefined") {
      // Request the SVG file
      var ajax = new XMLHttpRequest();
      ajax.open("GET", url + ".svg", true);
      ajax.send();

      // Append the SVG to the target
      ajax.onload = function (e) {
        target.innerHTML = ajax.responseText;
      }
    } else {
      // Fallback to png
      target.innerHTML = "<img src='" + url + ".png' />";
    }
  }
}(window.sphp = window.sphp || {}, jQuery));

