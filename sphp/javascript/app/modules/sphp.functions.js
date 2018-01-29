
/**
 * Contains sphp.TechLinks functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @namespace sphp
 */
;
(function (sphp, $, undefined) {
  "use strict";

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
  };
}(window.sphp = window.sphp || {}, jQuery));

