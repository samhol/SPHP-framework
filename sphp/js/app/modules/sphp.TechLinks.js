
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
    console.log("sphp.TechLinks() v2");
    $(".sphp-tech-list .jQuery")
            .attr("title", "jQuery: " + $.fn.jquery);
    $(".sphp-tech-list .Foundation")
            .attr("title", "Foundation: " + sphp.getFoundationVersion());
    
    $("a.jquery_version").append(" " + $.fn.jquery)
            .attr("title", "jQuery: " + $.fn.jquery);
    $("a.foundation_version").append(" " + sphp.getFoundationVersion())
            .attr("title", "Foundation for sites version " + sphp.getFoundationVersion());
    $("a.anytime_version").append(" " + AnyTime.version)
            .attr("title", "Any+Time™ version " + AnyTime.version);
    
  };

}(window.sphp = window.sphp || {}, jQuery));
$(window).bind("load", function () {
  "use strict";
  sphp.TechLinks();
});
