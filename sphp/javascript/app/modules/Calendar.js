
/**
 * Contains Calendar functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @namespace sphp
 */
;
(function (sphp, $, undefined) {
  "use strict";
  sphp.calendar = function () {
    var $modal = $('#exampleModal1');
    


    $('button').on("click", function () {
      var url = $(this).attr('data-url');
      var date = $(this).attr('data-date');
      console.log('sphp/ajax/DateInfoContent.php');
      $modal.html('<strong>Loading...</strong>');
      $.ajax('sphp/ajax/DateInfoContent.php?date=' + date)
              .done(function (resp) {
                $modal.html(resp).foundation('open');
        $modal.foundation();
              });
    });
  };

}(window.sphp = window.sphp || {}, jQuery));



$(window).bind("load", function () {
  "use strict";
  sphp.calendar();

});
