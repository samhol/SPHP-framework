/**
 * commonJqueryPlugins.js (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery (1.8.2)+</a>
 * 
 */
(function ($) {
  'use strict';
  $.fn.outerHTML = function (arg) {
    var ret;
    // If no items in the collection, return
    if (!this.length) {
      return typeof arg === "undefined" ? this : null;
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
   * Lomakkeen tekstisyötteen sisällön siistijä
   *
   * @author   Sami Holck <sami.holck@gmail.com>
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

}(jQuery));



