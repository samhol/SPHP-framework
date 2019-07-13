
/**
 * Contains sphp.TechLinks functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @name manual
 * @namespace manual
 */
;
(function (manual, $, undefined) {
  "use strict";

  /**
   * 
   */
  manual.techLinksList = function () {
    //var $irs;
    console.log("manual.TechLinks() v2");
    var $phpTitle = '<strong>PHP</strong> <var>' + php.version + '</var>',
            $content = $('<strong>Execution time:</strong> <var>' + php.execTime + ' s</var><br><strong>Peak memory:</strong> <var>' + php.memory + ' MB</var>');
    $(".tech-links-list .php").tipso({
      titleContent: $phpTitle,
      background: '#4F5B93',
      content: $content,
      width: null, 
      maxWidth: 200
    });
    $(".tech-links-list .html5").tipso({
      titleContent: 'HTML5',
      background: '#F16529',
      content: 'validation sevice',
      width: null, 
      maxWidth: 200
    });
    $(".tech-links-list .css3").tipso({
      titleContent: 'CSS3',
      background: '#1779ba',
      content: 'validation sevice',
      width: null, 
      maxWidth: 200
    });
    $(".tech-links-list .jQuery").tipso({
      titleContent: 'jQuery',
      content: "version: " + $.fn.jquery,
      width: null, 
      maxWidth: 200, onShow : function(a,b){
        $(a).addClass('foo');
        $(b).addClass('foo');
    console.log('This is beforeShow');
  }
    });
    $(".tech-links-list .foundation").tipso({
      titleContent: 'Foundation for sites',
      background: '#1779ba',
      content: "version: " + Foundation.version,
      width: null, 
      maxWidth: 200
    });
  };

}(window.manual = window.manual || {}, jQuery));
$(window).bind("load", function () {
  "use strict";
  manual.techLinksList();

});
 