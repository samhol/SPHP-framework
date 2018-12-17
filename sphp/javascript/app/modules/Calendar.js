
/**
 * Contains Calendar functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @namespace sphp
 */
(function (sphp, $, undefined) {
  "use strict";
  sphp.calendar = function () {
    var $modal = $('.sphp-calendar.reveal');
    $('.calendar-day.has-info').on("click", function () {
      var date = $(this).attr('data-date');
      console.log('sphp/ajax/DateInfoContent.php');
      $modal.find('.calendar-date-root').html('<strong>Loading...</strong>');
      $.ajax('sphp/ajax/DateInfoContent.php?date=' + date)
              .done(function (resp) {
                $modal.find('.calendar-date-root').html(resp);
                //$modal.foundation('open');
                $modal.find('.calendar-date-root').foundation();
              });
    });
  };
}(window.sphp = window.sphp || {}, jQuery));

$(window).bind("load", function () {
  "use strict";
  sphp.calendar();

});
