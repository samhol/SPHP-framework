/**
 * @fileOverview jquery plugin pattern (featured)
 *               <p>License MIT</p>
 *               <br>Copyright 2014 Sami Holck
 * @author   Sami Holck
 * @requires jQuery
 */

/**
 * See <a href="https://github.com/lgarron/clipboard-polyfill">GitHub</a>).
 * @name clipboard
 * @class
 * See the clipboard-polyfill Library at (<a href="https://github.com/lgarron/clipboard-polyfill">GitHub</a>)
 * This library library provides an easy way to copy text to the clipboard.
 */

/**
 * See <a href="http://jquery.com">http://jquery.com</a>.
 * @name jQuery
 * @class
 * See the jQuery Library  (<a href="http://jquery.com">http://jquery.com</a>) for full details.  This just
 * documents the function and classes that are added to jQuery by this plug-in.
 */

/**
 * See <a href="http://jquery.com">http://jquery.com</a>
 * @name fn
 * @class
 * See the jQuery Library  (<a href="http://jquery.com">http://jquery.com</a>) for full details.  This just
 * documents the functions and classes that are added to jQuery by this plug-in.
 * @memberOf jQuery
 */

/**
 * The built in string object.
 * @external String
 * @see {@link https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/String String}
 */

if (!window.console) {
  window.console = {};
}
if (!window.console.log) {
  window.console.log = function () {
    'use strict';
  };
}

/**
 * Contains all SPHP functionality.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @namespace sphp
 */
(function (sphp, $, undefined) {
  "use strict";
  var consoleLog = console.log;

  /**
   * Returns the jQuery version number
   *
   * @public
   * @static
   * @returns {String} the jQuery version number
   */
  sphp.jQueryVersion = function () {
    return $.fn.jquery;
  };

  /**
   * Returns the Foundation framework version number
   *
   * @public
   * @static
   * @returns {String} the Foundation framework version number
   */
  sphp.getFoundationVersion = function () {
    return Foundation.version;
  };
  /**
   * Enables or disables browsers console.log messages
   * 
   * @public
   * @static
   * @param   {Boolean} enabled
   * @returns {Boolean} whether the console is enabled or not
   */
  sphp.enableConsole = function (enabled) {
    if (enabled) {
      window.console.log = consoleLog;
    } else {
      window.console.log = function () {};
    }
    return enabled;
  };
  sphp.Exception = function (message) {
    this.message = message;
    this.name = "UserException";
  };
  sphp.Foundation = {
    getProgressBar: function ($name) {
      var $bar = $("[data-sphp-progressbar-name='" + $name + "']");
      if (!$bar) {
        throw "progressbar was fucked up";
      }
      return $bar;
    }
  };


  /**
   * Initializes the clipboard functionality
   * 
   * @public
   * @static
   * @returns {sphp} for fluent interface
   */
  sphp.initClipboard = function () {
    var button = $('[data-clipboard-target]');
    button.click(
            function () {
              var $btn = $(this), $container;
              console.log('content-id: ' + $btn.attr("data-clipboard-target"));
              $container = $($btn.attr("data-clipboard-target"));
              var dt = new clipboard.DT();
              dt.setData("text/plain", $container.text());
              dt.setData("text/html", $container.html());
              clipboard.write(dt);
              $container.sphpPopper({content: "Code is copied to the clipboard"});
            });
    return this;
  };

  sphp.historyBackButtons = function () {
    $('[data-sphp-history-back]').click(function () { //on click event
      //number of days to keep the cookie
      var $this = $(this), $steps = 1;
      $steps = $this.attr('data-sphp-history-back');
      console.log("History steps: " + $steps);
      window.history.go($steps);
    });
  };
  /**
   * Initializes back to top button functionality
   *    
   * @returns {sphp}
   */
  sphp.initBackToTopButtons = function () {
    console.log("sphp.initBackToTopButtons()");
    $('[data-sphp-back-to-top-button]').backToTopController();
    return this;
  };

  /**
   * Initializes all sphp functionality
   *
   * @public
   * @static
   */
  sphp.initialize = function () {
    sphp.enableConsole(true);
    console.log("sphp.initialize() started");
    sphp.initClipboard().initBackToTopButtons();
    sphp.historyBackButtons();
    //var $ajaxLoaders = $("[data-sphp-ajax-url]");

    sphp.setFoundationAbideAddons();
    $(document).foundation();
    console.log("jQuery " + $.fn.jquery + " loaded...");
    console.log("Foundation " + Foundation.version + " loaded...");
    console.log("AnyTime " + AnyTime.version + " loaded...");
    //$ajaxLoaders.sphpAjaxLoader();
    $("[data-sphp-ajax-append]").sphpAjaxAppend();
    $("[data-sphp-ajax-prepend]").sphpAjaxPrepend();
    //$("[data-sphp-foundation-rangeslider]").sphpFoundationRangeSliderValueViewer();
    $('.slider').sphpFoundationSlider();
    /*$ajaxLoaders.on("sphp-ajax-loader-finished", function () {
     console.log("SPHP Ajax loader finished loaded...");
     $(this).foundation();
     //$(this).find(".sphp-viewport-size-viewer").viewportSizeViewer();
     });*/
    //$(".sphp-viewport-size-viewer").viewportSizeViewer();
    $("[data-sphp-qtip]").qtips();
    $('div[data-switch-board]').switchBoard();
    $('.sphp.cookie-banner').cookieBanner();
    // $('.sphp-back-to-top-button').backToTopBtn();
    $("input[data-anytime]").SphpAnyTimeInput();
    $("[data-sphp-ion-slider]").ionRangeSlider({});
    //$("[data-reveal]").sphpPopup();
    $('[data-slick]').slick();
    $('[data-accordion]').on('down.zf.accordion', function () {
      var $accordion = $(this), $sliders;
      //console.log('Foundation Accordion opened!');
      $accordion.lazyLoadXT();
      $sliders = $accordion.find('.slider');
      if ($sliders.length > 0) {
        $sliders.find('.slider').show();
        $sliders.find('.slider').foundation('_reflow');
      }
    });
    $("[data-src]").lazyLoadXT();
    sphp.initReCAPTCHAv3sForm();
    $("[data-sphp-tipso]").sphpTipso();
   // $("[data-sphp-php-info-tipso]").phpInfoTipso();

  };

}(window.sphp = window.sphp || {}, jQuery));

//$(window).bind("load", function () {
//  "use strict";
sphp.initialize();

//});
