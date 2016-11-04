/**
 * Contains all sph functionality.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @name sphp
 * @namespace sphp
 */
(function (sphp, $, undefined) {
  "use strict";
  sphp.EVENTS = {
    SINGLE_ACCORDION: {
      OPENED: 'sphp-single-accordion-opened',
      CLOSED: 'sphp-single-accordion-closed'
    },
    AJAX_LOADER: {
      FINISHED: 'sphp-ajax-loader-finished'
    }
  };
}(window.sphp = window.sphp || {}, jQuery));



/**
 * commonJqueryPlugins.js (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery (1.8.2)+</a>
 * 
 * @namespace $
 */
(function ($) {
  'use strict';
  $.fn.outerHTML = function (arg) {
    var ret;
    // If no items in the collection, return
    if (!this.length) {
      return typeof arg == "undefined" ? this : null;
    }
    // Getter overload (no argument passed)
    if (!arg) {
      return this[0].outerHTML ||
              (ret = this.wrap('<div>').parent().html(), this.unwrap(), ret);
    }
    // Setter overload
    $.each(this, function (i, el) {
      var fnRet,
              pass = el,
              inOrOut = el.outerHTML ? "outerHTML" : "innerHTML";

      if (!el.outerHTML) {
        el = $(el).wrap('<div>').parent()[0];
      }
      if ($.isFunction(arg)) {
        if ((fnRet = arg.call(pass, i, el[inOrOut])) !== false) {
          el[inOrOut] = fnRet;
        }
      } else {
        el[inOrOut] = arg;
      }
      if (!el.outerHTML) {
        $(el).children().unwrap();
      }
    });
    return this;
  };
  /**
   * 
   * @returns {Array|String|@this;@pro;value}
   */
  $.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
      if (o[this.name] !== undefined) {
        if (!o[this.name].push) {
          o[this.name] = [o[this.name]];
        }
        o[this.name].push(this.value || '');
      } else {
        o[this.name] = this.value || '';
      }
    });
    return o;
  };

  /**
   * Replaces the selected part of the attribute value
   *
   * @memberOf jQuery.fn#
   * @method   gsubAttr
   * @param    {String} attr the name of the attribute
   * @param    {String} find the replaceable content
   * @param    {String} replace the replacer
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.gsubAttr = function (attr, find, replace) {
    return this.each(function () {
      var $this = $(this), $attrValue = $this.attr(attr);
      $this.attr(attr, $attrValue.gsub(find, replace));
    });
  };

  /**
   * Loads the data from the server pointed on the data attribute 'data-sph-load' using 
   * jQuery's Ajax capabilities and places the returned HTML into the object.
   * 
   * @memberOf jQuery.fn#
   * @method   sphLoadContent
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpAjaxLoader = function () {
    return this.each(function () {
      var $this = $(this),
              $url = $this.attr("data-sphp-ajax-url"),
              $op = $this.attr("data-sphp-ajax-op"),
              $content = $("<div>");
      //$this.addWaitLoader();
      if ($op === "replace") {
        $this.addWaitLoader();
        console.log("sphpAjaxLoader");
      }
      $content = $("<div>").load($url, function (response, status, xhr) {
        if (status === "error") {
          $("#error").html("<strong>ERROR</strong> while loading resource: " + xhr.status + " " + xhr.statusText);
          $content.html(
                  "<strong>ERROR</strong> while loading resource: '<u><var>"
                  + $url + "</var></u>'<br> <strong>"
                  + xhr.status + " " + xhr.statusText + "</strong>");
        }
        if ($op === "append") {
          $this.append($content.html());
        } else if ($op === "prepend") {
          $this.prepend($content.html());
        } else if ($op === "replace") {
          $this.html($content.html());
        }
        $this.trigger("sphp-ajax-loader-finished");
      });
    });
  };

  /**
   * Loads the data from the server pointed on the data attribute 'data-sph-load' using 
   * jQuery's Ajax capabilities and places the returned HTML into the object.
   * 
   * @memberOf jQuery.fn#
   * @method   sphLoadContent
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphLoadContent = function () {
    return this.each(function () {
      var $this = $(this), $url = $this.attr("data-sph-load");
      $this.addWaitLoader();
      $this.load($url, function (response, status, xhr) {
        if (status === "error") {
          $this.html(
                  "<strong>ERROR</strong> while loading resource: '<u><var>"
                  + $url + "</var></u>'<br> <strong>"
                  + xhr.status + " " + xhr.statusText + "</strong>");
        }
      });
    });
  };


  /**
   * Sticks a component to the ottom of the document
   * 
   * @memberOf jQuery.fn#
   * @method   sphLoadContent
   * @returns  {jQuery.fn} object for method chaining
   * @deprecated if Foundation 6 is in use
   */
  $.fn.stickToBottom = function () {
    return this.each(function () {
      console.log("stickToBottom:");
      var $this = $(this);
      function stick() {
        var pos, height;
        pos = $this.position();
        height = $(window).height();
        height = height - pos.top;
        height = height - $this.outerHeight();
        console.log("stickToBottom:" + height + 'px');
        if (height > 0) {
          console.log("footer height:" + height + 'px');
          $this.css({'margin-top': height + 'px'});
        }
      }
      stick();
      $(window).resize(function () {
        stick();

      });
    });
  };


  /**
   * Copies the content of the HTML component to the clipboard
   * 
   * @memberOf jQuery.fn#
   * @method   copyToClipboardButton
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.copyToClipboardButton = function () {
    return this.each(function () {
      var $this = $(this), clip = new ZeroClipboard($this),
              $container = $("#" + $this.attr("data-clipboard-target"));
      console.log("Initializing ZeroClipboard v " + ZeroClipboard.version);
      clip.on("ready", function (e) {
        console.log(e.message);
      });
      clip.on("aftercopy", function (e) {
        console.log($this.attr("data-clipboard-target"));
        $container.sphpPopper({content: "Code is copied to the clipboard"});
        console.log("Text copied to clipboard");
      });
      clip.on("error", function (e) {
        $this.hide();
        console.log(e.message);
      });
    });
  };

  /**
   * Shows a quick popup text over the element
   * 
   * @memberOf jQuery.fn#
   * @method   sphpPopper
   * @param    {Object} options {content: String the content of the popper,
   *                           delay: int visibility time (default 3000 ms)}
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpPopper = function (options) {
    var opts = $.extend({}, $.fn.sphpPopper.defaults, options);
    return this.each(function () {
      var $this = $(this), popper, $o;
      $o = $.meta ? $.extend({}, opts, $this.data()) : opts;
      popper = $('<div class="sphp-popper" style="visibility: hidden;">' + $o.content + '</div>');
      console.log("append popper");
      popper.appendTo($this)
              .centerTo($this, true)
              .css({
                zIndex: $o.zIndex,
                visibility: "visible"
              })
              .hide()
              .fadeIn($o.delay, "linear", function () {
                setTimeout(function () {
                  popper.fadeOut($o.delay, "linear", function () {
                    popper.remove();
                  });
                }, $o.show);
              });
    });
  };
  $.fn.sphpPopper.defaults = {
    zIndex: 20000,
    delay: 500,
    show: 2000,
    content: 'This is the popper!'
  };

  /**
   * Shows a quick popup text over the element
   * 
   * @memberOf jQuery.fn#
   * @method   sphpImageResizer
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpImageResizer = function () {
    return this.each(function () {
      var $this = $(this), $url, $operation, $o, $query;
      console.log("sphpImageResizer:");
      $query = {
        operation: 0,
        ratio: 1,
        width: null,
        height: null
      };
      $query = Foundation.utils.data_options($this, "sphp-img-resize");
      //console.log($.fn.sphpImageResizer.IMAGE_APP + "?" + $.param($query));
      $query.src = $this.attr("src");
      //console.log($.param($query));
      $this.attr("src", $.fn.sphpImageResizer.IMAGE_APP + "?" + $.param($query));
      $this.css('visibility', "visible");
    });
  };
  $.fn.sphpImageResizer.RESIZE = 1;
  $.fn.sphpImageResizer.SCALE = 2;
  $.fn.sphpImageResizer.SCALE_TO_FIT = 4;
  $.fn.sphpImageResizer.defaults = {
    operation: 0,
    ratio: 1,
    width: null,
    height: null
  };

  /**
   * Shows the mouse coordinates when ever the mouse is onver the containing document
   * 
   * @memberOf jQuery.fn#
   * @method   sphMouseCoordinatesViewer
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphMouseCoordinatesViewer = function () {
    return this.each(function () {
      var $this = $(this),
              xSpan = $this.find(".x"),
              ySpan = $this.find(".y");
      $("body").mousemove(function (event) {
        //console.log(event.clientX + ", " + event.clientY);
        xSpan.text(event.clientX);
        ySpan.text(event.clientY);
      });
    });
  };

  /**
   * Shows the viewport size of the containing document
   * 
   * @memberOf jQuery.fn#
   * @method   viewportSizeViewer
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.viewportSizeViewer = function () {
    return this.each(function () {
      console.log("$.fn.viewportSizeViewer()");
      var $this = $(this), xSpan, ySpan;

      //$content = $("<span>");
      $this.html('<span class="x"></span> x <span class="y"></span> px');
      //$this.append($content.html());

      xSpan = $this.find(".x");
      ySpan = $this.find(".y");
      function setValues() {
        console.log("width: " + $(window).width() + "px, height: " + $(window).height() + "px");
        xSpan.text($(window).width());
        ySpan.text($(window).height());
      }
      setValues();
      $(window).resize(function () {
        setValues();
      });
    });
  };

  /**
   * Sets the component as an single accordion
   * 
   * @memberOf jQuery.fn#
   * @method   singleAccordion
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.singleAccordion = function () {
    return this.each(function () {
      var $this = $(this),
              head = $this.children(".head"),
              body = $this.children(".body");
      if (!head.hasClass("active")) {
        body.hide();
        head.addClass("inactive");
      }
      head.click(function (event) {
        console.log("singleAccordion.click()");
        var $head = $(this), $node = $(event.target);
        function setActive() {
          if ($head.hasClass("active")) {
            $head.removeClass("active").addClass("inactive");
            $this.trigger(sphp.EVENTS.SINGLE_ACCORDION.CLOSED);
          } else {
            $head.addClass("active").removeClass("inactive");
            $this.trigger("sphp-single-accordion-opened");
          }
        }
        if (!$node.hasClass("copy")) {
          //console.log($node);
          body.slideToggle("slow", function () {
            setActive();
          });
        }
      });
      $this.on('sphp-single-accordion-opened', function () {
        console.log('sphp-single-accordion-opened');
        $this.lazyLoadXT();
      });
    });
  };

  /**
   * Sets the highlighter component as an single accordion
   * 
   * @memberOf jQuery.fn#
   * @method   syntaxHighLighterAccordion 
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.syntaxHighLighterAccordion = function () {
    return this.each(function () {
      var $this = $(this),
              head = $this.children(".head"),
              button = $this.find(".head button");

      if (!head.hasClass("active")) {
        button.hide();
      }
      $this.on("sphp-single-accordion-opened", function () {
        button.fadeIn("slow");
      });
      $this.on("sphp-single-accordion-closed", function () {
        button.fadeOut("slow");
      });
    });
  };

  /**
   * Sets the dateTimeInput
   * 
   * @memberOf jQuery.fn#
   * @method   dateTimeInput
   * 
   * @returns {$.fn} self for method chaining
   */
  $.fn.dateTimeInput = function () {
    return this.each(function () {
      var $this = $(this), datetime_fi_locale = {
        format: "%d.%m.%Y %H:%i",
        firstDOW: 1,
        labelTitle: "Valitse päivämäärä ja kellonaika",
        labelYear: "Vuosi",
        labelMonth: "Kuukausi",
        labelDayOfMonth: "Päivä",
        labelHour: "Tunnit",
        labelMinute: "Minuutit",
        labelSecond: "Sekunnit",
        dayAbbreviations: ["Su", "Ma", "Ti", "Ke", "To", "Pe", "La"],
        dayNames: ["Sunnuntai", "Maanantai", "Tiistai", "Keskiviikko", "Torstai", "Perjantai", "Lauantai"],
        monthAbbreviations: ["Tam", "Hel", "Maa", "Huh", "Tou", "Kes", "Hei", "Elo", "Syy", "Lok", "Mar", "Jou"],
        monthNames: ["Tammikuu", "Helmikuu", "Maaliskuu", "Huhtikuu", "Toukokuu", "Kesäkuu", "Heinäkuu", "Elokuu", "Syyskuu", "Lokakuu", "Marraskuu", "Joulukuu"]
      }, $input = $("input[data-anytime]"),
              locale = {
                format: "%Y-%m-%d %H:%i",
                firstDOW: 1
              };
      console.log($input.attr("data-locale"));
      if ($this.attr("data-locale") === "fi") {
        locale = datetime_fi_locale;
        console.log(locale);
      }
      if ($this.attr("data-format")) {
        locale.format = $input.attr("data-format");
      }
      console.log(locale);
      $this.AnyTime_picker(locale);
    });
  };

  /**
   * Sets the dateTimeInput
   * 
   * @memberOf jQuery.fn#
   * @method   backToTopBtn
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.backToTopBtn = function () {
    return this.each(function () {
      var $this = $(this), offset = 220, duration = 500;
      $(window).scroll(function () {
        if ($(this).scrollTop() > offset) {
          $this.fadeIn(duration);
        } else {
          $this.fadeOut(duration);
        }
      });
      $this.click(function () {
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
      });
    });
  };

  /**
   * Centers the  given element against the given element
   * 
   * <b>Notes:</b> the centerized {@link jQuery.fn} component has also the following CSS settings after execution:
   * 
   * <var>{display: block, position: absolute}</var>
   * 
   * @memberOf jQuery.fn#
   * @method   centerTo
   * @param    {String|jQuery.fn} what a selector, or jQuery to use as context to center
   * @param    {boolean} remember whether the centering should be rememebered when resizing or not (optionla: default value FALSE)
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.centerTo = function (what, remember) {
    return this.each(function () {
      var $this = $(this), el = $(what);
      function centerize() {
        $this.css({
          display: "block",
          position: "absolute"
        });
        console.log($this.css("display") + ":" + $this.width());
        var pos = el.position(),
                x = Math.floor(pos.left + (el.width() - $this.width()) / 2),
                y = Math.floor(pos.top + (el.height() - $this.height()) / 2);
        $this.css({
          left: x + "px",
          top: y + "px"
        });
      }
      centerize();
      if (remember === true) {
        $(window).resize(centerize);
      }
    });

  };
  /**
   * Peittää ruudun asettalla div.Fog-elementin annettuihin jQuery-objekteihin.
   * Kaikki elementit, joiden z-indeksi on pienempi kuin $z_index-parametri
   * jäävät piiloon.
   *
   * @author   Sami Holck <sami.holck@gmail.com>
   * @update   2012-09-23
   * @memberOf jQuery.fn#
   * @method   addFog
   * @param    {Object} options {zIndex: int div.Fog-elementin z-indeksi (oletus 20000),
   *                           delay: int esiintuloefektin kesto millisekunneissa (oletus 1000 ms)}
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.addFog = function (options) {
    var opts = $.extend({}, $.fn.addFog.defaults, options);
    return this.each(function () {
      var $this = $(this), $fog, $o;
      $o = $.meta ? $.extend({}, opts, $this.data()) : opts;
      $fog = $('<div class="Fog"></div>');
      $fog.css("zIndex", $o.zIndex);
      $fog.appendTo($this);
      $fog.fadeIn($o.delay);
    });
  };
  $.fn.addFog.defaults = {
    zIndex: 20000,
    delay: 1000
  };

  /**
   * Poistaa div.Fog-elementin annettuista jQuery-objekteista
   *
   * @author   Sami Holck <sami.holck@gmail.com>
   * @since    2012-09-23
   * @memberOf jQuery.fn#
   * @method   removeFog
   * @param    {Object} options {delay: int postumisefektin kesto millisekunneissa (oletus 1000 ms)}
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.removeFog = function (options) {
    var opts = $.extend({}, $.fn.removeFog.defaults, options);
    return this.each(function () {
      var $this = $(this), $fog = $this.find(".Fog"), $o;
      $o = $.meta ? $.extend({}, opts, $this.data()) : opts;
      $fog.fadeOut($o.delay, function () {
        $fog.remove();
      });
    });
  };
  $.fn.removeFog.defaults = {
    delay: 1000
  };

  /**
   * Sets the loader element (an animated gif image) to the given {@link jQuery.fn}.
   *
   * @author   Sami Holck <sami.holck@gmail.com>
   * @since    2012-09-23
   * @memberOf jQuery.fn#
   * @method   addWaitLoader
   * @param    {Object} options {z_index: int div.WaitLoader-elementin z-indeksi (oletus 20000),
   *                          duration: int appearance duration in ms (default: 1000 ms)}
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.addWaitLoader = function (options) {
    var opts = $.extend({}, $.fn.addWaitLoader.defaults, options);
    return this.each(function () {
      var $this = $(this), $loader, $o;
      $o = $.meta ? $.extend({}, opts, $this.data()) : opts;
      $loader = $('<div class="sphp-loader"><img src="sphp/pics/spinner.gif" alt="Loading..."></div>');
      $loader.css("z-index", $o.zIndex);
      $loader.appendTo($this);
      $loader.fadeIn($o.duration);
    });
  };
  $.fn.addWaitLoader.defaults = {
    z_index: "inherit",
    duration: 1000
  };

  /**
   * Poistaa div.WaitLoader-elementin annettuista jQuery-objekteista.
   *
   * @author   Sami Holck <sami.holck@gmail.com>
   * @since    2012-09-23
   * @memberOf jQuery.fn#
   * @method   removeWaitLoader
   * @param    {Object} options {duration: int postumisefektin kesto millisekunneissa (oletus 1000 ms)}
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.removeWaitLoader = function (options) {
    var opts = $.extend({}, $.fn.removeWaitLoader.defaults, options);
    return this.each(function () {
      var $this = $(this), $loader = $this.find(".sphp-loader"), $o;
      $o = $.meta ? $.extend({}, opts, $this.data()) : opts;
      $loader.fadeOut($o.duration, function () {
        $loader.remove();
      });
    });
  };
  $.fn.removeWaitLoader.defaults = {
    duration: 1000
  };


  /**
   * Lomakkeen tekstisyötteen sisällön siistijä
   *
   * @author   Sami Holck <sami.holck@gmail.com>
   * @since    2012-09-11
   * @memberOf jQuery.fn#
   * @method   cleanVal
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.cleanVal = function () {
    return this.each(function () {
      var $this = $(this), trimmed = $this.val().replace(/^\s+|\s+$/g, '');
      trimmed = trimmed.replace(/(\ {2,})/g, ' ');
      $this.val(trimmed);
    });
  };

  /**
   * Sets popups default javascript functionality
   *
   * Requires <a href="http://jqueryui.com/">jQuery UI (1.8.19)+ </a>
   *
   * @author   Sami Holck <sami.holck@gmail.com>
   * @since    2012-09-11
   * @memberOf jQuery.fn#
   * @method   sphpPopup
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpPopup = function () {
    this.each(function () {
      var $popup = $(this), $closers = $popup.find('[name="close"]');
      $closers = $("[data-sphp-foundation-modal-close]");
      $closers.click(function () {
        var $popupId = $(this).attr("data-sphp-foundation-modal-close");
        $('#' + $popupId).foundation('reveal', 'close');
      });
      console.log("data-sphp-modal-default-closer:" + $popup.attr("data-sphp-modal-default-closer"));
      if ($popup.attr("data-sphp-modal-default-closer") !== undefined) {
        $popup.append('<a class="close-reveal-modal" aria-label="Close">&#215;</a>');
      }
    });
    return this;
  };

  /**
   * Inserts an font icon before the inner contents of the componenet
   *
   * @memberOf jQuery.fn#
   * @method   iconhBefore
   * @param    {String} classes One or more space-separated classes to be added 
   *           to the class attribute of each matched element.
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.iconBefore = function (classes) {
    return this.each(function () {
      $(this).prepend($("<i>").addClass(classes));
    });
  };

  /**
   * Inserts an font icon after the inner contents of the componenet
   *
   * @memberOf jQuery.fn#
   * @method   iconAfter
   * @param    {String} classes One or more space-separated classes to be added 
   *           to the class attribute of each matched element.
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.iconAfter = function (classes) {
    return this.each(function () {
      $(this).append($("<i>").addClass(classes));
    });
  };

  /**
   * Shows the mouse coordinates when ever the mouse is onver the containing document
   * 
   * @memberOf jQuery.fn#
   * @method   sphMouseCoordinatesViewer
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.qtips = function () {
    return this.each(function () {
      var $this = $(this), $classes;
      $classes = $this.attr('data-sphp-qtip-classes');
      function parsePosition() {
        var position = {};
        if ($this.attr('data-sphp-qtip-my')) {
          position.my = $this.attr('data-sphp-qtip-my');
        } else {
          position.my = 'center left';
        }
        if ($this.attr('data-sphp-qtip-at')) {
          position.at = $this.attr('data-sphp-qtip-at');
        } else {
          position.at = 'center right';
        }
        position.target = $this;
        //console.log(position);
        return position;
      }
      console.log({
        style: {
          classes: 'qtip-dark qtip-rounded'
        },
        position: parsePosition()
      });
      $this.qtip({
        style: {
          classes: 'qtip-dark qtip-rounded'
        },
        position: parsePosition()
      });
    });

  };
}(jQuery));



