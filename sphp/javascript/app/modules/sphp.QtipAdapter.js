/**
 * QtipAdapter.js (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 *
 * Requires <a href="http://jquery.com/">jQuery+</a>
 * 
 */
(function ($) {
  'use strict';

  /**
   * Manages Qtips
   * 
   * @memberOf jQuery.fn#
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.qtips = function () {
    return this.each(function () {
      var $this = $(this), $classes, $settings = {};
      $classes = $this.attr('data-sphp-qtip-classes');
      function parsePosition(obj) {
        obj.position = {};
        if ($this.attr('data-sphp-qtip-viewport')) {
          obj.position.viewport = $($this.attr('data-sphp-qtip-viewport'));
        }
        obj.position.adjust = {
          method: 'shift none'
        };
        if ($this.attr('data-sphp-qtip-my')) {
          obj.position.my = $this.attr('data-sphp-qtip-my');
        } else {
          obj.position.my = 'center left';
        }
        if ($this.attr('data-sphp-qtip-at')) {
          obj.position.at = $this.attr('data-sphp-qtip-at');
        } else {
          obj.position.at = 'center right';
        }
        obj.position.target = $this;
        //console.log(position);
        return obj;
      }
      function parseContent(obj) {
        if ($this.attr('data-sphp-qtip-content')) {
          var id = $this.attr('data-sphp-qtip-content');
          obj.content = {};
          obj.content.text = $('#' + id);
        }
        return obj;
      }
      parsePosition($settings);
      parseContent($settings);
      //console.log($settings);
      $settings.style = {classes: 'qtip-dark qtip-rounded'};
      $this.qtip($settings);
    });
  };
}(jQuery));
