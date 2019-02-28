/**
 * Contains Calendar functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @namespace sphp
 */
(function (sphp, $, undefined) {
  "use strict";

  sphp.columnHighlighter = function () {
    var $dayCell = $('div.sphp.calendar.date');
    $dayCell.mouseover(function () {
      var $weekday = $(this).attr('data-week-day');
      $('div.sphp.calendar.month .head .' + $weekday).addClass('active');
      //console.log('weekday activated: ' + $weekday);
    });
    $dayCell.mouseout(function () {
      var $weekday = $(this).attr('data-week-day');
      $('div.sphp.calendar.month .head .' + $weekday).removeClass('active');
      //console.log('weekday deactivated: ' + $weekday);
    });
  };
  sphp.calendar = function () {

    var $modal = $('.sphp.calendar.reveal');
    $('div.sphp.calendar.date.has-info').on('click', function () {
      var date = $(this).attr('data-date');
      console.log('/sphp/ajax/DateInfoContent.php');
      $modal.find('.calendar-date-root').html('<strong>Loading...</strong>');
      $.ajax('/sphp/ajax/DateInfoContent.php?date=' + date)
              .done(function (resp) {
                $modal.find('.calendar-date-root').html(resp);
                //$modal.foundation('open');
                $modal.find('.calendar-date-root').foundation();
              });
    });
  };
  sphp.calendar.selector = function () {
    $(".month-selector select").change(function () {
      var $year, $month, $path;
      $year = $("select[name='year'] option:selected").attr('value');
      $month = $("select[name='month'] option:selected").attr('value');
      $path = "/calendar/" + $year + "/" + $month;
      console.log($path);
      window.location.pathname = $path;
    });

  };
}(window.sphp = window.sphp || {}, jQuery));

$(window).bind("load", function () {
  "use strict";
  sphp.columnHighlighter();
  sphp.calendar();
  sphp.calendar.selector();

});
