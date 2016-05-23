
/**
 * Contains sphp.TechLinks functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @name sphp
 * @namespace sphp
 */
(function (sphp, $, undefined) {
  "use strict";

  /**
   * 
   * @returns 
   */
  sphp.TechLinks = function () {
    console.log("sphp.TechLinks()");
    $(".sphp-tech-list .jQuery")
            .attr("title", "jQuery: " + $.fn.jquery);
    $(".sphp-tech-list .Foundation")
            .attr("title", "Foundation: " + sphp.getFoundationVersion());
  };

}(window.sphp = window.sphp || {}, jQuery));
$(window).bind("load", function () {
  "use strict";
  sphp.TechLinks();
});