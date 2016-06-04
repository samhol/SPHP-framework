
/**
 * Contains sphp.SideNavs functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @name sphp
 * @namespace sphp
 */
(function (sphp, $, undefined) {
  "use strict";
  var $progressBars = [];

sphp.progressBar = {change: "sphp.progressBar.change"};
  sphp.initProgresBars = function () {
    $("[data-sphp-progressbar]").progressBar();
  };
  /**
   * 
   * @returns 
   */
  sphp.addProgressBar = function ($barName) {
    console.log("sphp.addProgressBar(" + $barName + ")");

  };
}(window.sphp = window.sphp || {}, jQuery));

(function ($) {
  'use strict';
  $.fn.progressBar = function ($progress) {
    return this.each(function () {

      var $this = $(this),
              $meter = $this.children(".progress-meter");
      console.log("$.fn.progressBar(" + $progress + ")");
      $meter.css("width", $progress + "%");
      $(this).trigger(sphp.progressBar.change, {progress : $progress});
      this.a = function () {
        return $meter.css("width");
      };
    });

  };

}(jQuery));
var $a = 10;
$("[data-sphp-progressbar]").on(sphp.progressBar.change, function( event, param) {
  //$( this ).getProgress();
  
  console.log(event.namespace + ":" +  event.type);
});
function test() {
  var $v = ($a += 10) % 100;
  $("[data-sphp-progressbar]").progressBar($v);
  //console.log("v:" + $("[data-sphp-progressbar]").progressBar());
}
var id = setInterval(test, 1000); //call test every 10 seconds.
function stop() { // call this to stop your interval.
  clearInterval(id);
}
