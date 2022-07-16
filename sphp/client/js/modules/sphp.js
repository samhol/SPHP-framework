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
   * @returns void
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
    console.log("... sphp.initClipboard running");
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
   * @public
   * @static
   * @returns void
   */
  sphp.initBackToTopButtons = function () {
    $('[data-sphp-back-to-top-button]').backToTopController();
    console.log("... Back to top buttons intialized.");
  };

  /**
   * Initializes cookie banner functionality
   * 
   * @public
   * @static
   * @returns void
   */
  sphp.initCookieBanner = function () {
    $('.sphp.cookie-banner-container').cookieBanner();
    console.log("... Cookie Banner intialized!");
  };
  /**
   * Initializes back to top button functionality
   *    
   * @returns {sphp} 
   */
  sphp.initSphp = function () {
    console.log("sphp initSphp()");

    $('.card.card-reveal-wrapper').find('.card-open-button').click(function () {
      console.log('.card-open-button clicked');
      $(this).siblings('.card-reveal').toggleClass('open');
    });

    $('.card.card-reveal-wrapper').find('.card-close-button').click(function () {
      $(this).parent().parent('.card-reveal').toggleClass('open');
    });
    return this;
  };
  /**
   * Sets an onload event
   * 
   * @public
   * @static
   * @param   {function} func
   */
  sphp.addLoadEvent = function (func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
      window.onload = func;
    } else {
      window.onload = function () {
        if (oldonload) {
          oldonload();
        }
        func();
      };
    }
  };


  /**
   * Initializes all sphp functionality
   *
   * @public
   * @static
   */
  sphp.initialize = function () {
    //sphp.enableConsole(false);
    console.groupCollapsed('SPHPlayground init started...:');
    sphp.initClipboard();
    sphp.initBackToTopButtons();
    sphp.historyBackButtons();
    sphp.initCookieBanner();
    if (jQuery()) {
      console.log("... jQuery " + $.fn.jquery + " loaded!");
    }
    //$ajaxLoaders.sphpAjaxLoader();

    //console.log("Foundation " + typeof Foundation + " loaded...");
    if (jQuery().switchBoard) {
      $('div[data-switch-board]').switchBoard();
      $('.switch-board').switchBoard();
      console.log("...sphp.switchBoard loaded!");
    }
    if (jQuery().AnyTime_picker) {
      console.log("...AnyTime " + AnyTime.version + " loaded!");
      $("input[data-anytime]").SphpAnyTimeInput();
    }
    if (jQuery().ionRangeSlider) {
      $("[data-sphp-ion-slider]").ionRangeSlider({});
      console.log("... jQuery.ionRangeSlider loaded!");
    }
    if (jQuery().tipso) {
      $("[data-sphp-tipso]").sphpTipso();
      console.log("... jQuery.tipso loaded!");
    }
    if (jQuery().slick) {
      $('[data-slick]').slick();
      console.log("...jQuery.slick loaded!");
    }

    console.groupEnd();
    document.addEventListener('securitypolicyviolation',
            console.error.bind(console));
    // $("[data-sphp-php-info-tipso]").phpInfoTipso();

  };


}(window.sphp = window.sphp || {}, jQuery));

sphp.initialize();
