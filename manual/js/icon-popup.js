
(function (sphp, $, undefined) {
  "use strict";


  sphp.initIconGroupInfo = function ($icons) {
    console.error('...iconsFunc....');
    var $popup = $('#' + $icons.attr('data-sphp-target')),
            $popupContentContainer = $popup.find(".icon-info");
    $icons.click(function () {
      $popupContentContainer.html('<h3>Icongroup information loading...</h3>');
      var $this = $(this),
              $url = $this.attr("data-sphp-url");
      console.log('icon with data-sphp-url="' + $url + '" clicked...');
      $popupContentContainer.load($url, function () {
        // $this.removeAttr("data-url");
        console.log("loading (" + $url + ") successfull");
        var $copyStuff = $popupContentContainer.find('.icon-info-cell');
        $copyStuff.click(function () {
          var $this = $(this), $nameContainer = $('.icon-name'),dt;
          console.log($this.attr('class'));
              console.log('content to copy: ' + $nameContainer.text());
              //$this = $($btn.attr("data-clipboard-target"));
              dt = new clipboard.DT();
              dt.setData("text/plain", $nameContainer.text());
              dt.setData("text/html", $nameContainer.text());
              clipboard.write(dt);
              $this.sphpPopper({content: "Code is copied to the clipboard"});
        });
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
  sphp.initIconGroupLinks = function () {
    console.log('SPHP: initIconLoaders....');
    var triggers = $('[data-sphp-iconset-url]');
    console.log("\t" + triggers);

    triggers.click(function () {
      var $this = $(this), $popup, $target, $url = $this.attr('data-sphp-iconset-url');
      console.log("\tIconSet trigger clicked");
      $popup = $('#' + $this.attr('data-open'));
      $target = $popup.find('div.content');
      console.log('icon-popup-trigger: ' + $url);
      if ($this.hasAttr('data-sphp-iconset-url')) {
        $target.load($url, function (response, status, xhr) {
          if (status === "error") {
            var msg = "Sorry but there was an error: ";
            $target.html(msg + xhr.status + " " + xhr.statusText);
          } else {
            $this.removeAttr('data-sphp-iconset-url');
            console.log("loading URL(" + $url + ") successfull");
            $target.foundation();
            sphp.initIconGroupInfo($target.find('[data-sphp-url]'));
          }
        });
      }

    });
  };

}(window.sphp = window.sphp || {}, jQuery));

sphp.initIconGroupLinks();
