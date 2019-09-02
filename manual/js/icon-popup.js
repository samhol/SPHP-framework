
(function (sphp, $, undefined) {
  "use strict";
  sphp.iconsFunc = function ($icons) {
    console.log('iconsFunc....');
    $icons.click(function () {
      console.log('icon clicked....');
      var $url = $icons.attr("data-url"),
      $target =  $('#' + $icons.attr('data-open')),
      $div = $('<div class="content">');
      $target.html($div);
      $.ajax($url)
              .done(function (html) {
               // $this.removeAttr("data-url");
                console.log("loading (" + $url + ") successfull");
                $div.append(html);
                sphp.iconsFunc($target.find('[data-url]'));
              })
              .fail(function () {
                console.error("loading (" + $url + ") failed");
              })
              .always(function () {
                console.log("loading (" + $url + ") complete");
              });
    });
  };

  /**
   * Returns the jQuery version number
   *
   * @public
   * @static
   * @returns {String} the jQuery version number
   */
  sphp.initIconLoaders = function () {
    console.log('initIconLoaders....');
    var triggers = $('.icon-popup-trigger');

    triggers.click(function () {
      var $this = $(this), jqxhr, $target,
              $url = $this.attr("data-url");
      $target = '#' + $this.attr('data-open');
      console.log('icon-popup-trigger: ' + $url);
      if ($this.hasAttr("data-url")) {
        jqxhr = $.ajax($url)
                .done(function (html) {
                  $this.removeAttr("data-url");
                  console.log("loading (" + $url + ") successfull");
                  $($target).append(html);
                  sphp.iconsFunc($($target).find('[data-url]'));
                })
                .fail(function () {
                  console.error("loading (" + $url + ") failed");
                })
                .always(function () {
                  console.log("loading (" + $url + ") complete");
                });
      }

    });

  };


}(window.sphp = window.sphp || {}, jQuery));

//$(window).bind("load", function () {
//  "use strict";

sphp.initIconLoaders();

//});

