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
  var $httpRoot = "", consoleLog = console.log, foundationVersion;

  /**
   * Sets the http root path to be used in the sphp namespace
   * 
   * @public
   * @static
   * @memberOf sphp
   * @param   {String} httpRoot the http root path to be used in the sphp namespace
   * @returns {undefined}
   */
  sphp.setHttpRoot = function (httpRoot) {
    console.log(window.location.href);
    console.log("sphp.setHttpRoot(" + httpRoot + ")");
    $httpRoot = httpRoot;
  };

  /**
   * Returns the http root path to be used in the sphp namespace
   *
   * @public
   * @static
   * @memberOf sphp
   * @returns {String} httpRoot the http root path to be used in the sphp namespace
   */
  sphp.getHttpRoot = function () {
    console.log("sphp.getHttpRoot():" + $httpRoot);
    return $httpRoot;
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
    console.log("sphp.getFoundationVersion():" + Foundation.version);
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
        throw new "progressbar was fucked up";
      }
      return $bar;
    }
  };



  function handleFoundationSliders() {
    $('[data-slider]').on('change', function () {
      var slider = $(this),
              input = slider.find("input[type='hidden']"),
              viewer = slider.siblings("label").find(".sphp-range-slider-value"),
              currentValue = slider.attr('data-slider');
      //console.log(input.attr("type") + ": " + slider.attr('data-slider'));
      input.attr("value", currentValue);
      //slider.attr("title", currentValue);
      viewer.html(currentValue);
    });
  }

  sphp.initGlyphs = function () {
    var $before = $("[data-sphp-icon-before]");
    $before.iconBefore($before.attr("data-sphp-icon-before")).addClass("sphp-icon-left");
    var $after = $("[data-sphp-icon-after]");
    $after.iconAfter($after.attr("data-sphp-icon-after"));

  };

  /**
   * Initializes all sph functionality
   *
   * @public
   * @static
   * @memberOf sphp
   * @param  {String} http_root the http root url of the application
   */
  sphp.initialize = function (http_root) {
    //sphp.enableConsole(false);
    console.log("sphp.initialize(" + http_root + ")");
    sphp.setHttpRoot(http_root);
    $.fn.sphpImageResizer.IMAGE_APP = http_root + "image.php";
    //stickyFooter();
    //intBackToTop();
    //$(document).ready(function () {
    console.log("loading ZeroClipboard.swf from:" + http_root + 'sphp/js/vendor/ZeroClipboard.swf');
    ZeroClipboard.config({swfPath: http_root + 'sphp/js/vendor/ZeroClipboard.swf'});
    var $ajaxLoaders = $("[data-sphp-ajax-url]");
    console.log("loaded");
    //alert($(document) + "init Foundation");
    //sphp.initGlyphs();
    $('[data-sphp-qtip][title!=""]').qtip({// Grab all elements with a non-blank data-tooltip attr.
      content: {
        attr: 'title' // Tell qTip2 to look inside this attr for its content
      }
    });
    $(document).foundation();

    console.log("Foundation loaded...");
    $ajaxLoaders.sphpAjaxLoader();
    $ajaxLoaders.on("sphp-ajax-loader-finished", function () {
      console.log("SPHP Ajax loader finished loaded...");
      $(this).foundation();
      $(this).find(".sphp-viewport-size-viewer").viewportSizeViewer();
    });
    $(".sphp-viewport-size-viewer").viewportSizeViewer();

    $("[data-sphp-qtip]").qtips();
    //  if ($(document).foundation()) {
    // $(document).foundation();
    //handleFoundationSliders();
    //}
    //$(".footer").stickToBottom();
    $('.sphp-back-to-top-button').backToTopBtn();
    $("input[data-anytime]").dateTimeInput();
    //syntaxHighlighterAccordion();
    //$("[data-sph-load]").sphLoadContent();
    $("[data-ion-rangeslider]").initIonRangeSlider();
    $("[data-sphp-ion-slider]").ionRangeSlider({});
    $("[data-sphp-single-accordion='syntaxHighlighter']").syntaxHighLighterAccordion();
    $("[data-reveal]").sphpPopup();
    /*$("[data-sph-single-accordion]").on('sphp-single-accordion-opened', function() {
     $(this).lazyLoadXT();
     });*/
    $('[data-accordion]').on('down.zf.accordion', function () {
      console.log('Foundation Accordion opened!');
      $(this).lazyLoadXT();
    });
    $("[data-clipboard-target]").copyToClipboardButton();
    $("[data-src]").lazyLoadXT();
    $("img[data-sphp-img-resize]").sphpImageResizer();
    sphp.enableConsole(true);
    // var $form = new sphp.ValidableForm($('form[data-sphp-validate]'));
    //});
  };
  sphp.EVENTS = {
    SINGLE_ACCORDION: {
      OPENED: 'sphp-single-accordion-opened',
      CLOSED: 'sphp-single-accordion-closed'
    }
  };

}(window.sphp = window.sphp || {}, jQuery));
//sphp.initializeAll();
//\sph\js\vendor
