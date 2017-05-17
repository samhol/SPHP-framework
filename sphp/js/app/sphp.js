/**
 * @fileOverview jquery plugin pattern (featured)
 *               <p>License MIT</p>
 *               <br>Copyright 2014 Sami Holck
 * @author   Sami Holck
 * @requires jQuery
 */

/**
 * See <a href="http://jquery.com">http://jquery.com</a>.
 * @name ZeroClipboard
 * @class
 * See the ZeroClipboard Library at (<a href="http://zeroclipboard.org/index-v1.x.html">ZeroClipboard v1.x</a>)
 * The ZeroClipboard library provides an easy way to copy text to the clipboard.
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

/**
 * Single accordion open event
 *
 * @event external:$.fn#sph-sa-opened
 */

/**
 * Pattern for class inheritance in JavaScript
 *
 * <b>Notes:</b>
 * The constructor function of the parent class is not inherited.
 * So even if you need it to be called. you have to do it by yourself.
 *
 * @param {Object} base inherited parent class
 */
Function.prototype.subclass = function (base) {
  'use strict';
  var C = Function.prototype.subclass.nonconstructor;
  C.prototype = base.prototype;
  this.prototype = new C();
};
Function.prototype.subclass.nonconstructor = function () {
  'use strict';
};

Function.prototype.inheritsFrom = function (ParentClassOrObject) {
  'use strict';
  if (ParentClassOrObject.constructor == Function) {
    //Normal Inheritance 
    this.prototype = new ParentClassOrObject();
    this.prototype.constructor = this;
    this.prototype.parent = ParentClassOrObject.prototype;
  } else {
    //Pure Virtual Inheritance 
    this.prototype = ParentClassOrObject;
    this.prototype.constructor = this;
    this.prototype.parent = ParentClassOrObject;
  }
  return this;
};

/**
 * Returns the string with every occurence of a given pattern replaced by string.
 *
 * @function external:String#gsub
 * @param  {String} pattern target text to be replaced
 * @param  {String} replacement replacer text
 * @return {String} gsubbed string
 */
String.prototype.gsub = function (pattern, replacement) {
  'use strict';
  var strText = this, intIndexOfMatch = strText.indexOf(pattern);
  while (intIndexOfMatch !== -1) {
    strText = strText.replace(pattern, replacement);
    intIndexOfMatch = strText.indexOf(pattern);
  }
  return strText;
};

if (!window.console) {
  window.console = {};
}
if (!window.console.log) {
  window.console.log = function () {
    'use strict';
  };
}

/**
 * Contains all sph functionality.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @name sphp
 * @namespace sphp
 */
(function (sphp, $, undefined) {
  "use strict";
  var consoleLog = console.log, foundationVersion;

  /**
   * Returns the jQuery version number
   *
   * @public
   * @static
   * @memberOf sphp
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
   * @memberOf sphp
   * @returns {String} the Foundation framework version number
   */
  sphp.getFoundationVersion = function () {
    //console.log("sphp.getFoundationVersion():" + Foundation.version);
    return Foundation.version;
  };
  /**
   * Enables or disables browsers console.log messages
   * 
   * @public
   * @static
   * @memberOf sphp
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

  sphp.initClipboard = function () {
    if (Clipboard.isSupported()) {
      var clipboard = new Clipboard('[data-clipboard-target]');
      clipboard.on('success', function (e) {
        var $this = $(e.trigger), $container = $($this.attr("data-clipboard-target"));
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);
        $container.sphpPopper({content: "Code is copied to the clipboard"});
        e.clearSelection();
      });
      clipboard.on('error', function (e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
      });
    }
    return this;
  };

  /**
   * Initializes all sph functionality
   *
   * @public
   * @static
   * @memberOf sphp
   * @param  {String} http_root the http root url of the application
   */
  sphp.initialize = function () {
    sphp.enableConsole(true);
    console.log("sphp.initialize()");
    sphp.initClipboard();
    var $ajaxLoaders = $("[data-sphp-ajax-url]");
    console.log("loaded");

    $(document).foundation();
    console.log("jQuery " + $.fn.jquery + " loaded...");
    console.log("Foundation " + Foundation.version + " loaded...");
    console.log("AnyTime " + AnyTime.version + " loaded...");
    $ajaxLoaders.sphpAjaxLoader();
    $ajaxLoaders.on("sphp-ajax-loader-finished", function () {
      console.log("SPHP Ajax loader finished loaded...");
      $(this).foundation();
      $(this).find(".sphp-viewport-size-viewer").viewportSizeViewer();
    });
    $(".sphp-viewport-size-viewer").viewportSizeViewer();

    $("[data-sphp-qtip]").qtips();
    $('.sphp-back-to-top-button').backToTopBtn();
    $("input[data-anytime]").dateTimeInput();
    $("[data-ion-rangeslider]").initIonRangeSlider();
    $("[data-sphp-ion-slider]").ionRangeSlider({});
    $("[data-reveal]").sphpPopup();

    $('[data-accordion]').on('down.zf.accordion', function () {
      console.log('Foundation Accordion opened!');
      $(this).lazyLoadXT();
    });
    $("[data-src]").lazyLoadXT();

  };

}(window.sphp = window.sphp || {}, jQuery));

