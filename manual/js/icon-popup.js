
(function (sphp, $, undefined) {
  "use strict";


  sphp.iconsFunc = function ($icons) {
    console.log('iconsFunc....');
    $icons.click(function () {
      var $this = $(this),
              $url = $this.attr("data-url"),
              $div = $('#icon-info');
      console.log('icon with data-url="' + $url + '" clicked...');
      $div.load($url, function () {
        // $this.removeAttr("data-url");
        console.log("loading (" + $url + ") successfull");
        //sphp.iconsFunc($target.find('[data-url]'));
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
      var $this = $(this), $popup, $target,
              $url = $this.attr("data-url");
      $popup = $('#' + $this.attr('data-open'));
      $target = $popup.find('div.content'); 
              console.log('icon-popup-trigger: ' + $url);
      if ($this.hasAttr("data-url")) {
        $target.load($url, function (response, status, xhr) {
          if (status === "error") {
            var msg = "Sorry but there was an error: ";
            $target.html(msg + xhr.status + " " + xhr.statusText);
          } else {
            $this.removeAttr("data-url");
            console.log("loading (" + $url + ") successfull");
            sphp.iconsFunc($target.find('[data-url]'));
          }
        });
      }

    });
  };

}(window.sphp = window.sphp || {}, jQuery));

sphp.initIconLoaders();
