
/**
 * Contains sphp.SideNavs functionality
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
  sphp.SideNavs = function () {
    console.log("sphp.SideNavs()");
    var $accordions = $(".sphp-side-nav [data-sphp-single-accordion]").has("li.active.link");
    $accordions.each(function () {
      var $accordion = $(this);
      console.log("showing accordion...");
      $accordion.find(".head").removeClass("inactive").addClass("active");
      $accordion.find("ul.body").show();
    });
  };

  /**
   * Creates the PhotoAlbum widget component if .
   *
   * @public
   * @static 	 
   * @memberOf sphp
   * @returns  {sphp.PhotoAlbum} an instance of the widget component
   */
  sphp.initSideNavs = function () {
    $(window).bind("load", function () {
      sphp.SideNavs();
    });
  };
}(window.sphp = window.sphp || {}, jQuery));
$(window).bind("load", function () {
  sphp.SideNavs();
});