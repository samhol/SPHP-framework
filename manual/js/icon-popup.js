
(function (sphp, $, undefined) {
  "use strict";


  /**
   * @class
   * @classdesc IconsViewer object generator
   * @constructor
   * @param {String} siteId The site id
   * @param {String} selector the selector to the search box(es)
   */
  sphp.IconsViewer = function () {
    this.dt = new clipboard.DT();
    console.log('SPHP: initIconLoaders....');
    return this.initIconGroupLinks();
  };
  sphp.IconsViewer.prototype = {

    /**
     * Runs all the processess needed for the application
     * 
     * @protected
     * @returns {sphp.IconsViewer} self for method chaining
     */
    initIconGroupLinks: function () {
      console.log('SPHP: IconsViewer.initIconGroupLinks()');
      var triggers = $('[data-sphp-iconset-url]'), $app = this;
      console.log("\t" + triggers);

      triggers.click(function () {
        var $this = $(this), $popup, $target, $url = $this.attr('data-sphp-iconset-url');
        $popup = $('#' + $this.attr('data-open'));
        console.log("\tIcon Group trigger (" + $this.attr('data-open') + ") clicked");
        $target = $popup.find('div.content');
        console.log('...and now loading from URL(' + $url + ')');

        if ($this.hasAttr('data-sphp-iconset-url')) {
          $target.load($url, function (response, status, xhr) {
            if (status === "error") {
              var msg = "Sorry but there was an error: ";
              $target.html(msg + xhr.status + " " + xhr.statusText);
            } else {
              $this.removeAttr('data-sphp-iconset-url');
              console.log("loading URL(" + $url + ") successfull");
              $target.foundation();
              $target.find("[data-src]").lazyLoadXT({scrollContainer: $popup.parent()});
              $app.initIconGroupInfo($target.find('[data-sphp-url]'));
            }
          });
        }

      });
      return this;
    },

    /**
     * Sets the selector to the search box(es)
     * 
     * @public
     * @param  {String} $icons the selector to the search box(es)
     * @returns {sphp.IconsViewer} self for method chaining
     */
    initIconGroupInfo: function ($icons) {
      console.log('sphp.IconsViewer.initIconGroupInfo()');
      var $container = $('#' + $icons.attr('data-sphp-target')).find(".icon-group-info"), $dt = this.dt;
      $icons.click(function () {
        $container.html('<h3>Icongroup information loading...</h3>');
        var $this = $(this),
                $url = $this.attr("data-sphp-url");
        console.log('icon with data-sphp-url="' + $url + '" clicked...');
        $container.load($url, function () {
          // $this.removeAttr("data-url");
          console.log("loading (" + $url + ") successfull");
          var $copyStuff = $container.find('.icon-info-cell');
          $copyStuff.click(function () {
            var $this = $(this), $nameContainer = $('.icon-name');
            console.log($this.attr('class'));
            console.log('content to copy: ' + $nameContainer.text());

            $dt.setData("text/plain", $nameContainer.text());
            $dt.setData("text/html", $nameContainer.text());
            clipboard.write($dt);
            $this.sphpPopper({content: "Icon name is copied!"});
          });
        });
      });
    },

    /**
     * Sets the selector where the results should be inserted'} or undefined for layover
     * 
     * @public
     * @param  {String} selector the selector to the search box(es)
     */
    setResult: function (selector) {
      var res;
      if ($('.sphp-ss360-searchResults').length) {
        res = {'contentBlock': '.sphp-ss360-searchResults'}; // it exists
      }
      console.log('setSearchSelector: ' + selector);
      this.config.searchResults = res;
      return this;
    }
  };

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
          var $this = $(this), $nameContainer = $('.icon-name'), dt;
          console.log($this.attr('class'));
          console.log('content to copy: ' + $nameContainer.text());
          //$this = $($btn.attr("data-clipboard-target"));
          dt = new clipboard.DT();
          dt.setData("text/plain", $nameContainer.text());
          dt.setData("text/html", $nameContainer.text());
          clipboard.write(dt);
          $this.sphpPopper({content: "Icon name is copied!"});
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
            $target.find("[data-src]").lazyLoadXT({scrollContainer: $popup.parent()});
            sphp.initIconGroupInfo($target.find('[data-sphp-url]'));
          }
        });
      }

    });
  };

}(window.sphp = window.sphp || {}, jQuery));
new sphp.IconsViewer();
//sphp.initIconGroupLinks();
