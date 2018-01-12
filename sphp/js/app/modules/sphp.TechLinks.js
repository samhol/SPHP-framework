
/**
 * Contains sphp.TechLinks functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @name sphp
 * @namespace sphp
 */
;
(function (manual, $, undefined) {
  "use strict";

  /**
   * 
   * @returns 
   */
  manual.techLinksList = function () {
    //var $irs;
    console.log("sphp.TechLinks() v2");
    $(".tech-links-list .jQuery")
            .attr("title", "jQuery: " + $.fn.jquery);
    $(".tech-links-list .foundation")
            .attr("title", "Foundation for sites version: " + Foundation.version);
  };

}(window.manual = window.manual || {}, jQuery));
$(window).bind("load", function () {
  "use strict";
  manual.techLinksList();
});
